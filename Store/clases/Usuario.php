<?php 

	class Usuario{

		private $usuarioID;
		private $usuarioNombre;
		private $usarioApellido;
		private $usuarioEmail;
		private $usuarioTelefono;
		private $usuarioFechaDeNacimiento;
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
			return $this->usuarioFechaDeNacimiento;
		}
		public function setFechaNacimiento($nacimiento){
			$this->usuarioFechaDeNacimiento = $nacimiento;
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
			return $this->usuarioEstado;
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
			if (isset($miUsuario["usuarioId"])) {
				$this->usuarioID = $miUsuario["usuarioId"];
			}
			$this->usuarioNombre = $miUsuario["usuarioNombre"];
			$this->usarioApellido = $miUsuario["usuarioApellido"];
			$this->usuarioEmail = $miUsuario["usuarioEmail"];
			$this->usuarioTelefono = $miUsuario["usuarioTelefono"];
			$this->usuarioFechaDeNacimiento = $miUsuario["usuarioFechaDeNacimiento"];
			$this->usuarioGenero = $miUsuario["usuarioGenero"];
			$this->usuarioPassword = $miUsuario["usuarioPassword"];
			$this->usuarioFotoPerfil = $miUsuario['usuarioFotoPerfil'];
			$this->usuarioEstado = $miUsuario['usuarioEstado'];
			$this->usuarioFechaAlta = $miUsuario['usuarioFechaAlta'];
			if (isset($miUsuario["usuarioFechaDeModificacion"])) {
				$this->usuarioFechaDeModificacion = $miUsuario["usuarioFechaDeModificacion"];
			}		
		}

		public static function uploadAvatar($usuario,$usuarioAvatar){
			if ($_FILES["fotoPerfil"]["error"] == UPLOAD_ERR_OK){
				$id = $usuario;

				//No hubo errores :)
				$directory = dirname(__FILE__);
				$directory = $directory . "/../assets/".$id."/profile/";
				umask(0);
				
				if (!is_dir($directory) ) {
					mkdir($directory,0777,true);
				}

				$destino = $directory . $_FILES['fotoPerfil']['name'];

				move_uploaded_file($_FILES["fotoPerfil"]["tmp_name"], $destino);
			}
		}
	}
 ?>