<?php 

	require_once("config.php");

	if ($auth->estaLogueado()) {
		$redirect->redirigirAIndex();
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
			// $usuario = new Usuario;
			$usuarioAGuardar = $repositorio->getUserRepository()->crearUsuario($_POST);
			//la variable creada, la meto en un JSON
			var_dump($usuarioAGuardar);exit;
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
				<?php 
					} ?>
				<div class="halfInput">
					<label for="name">Nombre:</label>
					<input type="text" id="name" name="name" placeholder="Ingrese su Nombre" value="<?php if ($_POST) { echo $datosUsuario['name']; } ?>"><br>
				</div>
				<div class="halfInput">
					<label for="lastName">Apellido:</label>
					<input type="text" id="lastName" name="lastName" placeholder="Ingrese su Apellido" value="<?php if ($_POST) { echo $datosUsuario['lastName']; } ?>"><br>
				</div>
				<div class="halfInput">
					<label for="email">Email:</label>
					<input type="text" id="email" name="email" placeholder="Ingrese su Email" value="<?php if ($_POST) { echo $datosUsuario['email']; } ?>"><br>
				</div>
				<div class="halfInput">
					<label for="telefono">Telefono:</label>
					<input type="tel" id="telefono" name="telefono" placeholder="Ingrese su Telefono" value="<?php if ($_POST) { echo $datosUsuario['telefono']; } ?>"><br>
				</div>
				<div class="halfInput">
					<label for="fechaNacimiento">Fecha nacimiento:</label>
					<input type="date" id="fechaNacimiento" name="fechaNacimiento" value="<?php if ($_POST) { echo $datosUsuario['fechaNacimiento']; } ?>"><br>
				</div>
				<div class="halfInput">
					<label for="genero">Sexo:</label>
					    <select id="genero" name="genero">
					        <?php foreach ($genero as $key => $value) { ?>
								<?php if (isset($_POST["genero"]) && $key == $_POST["genero"]) { ?>
									<option selected value="<?php echo $key?>"><?php echo $value?></option>
								<?php } else { ?>
									<option value="<?php echo $key?>"><?php echo $value?></option>
								<?php } ?>
							<?php } ?>
					    </select>

				    <br>
				</div>
				<div class="halfInput">
					<label for="password">Contraseña:</label>
					<input id="password" name="password" type="password" placeholder="Ingrese su contraseña">
					<br>
				</div>
				<div class="halfInput">
					<label for="password">Confirme su Contraseña:</label>
					<input id="confPassword" name="confPassword" type="password" placeholder="Vuelva a ingresar su contraseña">
					<br>
				</div>
				<div class="terminos">
					<label for="terminos">Acepta los terminos y condiciones?</label>
					<input type="checkbox" id="terminos" name="terminos" value="si" <?php if ($_POST && isset ($_POST['terminos']) ) {  echo "checked"; }  ?> > 
					<label for="terminos">Si</label>
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