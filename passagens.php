<?php
require_once ("controller/Clientes.php");
require_once ("controller/Cidades.php");

include_once ("html/cabecalho_principal.html");
include_once ("menu_principal.php");

if (isset($_SESSION ['cliente_Nome'])) {
	$nome = $_SESSION ['cliente_Nome'];
	
	$cliente = new Clientes();
	$dadosCliente = $cliente->getDados($_SESSION['cliente_Email']);
	$dadosCliente = $dadosCliente[0]; 
}
?>

<div class="wrapper" role="main">
	<div class="container">
		<h3 class="form-signin-heading">Passagens</h3>
		<div class="row">
			<div class="col-md-12">
				<form role="form" method="post" action="controller/comprarPassagem.php" class="form-signin">
					<div class="form-group">
						<div class="hidden">
							<input type="hidden" name="codigo" value="<?php echo utf8_encode($dadosCliente['cliente_Cod']); ?>">
						</div>
					</div>
					<div class="form-group">
						<label for="InputCidade">Destino:</label>
						<select class="form-control selectpicker" id="InputCidade" name="cidade" required>
							<option value="" disabled="disabled" selected>Selecione uma cidade</option>
							<?php
								$cidades = new Cidades ();
								$resultado = $cidades->retornaCidades ();
								
								if (is_array ( $resultado )) {
									foreach ( $resultado as $dados ) {
										echo "<option ";
										echo "value=\"" . $dados ["cidade_Cod"] . "\">" . utf8_encode ( $dados ["cidade_Nome"] );
										echo "</option>\n";
									}
								} else {
									echo "</select> \n $resultado\n";
								}
							?>
						</select>
					</div>
					<div class="form-group">
						<div class="row">
						<div class="col-md-12">
						<h4>Ida</h4>
						<div class="row">
							<div class="col-md-6">
							<h4>Partida</h4>
							<div class="col-md-6">
								<label for="InputDataIda">Data:</label>
								<input type="date" class="form-control" id="InputDataIda" name="dataIda" required>
							</div>
							<div class="col-md-6">
								<label for="InputHoraIda">Hora:</label>
								<input type="time" class="form-control" id="InputHoraIda" name="horaIda" required>
							</div>
							</div>
							<div class="col-md-6">
							<h4>Chegada</h4>
							<div class="col-md-6">
								<label for="InputDataIda">Data:</label>
								<input type="date" class="form-control" id="InputDataIda" name="dataIda" required>
							</div>
							<div class="col-md-6">
								<label for="InputHoraIda">Hora:</label>
								<input type="time" class="form-control" id="InputHoraIda" name="horaIda" required>
							</div>
							</div>
						</div>
						</div>
						</div>
					</div>
					<div class="form-group">
						<h4>Volta</h4>
						<label for="InputDataVolta">Data:</label>
						<input type="date" class="form-control" id="InputDataVolta" name="dataVolta" required>
						<label for="InputHoraVolta">Hora:</label>
						<input type="time" class="form-control" id="InputHoraVolta" name="horaVolta" required>
					</div>
					<button type="submit" class="btn btn-primary">Salvar</button>
				</form>
			</div>
		</div>
	</div>
</div>

<?php
include_once ("html/rodape_principal.html");
?>