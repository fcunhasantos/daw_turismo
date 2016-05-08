<?php
require_once ("controller/autenticaSessao.php");

include_once ("html/cabecalho_principal.html");
include_once ("menu_principal.php");

require_once("controller/Voos.php");
require_once("controller/Cidades.php");

$voos = new Voos();
$voo = $voos->getVoo($_GET['voo']);

$cidades = new Cidades();
$cidade = $cidades->getCidade($voo['voo_CidadeOrigem']);
$nomeCidadeOrigem = utf8_encode($cidade[0]['cidade_Nome']);
$cidade = $cidades->getCidade($voo['voo_CidadeDestino']);
$nomeCidadeDestino = utf8_encode($cidade[0]['cidade_Nome']);

?>
        
		<div class="wrapper" role="main">
			<div class="container">
				<div>
					<h3>Reservar Passagens</h3>
				</div>
				<div class="row">
					<div class="col-md-6">
						<form class="form-horizontal" role="form" method="post" action="controller/reservarVoo.php">
							<div class="form-group">
								<div class="hidden">
									<input type="hidden" name="voo_Cod" value="<?php echo utf8_encode($voo['voo_Cod']); ?>">
								</div>
							</div>
							<div class="form-group">
								<label><?php echo "Código do Vôo: ".$voo['voo_Cod']; ?></label><br>
								<label><?php echo "Data/Hora: ".$voo['voo_Data']; ?></label><br>
								<label><?php echo "De: ".$nomeCidadeOrigem." - Para: ".$nomeCidadeDestino; ?></label>
							</div>
							<div class="form-group">
								<label>Passageiros:</label>
								<select class="form-control" name="voo_Passageiros" required="required">
									<option>1</option>
									<option>2</option>
									<option>3</option>
									<option>4</option>
									<option>5</option>
								</select>
							</div>
							<div class="form-group">
								<button type="submit" class="btn btn-primary">Fazer Reserva</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

<?php
include_once("html/rodape_principal.html");
?>