<?php
include_once ("html/cabecalho_principal.html");
include_once ("menu_principal.php");
?>

		<div class="wrapper" role="main">
			<div class="container">
				<div class="starter-template">
					<h3 class="sub-header">Hoteis</h3>
				</div>
				<form class="navbar-form " role="form">
					<div class="form-group">
						Procurar: <input type="text" placeholder="Nome, Cidade" name="filtro" id ="filtro" class="form-control">
					</div>
					<button type="button" class="btn btn-sm btn-primary" onclick="return reqHoteis(document.getElementById('filtro'))">Buscar</button>
					</form>
					<table class="table table-striped">	
						<thead>
							<tr>
								<th>Nome</th>
								<th>Categoria</th>
								<th>Cidade</th>
								<th>Diária</th>
							</tr>
						</thead>
						<tbody id="tbCorpo"> </tbody>
				</table>
			</div>
		</div>

<?php
include_once("html/rodape_principal.html");
?>