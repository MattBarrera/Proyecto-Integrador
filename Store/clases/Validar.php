<?php 
	Class Validar{

		private $userRepository;
		private static $instance = null;

		public static function getInstance(UserRepository $userRepository){
	        if (Validar::$instance === null) {
	            Validar::$instance = new Validar();
	            Validar::$instance->setUserRepository($userRepository);
	        }
	        return Validar::$instance;
	    }
	    private function setUserRepository(UserRepository $userRepository){
	        
	        $this->userRepository = $userRepository;
	    }
		private function __construct() {
		}
		/********************************
			    Usuarios
		*********************************/
		public function validarUsuario($usuario){
			
			$errores = [];
			if (trim($usuario["name"]) == ""){
				$errores[] = "Falta ingresar el nombre";
				$datosUsuario ['name'] = $usuario["name"];
			}
			if (trim($usuario["lastName"]) == ""){
				$errores[] = "Falta ingresar el apellido";
				$datosUsuario [] = $usuario["lastName"];
			}
			//validacion mail
			if ($usuario["email"] == ""){
				$errores[] = "Falta ingresar el mail";
				$datosUsuario [] = $usuario["email"];
			}elseif (!filter_var($usuario["email"], FILTER_VALIDATE_EMAIL)){
					$errores[] = "Ingrese un Mail valido";
					$datosUsuario [] = $usuario["email"];
				}elseif ($estado = $this->userRepository->existeElMail($usuario["email"])){
					// var_dump($estado);exit;
					if ($estado['usuarioEstado'] == 1) {
						$errores[] = "El Usuario ya  esta registrado";
						$datosUsuario [] = $usuario["email"];
					}elseif ($estado['usuarioEstado'] == 2) {
						header("location:reactivarProfile.php");exit;
					}
				}
			//fin validacion mail
			if (trim($usuario["telefono"]) == ""){
				$errores[] = "Falta ingresar el telefono";
				$datosUsuario [] = $usuario["lastName"];
			}
			if (trim($usuario["fechaNacimiento"]) == ""){
				$errores[] = "Falta ingresar la fecha de nacimiento";
				$datosUsuario [] = $usuario["fechaNacimiento"];
			}
			if (trim($usuario["genero"]) == ""){
				$errores[] = "Falta ingresar el genero";
				$datosUsuario [] = $usuario["genero"];
			}
			if (trim($usuario["password"]) == ""){
				$errores[] = "Falta ingresar la contraseña";
			}
			if (trim($usuario["confPassword"]) == ""){
				$errores[] = "Falta ingresar la confirmacion de la contraseña";
			}
			if ($usuario["password"] != $usuario["confPassword"]){
				$errores[] = "La contraseñas son distintas";
			}
			if ( !isset($usuario["terminos"])){
				$errores[] = "Falta aceptar los terminos y condiciones";
			}	
				// return $errores;

				// return $datosUsuario;
				$datosUsuario = $usuario;// yo querio agregar los datos como sie fuera errores...

				return array('errores'=> $errores, 'datosUsuario'=>$datosUsuario);
		}
		public function validarLogin(){

			$errores = [];

			if (trim($_POST['email'] == "" || $_POST["password"] == "") ){
				$errores[] = "Tenes que completar todos los campos";	
			}else if (!$this->userRepository->existeElMail($_POST["email"], FILTER_VALIDATE_EMAIL)){
				$errores[] = "El Mail no existe";
			}else if ($estado = $this->userRepository->existeElMail($_POST["email"], FILTER_VALIDATE_EMAIL)){
				if ($estado['usuarioEstado']==2) {
					header("location:reactivarProfile.php");exit;
				}elseif ($estado['usuarioEstado']== 3) {
					$errores[] = "El Mail no existe ";
				}
			} else if (!$this->usuarioValido($_POST["email"], $_POST["password"])) {
				$errores [] = "El usuario o la contraseña no son validos";
			}

			return $errores;
		}
		public function usuarioValido($usuarioMail, $usuarioPassword){
			// echo "hola desde usuarioValido";exit;
			$usuarioByMail = $this->userRepository->getUsuarioByMail($usuarioMail);
			// echo arrayToString($usuarioByMail);
			$password_haseada = password_hash($usuarioPassword, PASSWORD_DEFAULT);
			// echo "esta es la pass cargada: ".$password_haseada;echo "<br>";
			// echo "esta es la pass en labd: ".$usuarioByMail['password'];
			if ($usuarioByMail) {
				if (password_verify($usuarioPassword, $usuarioByMail->getPassword())) {
					return true;
				}
			}
			return false;
		}
		public function validarUsuarioAModificar($usuario){

			// var_dump($usuario);exit;
			$errores = [];

			if (trim($usuario["name"]) == ""){
				$errores[] = "Falta ingresar el nombre";
				$datosUsuario ['name'] = $usuario["name"];
			}
			if (trim($usuario["lastName"]) == ""){
				$errores[] = "Falta ingresar el apellido";
				$datosUsuario [] = $usuario["lastName"];
			}
			//validacion mail
			if ($usuario["email"] == ""){
				$errores[] = "Falta ingresar el mail";
				$datosUsuario [] = $usuario["email"];
			}elseif (!filter_var($usuario["email"], FILTER_VALIDATE_EMAIL)){
					$errores[] = "Ingrese un Mail valido";
					$datosUsuario [] = $usuario["email"];
				}
			//fin validacion mail
			if (trim($usuario["telefono"]) == ""){
				$errores[] = "Falta ingresar el telefono";
				$datosUsuario [] = $usuario["lastName"];
			}
			if (trim($usuario["fechaNacimiento"]) == ""){
				$errores[] = "Falta ingresar la fecha de nacimiento";
				$datosUsuario [] = $usuario["fechaNacimiento"];
			}
			if (trim($usuario["genero"]) == ""){
				$errores[] = "Falta ingresar el genero";
				$datosUsuario [] = $usuario["genero"];
			}
			if (trim($usuario["password"]) !== ""){
				if (!password_verify(trim($usuario["password"]), getPasswordById($_SESSION["usuarioLogueado"])) ){
					$errores[] = "Ingresaste mal tu contraseña anterior";
				}
				if ($usuario['newPassword'] == "" || $usuario['newConfPassword']=="") {
					$errores[] = "Tenes que ingresar la nueva contraseña";
				}elseif ($usuario["newPassword"] != $usuario["newConfPassword"]){
					$errores[] = "La contraseñas son distintas";
				}	
			}
			$datosUsuario = $usuario;// yo querio agregar los datos como sie fuera errores...

			return array('errores'=> $errores, 'datosUsuario'=>$datosUsuario);
		}
		public function validarForgotPassword ($email){

			$errores = [];

			if ($email == ""){
				$errores[] = "Falta ingresar el mail";
				$datosUsuario [] = $email;
			}if (filter_var($email, FILTER_VALIDATE_EMAIL)){
					$errores[] = "Ingrese un Mail valido";
					$datosUsuario [] = $email;
			}elseif (!$this->userRepository->existeElMail($_POST["email"], FILTER_VALIDATE_EMAIL)){
				$errores[] = "El Usuario no existe";
			}
				$datosUsuario = $email;
			return array('errores'=> $errores, 'datosUsuario'=>$datosUsuario);
		}
		public function validarChangePassword ($password){

			$errores = [];

			if (trim($password["password"]) == ""){
				$errores[] = "Falta ingresar la contraseña";
			}
			if (trim($password["confPassword"]) == ""){
				$errores[] = "Falta ingresar la confirmacion de la contraseña";
			}
			if ($password["password"] != $password["confPassword"]){
				$errores[] = "La contraseñas son distintas";
			}else{
				$password = password_hash($password['password'], PASSWORD_DEFAULT);
			}
			$datosUsuario = $password;
			
			return array('errores'=> $errores, 'datosUsuario'=>$datosUsuario);
			// var_dump($password);exit;
		}
		/********************************
			    Productos
		*********************************/
		public function validarProducto($producto){
			// var_dump($producto);exit;
			$errores = [];

			if (trim($producto["nombre"]) == ""){
				$errores[] = "Falta ingresar el nombre";
				$datosUsuario ['nombre'] = $producto["nombre"];
			}
			if (trim($producto["descripcion"]) == ""){
				$errores[] = "Falta ingresar la descripcion";
				$datosProducto [] = $producto["descripcion"];
			}
			if (trim($producto["precio"]) == ""){
				$errores[] = "Falta ingresar el precio";
				$datosProducto [] = $producto["precio"];
			}
			if (trim($producto["genero"]) == ""){
				$errores[] = "Falta ingresar el genero";
				$datosProducto [] = $producto["genero"];
			}
			if (trim($producto["categoria"]) == ""){
				$errores[] = "Falta ingresar la categoria";
				$datosProducto [] = $producto["categoria"];
			}
			if (trim($producto["subCategoria"]) == ""){
				$errores[] = "Falta ingresar la subCategoria";
				$datosProducto [] = $producto["subCategoria"];
			}

				$datosProducto = $producto;// yo querio agregar los datos como sie fuera errores...

				return array('errores'=> $errores, 'datosProducto'=>$datosProducto);
		}

	}
 ?>