<?php
session_start();

$hotel_Cod = (isset($_POST['hotel_Cod']) ? $_POST['hotel_Cod'] : $_SESSION['fields_request']['hotel_Cod']);
$periodo_Ini = (isset($_POST['periodo_Ini']) ? $_POST['periodo_Ini'] : $_SESSION['fields_request']['periodo_Ini']);
$periodo_Fim = (isset($_POST['periodo_Fim']) ? $_POST['periodo_Fim'] : $_SESSION['fields_request']['periodo_Fim']);

//@todo limpar 'page_request' e 'fields_request' do vetor SESSION
if (!isset($_SESSION ['autenticado'])) {
	$_SESSION['page_request'] = 'reservarHotel';
	$_SESSION['fields_request'] = array(
			'hotel_Cod' => $hotel_Cod,
			'periodo_Ini' => $periodo_Ini,
			'periodo_Fim' => $periodo_Fim,
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
			'hotel' => $hotel_Cod,
			'dtinicio' => $periodo_Ini,
			'dtfinal' => $periodo_Fim,
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
	
	$array_carrinho['hoteis'][] = $reserva;
	
	$_SESSION['carrinho'] = $array_carrinho;
	
	header( "Location: ../carrinho.php" );
}

?>