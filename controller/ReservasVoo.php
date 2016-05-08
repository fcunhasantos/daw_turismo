<?php

require_once("ConexaoBD.php");

class ReservasVoo {
	public function retornaReservas($cliente_Cod) {
		try {
			$conexaoBD = new ConexaoBD();
		
			$conexao = $conexaoBD->getConexao();
			
			if (!$conexao) {
				throw new PDOException ( "ERRO NA CONEXÃO AO SERVIDOR DE BANCO DE DADOS!!!" );
			}
			
			$SQLSelect = 'SELECT * FROM reservasvoo WHERE reservasVoo_Cliente=?';
			
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
				
			$SQLInsert = 'INSERT INTO reservasvoo
					(reservasVoo_Cliente, reservasVoo_Voo, reservasVoo_QuantPassageiros, reservasVoo_PrecoTotal)
				  		  VALUES (?,?,?,?)';
			
			$operacao = $conexao->prepare ( $SQLInsert );
			
			if (!$operacao) {
				throw new PDOException ( "ERRO NA INSTRUÇÂO SQL!!!" );
			}
			
			$inserir = $operacao->execute ( array (
					$reserva['cliente_Cod'],
					$reserva['voo_Cod'],
					$reserva['qtde_Passageiros'],
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
	
			$SQLDelete = 'DELETE FROM reservasvoo WHERE reservasVoo_Cliente=?';
	
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
				throw new PDOException("ReservasVoo.php>".$arr[2]);
			}
		} catch (PDOException $e) {
			throw $e;
		}
	}
}
?>