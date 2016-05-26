<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>clothes Shop - Register</title>
	<!-- Styles -->
	<link rel="stylesheet" href="css/stylesFinal.css">
	<!-- Scrips -->
	<script type="text/javascript" src="js/validate.js"></script>
	

</head>
<body>
	<header>
		<a href="index.html"><img src="img/final4.png" alt="Logo" id="logo"></a>
		<!-- <a href="#" onclick="Nav" class="btn-nav"><span>Menu</span></a> -->
		<nav>
			<ul>
				<li><a href="register.php">Register</a></li>
				<li><a href="#">Store</a></li>
			</ul>
		</nav>
	</header>
	<main>
		<section id="register">
			<div class="title"><h2>Registrate!</h2></div>
			<div class="error" id="errorRegister">
				<h3>Los siguientes Campos tuvieron errores</h3>
				<ul class="listadoErrores">
					
				</ul>
			</div>
			<form action="" method="POST" id="formRegister">
				<div class="halfInput">
					<label for="name">Nombre:</label>
					<input type="text" id="name" name="name" placeholder="Ingrese su Nombre" ><br>
				</div>
				<div class="halfInput">
					<label for="lastName">Apellido:</label>
					<input type="text" id="lastName" name="lastName" placeholder="Ingrese su Apellido"><br>
				</div>
				<div class="halfInput">
					<label for="email">Email:</label>
					<input type="email" id="email" name="email" placeholder="Ingrese su Email"><br>
				</div>
				<div class="halfInput">
					<label for="telefono">Telefono:</label>
					<input type="tel" id="telefono" name="telefono" placeholder="Ingrese su Telefono"><br>
				</div>
				<div class="halfInput">
					<label for="fechaNacimiento">Fecha nacimiento:</label>
					<input type="date" id="fechaNacimiento" name="fechaNacimiento" ><br>
				</div>
				<div class="halfInput">
					<label for="genero">Sexo:</label>
					    <select id="genero" name="genero">
					    	<option value=""> - Selecciona el genero - </option>
					        <option id="genero" value="Femenino">Femenino</option>
					        <option id="genero" value="Masculino">Masculino</option>
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
				<div class="acuerdos">
					<label for="acuerdos">Acepta los terminos y acuerdos?</label>
					<input type="checkbox" id="Si"name="si"> 
					<label for="Si">Si</label>
				</div>
				<div class="finalButton">
					<input type="reset" value="Reset">
					<input type="submit" value="Enviar" id="btnRegistrar"class="special"><br><br>
				</div>

			</form>

			<div id="myModalRegister" class="modal">
				<!-- Modal content -->
				<div class="modal-content">
			    	<div class="modal-header">
			      		<span class="close">×</span>
			    		<h2 class="headerGracias"></h2>
			    	</div>
			    <div class="modal-body">
			    	<p class="mensajeRegister">En minutos te va a estar llegando un Email para confirmar tu cuenta, y asi poder ingresar a tu cuenta! </p>
			    </div>
			    <div class="modal-footer">
					<button class="closeModal">Cerrar</button>
			    </div>
			  </div>
			</div>
				<div class="clear">
					<h2>¿Ya estas registrado?</h2><a href="login.html">Inicia sesion</a>
				</div>
		</section>
	</main>	
</body>
</html>