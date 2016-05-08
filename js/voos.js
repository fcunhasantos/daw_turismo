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

function reqVoos(fonte){
	objAjax.onreadystatechange = atualizarTabela;
	buscarDados("controller/voosAJAX.php", objAjax, fonte);
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
	var voos = objXML.getElementsByTagName("voo");
	
	var iniLinkEditar = "<a href='./reservaVoo.php?voo=";
	var midLinkEditar = "'>";
	var fimLinkEditar = "</a>";
	
	for(var i=0; i<voos.length; i++){
		
		var contatoAtual=voos[i];
		
		var codigo = contatoAtual.getElementsByTagName("voo_Cod")[0].firstChild.nodeValue;
		var origem = contatoAtual.getElementsByTagName("voo_CidadeOrigem")[0].firstChild.nodeValue;
		var destino = contatoAtual.getElementsByTagName("voo_CidadeDestino")[0].firstChild.nodeValue;
		var data = contatoAtual.getElementsByTagName("voo_Data")[0].firstChild.nodeValue;
		var preco = contatoAtual.getElementsByTagName("voo_Preco")[0].firstChild.nodeValue;
		
		var linha=corpoDados.insertRow();
		
		var celula1=linha.insertCell(0);
		var celula2=linha.insertCell(1);
		var celula3=linha.insertCell(2);
		var celula4=linha.insertCell(3);
		var celula5=linha.insertCell(4);
		
		celula1.innerHTML=iniLinkEditar+codigo+midLinkEditar+codigo+fimLinkEditar;
		celula2.innerHTML=origem;
		celula3.innerHTML=destino;
		celula4.innerHTML=data;
		celula5.innerHTML=preco;
	}
}