<?php 
	require_once("config.php");
	
	$titulo = "My Acount";
	$genero = [
				''=>' - Selecciona el genero - ',
				'Masculino'=>'Masculino',
				'Femenino'=>'Femenino',
				'Otro'=>'Otro'
			];
	$datosUsuario = $repositorio->getUserRepository()->getUsuarioById($_GET['userId']);
	if ($_POST) {
		if (!$auth->estaLogueado()) {
			$redirect->redirigirALogin(urlencode("profileDetalle.php?userId=" . $_GET["userId"]));
		}
		if (isset($_POST['seguir'])) {
			// echo 'seguir';exit;
			$seguidor = $repositorio->getUserRepository()->seguirUsuario($_SESSION['usuarioLogueado'],$_GET['userId']);
		}else {
			// echo 'dejarDeSeguir';exit;
			$seguidor = $repositorio->getUserRepository()->dejarDeSeguirUsuario($_SESSION['usuarioLogueado'],$_GET['userId']);
		}
	}
	$resultado = $repositorio->getUserRepository()->conusltaSeguidores(isset($_SESSION['usuarioLogueado']),$datosUsuario->getId());
		//var_dump($resultado);exit;
	
?>
<?php require_once("include/head.php"); ?>
<body>
	<?php require_once("include/header.php"); ?>
<section id="register">
			<div class="title"><h2>My Acount</h2></div>
			<form action="" method="POST" id="formRegister" enctype="multipart/form-data">
				<?php if (!empty($errores)) { ?>
						<div class="error" id="errorRegister">
							<h3>Los siguientes Campos tuvieron errores</h3>
							<ul class="listadoErrores">
								<?php foreach ($errores as $error) { ?> 
									<li><?php echo $error; ?></li>
								<?php } ?>
							</ul>
						</div>
				<?php } ?>
				<div class="halfInput">
					<label for="name">Nombre:</label>
					<input type="text" id="name" name="name" placeholder="Ingrese su Nombre" readonly value="<?php echo $datosUsuario->getNombre() ?>"><br>
				</div>
				<div class="halfInput">
					<label for="lastName">Apellido:</label>
					<input type="text" id="lastName" name="lastName" placeholder="Ingrese su Apellido" readonly value="<?php echo $datosUsuario->getApellido() ?>"><br>
				</div>
				<div class="halfInput">
					<label for="email">Email:</label>
					<input type="text" id="email" name="email" placeholder="Ingrese su Email" readonly value="<?php echo $datosUsuario->getMail() ?>"><br>
				</div>
				<div class="halfInput">
					<label for="telefono">Telefono:</label>
					<input type="tel" id="telefono" name="telefono" placeholder="Ingrese su Telefono" readonly value="<?php echo $datosUsuario->getTelefono(); ?>"><br>
				</div>
				<div class="halfInput">
					<label for="fechaNacimiento">Fecha nacimiento:</label>
					<input type="text" id="fechaNacimiento" name="fechaNacimiento" readonly value="<?php echo $datosUsuario->getFechaNacimiento(); ?>"><br>
				</div>
				<div class="halfInput">
					<label for="genero">Sexo:</label>
					<input type="tel" id="telefono" name="genero" readonly value="<?php echo $datosUsuario->getGenero(); ?>"><br>
				</div>
				<div class="halfInput">
					<label for="fotoPerfil">Foto de perfil</label><br>
					<?php if ($datosUsuario->getFotoPerfil() == "avatar_2x.png") {
						 	echo '<img class="fotoProducto" src="assets/'.$datosUsuario->getFotoPerfil().'" alt="">';
						}else{
							echo '<img class="fotoProducto" src="assets/'.$datosUsuario->getId().'/profile/'.$datosUsuario->getFotoPerfil().'" alt="">';
						}?><br>
					<br>
				</div>
				<?php if ($_SESSION['usuarioLogueado'] !== $_GET["userId"]) {?>
					<div class="finalButton">
						<?php if ($resultado == false){?>
							<input type="hidden" name="seguir">
							<input type="submit" value="Seguir usuario" id="btnRegistrar special">
						<?php }else{ ?>
							<input type="hidden" name="dejarDeSeguir">
							<input type="submit" value="Dejar de Seguir usuario" id="btnRegistrar special">
							<?php } ?>
					</div>
				<?php } ?>
				<div class="clear"></div>
			</form>
	</section>
	<?php require_once("include/footer.php") ?>		
</body>
</html>