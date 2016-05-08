<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
	session_start();
}

if (isset($_SESSION ['cliente_Nome'])) {
	$nome = $_SESSION ['cliente_Nome'];
} else {
	$nome = null;
}
?>
		<nav class="navbar navbar-default">
			<div class="container">
				<!-- Logo -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed"
						data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						<span class="sr-only">Toggle navigation</span> <span
							class="icon-bar"></span> <span class="icon-bar"></span> <span
							class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="index.php">My Tour</a>
				</div>
				<!-- Menu -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					
					<!-- Botoes -->
					<ul class="nav navbar-nav">
						<li><a href="listaVoos.php">Passagens</a></li>
						<li><a href="listaHoteis.php">Hotéis</a></li>
					</ul>
					
					<?php
					if ($nome == null) { 
					?>
					<ul class="nav navbar-nav navbar-right">
						<li><a href="login.php">Login</a></li>
					</ul>
					<?php
					} else {
						if (isset($_SESSION ['cliente_Foto'])) {
					?>
					<!-- Botoes Cliente -->
					<a class="nav navbar-brand navbar-img-user navbar-right" href="dadosCliente.php">
						<img class="img-circle img-user" alt="foto" src="<?php echo $_SESSION ['cliente_Foto']; ?>">
					</a>
					<?php
						} else { 
					?>
					<a class="nav navbar-brand navbar-right" href="dadosCliente.php">
						<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
					</a>
					<?php
						} 
					?>
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"> <?php echo $nome; ?>
								<span class="caret"></span>
							</a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="carrinho.php">Carrinho</a></li>
								<li class="divider"></li>
								<li><a href="dadosCliente.php">Meus dados</a></li>
								<li><a href="listaReservas.php">Minhas compras</a></li>
								<li class="divider"></li>
								<li><a href="controller/logout.php">Sair</a></li>
							</ul>
						</li>
					</ul>
					<?php
					} 
					?>
					
				</div>
			</div>
		</nav>
