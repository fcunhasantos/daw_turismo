<?php
include_once ("html/cabecalho_principal.html");
include_once ("menu_principal.php");

require_once ("controller/Cidades.php");
?>

		<div class="wrapper" role="main">
			<div class="container">
				<div class="starter-template">
					<h3 class="sub-header">Passagens</h3>
				</div>
				<form class="navbar-form " role="form">
					<div class="form-group">
						Procurar: <input type="text" placeholder="Código" name="filtro" id="filtro" class="form-control">
					</div>
					<button type="button" class="btn btn-sm btn-primary" onclick="return reqVoos(document.getElementById('filtro'))">Buscar</button>
				</form>
				<table class="table table-striped">	
					<thead>
						<tr>
							<th>Código Vôo</th>
							<th>Origem</th>
							<th>Destino</th>
							<th>Data</th>
							<th>Valor
						</tr>
					</thead>
					<tbody id="tbCorpo"> </tbody>
				</table>
			</div>
		</div>

<?php
include_once("html/rodape_principal.html");
?>