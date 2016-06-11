<?php 
	require_once("config.php");
	if (!$auth->estaLogueado()) {
		$redirect->redirigirALoginBackDoor();
	}
	$titulo = "My Acount";
	$genero = [
				''=>' - Selecciona el genero - ',
				'Masculino'=>'Masculino',
				'Femenino'=>'Femenino',
				'Otro'=>'Otro'
			];
	$datosUsuario = $repositorio->getUserRepository()->getUsuarioById($_SESSION['usuarioLogueado']);
	if ($_POST) {
		//valido los datos, si hay errores los muestro
		$errores =  $validar->validarUsuarioAModificar($_POST)['errores'];
		$datosUsuario = $validar->validarUsuarioAModificar($_POST)['datosUsuario'];
		//capturo el avatar
			if (isset($_FILES['fotoPerfil'])) {
				$datosUsuarioAvatar = $_FILES['fotoPerfil'];
			}
		if (empty($errores)) {
			//rutina para subir el avatar fisico
			Usuario::uploadAvatar($_SESSION['usuarioLogueado'],$datosUsuarioAvatar);//
			//preparo al usuario = lo meto en una variable del JSON
			$usuarioAModificar = $repositorio->getUserRepository()->usuarioAModificarEnJSON($datosUsuario,$datosUsuarioAvatar);//
			//modifico el usuario en el archivo
			$repositorio->getUserRepository()->modificarUsuario($usuarioAModificar);	
		}
	}
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
					<input type="text" id="name" name="name" placeholder="Ingrese su Nombre" value="<?php echo $repositorio->getUserRepository()->getUsuarioById($_SESSION['usuarioLogueado'])->getNombre() ?>"><br>
				</div>
				<div class="halfInput">
					<label for="lastName">Apellido:</label>
					<input type="text" id="lastName" name="lastName" placeholder="Ingrese su Apellido" value="<?php echo $repositorio->getUserRepository()->getUsuarioById($_SESSION['usuarioLogueado'])->getApellido() ?>"><br>
				</div>
				<div class="halfInput">
					<label for="email">Email:</label>
					<input type="text" id="email" name="email" placeholder="Ingrese su Email" value="<?php echo $repositorio->getUserRepository()->getUsuarioById($_SESSION['usuarioLogueado'])->getMail() ?>"><br>
				</div>
				<div class="halfInput">
					<label for="telefono">Telefono:</label>
					<input type="tel" id="telefono" name="telefono" placeholder="Ingrese su Telefono" value="<?php echo $repositorio->getUserRepository()->getUsuarioById($_SESSION['usuarioLogueado'])->getTelefono(); ?>"><br>
				</div>
				<div class="halfInput">
					<label for="fechaNacimiento">Fecha nacimiento:</label>
					<input type="date" id="fechaNacimiento" name="fechaNacimiento" value="<?php echo $repositorio->getUserRepository()->getUsuarioById($_SESSION['usuarioLogueado'])->getFechaNacimiento(); ?>"><br>
				</div>

				<div class="halfInput">
					<label for="genero">Sexo:</label>
					    <select id="genero" name="genero">
					    	<?php foreach ($genero as $key => $value) { ?>
								<?php if ($key == $repositorio->getUserRepository()->getUsuarioById($_SESSION['usuarioLogueado'])->getGenero()) { ?>
									<option selected value="<?php echo $key; ?>" ><?php echo $value;?></option>
								<?php } else { ?>
									<option value="<?php echo $key;?>"><?php echo $value;?></option>
								<?php } ?>
							<?php } ?>
					    </select>
				    <br>
				</div>
				 
				<div class="halfInput">
					<label for="password">Contraseña Anterior:</label>
					<input id="password" name="password" type="password" placeholder="Ingrese la contraseña anterior">
					<br>
				</div>
				<div class="halfInput">
					<label for="password">Nueva Contraseña:</label>
					<input id="password" name="newPassword" type="password" placeholder="Ingrese su contraseña">
					<br>
				</div>
				<div class="halfInput">
					<label for="password">Confirme su nueva Contraseña:</label>
					<input id="confPassword" name="newConfPassword" type="password" placeholder="Vuelva a ingresar su contraseña">
					<br>
				</div>
				<div class="halfInput">
					<label for="fotoPerfil">Foto de perfil</label><br>
					<?php if ($repositorio->getUserRepository()->getUsuarioById($_SESSION['usuarioLogueado'])->getFotoPerfil() == "avatar_2x.png") {
						 	echo '<img class="fotoPerfil" src="assets/'.$repositorio->getUserRepository()->getUsuarioById($_SESSION['usuarioLogueado'])->getFotoPerfil().'" alt="">';
						}else{
							echo '<img class="fotoPerfil" src="assets/'.$_SESSION['usuarioLogueado'].'/profile/'.$repositorio->getUserRepository()->getUsuarioById($_SESSION['usuarioLogueado'])->getFotoPerfil().'" alt="">';
						}?><br>
					<input type="file" name="fotoPerfil" id="fotoPerfil">
					<br>
				</div>
				<div class="finalButton">
					<input type="submit" value="Modificar" id="btnRegistrar special"><br><br>
				</div>
			</form>
			<button><a href="deleteProfile.php?">Eliminar Perfil</a></button>
	</section>		
</body>
</html>