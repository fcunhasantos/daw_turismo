<?php

require_once("ConexaoBD.php");

class Clientes {
	public function validaLogin($email, $senha) {
		try {
			$conexaoBD = new ConexaoBD();
		
			$conexao = $conexaoBD->getConexao();
			
			if (!$conexao) {
				throw new PDOException ( "ERRO NA CONEXÃO AO SERVIDOR DE BANCO DE DADOS!!!" );
			}
			
			$SQLSelect = 'SELECT * FROM clientes WHERE cliente_Senha=MD5(?) AND cliente_Email=?';
			
			$operacao = $conexao->prepare($SQLSelect);
			
			if (!$operacao) {
				throw new PDOException ( "ERRO NA CONSULTA!!!" );
			}
			
			$pesquisar = $operacao->execute ( array (
					$senha,
					$email
			) );
			
			$resultados = $operacao->fetchAll ();
			
			$conexao = null;
			
			return $resultados;
		} catch (PDOException $e) {
			throw $e;
		}
	}
	
	public function getDados($email) {
		try {
			$conexaoBD = new ConexaoBD();
		
			$conexao = $conexaoBD->getConexao();
				
			if (!$conexao) {
				throw new PDOException ( "ERRO NA CONEXÃO AO SERVIDOR DE BANCO DE DADOS!!!" );
			}
				
			$SQLSelect = 'SELECT * FROM clientes WHERE cliente_Email=?';
				
			$operacao = $conexao->prepare($SQLSelect);
				
			if (!$operacao) {
				throw new PDOException ( "ERRO NA CONSULTA!!!" );
			}
				
			$pesquisar = $operacao->execute ( array (
					$email
			) );
				
			$resultados = $operacao->fetchAll ();
				
			$conexao = null;
				
			return $resultados;
		} catch (PDOException $e) {
			throw $e;
		}
	}
	
	public function getCliente($codigo) {
		try {
			$conexaoBD = new ConexaoBD();
	
			$conexao = $conexaoBD->getConexao();
	
			if (!$conexao) {
				throw new PDOException ( "ERRO NA CONEXÃO AO SERVIDOR DE BANCO DE DADOS!!!" );
			}
	
			$SQLSelect = 'SELECT * FROM clientes WHERE cliente_Cod=?';
	
			$operacao = $conexao->prepare($SQLSelect);
	
			if (!$operacao) {
				throw new PDOException ( "ERRO NA CONSULTA!!!" );
			}
	
			$pesquisar = $operacao->execute ( array (
					$codigo
			) );
	
			$resultados = $operacao->fetch();
	
			$conexao = null;
	
			return $resultados;
		} catch (PDOException $e) {
			throw $e;
		}
	}
	
	public function apagaCliente($codigo) {
		try {
			$conexaoBD = new ConexaoBD();
			
			$conexao = $conexaoBD->getConexao();
			
			if (!$conexao) {
				throw new PDOException ( "ERRO NA CONEXÃO AO SERVIDOR DE BANCO DE DADOS!!!" );
			}
			
			$SQLDelete = 'DELETE FROM clientes WHERE cliente_Cod=?';
		
			$operacao = $conexao->prepare($SQLDelete);
			
			if (!$operacao) {
				throw new PDOException ( "ERRO NA CONSULTA!!!" );
			}
		
			$deletar = $operacao->execute(array($codigo));
		
			$conexao = null;
			
			if ($deletar){
				return $deletar;
			}
			else {
				$arr = $operacao->errorInfo();
				throw new PDOException("Clientes.php>".$arr[2]);
			}
		} catch (PDOException $e) {
			throw $e;
		}
	}
}
?>