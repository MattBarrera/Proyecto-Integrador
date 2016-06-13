<?php 
	require_once("config.php");
	
	$titulo = "Forgot Password";
	if ($auth->estaLogueado()) {
		$redirect->redirigirAIndex();
	}
		// A) Se hace una pasada por "todo" hashes.json y las cosas "viejas" se eliminan.
		$repositorio->getUserRepository()->eliminarHashesViejos();
   		// B) Si el hash que viene por GET NO EXISTE, se le pone un 404 (pagina no encontrada)
		
			//esta echo en el body este paso!

    	// C) Si el hash SI existe, se le pone un form que diga "nueva contraseña" y "confirmar contraseña" y se le cambia la password al usuario asociado al hash. Luego se lo puede autologuear y SE BORRA ESA LINEA DE hashes.json.

	if($_POST){
		//validar formato Password
		$errores = $validar->validarChangePassword($_POST)['errores'];
		if (empty($errores)) {
			//traigo el usuario mediante el id dentro de hashes.json
			$userId = $repositorio->getUserRepository()->getUserIdByHash($_GET['hash']);
			// Preparo el usuario a modificar
			$usuarioAModificar = $repositorio->getUserRepository()->usuarioPasswordAModificarEnJSON($userId, $_POST['password']);
			// var_dump($usuarioAModificar);exit;
			// Cambiar la password en JSON
			$repositorio->getUserRepository()->modificarUsuario($usuarioAModificar);
			// traigo el usuario a loguear a travez del id
			$usuarioALogear = $repositorio->getUserRepository()->getUsuarioById($userId);
			// logueo al usuario
			$auth->loguearUsuario($usuarioALogear);
			// Redireccionamiento Directo al INDEX YA LOGUEADO
			$redirect->redirigirAIndex();
		}
	}
 ?>
 <?php require_once("include/head.php"); ?>
<body>
	<?php require_once("include/header.php"); ?>
	<section id="containerLogin">
	    	<?php if ($repositorio->getUserRepository()->checkHash($_GET['hash'])) {
			echo '<h2>Restablecer contraseña</h2>
	    			<section class="login">
					<form action="" method="POST" id="formLogin">';	
				        if (!empty($errores) ) { 
				        	echo '<div class="error" id="errorRegister">
									<h3>Los siguientes Campos tuvieron errores</h3>
									<ul class="listadoErrores">';
										if (!empty($errores)) {
											 	foreach ($errores as $error) {
													echo'<li>'; echo $error; echo'</li>';
												}
											  }
									echo'</ul>
								</div>';
						 }; 
			      		echo'<div class="halfInput">
							<label for="password">Contraseña:</label>
							<input id="password" name="password" type="password" placeholder="Ingrese su contraseña">
							<br>
						</div>
						<div class="halfInput">
							<label for="password">Confirme su Contraseña:</label>
							<input id="confPassword" name="confPassword" type="password" placeholder="Vuelva a ingresar su contraseña">
							<br>
						</div>
			      		
			      		<input type="submit" id="btnLogin" value="Actualizar Contraseña"></input>
			        </form>';
		}else{
			echo 'El tiempo de Cambio de contraseña expiro, vuelve a restablecerla haicendo Click <button ><a href="forgotPassword.php">Aqui</a></button> , o ingresa al <button ><a href="login.php">Login</a></button>';
		}?>   	
	    </section>
    </section>
    <script>
    </script>
</body>
</html>