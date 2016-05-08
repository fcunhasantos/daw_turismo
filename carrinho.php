<?php
require_once ("controller/autenticaSessao.php");

include_once ("html/cabecalho_principal.html");
include_once ("menu_principal.php");

require_once("controller/Hoteis.php");
require_once("controller/Voos.php");
require_once("controller/Cidades.php");

$carrinho = $_SESSION['carrinho'];

if (isset($_GET['rh'])) {
	unset($carrinho['hoteis'][$_GET['rh']]);
	$_SESSION['carrinho'] = $carrinho;
}
elseif (isset($_GET['rv'])) {
	unset($carrinho['voos'][$_GET['rv']]);
	$_SESSION['carrinho'] = $carrinho;
}

/*foreach ($_SESSION as $key=>$value) {
	echo $key."=".$value."<br>";
}*/

?>
        
		<div class="wrapper" role="main">
			<div class="container">
				<div class="starter-template">
					<h2 class="header">Meu Carrinho</h2>
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
							<th>Diária</th>
							<th>Valor Total</th>
							<th> </th>
						</tr>
					</thead>
					<tbody id="tbCorpo">
					<?php
					$total_hoteis = 0;
					foreach ($carrinho['hoteis'] as $key=>$reserva) {
						//echo 'hotel:'.$reserva['hotel'].'<br>';
						if (!is_null($reserva['hotel'])) {
							$hoteis = new Hoteis();
							$hotel = $hoteis->getHotel($reserva['hotel']);
							if (is_array($hotel)) {
								
								if ($hotel['hotel_Categoria'] == 1) {
									$categoria = "Básico";
								} else {
									$categoria = "Luxo";
								}
								
								$cidades = new Cidades();
								$cidade = $cidades->getCidade($hotel['hotel_Cidade']);
								$nomeCidade = $cidade[0]['cidade_Nome'];
								
								$dtinicio = date_create($reserva['dtinicio']);
								$dtfinal = date_create($reserva['dtfinal']);
								$diff = date_diff($dtinicio,$dtfinal);
								$periodo = ($diff->y * 365.25) + ($diff->m * 30) + $diff->d;
								
								$total_hotel = $periodo * $hotel['hotel_Diaria'];
								
								$_SESSION['carrinho']['hoteis'][$key]['preco'] = $total_hotel;
								
								echo "<tr>";
								echo "<td>".$hotel['hotel_Nome']."</td>";
								echo "<td>".$categoria."</td>";
								echo "<td>".utf8_encode($nomeCidade)."</td>";
								echo "<td>".date_format($dtinicio, 'd/m/Y')." a ".date_format($dtfinal, 'd/m/Y')."</td>";
								echo "<td>".number_format($hotel['hotel_Diaria'],2,',','.')."</td>";
								echo "<td>".number_format($total_hotel,2,',','.')."</td>";
								echo "<td><a href='./carrinho.php?rh=".$key."' class='btn btn-danger btn-xs' role='button'>Retirar</a></td>";
								//echo "<td><button class='btn btn-danger btn-xs removerHotel' type='button'>Remover</button></td>";
								echo "</tr>";
								
								$total_hoteis += $total_hotel;
							} else {
								echo "<tr><td colspan='7'>Não encontrado registro (".$reserva['hotel'].")</td></tr>";
							}
						} else {
							echo "<tr><td colspan='7'>Nenhum registro encontrado</td></tr>";
						}
					}
					?>
					</tbody>
					<tfoot>
						<tr>
							<td colspan="5">Total</td>
							<td colspan="2"><?php echo "R$ ".number_format($total_hoteis,2,',','.'); ?></td>
						</tr>
					</tfoot>
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
							<th>Passagem</th>
							<th>Nº Passageiros</th>
							<th>Valor Total</th>
							<th> </th>
						</tr>
					</thead>
					<tbody id="tbCorpo">
					<?php
					$total_voos = 0;
					foreach ($carrinho['voos'] as $key=>$reserva) {
						//echo 'hotel:'.$reserva['hotel'].'<br>';
						if (!is_null($reserva['voo'])) {
							$voos = new Voos();
							$voo = $voos->getVoo($reserva['voo']);
							if (is_array($voo)) {
								
								$cidades = new Cidades();
								$cidade = $cidades->getCidade($voo['voo_CidadeOrigem']);
								$nomeCidadeOrigem = $cidade[0]['cidade_Nome'];
								$cidade = $cidades->getCidade($voo['voo_CidadeDestino']);
								$nomeCidadeDestino = $cidade[0]['cidade_Nome'];
								
								$data = date_create($voo['voo_Data']);
								
								$total_voo = $reserva['passageiros'] * $voo['voo_Preco'];
								$_SESSION['carrinho']['voos'][$key]['preco'] = $total_hotel;
								
								echo "<tr>";
								echo "<td>".$voo['voo_Cod']."</td>";
								echo "<td>".utf8_encode($nomeCidadeOrigem)."</td>";
								echo "<td>".utf8_encode($nomeCidadeDestino)."</td>";
								echo "<td>".date_format($data, 'd/m/Y h:i:s')."</td>";
								echo "<td>".number_format($voo['voo_Preco'],2,',','.')."</td>";
								echo "<td>".$reserva['passageiros']."</td>";
								echo "<td>".number_format($total_voo,2,',','.')."</td>";
								echo "<td><a href='./carrinho.php?rv=".$key."' class='btn btn-danger btn-xs' role='button'>Retirar</a></td>";
								//echo "<td><button class='btn btn-danger btn-xs removerVoo' type='button'>Remover</button></td>";
								echo "</tr>";
								
								$total_voos += $total_voo;
							} else {
								echo "<tr><td colspan='8'>Não encontrado registro (".$reserva['voo'].")</td></tr>";
							}
						} else {
							echo "<tr><td colspan='8'>Nenhum registro encontrado</td></tr>";
						}
					}
					?>
					</tbody>
					<tfoot>
						<tr>
							<td colspan="6">Total</td>
							<td colspan="2"><?php echo "R$ ".number_format($total_voos,2,',','.'); ?></td>
						</tr>
					</tfoot>
				</table>
				
				<div class="starter-template">
					<h2 class="footer">Valor Total R$<?php echo number_format($total_hoteis+$total_voos,2,',','.'); ?></h2>
				</div>
				
				<a href="controller/fazerReservas.php" class="btn btn-primary btn-lg pull-right" role="button">Comprar</a>
				
			</div>
		</div>

<?php
include_once("html/rodape_principal.html");
?>