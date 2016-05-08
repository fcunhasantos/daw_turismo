<?php
require_once ("autenticaSessao.php");

require_once("ReservasHotel.php");
require_once("ReservasVoo.php");

if (isset($_SESSION)) {
	foreach ($_SESSION as $key=>$value) {
		if (!is_array($value)) {
			echo $key."=".$value."<br>";
		}
	}
	
	$carrinho = $_SESSION['carrinho'];
	
	foreach ($carrinho['hoteis'] as $key=>$reserva) {
		echo 'hotel:'.$reserva['hotel'].'<br>';
		foreach ($reserva as $campo=>$valor) {
			echo $campo."=".$valor."<br>";
		}
		
	}
	
	foreach ($carrinho['voos'] as $key=>$reserva) {
		echo 'voo:'.$reserva['voo'].'<br>';
		foreach ($reserva as $campo=>$valor) {
			echo $campo."=".$valor."<br>";
		}
	}
}

$cliente_Cod = $_SESSION['cliente_Cod'];

$carrinho = $_SESSION['carrinho'];

try {
	/*Hoteis*/
	$objReservaHotel = new ReservasHotel();
	foreach ($carrinho['hoteis'] as $key=>$reserva) {
		$reservaHotel = array(
				'cliente_Cod' => $cliente_Cod,
				'hotel_Cod' => $reserva['hotel'],
				'hotel_Entrada' => $reserva['dtinicio'],
				'hotel_Saida' => $reserva['dtfinal'],
				'preco_Total' => $reserva['preco'],
		);
		
		$inserirHoteis = $objReservaHotel->insereReserva($reservaHotel);
		
		if (!$inserirHoteis) {
			//echo "<h1>Erro o reservar hotel.</h1>\n";
			header ( "Location:../resultadoReservas.php?id=error&msg=Erro o reservar hotel" );
			die ();
		}
	}
	
	/*Voos*/
	$objReservaVoo = new ReservasVoo();
	foreach ($carrinho['voos'] as $key=>$reserva) {
		$reservaVoo = array(
				'cliente_Cod' => $cliente_Cod,
				'voo_Cod' => $reserva['voo'],
				'qtde_Passageiros' => $reserva['passageiros'],
				'preco_Total' => $reserva['preco'],
		);
	
		$inserirVoos = $objReservaVoo->insereReserva($reservaVoo);
		
		if (!$inserirVoos) {
			//echo "<h1>Erro o reservar vôo.</h1>\n";
			header ( "Location:../resultadoReservas.php?id=error&msg=Erro o reservar vôo" );
			die ();
		}
	}
	
	//echo "<h1>Operação realizada com sucesso.</h1>\n";
	header ( "Location:../resultadoReservas.php?id=info" );
	die ();
	
} catch (\Exception $e) {
	//echo "<h1>Erro na operação.</h1>\n";
	//echo "<p>".$e->getMessage()."</p>";
	header ( "Location:../resultadoReservas.php?id=error&msg=".$e->getMessage() );
	die ();
}

?>