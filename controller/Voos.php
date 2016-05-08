<?php
require_once ("conexaoBD.php");
class Voos {
	
	public function retornaVoos() {
		try {
			$conexaoBD = new ConexaoBD ();
				
			$conexao = $conexaoBD->getConexao ();
				
			if (!$conexao) {
				throw new PDOException ( "ERRO NA CONEXÃO AO SERVIDOR DE BANCO DE DADOS!!!" );
			}
				
			$SQLSelect = "SELECT * FROM voos ORDER BY voo_Data";
				
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
	
	public function getVoo($voo_Cod) {
		try {
			$conexaoBD = new ConexaoBD ();
	
			$conexao = $conexaoBD->getConexao ();
	
			if (!$conexao) {
				throw new PDOException ( "ERRO NA CONEXÃO AO SERVIDOR DE BANCO DE DADOS!!!" );
			}
	
			$SQLSelect = "SELECT * FROM voos WHERE voo_Cod = ?";
	
			$operacao = $conexao->prepare($SQLSelect);
	
			if (!$operacao) {
				throw new PDOException ( "ERRO NA CONSULTA!!!" );
			}
	
			$pesquisar = $operacao->execute ( array (
					$voo_Cod
			) );
	
			$resultado = $operacao->fetch();
	
			$conexao = null;
	
			return $resultado;
		} catch ( PDOException $e ) {
			return $e->getMessage ();
		}
	}
	
}