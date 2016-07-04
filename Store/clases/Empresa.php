<?php 

	class Empresa{

		private $empresaId;
		private $empresaNombre;
		private $empresaEmail;
		private $empresaCUIT;
		private $empresaTelefono;
		private $empresaDireccion;
		private $empresaEstado;
		private $empresaFechaAlta;
		private $empresaFechaDeModificacion;
		private $usuarioId;


		public function getEmpresaId() {
			return $this->empresaId;
		}
		public function setEmpresaId($id){
			$this->empresaId = $id;
		}

		public function getEmpresaNombre() {
			return $this->empresaNombre;
		}
		public function setEmpresaNombre($nombre){
			$this->empresaNombre = $nombre;
		}

		public function getEmpresaEmail() {
			return $this->empresaEmail;
		}
		public function setEmpresaEmail($email){
			$this->empresaEmail = $email;
		}

		public function getEmpresaCUIT() {
			return $this->empresaCUIT;
		}
		public function setEmpresaCUIT($CUIT){
			$this->empresaCUIT = $CUIT;
		}

		public function getEmpresaTelefono() {
			return $this->empresaTelefono;
		}
		public function setEmpresaTelefono($telefono){
			$this->empresaTelefono = $telefono;
		}
		public function getEmpresaDireccion() {
			return $this->empresaDireccion;
		}
		public function setEmpresaDireccion($direccion){
			$this->empresaDireccion = $direccion;
		}
		public function getEmpresaEstado() {
			return $this->empresaEstado;
		}
		public function setEmpresaEstado($estado){
			$this->empresaEstado = $estado;
		}
		public function getEmpresaFechaAlta() {
			return $this->empresaFechaAlta;
		}
		public function setEmpresaFechaAlta($FechaAlta){
			$this->empresaFechaAlta = $FechaAlta;
		}
		public function getEmpresaFechaDeModificacion() {
			return $this->empresaFechaDeModificacion;
		}
		public function setEmpresaFechaDeModificacion($fechaDeModificacion){
			$this->empresaFechaDeModificacion = $fechaDeModificacion;
		}
		public function getEmpresaUsuarioId(){
			return $this->usuarioId;
		}
		public function setEmpresaUsuarioId($usuarioId){
			$this->usuarioId = $usuarioId;
		}
	
		public function verUsuario(Array $miEmpresa){
			if (isset($miEmpresa["empresaId"])) {
				$this->empresaId = $miEmpresa["empresaID"];
			}
			$this->empresaNombre = $miEmpresa["empresaNombre"];
			$this->empresaEmail = $miEmpresa["empresaEmail"];
			$this->empresaCUIT = $miEmpresa["empresaCUIT"];
			$this->empresaTelefono = $miEmpresa["empresaTelefono"];
			$this->empresaDireccion = $miEmpresa["empresaDireccion"];
			$this->empresaEstado = $miEmpresa['empresaEstado'];
			$this->empresaFechaAlta = $miEmpresa['empresaFechaAlta'];
			if (isset($miEmpresa["empresaFechaDeModificacion"])) {
				$this->empresaFechaDeModificacion = $miEmpresa["empresaFechaDeModificacion"];
			}
			$this->usuarioId = $miEmpresa['usuarioId'];	
		}
	}
 ?>