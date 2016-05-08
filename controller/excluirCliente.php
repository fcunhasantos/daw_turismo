<?php
require_once ("autenticaSessao.php");

require_once("ConexaoBD.php");
require_once("Clientes.php");
require_once("ReservasHotel.php");
require_once("ReservasVoo.php");

try {
	if (count($_GET)!=1) {
		header("Location: ../dadosCliente.php?error=Erro de acesso");
		die();
	}
	else {
		$codigo = $_GET['id'];
		
		$clientes = new Clientes();
		
		$cliente = $clientes->getCliente($codigo);
		
		if (is_array($cliente)) {
			
			$reservasHotel = new ReservasHotel();
			
			$reservasHotel->apagaReserva($codigo);
			
			$reservasVoo = new ReservasVoo();
				
			$reservasVoo->apagaReserva($codigo);

			$deletar = $clientes->apagaCliente($codigo);
	
			if ($deletar){
				unlink($cliente['cliente_Foto']);
				
				header("Location: ./logout.php");
			}
			else {
				header("Location: ../dadosCliente.php?error=Erro na operação");
				die();
			}
		} else {
			header("Location: ../dadosCliente.php?error=Cliente não encontrado");
			die();
		}
	}
} catch (PDOException $e) {
	header("Location: ../dadosCliente.php?error=PDOException:".$e->getMessage());
	die();
}

?>
