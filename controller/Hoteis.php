<?php
require_once ("conexaoBD.php");
class Hoteis {
	
	public function retornaHoteis() {
		try {
			$conexaoBD = new ConexaoBD ();
				
			$conexao = $conexaoBD->getConexao ();
				
			if (!$conexao) {
				throw new PDOException ( "ERRO NA CONEXÃO AO SERVIDOR DE BANCO DE DADOS!!!" );
			}
				
			$SQLSelect = "SELECT * FROM hoteis ORDER BY hotel_Nome";
				
			$operacao = $conexao->prepare($SQLSelect);
				
			if (!$operacao) {
				throw new PDOException ( "ERRO NA CONSULTA!!!" );
			}
				
			$pesquisar = $operacao->execute();
				
			$resultado = $operacao->fetchAll ();
				
			$conexao = null;
				
			return $resultado;
		} catch ( PDOException $e ) {
			return $e->getMessage ();
		}
	}
	
	public function getHotel($hotel_Cod) {
		try {
			$conexaoBD = new ConexaoBD ();
	
			$conexao = $conexaoBD->getConexao ();
	
			if (!$conexao) {
				throw new PDOException ( "ERRO NA CONEXÃO AO SERVIDOR DE BANCO DE DADOS!!!" );
			}
	
			$SQLSelect = "SELECT * FROM hoteis WHERE hotel_Cod = ?";
	
			$operacao = $conexao->prepare($SQLSelect);
	
			if (!$operacao) {
				throw new PDOException ( "ERRO NA CONSULTA!!!" );
			}
	
			$pesquisar = $operacao->execute ( array (
					$hotel_Cod
			) );
	
			$resultado = $operacao->fetch();
	
			$conexao = null;
	
			return $resultado;
		} catch ( PDOException $e ) {
			return $e->getMessage ();
		}
	}
	
	public function buscarHoteis($nome, $categoria, $cidade) {
		
	}
}