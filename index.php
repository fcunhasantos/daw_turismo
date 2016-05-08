<?php
include_once ("html/cabecalho_principal.html");
include_once ("menu_principal.php");
?>
		
	<!-- Aqui começa o conteudo -->
	<div class="wrapper" role="main">
		<div class="container">
			<div class="row">
				<?php
				if (isset($_GET['success'])) {
				?>
				<div class="alert alert-success alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<strong> <?php echo $_GET['success']; ?> </strong>
				</div>
				<?php
				}
				?>
				
				<?php
				if (isset($_GET['error'])) {
				?>
				<div class="alert alert-danger alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<strong>Erro!</strong> <?php echo $_GET['error']; ?>
				</div>
				<?php
				}
				?>
				<!-- Aqui e a area do conteudo -->
				<div id="conteudo" class="col-md-12">
					<div class="row">
						<div class="artigo" role="article">
							<h2>Bem Vindo ao MyTour</h2>
							<div class="col-md-6">
								
							</div>
						</div>
					</div>
					
					<p class="divider"></p>
					
					<!-- Figuras -->
					<div class="row">
						<div class="artigo" role="article">
							<h4>Vendas de passagens aéreas e reservas de hotéis</h4>
						</div>
					</div>
				</div>
					
			</div>
		</div>
	</div>
	<!-- Fim do conteudo -->
		
<?php
include_once ("html/rodape_principal.html");
?>