<?php 

	class Usuario{

		private $usuarioID;
		private $usuarioNombre;
		private $usarioApellido;
		private $usuarioEmail;
		private $usuarioTelefono;
		private $usuarioNacimiento;
		private $usuarioGenero;
		private $usuarioPassword;
		private $usuarioFotoPerfil;
		private $usuarioEstado;
		private $usuarioFechaAlta;
		private $usuarioFechaDeModificacion;


		public function getId() {
			return $this->usuarioID;
		}
		public function setId($id){
			$this->usuarioID = $id;
		}

		public function getNombre() {
			return $this->usuarioNombre;
		}
		public function setNombre($nombre){
			$this->usuarioNombre = $nombre;
		}
		
		public function getApellido() {
			return $this->usarioApellido;
		}
		public function setApellido($apellido){
			$this->usarioApellido = $apellido;
		}

		public function getMail() {
			return $this->usuarioEmail;
		}
		public function setMail($mail){
			$this->usuarioEmail = $mail;
		}

		public function getTelefono() {
			return $this->usuarioTelefono;
		}
		public function setTelefono($telefono){
			$this->usuarioTelefono = $telefono;
		}

		public function getFechaNacimiento() {
			return $this->usuarioNacimiento;
		}
		public function setFechaNacimiento($nacimiento){
			$this->usuarioNacimiento = $nacimiento;
		}

		public function getGenero() {
			return $this->usuarioGenero;
		}
		public function setGenero($sexo){
			$this->usuarioGenero = $sexo;
		}

		public function getPassword() {
			return $this->usuarioPassword;
		}
		public function setPassword($password){
			$this->usuarioPassword = password_hash($password, PASSWORD_DEFAULT);
		}

		public function getFotoPerfil() {
			return $this->usuarioFotoPerfil;
		}
		public function setFotoPerfil($FotoPerfil){
			$this->usuarioFotoPerfil = $FotoPerfil;
		}
		public function getEstado() {
			return $this->usuarioFechaAlta;
		}
		public function setEstado($estado){
			$this->usuarioEstado = $estado;
		}
		public function getFechaAlta() {
			return $this->usuarioFechaAlta;
		}
		public function setFechaAlta($FechaAlta){
			$this->usuarioFechaAlta = $FechaAlta;
		}
		public function getFechaDeModificacion() {
			return $this->usuarioFechaDeModificacion;
		}
		public function setFechaDeModificacion($fechaDeModificacion){
			$this->usuarioFechaDeModificacion = $fechaDeModificacion;
		}
		

		public function verUsuario(Array $miUsuario){
			// var_dump($miUsuario);exit;
			$this->usuarioID = $miUsuario["id"];
			$this->usuarioNombre = $miUsuario["name"];
			$this->usarioApellido = $miUsuario["lastName"];
			$this->usuarioEmail = $miUsuario["email"];
			$this->usuarioTelefono = $miUsuario["telefono"];
			$this->usuarioNacimiento = $miUsuario["fechaNacimiento"];
			$this->usuarioGenero = $miUsuario["genero"];
			$this->usuarioPassword = $miUsuario["password"];
			$this->usuarioFotoPerfil = $miUsuario['fotoPerfil'];
			$this->usuarioEstado = $miUsuario['estado'];
			$this->usuarioFechaAlta = $miUsuario['fechaAlta'];
			// $this->usuarioFechaDeModificacion = $miUsuario['fechaDeModificacion'];
						
		}

		public static function uploadAvatar($usuario,$usuarioAvatar){
			// var_dump($usuario);exit;
			if ($_FILES["fotoPerfil"]["error"] == UPLOAD_ERR_OK){
				// var_dump($usuario);exit;
				$id = $usuario;

				//No hubo errores :)
				$directory = dirname(__FILE__);
				$directory = $directory . "/../assets/".$id."/profile";
				// var_dump($directory);exit;
				// echo getcwd();exit;
				if (!is_dir($directory)) {
					mkdir($directory);
				}
				// var_dump($directory);exit;
				// echo $directory;exit;
				$destino = $directory . $_FILES['fotoPerfil']['name'];

				move_uploaded_file($_FILES["fotoPerfil"]["tmp_name"], $destino);
				}
		}

		

	}
 ?>