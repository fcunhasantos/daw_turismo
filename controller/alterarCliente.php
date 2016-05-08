<?php
require_once ("autenticaSessao.php");

require_once("ConexaoBD.php");
require_once("Clientes.php");

try {
	$conexaoBD = new ConexaoBD();
	$conexao = $conexaoBD->getConexao();
	
	$nome = utf8_encode ( htmlspecialchars ( $_POST ['nome'] ) );
	$cidade = utf8_encode ( htmlspecialchars ( $_POST ['cidade'] ) );
	$email = utf8_encode ( htmlspecialchars ( $_POST ['email'] ) );
	$senha = utf8_encode ( htmlspecialchars ( $_POST ['senha'] ) );
	$senhaConf = utf8_encode ( htmlspecialchars ( $_POST ['senha2'] ) );
	$foto = $_FILES["input-file-preview"];
	$codigo = utf8_encode ( htmlspecialchars ( $_POST ['codigo'] ) );
	
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
	
			// Altera cliente
			if ($senha != '') {
				if (($senha != $senhaConf) || (strlen ( $senha ) < 4) || (strlen ( $senha ) > 8)) {
					header("Location:../dadosCliente.php?error=Senhas não conferem" );
					die ();
				}
				
				$SQLUpdate = 'UPDATE clientes SET cliente_Email=?, cliente_Senha=MD5(?), cliente_Cidade=?, cliente_Nome=?, cliente_Foto=?
						  WHERE cliente_Cod = ?';
				$params = array($email, $senha, $cidade, $nome, $caminho_imagem, $codigo);
			}
			else {
				$SQLUpdate = 'UPDATE clientes SET cliente_Email=?, cliente_Cidade=?, cliente_Nome=?, cliente_Foto=?
						  WHERE cliente_Cod = ?';
				$params = array($email, $cidade, $nome, $caminho_imagem, $codigo);
			}
	
			$operacao = $conexao->prepare($SQLUpdate);					  
			
			$atualizacao = $operacao->execute($params);
			
			// Faz o upload da imagem para seu respectivo caminho
			move_uploaded_file($foto["tmp_name"], $caminho_imagem);
			
			$conexao = null;
			
			if ($atualizacao){
				
				$_SESSION['cliente_Nome'] = $nome;
				$_SESSION['cliente_Email'] = $email;
				$caminho_imagem = str_replace('../', '', $caminho_imagem);
				$_SESSION['cliente_Foto'] = $caminho_imagem;
				
				header("Location: ../index.php");
				die();
			}
			else {
				//echo "<h1>Erro na operação.</h1>\n";
				$arr = utf8_decode($operacao->errorInfo());		//mensagem de erro retornada pelo SGBD
				//echo "<p>$arr[2]</p>";							//deve ser melhor tratado em um caso real
			    //echo "<p><a href=\"./index.php\">Voltar</a></p>\n";
				header("Location:../dadosCliente.php?error=".$arr[2] );
				die ();
			}
	
			// Faz o upload da imagem para seu respectivo caminho
			move_uploaded_file($foto["tmp_name"], $caminho_imagem);
				
		}
	
		// Se houver mensagens de erro, exibe-as
		if (count($error) != 0) {
			foreach ($error as $erro) {
				$msgErro = $erro . "<br />";
			}
			header("Location:../dadosCliente.php?error=".$msgErro );
			die ();
		}
	}
}
catch (PDOException $e)
{
    echo "Erro!: " . $e->getMessage() . "<br>";
    die();
}

?>
