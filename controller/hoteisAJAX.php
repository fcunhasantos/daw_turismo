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

	$SQLSelect = 'SELECT * FROM hoteis';
	
	if(!empty($_POST['filtro'])){
	    $nomeBusca = (htmlspecialchars($_POST['filtro']));
		$nomeBusca = "%".$nomeBusca."%";
		$SQLSelect .= ' WHERE hotel_Nome like ?';
	}
		
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
		
		if ($contatosEncontrados['hotel_Categoria'] == 1) {
			$categoria = "Básico";
		} else {
			$categoria = "Luxo";
		}
		
		$cidades = new Cidades();
		$cidade = $cidades->getCidade($contatosEncontrados['hotel_Cidade']);
		$nomeCidade = $cidade[0]['cidade_Nome'];
		
		$XMLout->startElement("hotel");
			$XMLout->writeElement("hotel_Cod", ($contatosEncontrados['hotel_Cod']));
			$XMLout->writeElement("hotel_Nome", ($contatosEncontrados['hotel_Nome']));
			//$XMLout->writeElement("hotel_Categoria", ($contatosEncontrados['hotel_Categoria']));
			$XMLout->writeElement("hotel_Categoria", ($categoria));
			//$XMLout->writeElement("hotel_Cidade", ($contatosEncontrados['hotel_Cidade']));
			$XMLout->writeElement("hotel_Cidade", (utf8_encode($nomeCidade)));
			$XMLout->writeElement("hotel_Diaria", (number_format($contatosEncontrados['hotel_Diaria'],2,',','.')));
		$XMLout->endElement();  //elemento hoteis
	}
	
	$XMLout->endElement(); //elemento daw_turismo
	
	$XMLout->endDocument();
	echo $XMLout->outputMemory();
?>
