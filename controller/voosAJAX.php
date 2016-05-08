<?php
require_once("conexaoBD.php");
require_once("Cidades.php");

header("Content-Type: application/xml; charset=utf-8");

	try{
		$conexao = new ConexaoBD();
		$conexao = $conexao->getConexao();
	}catch(PDOException $excep){
	    echo "Erro!: " . $excep->getMessage() . "\n";
		die();
	}

	$SQLSelect = 'SELECT * FROM voos';
	
	if(!empty($_POST['filtro'])){
	    $nomeBusca = (htmlspecialchars($_POST['filtro']));
		$nomeBusca = "%".$nomeBusca."%";
		$SQLSelect .= ' WHERE voo_Cod like ?';
	}
	
	/*if(!empty($_POST['filtro'])){
		$filtro = (htmlspecialchars($_POST['filtro']));
		$filtro = "%".$filtro."%";
		$SQLSelect =
		' LEFT JOIN cidades orig ON orig.cidade_Cod = voos.voo_CidadeOrigem
		  LEFT JOIN cidades dest ON dest.cidade_Cod = voos.voo_CidadeDestino
		  WHERE (voos.voo_Cod like ?) OR (orig.cidade_Nome like ?) OR (dest.cidade_Nome like ?)';
	}*/
		
	//prepara a execução da sentença
	$operacao = $conexao->prepare($SQLSelect);					  
	if(!empty($_POST['filtro'])){				
		//executa a sentença SQL com o valor passado por parâmetro
		$pesquisar = $operacao->execute(array($nomeBusca));
	}
	else{
		$pesquisar = $operacao->execute();
	}
	//captura TODOS os resultados obtidos
	$resultados = $operacao->fetchAll();
	
	//libera a conexão (dados já foram capturados)
	$conexao=null;
	
	$XMLout = new XMLWriter();
	$XMLout->openMemory();
	$XMLout->startDocument('1.0', 'UTF-8');
	$XMLout->setIndent(true);
	$XMLout->startElement("daw_turismo");
	
	foreach($resultados as $contatosEncontrados){		//para cada elemento do vetor de resultados...
		
		$cidades = new Cidades();
		$cidade = $cidades->getCidade($contatosEncontrados['voo_CidadeOrigem']);
		$nomeCidadeOrigem = $cidade[0]['cidade_Nome'];
		$cidade = $cidades->getCidade($contatosEncontrados['voo_CidadeDestino']);
		$nomeCidadeDestino = $cidade[0]['cidade_Nome'];
		
		$XMLout->startElement("voo");
			$XMLout->writeElement("voo_Cod", ($contatosEncontrados['voo_Cod']));
			$XMLout->writeElement("voo_CidadeOrigem", (utf8_encode($nomeCidadeOrigem)));
			$XMLout->writeElement("voo_CidadeDestino", (utf8_encode($nomeCidadeDestino)));
			$XMLout->writeElement("voo_Data", ($contatosEncontrados['voo_Data']));
			$XMLout->writeElement("voo_Preco", (number_format($contatosEncontrados['voo_Preco'],2,',','.')));
		$XMLout->endElement();  //elemento voo
	}
	
	$XMLout->endElement(); //elemento daw_turismo
	
	$XMLout->endDocument();
	echo $XMLout->outputMemory();
?>
