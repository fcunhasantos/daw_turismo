<?php
require_once ("controller/autenticaSessao.php");

include_once ("html/cabecalho_principal.html");
include_once ("menu_principal.php");

require_once("controller/ReservasHotel.php");
require_once("controller/ReservasVoo.php");
require_once("controller/Hoteis.php");
require_once("controller/Voos.php");
require_once("controller/Cidades.php");

$objReservaHotel = new ReservasHotel();
$reservaHotel = $objReservaHotel->retornaReservas($_SESSION['cliente_Cod']);

$objReservaVoo = new ReservasVoo();
$reservaVoo = $objReservaVoo->retornaReservas($_SESSION['cliente_Cod']);

?>
        
		<div class="wrapper" role="main">
			<div class="container">
				<div class="starter-template">
					<h2 class="header">Minhas Compras</h2>
				</div>
				
				<div class="starter-template">
					<h3 class="sub-header">Hoteis</h3>
				</div>
				<table class="table table-striped" id="hoteis">	
					<thead>
						<tr>
							<th>Hotel</th>
							<th>Categoria</th>
							<th>Cidade</th>
							<th>Período</th>
							<th>Valor Total</th>
						</tr>
					</thead>
					<tbody id="tbCorpo">
					<?php
					foreach ($reservaHotel as $key=>$reserva) {
						$hoteis = new Hoteis();
						$hotel = $hoteis->getHotel($reserva['reservasHotel_Hotel']);
						if (is_array($hotel)) {
							
							if ($hotel['hotel_Categoria'] == 1) {
								$categoria = "Básico";
							} else {
								$categoria = "Luxo";
							}
							
							$cidades = new Cidades();
							$cidade = $cidades->getCidade($hotel['hotel_Cidade']);
							$nomeCidade = $cidade[0]['cidade_Nome'];
							
							$dtinicio = date_create($reserva['reservasHotel_DataEntrada']);
							$dtfinal = date_create($reserva['reservasHotel_DataSaida']);
							
							echo "<tr>";
							echo "<td>".$hotel['hotel_Nome']."</td>";
							echo "<td>".$categoria."</td>";
							echo "<td>".utf8_encode($nomeCidade)."</td>";
							echo "<td>".date_format($dtinicio, 'd/m/Y')." a ".date_format($dtfinal, 'd/m/Y')."</td>";
							echo "<td>".number_format($reserva['reservasHotel_PrecoTotal'],2,',','.')."</td>";
							echo "</tr>";
						} else {
							echo "<tr><td colspan='5'>Nenhum registro encontrado</td></tr>";
						}
					}
					?>
					</tbody>
				</table>
				
				<div class="starter-template">
					<h3 class="sub-header">Passagens</h3>
				</div>
				<table class="table table-striped" id="voos">	
					<thead>
						<tr>
							<th>Vôo</th>
							<th>Origem</th>
							<th>Destino</th>
							<th>Data/Hora</th>
							<th>Nº Passageiros</th>
							<th>Valor Total</th>
						</tr>
					</thead>
					<tbody id="tbCorpo">
					<?php
					foreach ($reservaVoo as $key=>$reserva) {
						$voos = new Voos();
						$voo = $voos->getVoo($reserva['reservasVoo_Voo']);
						if (is_array($voo)) {
							
							$cidades = new Cidades();
							$cidade = $cidades->getCidade($voo['voo_CidadeOrigem']);
							$nomeCidadeOrigem = $cidade[0]['cidade_Nome'];
							$cidade = $cidades->getCidade($voo['voo_CidadeDestino']);
							$nomeCidadeDestino = $cidade[0]['cidade_Nome'];
							
							$data = date_create($voo['voo_Data']);
							
							echo "<tr>";
							echo "<td>".$voo['voo_Cod']."</td>";
							echo "<td>".utf8_encode($nomeCidadeOrigem)."</td>";
							echo "<td>".utf8_encode($nomeCidadeDestino)."</td>";
							echo "<td>".date_format($data, 'd/m/Y h:i:s')."</td>";
							echo "<td>".$reserva['reservasVoo_QuantPassageiros']."</td>";
							echo "<td>".number_format($reserva['reservasVoo_PrecoTotal'],2,',','.')."</td>";
							echo "</tr>";
						} else {
							echo "<tr><td colspan='6'>Nenhum registro encontrado</td></tr>";
						}
					}
					?>
					</tbody>
				</table>
				
			</div>
		</div>

<?php
include_once("html/rodape_principal.html");
?>