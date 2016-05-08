<?php
require_once ("controller/autenticaSessao.php");

include_once ("html/cabecalho_principal.html");
include_once ("menu_principal.php");

require_once("controller/Hoteis.php");
require_once("controller/Cidades.php");

$hoteis = new Hoteis();
$hotel = $hoteis->getHotel($_GET['hotel']);

$cidades = new Cidades();
$cidade = $cidades->getCidade($hotel['hotel_Cidade']);
$nomeCidade = utf8_encode($cidade[0]['cidade_Nome']);

?>
        
		<div class="wrapper" role="main">
			<div class="container">
				<div class="starter-template">
					<h3 class="sub-header">Reservar Hotel</h3>
				</div>
				<form role="form" method="post" action="controller/reservarHotel.php" class="form-signin">
					<div class="form-group">
						<div class="hidden">
							<input type="hidden" name="hotel_Cod" value="<?php echo utf8_encode($hotel['hotel_Cod']); ?>">
						</div>
					</div>
					<div class="form-group">
						<label><?php echo utf8_encode($hotel['hotel_Nome']) ." - ". utf8_encode($nomeCidade); ?></label>
					</div>
					<div class="form-group">
						<label for="InputPeriodo">Período</label>
						<div class="row">
							<div class="col-md-3">
								<input type="date" class="form-control" id="InputPeriodoIni" name="periodo_Ini" required="required">
							</div>
							<div class="col-md-3">
								<input type="date" class="form-control" id="InputPeriodoFim" name="periodo_Fim" required="required">
							</div>
						</div>
					</div>
					<button type="submit" class="btn btn-primary">Fazer Reserva</button>
				</form>
			</div>
		</div>

<?php
include_once("html/rodape_principal.html");
?>