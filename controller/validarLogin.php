<?php
	session_start();
	ob_start();
	require_once("Clientes.php");
	
	foreach ($_POST as $key => $value) {
		echo "<p>$key = $value</p>";
	}
	
	if (isset( $_POST ["login"] )) {
		$login = utf8_encode( htmlspecialchars( $_POST ["login"] ) );
		$senha = utf8_encode( htmlspecialchars( $_POST ["passwd"] ) );
		if (array_key_exists( "lembrarLogin", $_POST )) {
			$lembrarLogin = utf8_encode( htmlspecialchars( $_POST ["lembrarLogin"] ) );
		}
	} elseif (isset( $_COOKIE ["loginAutomatico"] )) { // existe um cookie com nome senha --> login automÃ¡tico
		$login = utf8_encode( htmlspecialchars( $_COOKIE ["loginDawTurismo"] ) );
		$senha = utf8_encode( htmlspecialchars( $_COOKIE ["loginAutomatico"] ) );
	} else {
		header( "Location:./erroLogin.php" );
		die();
	}
	
	$clientes = new Clientes();
	
	$resultados = $clientes->validaLogin($login, $senha);
	
	if (count($resultados) != 1) {
		header( "Location:../erroLogin.php" );
		die();
	} else {
		setcookie( "loginDawTurismo", $login, (time() + 60 * 60 * 24 * 90) ); // guarda o login por 90 dias a partir de agora
		if (! empty( $lembrarLogin )) {
			setcookie( "loginAutomatico", $senha, (time() + 60 * 60 * 24 * 90) ); // guarda a senha por 90 dias a partir de agora
		}
		$_SESSION['autenticado'] = true;
		$_SESSION['cliente_Cod'] = $resultados[0]['cliente_Cod'];
		$_SESSION['cliente_Nome'] = $resultados[0]['cliente_Nome'];
		$_SESSION['cliente_Email'] = $login;
		
		$array_carrinho = array();
		$array_hoteis = array();
		$array_voos = array();
		
		$array_carrinho['hoteis'] = $array_hoteis;
		$array_carrinho['voos'] = $array_voos;
		
		$_SESSION['carrinho'] = $array_carrinho;
		
		if (isset($_SESSION['page_request'])) {
			header("Location: ".$_SESSION['page_request'].".php");
		}
		else {
			header( "Location: ../index.php" );
		}
		die();
	}
?>