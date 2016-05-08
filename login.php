<?php
include_once ("html/cabecalho_principal.html");
include_once ("menu_principal.php");

if (isset ( $_COOKIE ['loginDawTurismo'] )) {
	$cliente_Email = $_COOKIE ['loginDawTurismo'];
} else {
	$cliente_Email = "";
}

if (isset ( $_COOKIE ['loginAutomatico'] )) {
	$cliente_Senha = $_COOKIE ['loginAutomatico'];
} else {
	$cliente_Senha = "";
}
?>

		<div class="wrapper" role="main">
			<div class="container">
				<div class="row">
					<div class="col-md-4"></div>
					<div class="col-md-4">
					<form class="form-signin" role="form" method="post" action="controller/validarLogin.php">
						<h3 class="form-signin-heading">Login</h3>
						<div class="form-group">
							<input type="text" class="form-control" placeholder="Email"
								name="login" value="<?php echo $cliente_Email?>" required autofocus>
						</div>
						<div class="form-group">
							<input type="password" class="form-control" placeholder="Senha"
								name="passwd" value="<?php echo $cliente_Senha?>"required>
						</div>
						<div class="form-group pull-center">
							<label>
								<input type="checkbox" name="lembrarLogin" value="loginAutomatico"> Lembrar login
							</label>
						</div>
						<div class="form-group">
							<button class="btn btn-lg btn-primary btn-block" type="submit">Entrar</button>
						</div>
						<div class="form-group">
						<button class="btn btn-lg btn-success btn-block" type="button"
							onclick="javascript:window.location.href='novoCliente.php'">Cadastrar-se</button>
						</div>
					</form>
					</div>
					<div class="col-md-4"></div>
				</div>
			</div>
		</div>

<?php
include_once ("html/rodape_principal.html");
?>