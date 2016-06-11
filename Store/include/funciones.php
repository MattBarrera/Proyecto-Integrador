<?php
	// session_start();
	// 	checkLogin();
		/********************************
			    Usuarios
		*********************************/
		//listo
		// function validarUsuario($usuario){
		// 	$errores = [];
		// 	if (trim($usuario["name"]) == ""){
		// 		$errores[] = "Falta ingresar el nombre";
		// 		$datosUsuario ['name'] = $usuario["name"];
		// 	}
		// 	if (trim($usuario["lastName"]) == ""){
		// 		$errores[] = "Falta ingresar el apellido";
		// 		$datosUsuario [] = $usuario["lastName"];
		// 	}
		// 	//validacion mail
		// 	if ($usuario["email"] == ""){
		// 		$errores[] = "Falta ingresar el mail";
		// 		$datosUsuario [] = $usuario["email"];
		// 	}elseif (!filter_var($usuario["email"], FILTER_VALIDATE_EMAIL)){
		// 			$errores[] = "Ingrese un Mail valido";
		// 			$datosUsuario [] = $usuario["email"];
		// 		}elseif (existeElMail($usuario["email"])){
		// 			$errores[] = "El Usuario ya  esta registrado";
		// 			$datosUsuario [] = $usuario["email"];
		// 		}
		// 	//fin validacion mail
		// 	if (trim($usuario["telefono"]) == ""){
		// 		$errores[] = "Falta ingresar el telefono";
		// 		$datosUsuario [] = $usuario["lastName"];
		// 	}
		// 	if (trim($usuario["fechaNacimiento"]) == ""){
		// 		$errores[] = "Falta ingresar la fecha de nacimiento";
		// 		$datosUsuario [] = $usuario["fechaNacimiento"];
		// 	}
		// 	if (trim($usuario["genero"]) == ""){
		// 		$errores[] = "Falta ingresar el genero";
		// 		$datosUsuario [] = $usuario["genero"];
		// 	}
		// 	if (trim($usuario["password"]) == ""){
		// 		$errores[] = "Falta ingresar la contraseña";
		// 	}
		// 	if (trim($usuario["confPassword"]) == ""){
		// 		$errores[] = "Falta ingresar la confirmacion de la contraseña";
		// 	}
		// 	if ($usuario["password"] != $usuario["confPassword"]){
		// 		$errores[] = "La contraseñas son distintas";
		// 	}
		// 	if ( !isset($usuario["terminos"])){
		// 		$errores[] = "Falta aceptar los terminos y condiciones";
		// 	}
		// 		// return $errores;

		// 		// return $datosUsuario;
		// 		$datosUsuario = $usuario;// yo querio agregar los datos como sie fuera errores...

		// 		return array('errores'=> $errores, 'datosUsuario'=>$datosUsuario);
		// }
		// function existeElMail($email){

		// 	$usuariosEnJSON = file_get_contents("usuarios.json");

		// 	$usuariosArrayEnJSON = explode(PHP_EOL, $usuariosEnJSON);

		// 	array_pop($usuariosArrayEnJSON);

		// 	foreach ($usuariosArrayEnJSON as $key => $usuariosEnJSON) {
		// 		$usuariosArrayEnJSON = json_decode($usuariosEnJSON, true);

		// 		if ($email == $usuariosArrayEnJSON["email"])
		// 		{
		// 			return true;
		// 		}
		// 	}

		// 	return false;
		// }
		// function crearUsuario($usuario){
		// 	$usuarioAGuardar = [
		// 		"id" => getNewID(),
		// 		"name" => $usuario['name'],
		// 		"lastName" => $usuario['lastName'],
		// 		"email" => $usuario['email'],
		// 		"telefono" => $usuario['telefono'],
		// 		"fechaNacimiento" => $usuario['fechaNacimiento'],
		// 		"genero" => $usuario['genero'],
		// 		"password" => password_hash($usuario["password"], PASSWORD_DEFAULT),
		// 		"fechaAlta" => date("d-m-Y - H:i:s"),
		// 		"fotoPerfil" => 'avatar_2x.png'
		// 	];
		// 	return $usuarioAGuardar;
		// }
		// function guardarUsuario($usuarioAGuardar){

		// 	$usuarioJSON = json_encode($usuarioAGuardar);

		// 	file_put_contents("usuarios.json", $usuarioJSON . PHP_EOL, FILE_APPEND);
		// }		
		/********************************
			    Modificar Usuarios
		*********************************/
		// function uploadAvatar($usuario,$usuarioAvatar){
		// 	if ($_FILES["fotoPerfil"]["error"] == UPLOAD_ERR_OK){
				
		// 		$id = getUsuarioByMail($usuario['email'])['id'];

		// 		// No hubo errores :)
		// 		$directory = dirname(__FILE__);
		// 		$directory = $directory . "/assets/".$id."/";
		// 		// echo getcwd();exit;
		// 		if (!is_dir($directory)) {
		// 			mkdir($directory);
		// 		}
		// 		// echo $directory;exit;
		// 		$destino = $directory . $_FILES['fotoPerfil']['name'];

		// 		move_uploaded_file($_FILES["fotoPerfil"]["tmp_name"], $destino);
		// 		}
		// }
		// function validarUsuarioAModificar($usuario){

		// 	$errores = [];

		// 	if (trim($usuario["name"]) == ""){
		// 		$errores[] = "Falta ingresar el nombre";
		// 		$datosUsuario ['name'] = $usuario["name"];
		// 	}
		// 	if (trim($usuario["lastName"]) == ""){
		// 		$errores[] = "Falta ingresar el apellido";
		// 		$datosUsuario [] = $usuario["lastName"];
		// 	}
		// 	//validacion mail
		// 	if ($usuario["email"] == ""){
		// 		$errores[] = "Falta ingresar el mail";
		// 		$datosUsuario [] = $usuario["email"];
		// 	}elseif (!filter_var($usuario["email"], FILTER_VALIDATE_EMAIL)){
		// 			$errores[] = "Ingrese un Mail valido";
		// 			$datosUsuario [] = $usuario["email"];
		// 		}
		// 	//fin validacion mail
		// 	if (trim($usuario["telefono"]) == ""){
		// 		$errores[] = "Falta ingresar el telefono";
		// 		$datosUsuario [] = $usuario["lastName"];
		// 	}
		// 	if (trim($usuario["fechaNacimiento"]) == ""){
		// 		$errores[] = "Falta ingresar la fecha de nacimiento";
		// 		$datosUsuario [] = $usuario["fechaNacimiento"];
		// 	}
		// 	if (trim($usuario["genero"]) == ""){
		// 		$errores[] = "Falta ingresar el genero";
		// 		$datosUsuario [] = $usuario["genero"];
		// 	}
		// 	if (trim($usuario["password"]) !== ""){
				
		// 		if (!password_verify(trim($usuario["password"]), getPasswordById($_SESSION["usuarioLogueado"])) ){
		// 			// echo "esta ok";
		// 			$errores[] = "Ingresaste mal tu contraseña anterior";
		// 		}
		// 		if ($usuario['newPassword'] == "" || $usuario['newConfPassword']=="") {
		// 			$errores[] = "Tenes que ingresar la nueva contraseña";
		// 		}elseif ($usuario["newPassword"] != $usuario["newConfPassword"]){
		// 			$errores[] = "La contraseñas son distintas";
		// 		}
				
				
		// 	}
		// 		$datosUsuario = $usuario;// yo querio agregar los datos como sie fuera errores...

		// 		return array('errores'=> $errores, 'datosUsuario'=>$datosUsuario);
		// }
		// function usuarioAModificarEnJSON($usuario, $usuarioAvatar){
		// 	// echo "hola desde usuarioAModificar";
		// 	//consulto si se envio la foto
		// 	if ($usuarioAvatar['name'] !== "") {
		// 			//si se envio la capturo
		// 			$fotoPerfil = $usuarioAvatar['name'];
		// 	}else{
		// 		//si no se envio, uso el nombre ya guardado
		// 		$fotoPerfil = getUsuarioByMail($usuario['email'])['fotoPerfil'];
		// 	}
		// 	if ($usuario['password'] == "") {
		// 		$password = getUsuarioByMail($usuario['email'])['password'];		
		// 	}else{
		// 		$password = password_hash($usuario['newPassword'],PASSWORD_DEFAULT);
		// 	}
			
		// 	$usuarioAModificar = [
		// 		"id" => $_SESSION["usuarioLogueado"],
		// 		"name" => $usuario['name'],
		// 		"lastName" => $usuario['lastName'],
		// 		"email" => $usuario['email'],
		// 		"telefono" => $usuario['telefono'],
		// 		"fechaNacimiento" => $usuario['fechaNacimiento'],
		// 		"genero" => $usuario['genero'],
		// 		"password" => $password,
		// 		"fotoPerfil" => $fotoPerfil,
		// 		"fechaAlta" => getUsuarioByMail($usuario['email'])['fechaAlta'],
		// 		"fechaDeModificacion" => date("d-m-Y - H:i:s")
		// 	];
		// 	return $usuarioAModificar;

		// 	// echo arrayToString($usuarioAModificar);exit;
		// }
		// function modificarUsuario($usuarioAModificar){
		// 	//COMENTARIO: Cada vez que digo imprimir, en verdad acumulas TODO en un a variable de tipo string.			

		// 	// Te traes todos los usuarios.
		// 	$usuariosEnJSONParaModificar = getAllUsers();
		// 	// echo "hola desde modificar usuario";
		// 	// arrayToString($usuariosEnJSONParaModificar);exit;
		// 	$todosLosUsuarios = "";
		// 	// Los recorres
		// 		foreach ($usuariosEnJSONParaModificar as $key => $usuarioJSON) {
		// 			// Por cada uno...
		// 			$usuario = json_decode($usuarioJSON, true);
		// 			if ($usuarioAModificar['id'] == $usuario['id']) {
		// 				// Si el id es el mismo del que estoy modificando
		// 					$todosLosUsuarios .= json_encode($usuarioAModificar) . PHP_EOL;
		// 					// arrayToString($$todosLosUsuarios);exit;
		// 			}else{
		// 				// Si no
		// 				// Directamente IMPRIMO el usuario como estaba
		// 					$todosLosUsuarios .= $usuarioJSON . PHP_EOL;
		// 			}
		// 		}
		// 	// modificar la linea que sea igual a mi ID
		// 	file_put_contents("usuarios.json", $todosLosUsuarios);
		// }
		/********************************
			    Consultas
		*********************************/	
		// function getNewID(){
		// 	if (!file_exists("usuarios.json"))
		// 	{
		// 		return 1;
		// 	}

		// 	$usuariosEnJSON = file_get_contents("usuarios.json");

		// 	$usuariosArrayEnJSON = explode(PHP_EOL, $usuariosEnJSON);
		// 	$ultimoUsuario = $usuariosArrayEnJSON[count($usuariosArrayEnJSON) - 2 ];
		// 	$ultimoUsuarioArray = json_decode($ultimoUsuario, true);

		// 	return $ultimoUsuarioArray["id"] + 1;
		// }
		// function getUsuarioByMail($usuarioMail){
		// 	// echo "hola desde getUsuarioByMail";exit;
		// 	$usuariosArrayEnJSON = getAllUsers();

		// 	foreach ($usuariosArrayEnJSON as $key => $usuarioJSON) {
		// 		$usuariosArrayEnJSON = json_decode($usuarioJSON, true);

		// 		if ($usuarioMail == $usuariosArrayEnJSON['email']) {
		// 			return $usuariosArrayEnJSON;
		// 		}
		// 	}

		// 	return null;
		// }
		// function getUsuarioById($usuarioId){
		// 	// echo "hola desde getUsuarioByMail";exit;
		// 	$usuariosArrayEnJSON = getAllUsers();

		// 	foreach ($usuariosArrayEnJSON as $key => $usuarioJSON) {
		// 		$usuariosArrayEnJSON = json_decode($usuarioJSON, true);

		// 		if ($usuarioId == $usuariosArrayEnJSON['id']) {
		// 			return $usuariosArrayEnJSON;
		// 		}
		// 	}

		// 	return null;
		// }

		// function getAllUsers(){
		// 	$usuariosEnJSON = file_get_contents("usuarios.json");

		// 	$usuariosArrayEnJSON = explode(PHP_EOL, $usuariosEnJSON);

		// 	array_pop($usuariosArrayEnJSON);

		// 	return $usuariosArrayEnJSON;
		// }
		function getPasswordById($id){
			
			return getUsuarioById($id)["password"];
		}
		function arrayToString($array){
			foreach ($array as $key => $value) {
				echo $key.'=>'.$value.'<br>';
			}
		}
		/*******************************
			    login
		********************************/
		// function checkLogin(){
		// 	//si no existe en session un usuario logeado...
		// 	if (!isset($_SESSION['usuarioLogueado'])) {
		// 		// busco a ver si hay una cookie
		// 		if (isset($_COOKIE['usuarioLogueado'])) {
		// 			$usuarioId = $_COOKIE["usuarioLogueado"];

		// 			$usuarioALogear = getUsuarioById($usuarioId);

		// 			loguearUsuario($usuarioALogear);
		// 		}
		// 	}
		// }
		// function estaLogueado(){

		// 	return isset($_SESSION["usuarioLogueado"]);
		// }
		// function validarLogin(){

		// 	$errores = [];

		// 	if (trim($_POST['email'] == "" || $_POST["password"] == "") ){
		// 		$errores[] = "Tenes que completar todos los campos";
		// 	}else if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
		// 		$errores[] = "ingrese un mail valido";
		// 	} else if (!usuarioValido($_POST["email"], $_POST["password"])) {
		// 		$errores [] = "El usuario o la contraseña no son validos";
		// 	}

		// 	return $errores;
		// }
		// function usuarioValido($usuarioMail, $usuarioPassword){
		// 	// echo "hola desde usuarioValido";exit;
		// 	$usuarioByMail = getUsuarioByMail($usuarioMail);
		// 	// echo arrayToString($usuarioByMail);
		// 	$password_haseada = password_hash($usuarioPassword, PASSWORD_DEFAULT);
		// 	// echo "esta es la pass cargada: ".$password_haseada;echo "<br>";
		// 	// echo "esta es la pass en labd: ".$usuarioByMail['password'];
		// 	if ($usuarioByMail) {
		// 		if (password_verify($usuarioPassword, $usuarioByMail['password'])) {
		// 			return true;
		// 		}
		// 	}
		// 	return false;
		// }
		// function loguearUsuario($usuarioALogear){
		// 	// unset($usuarioALogear["password"]);
		// 	$_SESSION["usuarioLogueado"] = $usuarioALogear['id'];
		// 	if (isset($_POST['recordarme'])) {
		// 		setcookie('usuarioLogueado', $usuarioALogear["id"], time() + 60 * 60 * 24 * 3);
		// 	}	
		// }
		// function logOut(){
		// 	session_destroy();
		// 	unsetCookie("usuarioLogueado");
		// }
		// function unsetCookie($cookie){
		// 	// echo "Hola desde unSetCookie";
		// 	setcookie($cookie, "", -1);
		// }
		/********************************
				Redireccionamiento
		*********************************/
		function redirigirALogin(){
			header("location:login.php");
			exit;	
		}
		function redirigirAIndex(){
			header("location:index.php");
			exit;
		}
		function redirigirALoginBackDoor(){
			header("location:login.php?errorLogin");
			exit;
		}
 ?>