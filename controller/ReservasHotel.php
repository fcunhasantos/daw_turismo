<?php

require_once("ConexaoBD.php");

class ReservasHotel {
	public function retornaReservas($cliente_Cod) {
		try {
			$conexaoBD = new ConexaoBD();
		
			$conexao = $conexaoBD->getConexao();
			
			if (!$conexao) {
				throw new PDOException ( "ERRO NA CONEXÃO AO SERVIDOR DE BANCO DE DADOS!!!" );
			}
			
			$SQLSelect = 'SELECT * FROM reservashotel WHERE reservasHotel_Cliente=?';
			
			$operacao = $conexao->prepare($SQLSelect);
			
			if (!$operacao) {
				throw new PDOException ( "ERRO NA CONSULTA!!!" );
			}
			
			$pesquisar = $operacao->execute(array(
					$cliente_Cod
			));
			
			$resultados = $operacao->fetchAll();
			
			$conexao = null;
			
			return $resultados;
		} catch (PDOException $e) {
			throw $e;
		}
	}
	
	public function insereReserva($reserva) {
		try {
			$conexaoBD = new ConexaoBD();
		
			$conexao = $conexaoBD->getConexao();
				
			if (!$conexao) {
				throw new PDOException ( "ERRO NA CONEXÃO AO SERVIDOR DE BANCO DE DADOS!!!" );
			}
				
			$SQLInsert = 'INSERT INTO reservashotel
					(reservasHotel_Cliente, reservasHotel_Hotel, reservasHotel_DataEntrada, reservasHotel_DataSaida, reservasHotel_PrecoTotal)
				  		  VALUES (?,?,?,?,?)';
			
			$operacao = $conexao->prepare ( $SQLInsert );
			
			if (!$operacao) {
				throw new PDOException ( "ERRO NA INSTRUÇÂO SQL!!!" );
			}
			
			$inserir = $operacao->execute ( array (
					$reserva['cliente_Cod'],
					$reserva['hotel_Cod'],
					$reserva['hotel_Entrada'],
					$reserva['hotel_Saida'],
					$reserva['preco_Total'],
			) );
			
			$conexao = null;
			
			return $inserir;
		} catch (PDOException $e) {
			throw $e;
		}
	}
	
	public function apagaReserva($codigo_Cliente) {
		try {
			$conexaoBD = new ConexaoBD();
				
			$conexao = $conexaoBD->getConexao();
				
			if (!$conexao) {
				throw new PDOException ( "ERRO NA CONEXÃO AO SERVIDOR DE BANCO DE DADOS!!!" );
			}
				
			$SQLDelete = 'DELETE FROM reservashotel WHERE reservasHotel_Cliente=?';
	
			$operacao = $conexao->prepare($SQLDelete);
				
			if (!$operacao) {
				throw new PDOException ( "ERRO NA CONSULTA!!!" );
			}
	
			$deletar = $operacao->execute(array($codigo_Cliente));
	
			$conexao = null;
	
			if ($deletar){
				return $deletar;
			}
			else {
				$arr = $operacao->errorInfo();
				throw new PDOException("ReservasHotel.php>".$arr[2]);
			}
		} catch (PDOException $e) {
			throw $e;
		}
	}
}
?>