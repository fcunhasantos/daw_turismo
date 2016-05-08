<?php
require_once ("conexaoBD.php");

try {
	$origem = basename($_SERVER['HTTP_REFERER']);
	if ((count($_POST) != 5) && ($origem != 'cadastroUsuario.php')) {
		header("Location: ../index.php?error=Acesso Negado" );
		die();
	} else {
		$conexaoBD = new ConexaoBD();
		$conexao = $conexaoBD->getConexao();
		
		$nome = utf8_encode ( htmlspecialchars ( $_POST ['nome'] ) );
		$cidade = utf8_encode ( htmlspecialchars ( $_POST ['cidade'] ) );
		$email = utf8_encode ( htmlspecialchars ( $_POST ['email'] ) );
		$senha = utf8_encode ( htmlspecialchars ( $_POST ['senha'] ) );
		$senhaConf = utf8_encode ( htmlspecialchars ( $_POST ['senha2'] ) );
		$foto = $_FILES["input-file-preview"];
		$caminho_imagem = "img/users/user.svg";
		
		if (($senha != $senhaConf) || (strlen ( $senha ) < 4) || (strlen ( $senha ) > 8)) {
			header("Location:../novoCliente.php?error=Senhas não conferem" );
			die ();
		}
		
		// Se a foto estiver sido selecionada
		if (!empty($foto["name"])) {
			
			// Largura máxima em pixels
			$largura = 354;
			// Altura máxima em pixels
			$altura = 472;
			// Tamanho máximo do arquivo em bytes
			$tamanho = 1024 * 1024;
	 
	    	// Verifica se o arquivo é uma imagem
	    	if(!preg_match("/^image\/(pjpeg|jpeg|png|gif|bmp)$/", $foto["type"])){
	     	   $error[1] = "Isso não é uma imagem.";
	   	 	} 
		
			// Pega as dimensões da imagem
			$dimensoes = getimagesize($foto["tmp_name"]);
		
			// Verifica se a largura da imagem é maior que a largura permitida
			if($dimensoes[0] > $largura) {
				$error[2] = "A largura da imagem não deve ultrapassar ".$largura." pixels";
			}
	 
			// Verifica se a altura da imagem é maior que a altura permitida
			if($dimensoes[1] > $altura) {
				$error[3] = "Altura da imagem não deve ultrapassar ".$altura." pixels";
			}
			
			// Verifica se o tamanho da imagem é maior que o tamanho permitido
			if($foto["size"] > $tamanho) {
	   		 	$error[4] = "A imagem deve ter no máximo ".$tamanho." bytes";
			}
	 
			// Se não houver nenhum erro
			if (count($error) == 0) {
			
				// Pega extensão da imagem
				preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $foto["name"], $ext);
	 
	        	// Gera um nome único para a imagem
	        	//$nome_imagem = md5(uniqid(time())) . "." . $ext[1];
				$nome_imagem =  $codigo . "." . $ext[1];
	 
	        	// Caminho de onde ficará a imagem
	        	$caminho_imagem = "../img/users/" . $nome_imagem;
			}
		
			// Se houver mensagens de erro, exibe-as
			if (count($error) != 0) {
				foreach ($error as $erro) {
					$msgErro = $erro . "<br />";
				}
				header("Location:../novoCliente.php?error=".$msgErro );
				die ();
			}
		}
		
		// Insere cliente
		$SQLInsert = 'INSERT INTO clientes (cliente_Email, cliente_Senha, cliente_Cidade, cliente_Nome, cliente_Foto)
			  		  VALUES (?,MD5(?),?,?,?)';
		
		$operacao = $conexao->prepare ( $SQLInsert );
		
		$inserir = $operacao->execute ( array (
				$email,
				$senha,
				$cidade,
				$nome,
				$caminho_imagem
		) );
		
		$conexao = null;
		
		if ($inserir) {
			// Faz o upload da imagem para seu respectivo caminho
			move_uploaded_file($foto["tmp_name"], $caminho_imagem);
			 
			header("Location:../index.php?success=Cadastro efetuado com sucesso." );
			die();
		} else {
			$arr = $operacao->errorInfo ();
			$erro = utf8_decode ( $arr [2] );
			 
			header("Location:../novoUsuario.php?erro=".$erro );
			die();
		}
	}
} catch ( PDOException $e ) {
	header("Location:../novoUsuario.php?erro=".$e->getMessage() );
	die ();
}
?>
