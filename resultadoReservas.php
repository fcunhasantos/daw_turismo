<?php
include_once ("html/cabecalho_principal.html");
include_once ("menu_principal.php");

?>
<div class="wrapper" role="main">
	<div class="container">
<?php
if ($_GET['id'] == 'error') {
?>
		<div class="alert alert-danger" role="alert">
			<h1>Erro na Operação.</h1>
<?php
}
elseif ($_GET['id'] == 'info') {
?>
		<div class="alert alert-success" role="alert">
			<h1>Operação realizada com sucesso.</h1>
<?php
}
?>
			<p class="lead">
<?php
if (isset($_GET['msg'])) {
	echo $_GET['msg'];
}
?>
			</p>
		</div>
	</div>
</div>
<?php
include_once("html/rodape_principal.html");
?>