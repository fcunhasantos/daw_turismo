<?php
require_once ("controller/autenticaSessao.php");
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
		<h3 class="form-signin-heading">Dados do Cliente</h3>
			<form role="form" method="post" enctype="multipart/form-data"
				action="controller/alterarCliente.php" class="form-signin fileinput">
				<div class="row">
					<div class="col-md-6">
						<div class="hidden">
							<input type="hidden" name="codigo" value="<?php echo utf8_encode($dadosCliente['cliente_Cod']); ?>">
						</div>
						<div class="form-group">
							<label for="InputNome">Nome Completo:</label>
							<input type="text"
								class="form-control" id="InputNome" name="nome"
								value="<?php echo utf8_encode($dadosCliente['cliente_Nome']); ?>" required>
						</div>
						<div class="form-group">
							<label for="InputCidade">Cidade:</label>
							<select class="form-control selectpicker" id="InputCidade" name="cidade" required>
							<?php
								$cidades = new Cidades ();
								$resultado = $cidades->retornaCidades ();
								
								if (is_array ( $resultado )) {
									foreach ( $resultado as $dados ) {
										echo "<option ";
										if ($dadosCliente['cliente_Cidade'] == $dados['cidade_Cod']) {
											echo " selected ";
										}
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
							<label for="InputEmail">Email:</label> <input type="email"
								class="form-control" id="InputEmail" name="email"
								value="<?php echo utf8_encode($dadosCliente['cliente_Email']); ?>" required>
						</div>
						<div class="form-group">
							<label for="InputSenha">Senha:</label> <input type="password"
								class="form-control" id="InputSenha" name="senha"
								placeholder="Informe para alterar a senha (4 a 8 caracteres)">
						</div>
						<div class="form-group">
							<label for="InputSenhaConf">Confirmação de Senha:</label> <input
								type="password" class="form-control" id="InputSenhaConf"
								name="senha2" placeholder="Confirme a senha">
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-primary pull-left">Salvar</button>
							<a class="btn btn-danger pull-right"
							href="controller/excluirCliente.php?id=<?php echo $_SESSION['cliente_Cod']; ?>" >Excluir Conta</a>
						</div>
					</div>
					
					<div class="col-md-6">
						<label>Foto:</label>
                        <div class="input-group image-preview">
                            <!-- don't give a name === doesn't send on POST/GET -->
                            <input type="text" class="form-control image-preview-filename" disabled="disabled">
                            <span class="input-group-btn">
                                <!-- image-preview-clear button -->
                                <button type="button" class="btn btn-default image-preview-clear" style="display:none;">
                                    <span class="glyphicon glyphicon-remove"></span> Limpar
                                </button>
                                <!-- image-preview-input -->
                                <div class="btn btn-default image-preview-input">
                                    <span class="glyphicon glyphicon-folder-open"></span>
                                    <span class="image-preview-input-title">Buscar</span>
                                    <!-- rename it -->
                                    <input type="file" accept="image/png, image/jpeg, image/gif" name="input-file-preview"/>
                                </div>
                            </span>
                        </div>
                        <div class="form-group">
							<img class="img-thumbnail img-user" alt="177x236"
							src="<?php
									if (isset($dadosCliente['cliente_Foto'])) {
										echo "img/users/user.svg";
									} else {
										echo str_replace('../', '', $dadosCliente['cliente_Foto']);
									}
								?>">
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<?php
include_once ("html/rodape_principal.html");
?>