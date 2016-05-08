<?php
require_once ("conexaoBD.php");
class Cidades {
	public function retornaCidades() {
		try {
			$conexaoBD = new ConexaoBD();
			
			$conexao = $conexaoBD->getConexao();
			
			if (!$conexao) {
				throw new PDOException("ERRO NA CONEXÃO AO SERVIDOR DE BANCO DE DADOS!!!");
			}
			
			$SQLSelect = "SELECT * FROM cidades ORDER BY cidade_Nome";
			
			$operacao = $conexao->prepare($SQLSelect);
			
			if (!$operacao) {
				throw new PDOException ( "ERRO NA CONSULTA!!!" );
			}
			
			$pesquisar = $operacao->execute();
			
			$resultado = $operacao->fetchAll();
			
			$conexao = null;
			
			return $resultado;
		} catch ( PDOException $e ) {
			return $e->getMessage ();
		}
	}
	
	public function getCidade($cidade_Cod) {
		try {
			$conexaoBD = new ConexaoBD ();
				
			$conexao = $conexaoBD->getConexao ();
				
			if (!$conexao) {
				throw new PDOException ( "ERRO NA CONEXÃO AO SERVIDOR DE BANCO DE DADOS!!!" );
			}
				
			$SQLSelect = "SELECT * FROM cidades WHERE cidade_Cod = ?";
				
			$operacao = $conexao->prepare($SQLSelect);
				
			if (!$operacao) {
				throw new PDOException ( "ERRO NA CONSULTA!!!" );
			}
				
			$pesquisar = $operacao->execute ( array (
					$cidade_Cod
			) );
				
			$resultado = $operacao->fetchAll();
				
			$conexao = null;
				
			return $resultado;
		} catch ( PDOException $e ) {
			return $e->getMessage ();
		}
	}
}
?>