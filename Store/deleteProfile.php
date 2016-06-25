<?php 
	require_once("config.php");
	if (!$auth->estaLogueado()) {
		$redirect->redirigirALoginBackDoor();
	}
	$titulo = "Delete my profile";
	
	$datosUsuario = $repositorio->getUserRepository()->getUsuarioById($_SESSION['usuarioLogueado']);
	// echo 'string';
	if ($_POST) {
		// var_dump($_POST['manu']);
		// echo 'string';
		// var_dump($_SESSION['usuarioLogueado']);exit;
		//preparo al usuario
		// var_dump($datosUsuario);exit;
		$usuarioAModificar = $repositorio->getUserRepository()->deleteProfile($datosUsuario, $_POST['baja']);
		// var_dump($usuarioAModificar);exit;

		//modifico el usuario en el archivo
		$repositorio->getUserRepository()->guardarUsuario($usuarioAModificar);
		
		$auth->logout();
		$redirect->redirigirAIndex();
	}
?>
<?php require_once("include/head.php"); ?>
<body>
	<?php require_once("include/header.php"); ?>
<section id="register">
			<div class="title"><h2>Delete your profile</h2></div>
			<section class="login">
				<form  method="POST" id="formRegister" id="formLogin">
					<p>De que forma queres dar de baja tu usuario!?</p>

					<input type="radio" name="baja" value="2" id="temporal">
					<label for="temporal">Temporal</label>
					<input type="radio" name="baja" value="3" id="permanent">
					<label for="permanent">Permanente</label>

					<!-- <p>estas seguro que quieres eliminar tu perfil? esta accion no tiene vuelta atras.</p> -->
					<input type="submit" value="Delete my profile">
				</form>
			</section>
	</section>
	<?php require_once("include/footer.php") ?>		
</body>
</html>