var objAjax = criarObj();

function criarObj(){
	if(window.XMLHttpRequest){
		var obj = new XMLHttpRequest();
		return obj;
	} 
	else 
		return false;
}

function buscarDados(dest, objReq, objFonte){
	if(objReq){
		var campo = objFonte.name+"="+objFonte.value;
		objReq.open("POST", dest, true);
		objReq.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		objReq.send(campo);
	}
	else
		alert("Objeto de requisição AJAX inválido");
}

function limparResultados(elemento){
	while (elemento.childNodes.length > 0 ){
		elemento.removeChild(elemento.childNodes[0]);
	}
}

function reqHoteis(fonte){
	objAjax.onreadystatechange = atualizarTabela;
	buscarDados("controller/hoteisAJAX.php", objAjax, fonte);
	return false;
}

function atualizarTabela(){
	if(objAjax.readyState==4){
		if(objAjax.status==200){
			var corpo = document.getElementById("tbCorpo");   
			limparResultados(corpo);
			processarAgenda(objAjax.responseXML, corpo);
		}
		else
			alert("Erro na resposta dos dados [Erro: "+objAjax.status+"-"+objAjax.statusText+"]");
	}
}

function processarAgenda(objXML, corpoDados){
	var hoteis = objXML.getElementsByTagName("hotel");
	
	var iniLinkEditar = "<a href='./reservaHotel.php?hotel=";
	var midLinkEditar = "'>";
	var fimLinkEditar = "</a>";
	
	for(var i=0; i<hoteis.length; i++){
		
		var contatoAtual=hoteis[i];
		
		var codigo = contatoAtual.getElementsByTagName("hotel_Cod")[0].firstChild.nodeValue;
		var nome = contatoAtual.getElementsByTagName("hotel_Nome")[0].firstChild.nodeValue;
		var categoria = contatoAtual.getElementsByTagName("hotel_Categoria")[0].firstChild.nodeValue;
		var cidade = contatoAtual.getElementsByTagName("hotel_Cidade")[0].firstChild.nodeValue;
		var diaria = contatoAtual.getElementsByTagName("hotel_Diaria")[0].firstChild.nodeValue;
		
		var linha=corpoDados.insertRow();
		
		var celula1=linha.insertCell(0);
		var celula2=linha.insertCell(1);
		var celula3=linha.insertCell(2);
		var celula4=linha.insertCell(3);
		
		celula1.innerHTML=iniLinkEditar+codigo+midLinkEditar+nome+fimLinkEditar;
		celula2.innerHTML=categoria;
		celula3.innerHTML=cidade;
		celula4.innerHTML=diaria;
	}
}