<?php
	require_once("config.php");

	$titulo = "usuarios Seguidos";

	if ($_POST) {
		$usuarioSeguidorId = $_POST['usuarioSeguidorId'];
		$seguidor = $repositorio->getUserRepository()->dejarDeSeguirUsuario($_SESSION['usuarioLogueado'],$usuarioSeguidorId);
	}
	$seguidores = $repositorio->getUserRepository()->getAllSeguidores($_SESSION['usuarioLogueado']);
	// var_dump($seguidores);

 ?>
	<?php require_once("include/head.php"); ?>
<body>
	<?php  require_once("include/header.php");?>
<section id="productosStore">
	<?php if (count($seguidores > 0)) { ?>
		<h1>Estos son todos los usuarios que seguis:</h1>
		<div class="productosDestacados">
			<div class="carrito">
					<table class="tableFull">
						<tr>
							<th>Foto</th>
							<th>Nombre:</th>
							<th>Apellido</th>
							<th>Email:</th>
							<!-- <th></th> -->
							<th></th>
						</tr>
						<?php for ($i = 0; $i < count($seguidores) ; $i++) { ?>
						<tr class="productoCarrito">
								<?php $datosSeguidor = $repositorio->getUserRepository()->getUsuarioById($seguidores[$i]['usuarioSeguidorId']); 
									if ($repositorio->getUserRepository()->getUsuarioById($seguidores[$i]['usuarioSeguidorId'])->getFotoPerfil() == "avatar_2x.png") {
										$comunAvatar = '<img class="fotoPerfil" src="assets/'.$repositorio->getUserRepository()->getUsuarioById($seguidores[$i]['usuarioSeguidorId'])->getFotoPerfil().'" alt="">';
									}else{
										$comunAvatar = 
											'<img class="fotoPerfil" src="assets/'.$seguidores[$i]['usuarioSeguidorId'].'/profile/'.$repositorio->getUserRepository()->getUsuarioById($seguidores[$i]['usuarioSeguidorId'])->getFotoPerfil().'" alt="">';
									} ?>				
									<td>
										<!-- <?php var_dump($comunAvatar); ?> -->
										<div class="productoFotoCarrito"><?php echo $comunAvatar; ?></div>
									</td>
									<td>	
										<div class="infoProdcuto">
											<p><?php echo $datosSeguidor->getNombre();?></p>
										</div>
									</td>
									<td>
										<div class="infoProducto">
											<p><?php echo $datosSeguidor->getApellido();?></p>
										</div>
									</td>
									<td>
										<div class="infoProducto">
											<p><?php echo $datosSeguidor->getMail();?></p>
										</div>
									</td>
<!-- 									<td>
										<div class="infoProducto">
											<p>$ 100</p>
										</div>
									</td> -->
									<td>
										<div class="infoProducto">
											<form action="" method="POST">
												<input type="hidden" name="usuarioSeguidorId" value="<?php echo $datosSeguidor->getId();?>">
												<input type="submit" value="Dejar de Seguir usuario" id="btnRegistrar special">
											</form>
										</div>
									</td>
						</tr>								
						<?php } ?>
					</table>
			</div>
		</div>
<?php }else{
		echo '<h1>Todavia no seguis a nadie</h1>';
	} ?>
</section>
	<?php require_once("include/footer.php") ?>
</body>
</html>
