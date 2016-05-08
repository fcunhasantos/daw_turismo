<?php
setcookie ( "loginDawTurismo", '', time () - 42000 );
setcookie ( "loginAutomatico", '', time () - 42000 );

include_once ("html/cabecalho_principal.html");
include_once ("menu_principal.php");
?>

<div class="wrapper" role="main">
	<div class="container">
		<div>
			<div class="alert alert-danger" role="alert">
				<h1>Não foi possível realizar o login.</h1>
				<p class="lead">
					<a href="login.php">Tente novamente.</a>
				</p>
			</div>
		</div>
	</div>
</div>

<?php
include_once("html/rodape_principal.html");
?>