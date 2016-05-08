<?php
class ConexaoBD {
	public function getConexao() {
		try {
			
			$servidor = 'us-cdbr-azure-west-c.cloudapp.net';
			$porta = 3306;
			$banco = "acsm_a4f2e3cc23d81e6";
			$usuario = "bbb3527688511b";
			$senha = "b4e0caaa";
			
			$conn = new PDO ( "mysql:host=$servidor;
                             port=$porta;
                             dbname=$banco", $usuario, $senha, array (
					PDO::ATTR_PERSISTENT => true 
			) );
			return $conn;
		} catch ( PDOException $e ) {
			throw $e;
		}
	}
}
?>