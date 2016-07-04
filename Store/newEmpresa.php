<?php 

	require_once("config.php");

	if (!$auth->estaLogueado()) {
		$redirect->redirigirALoginBackDoor();
	}
	$titulo = "Register";
	$genero = [
		''=>' - Selecciona el genero - ',
		'Masculino'=>'Masculino',
		'Femenino'=>'Femenino',
		'Otro'=>'Otro'
	];
	if ($_POST) {
		$errores = $validar->validarUsuario($_POST)['errores'];
		$datosUsuario = $validar->validarUsuario($_POST)['datosUsuario'];
		//si no hay errores....
		if (empty($errores)) {
			//crear el usuario = preaparar el usuario en una variable
			$usuarioAGuardar = $repositorio->getUserRepository()->crearUsuario($_POST);
			//la variable creada, la meto en un JSON
			// var_dump($usuarioAGuardar);exit;
			$repositorio->getUserRepository()->guardarUsuario($usuarioAGuardar);
			//si esta todo ok, lo logeo
			$redirect->redirigirALogin();
		}
	}
 ?>
 <?php require_once("include/head.php"); ?>
 <body>
	<?php require_once("include/header.php"); ?>
	<section id="register">
			<div class="title"><h2>Registrate!</h2></div>
			<form action="" method="POST" id="formRegister">
					<?php if (!empty($errores)) {
						?>
					<div class="error" id="errorRegister">
						<h3>Los siguientes Campos tuvieron errores</h3>
						<ul class="listadoErrores">
							<?php foreach ($errores as $key => $error) {
								?> <li><?php echo $error; ?></li><?php
							} ?>
						</ul>
					</div>
					<div></div>
				<?php 
					} ?>
				<div class="halfInput">
					<label for="name">Nombre:</label>
					<input type="text" id="empresaNombre" name="empresaNombre" placeholder="Ingrese su Nombre" value="<?php if ($_POST) { echo $datosUsuario['name']; } ?>"><br>
				</div>
				<div class="halfInput">
					<label for="empresaMail">Email:</label>
					<input type="email" id="empresaMail" name="empresaMail" placeholder="Ingrese su Email" value="<?php if ($_POST) { echo $datosUsuario['email']; } ?>"><br>
				</div>
				<div class="halfInput">
					<label for="empresaCUIT">CUIT:</label>
					<input type="text" id="empresaCUIT" name="empresaCUIT" placeholder="Ingrese su CUIT" value="<?php if ($_POST) { echo $datosUsuario['lastName']; } ?>"><br>
				</div>
				<div class="halfInput">
					<label for="empresaTelefono">Telefono:</label>
					<input type="tel" id="empresaTelefono" name="empresaTelefono" placeholder="Ingrese su Telefono" value="<?php if ($_POST) { echo $datosUsuario['telefono']; } ?>"><br>
				</div>
				<div class="halfInput">
					<label for="empresaDireccion">Direccion:</label>
					<input type="text" id="empresaDireccion" name="empresaDireccion" placeholder="Ingrese su Direccion" value="<?php if ($_POST) { echo $datosUsuario['telefono']; } ?>"><br>
				</div>
				<div class="finalButton">
					<input type="reset" value="Reset">
					<input type="submit" value="Enviar" id="btnRegistrar"class="special"><br><br>
				</div>
			</form>
	</section>
	<?php require_once("include/footer.php") ?>		
</body>
</html>