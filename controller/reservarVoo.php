<?php
session_start();

$voo_Cod = (isset($_POST['voo_Cod']) ? $_POST['voo_Cod'] : $_SESSION['fields_request']['voo_Cod']);
$voo_Passageiros = (isset($_POST['voo_Passageiros']) ? $_POST['voo_Passageiros'] : $_SESSION['fields_request']['voo_Passageiros']);

//@todo limpar 'page_request' e 'fields_request' do vetor SESSION
if (!isset($_SESSION ['autenticado'])) {
	$_SESSION['page_request'] = 'reservarVoo';
	$_SESSION['fields_request'] = array(
			'voo_Cod' => $voo_Cod,
			'voo_Passageiros' => $voo_Passageiros,
	);
	header("Location: ../login.php");
	die ();
} else {
	if (isset($_SESSION['page_request'])) {
		unset($_SESSION['page_request']);
	}
	if (isset($_SESSION['fields_request'])) {
		unset($_SESSION['fields_request']);
	}
	
	$reserva = array(
			'voo' => $voo_Cod,
			'passageiros' => $voo_Passageiros,
	);
	
	if (isset($_SESSION['carrinho'])) {
		$array_carrinho = $_SESSION['carrinho'];
	}
	else {
		$array_carrinho = array(
				'hoteis' => array(),
				'voos' => array()
		);
	}
	
	$array_carrinho['voos'][] = $reserva;
	
	$_SESSION['carrinho'] = $array_carrinho;
	
	header( "Location: ../carrinho.php" );
}

?>