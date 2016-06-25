<?php 
	require_once("config.php");
	$titulo = "Reactivar Usuario";
	if ($auth->estaLogueado()) {
		$redirect->redirigirAIndex();
	}
	if($_POST){
		// var_dump($_POST);exit;
		//validar si existe el mail
		$errores = $validar->validarForgotPassword($_POST)['errores'];
		$id = $repositorio->getUserRepository()->getUsuarioByMail($_POST['email'])->getId();
		// var_dump($id);exit;
		if (empty($errores)) {
			//llamo a funcion que crea Hash
			$hash = $repositorio->getUserRepository()->crearHash(30);
			// var_dump("primero creado ".$hash);
			//guardo el hash en un JSON, con el id del usuario y la fecha
			$hashAGuardar = $repositorio->getUserRepository()->hashAGuardar($hash,$id);
			// var_dump("nuevo ".$hashAGuardar['hashHash']);
			$repositorio->getUserRepository()->guardarHash($hashAGuardar);
			//si esta ok el mail, mando mail con el Hash
				$mail = $_POST['email'];
				// var_dump($_POST);exit;
				$subjet = 'Restablecer la Contraseña - Clothes Shop';
				// Para enviar un correo HTML, debe establecerse la cabecera Content-type
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= "X-Mailer: PHP/" . phpversion() . " \r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

				// Cabeceras adicionales
				// $headers .= 'To: Manuel Vilche <manuelvilche@gmail.com>' . "\r\n";
				$headers .= 'From: Clothes Shop <noreplay@clothesshop.com>' . "\r\n";
				// $headers .= 'Cc: birthdayarchive@example.com' . "\r\n";
				// $headers .= 'Bcc: birthdaycheck@example.com' . "\r\n";
				$message = "<div style=\"background-color:#ace2fa; width:550px; padding:15px; margin:auto; border:1px solid #008\">";   // esta línea genera un div para dar formato.

				$message .= '<h2>Restablece tu Contraseña</h2>
		      		<p>Podes restablecer tu contraseña haciendo click <a href="http://dh/Proyecto-Integrador/Store/changePassword.php?hash='.$hashAGuardar['hashHash'].'&e=1">Aqui</a> o en este link:</p>
		      		<a href="http://dh/Proyecto-Integrador/Store/changePassword.php?hash='.$hashAGuardar['hashHash'].'&e=1">http://dh/Proyecto-Integrador/changePassword.php?hash='.$hashAGuardar['hashHash'].'&e=1</a>';  // <--- modificar este contenido con el contenido de tu email

				$message .= "</div>";  // está línea cierra el div

				mail($mail, $subjet, $message, $headers);
				$redirect->redirigirAIndex();
		}
	}
 ?>
 <?php require_once("include/head.php"); ?>
<body>
	
	<?php require_once("include/header.php"); ?>
	<section id="containerLogin">
        <h2>Usuario Dado de Baja</h2>
        <p>Para reactivar tu cuenta tenes que cambiar tu Password.</p>
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
	      		<label for="email">Email</label>
	      		<input type="text" name="email" id="email"><br>
	      		<input type="submit" id="btnLogin" value="Enviar Email"></input>

	        </form>
	    </section>
    </section>
<?php require_once("include/footer.php") ?>
</body>
</html>