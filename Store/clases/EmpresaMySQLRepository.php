<?php 
	
	require_once("EmpresaRepository.php");
	require_once("Empresa.php");

	class EmpresaMySQLRepository extends EmpresaRepository {

		private $miConexion;
		
		public function __construct($miConexion){
			$this->miConexion = $miConexion;
		}

		public function existeElMail($empresaEmail){
			$stmt = $this->miConexion->prepare("SELECT empresaEstado from empresa where empresaEmail = :empresaEmail");

			$stmt->bindValue(":empresaEmail", $empresaEmail, PDO::PARAM_STR);

			$stmt->execute();
			$empresaEstado = $stmt->fetch();
			return $empresaEstado;
		}
		public function guardarUsuario(Usuario $miEmpresa){
			if ($miEmpresa->getEmpresaId()){
				if ($this->getEmpresaById($miEmpresa->getEmpresaId())){
					//si la empresa tiene id y existe ese id en la base lo modifico
					$stmt = $this->miConexion->prepare("UPDATE empresa set empresaNombre = :empresaNombre, empresaEmail = :empresaEmail, empresaEmail = :empresaEmail, empresaCUIT = :empresaCUIT, empresaTelefono = :empresaTelefono, empresaDireccion = :empresaDireccion, empresaEstado = :empresaEstado, empresaFechaAlta = :empresaFechaAlta, empresaFechaDeModificacion = :empresaFechaDeModificacion, empresaId = :empresaId WHERE empresaId = :empresaId");
				}else{
					//sino lo agrego con ese id (solo para migracion de datos)
					// $query = ("INSERT INTO usuario (empresaId, empresaNombre, usuarioApellido, empresaEmail, usuarioTelefono, usuarioFechaDeNacimiento, usuarioGenero, usuarioPassword, usuarioFotoPerfil, usuarioEstado, usuarioFechaAlta, usuarioFechaDeModificacion ) values (".$miEmpresa->getEmpresaId().",".$miEmpresa->getNombre().", ".$miEmpresa->getApellido().", ".$miEmpresa->getMail().", ".$miEmpresa->getTelefono().", ".$miEmpresa->getFechaNacimiento().", ".$miEmpresa->getGenero().", ".$miEmpresa->getPassword().", ".$miEmpresa->getFotoPerfil().", ".$miEmpresa->getEstado().",".$miEmpresa->getFechaAlta().",".$miEmpresa->getFechaDeModificacion().")");
					$stmt = $this->miConexion->prepare("INSERT INTO usuario (empresaId, empresaNombre, empresaEmail, empresaCUIT, empresaTelefono, empresaDireccion, empresaEstado, empresaFechaAlta, empresaFechaDeModificacion, usuarioId) values (:empresaId, :empresaNombre, :empresaEmail, :empresaCUIT, :empresaTelefono, :empresaDireccion, :empresaEstado, :empresaFechaAlta, :empresaFechaDeModificacion, :usuarioId)");
				}
				$stmt->bindValue(":empresaID", $miEmpresa->getEmpresaId(), PDO::PARAM_INT);
			}else{
				//si la empresa no tiene tiene id peor tiene mail mail
				$stmt = $this->miConexion->prepare("INSERT INTO empresa (empresaNombre, empresaEmail, empresaCUIT, empresaTelefono, empresaDireccion, empresaEstado, empresaFechaAlta, empresaFechaDeModificacion, usuarioId) values (:empresaNombre, :empresaEmail, :empresaCUIT, :empresaTelefono, :empresaDireccion, :empresaEstado, :empresaFechaAlta, :empresaFechaDeModificacion, :usuarioId)");
			}

			$stmt->bindValue(":empresaNombre", $miEmpresa->getEmpresaNombre(), PDO::PARAM_STR);
			$stmt->bindValue(":empresaEmail", $miEmpresa->getEmpresaEmail(), PDO::PARAM_STR);
			$stmt->bindValue(":empresaCUIT", $miEmpresa->getEmpresaCUIT(), PDO::PARAM_INT);
			$stmt->bindValue(":empresaTelefono", $miEmpresa->setEmpresaTelefono(), PDO::PARAM_INT);
			$stmt->bindValue(":empresaDireccion", $miEmpresa->getEmpresaDireccion(), PDO::PARAM_STR);
			$stmt->bindValue(":empresaEstado", $miEmpresa->getEmpresaEstado(), PDO::PARAM_INT);
			$stmt->bindValue(":empresaFechaAlta", $miEmpresa->getEmpresaFechaAlta(), PDO::PARAM_STR);
			$stmt->bindValue(":empresaFechaDeModificacion", $miEmpresa->getEmpresaFechaDeModificacion(), PDO::PARAM_STR);
			$stmt->bindValue(":usuarioId", $miEmpresa->getEmpresaempresaId(), PDO::PARAM_INT);

			$stmt->execute();
			// var_dump($query);exit;
			// var_dump($stmt->debugDumpParams());

			if ($miEmpresa->getEmpresaId() == null){
				$miEmpresa->setId($this->miConexion->lastInsertId());
			}
		}
		public function crearEmpresa(Array $miEmpresa){
			$empresaAGuardar = [
				'empresaNombre' => $miEmpresa["empresaNombre"],
				'empresaEmail' => $miEmpresa["empresaEmail"],
				'empresaCUIT' => $miEmpresa["empresaCUIT"],
				'empresaTelefono' => $miEmpresa["empresaTelefono"],
				'empresaDireccion' => $miEmpresa["empresaDireccion"],
				'empresaEstado' => $miEmpresa['empresaEstado'],
				'empresaFechaAlta' => $miEmpresa['empresaFechaAlta']
			];
			return $this->arrayToEmpresa($empresaArray);
		}
		public function deleteEmpresa(Usuario $miEmpresa, $opcion){
			if ($opcion == 2) {
				$miEmpresa->setEstado(2);
			}else{
				$miEmpresa->setEstado(3);
			}
			$miEmpresa->setFechaDeModificacion(date("Y-m-d H:i:s"));

			return $miEmpresa;
		}
		public function getAllEmpresas(){
			$stmt = $this->miConexion->prepare("SELECT * from empresa");

			$stmt->execute();

			$empresasArray = $stmt->fetchAll();

			return $this->muchosArraysAMuchosUsuarios($empresasArray);
		}
		private function muchosArraysAMuchosUsuarios(Array $empresasArray){
			$empresas = [];

			foreach ($empresasArray as $empresaArray) {
				$empresas[] = $this->arrayToEmpresa($empresaArray);
			}

			return $empresas;
		}
		private function arrayToEmpresa($empresaArray) {
			$empresa = new Empresa($miEmpresa);
			$empresa->verEmpresa($miEmpresa);
			return $empresa;
		}
		public function empresaAModificar($empresa, $empresaAvatar){
			//consulto si se envio la foto
			if ($empresaAvatar['name'] !== "") {
					//si se envio la capturo
					$fotoPerfil = $empresaAvatar['name'];
			}else{
				//si no se envio, uso el nombre ya guardado
				$fotoPerfil = $this->getEmpresaById($empresa['email'])->getFotoPerfil();
			}
			$empresaAModificar = [
				"empresaId" => $_SESSION["usuarioLogueado"],
				'empresaNombre' => $miEmpresa["empresaNombre"],
				'empresaEmail' => $miEmpresa["empresaEmail"],
				'empresaCUIT' => $miEmpresa["empresaCUIT"],
				'empresaTelefono' => $miEmpresa["empresaTelefono"],
				'empresaDireccion' => $miEmpresa["empresaDireccion"],
				"empresaEstado" => $this->getEmpresaById($empresa['empresaEmail'])->getEmpresaEstado(),
				"empresaFechaAlta" => $this->getEmpresaById($empresa['empresaEmail'])->getEmpresaFechaAlta(),
				"empresaFechaDeModificacion" => date("Y-m-d H:i:s")
			];
			return $this->arrayToEmpresa($empresaArray);
		}
		public function getEmpresaById($empresaEmail){
			$stmt = $this->miConexion->prepare("SELECT * from empresa where empresaEmail = :empresaEmail");

			$stmt->bindValue(":empresaEmail", $empresaEmail);

			$stmt->execute();

			$empresaArray = $stmt->fetch();

			if ($empresaArray == false)
			{
				return null;
			}
			// var_dump($this->arrayToEmpresa($empresaArray));exit($empresaArray));exit;
			return $this->arrayToEmpresa($empresaArray);//esta ok
		}
		public function getEmpresaById($empresaId){
			// echo "hola desde getEmpresaById";exit;
			$stmt = $this->miConexion->prepare("SELECT * from empresa where empresaId = :empresaId");

			$stmt->bindValue(":empresaId", $empresaId);
			$stmt->execute();
			$empresaArray = $stmt->fetch();

			if ($empresaArray == false)
			{
				return null;
			}

			return $this->arrayToEmpresa($empresaArray);//esta ok
		}
		public function seguirUsuario($empresaId, $empresaSeguidorId){
			$stmt = $this->miConexion->prepare("INSERT INTO seguidores (empresaId, usuarioSeguidorId) VALUES (:empresaId, :usuarioSeguidorId)");
			$stmt->bindValue(":empresaId", $empresaId, PDO::PARAM_INT);
			$stmt->bindValue(":usuarioSeguidorId", $empresaSeguidorId, PDO::PARAM_INT);
			$stmt->execute();
			
		}
		public function dejarDeSeguirUsuario($empresaId, $empresaSeguidorId){
			$stmt = $this->miConexion->prepare("DELETE FROM seguidores WHERE empresaId = :empresaId and usuarioSeguidorId = :usuarioSeguidorId");
			$stmt->bindValue(":empresaId", $empresaId, PDO::PARAM_INT);
			$stmt->bindValue(":usuarioSeguidorId", $empresaSeguidorId, PDO::PARAM_INT);
			$stmt->execute();
		}
		public function conusltaSeguidores($empresaId, $empresaSeguidorId){
			$stmt = $this->miConexion->prepare("SELECT empresaId FROM seguidores WHERE empresaId = :empresaId and usuarioSeguidorId = :usuarioSeguidorId");
			$stmt->bindValue(":empresaId", $empresaId, PDO::PARAM_INT);
			$stmt->bindValue(":usuarioSeguidorId", $empresaSeguidorId, PDO::PARAM_INT);
			$stmt->execute();
			if ($stmt->rowCount() == 0){
				return false;
			}else{
				return true;
			}
		}
		public function getAllSeguidores($empresaId){
			$stmt = $this->miConexion->prepare("SELECT usuarioSeguidorId FROM seguidores WHERE empresaId = :empresaId");
			$stmt->bindValue(":empresaId", $empresaId, PDO::PARAM_INT);
			$stmt->execute();
			$seguidores = $stmt->fetchAll(PDO::FETCH_ASSOC);
			return $seguidores;
		}
	}
 ?>