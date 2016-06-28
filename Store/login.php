<?php 
	require_once("config.php");
	
	$titulo = "Login";
	$redirectTo = "";
	if (array_key_exists("redirectTo", $_GET)) {
		$redirectTo = $_GET["redirectTo"];
	} 

	if ($auth->estaLogueado()) {
		$redirect->redirigirAIndex();
	}
	if ($_POST) {
		$errores = $validar->validarLogin();
		// si no hay errores....
		if (empty($errores)) {
			$usuarioALogear = $repositorio->getUserRepository()->getUsuarioByMail($_POST['email']);

			//validar login
			$auth->loguearUsuario($usuarioALogear);
			//si login esta ok, redirigir
			if (array_key_exists("redirectTo", $_GET)) {
				// echo 'redirectTo';
				header("location:" . $_POST["redirectTo"]);
				exit;
			}else {
				// echo 'index';
				$redirect->redirigirAIndex();		
			}	
		}
	}
 ?>
 <?php require_once("include/head.php"); ?>
<body>
	
	<?php require_once("include/header.php"); ?>
	<section id="containerLogin">
        <h2>Inicia Sesion</h2>
	    <section class="login">
	      	<form action="" method="POST" id="formLogin">
		        <?php if (!empty($errores) ) { ?>
						<div class="error" id="errorRegister">
							<h3>Los siguientes Campos tuvieron errores</h3>
							<ul class="listadoErrores">
								<?php if (!empty($errores)) {
									 	foreach ($errores as $error) {
											?> <li><?php echo $error; ?></li><?php
										}
									  }?>
							</ul>
						</div>
				<?php } ?>
				<?php if (isset($_GET['errorLogin'])) { ?>
							<div class="error" id="errorRegister">
								<?php echo 'Tenes que loguearte para ingresar a esta pagina';?>
							</div>
					<?php }?>
	      		<label for="email">Email</label>
	      		  <input type="text" name="email" id="email"><br>
	      		<label for="password">Password</label>
	      		  <input type="password" name="password" id="password"><br>
	      		
	      		<input type="checkbox" name="recordarme" id="recordarme" >
	      		<label for="recordarme">Recordarme</label><br>
	      		<button><a href="forgotPassword.php">Olvide mi Password</a></button><br>
	      		<input type="hidden" name="redirectTo" id="redirectTo" value="<?php echo $redirectTo; ?>">
	      		<input type="submit" id="btnLogin" value="Login"></input>
	        </form>
	    </section>
    </section>
    <?php require_once("include/footer.php") ?>
</body>
</html>