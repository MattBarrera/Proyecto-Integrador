<?php 
	
	require_once("UserRepository.php");
	require_once("Usuario.php");

	class UserMySQLRepository extends UserRepository {

		private $miConexion;
		
		public function __construct($miConexion){
			$this->miConexion = $miConexion;
		}

		public function existeElMail($usuarioEmail){
			$stmt = $this->miConexion->prepare("SELECT usuarioEstado from usuario where usuarioEmail = :usuarioEmail");

			$stmt->bindValue(":usuarioEmail", $usuarioEmail);

			$stmt->execute();
			$usuarioEstado = $stmt->fetch();
			return $usuarioEstado;
		}
		public function guardarUsuario(Usuario $miUsuario){
			if ($miUsuario->getId()){
				if ($this->getUsuarioById($miUsuario->getId())){
					$stmt = $this->miConexion->prepare("UPDATE usuario set usuarioNombre = :usuarioNombre, usuarioApellido = :usuarioApellido, usuarioEmail = :usuarioEmail, usuarioTelefono = :usuarioTelefono, usuarioFechaDeNacimiento = :usuarioFechaDeNacimiento, usuarioGenero = :usuarioGenero, usuarioPassword = :usuarioPassword, usuarioFotoPerfil = :usuarioFotoPerfil, usuarioEstado = :usuarioEstado, usuarioFechaAlta = :usuarioFechaAlta, usuarioFechaDeModificacion = :usuarioFechaDeModificacion WHERE usuarioId = :usuarioId");
				}else{
					// $query = ("INSERT INTO usuario (usuarioId, usuarioNombre, usuarioApellido, usuarioEmail, usuarioTelefono, usuarioFechaDeNacimiento, usuarioGenero, usuarioPassword, usuarioFotoPerfil, usuarioEstado, usuarioFechaAlta, usuarioFechaDeModificacion ) values (".$miUsuario->getId().",".$miUsuario->getNombre().", ".$miUsuario->getApellido().", ".$miUsuario->getMail().", ".$miUsuario->getTelefono().", ".$miUsuario->getFechaNacimiento().", ".$miUsuario->getGenero().", ".$miUsuario->getPassword().", ".$miUsuario->getFotoPerfil().", ".$miUsuario->getEstado().",".$miUsuario->getFechaAlta().",".$miUsuario->getFechaDeModificacion().")");
					$stmt = $this->miConexion->prepare("INSERT INTO usuario (usuarioId, usuarioNombre, usuarioApellido, usuarioEmail, usuarioTelefono, usuarioFechaDeNacimiento, usuarioGenero, usuarioPassword, usuarioFotoPerfil, usuarioEstado, usuarioFechaAlta, usuarioFechaDeModificacion) values (:usuarioId, :usuarioNombre, :usuarioApellido, :usuarioEmail, :usuarioTelefono, :usuarioFechaDeNacimiento, :usuarioGenero, :usuarioPassword, :usuarioFotoPerfil, :usuarioEstado, :usuarioFechaAlta, :usuarioFechaDeModificacion)");
				}
				$stmt->bindValue(":usuarioId", $miUsuario->getId());
			}else{
				$stmt = $this->miConexion->prepare("INSERT INTO usuario (usuarioNombre, usuarioApellido, usuarioEmail, usuarioTelefono, usuarioFechaDeNacimiento, usuarioGenero, usuarioPassword, usuarioFotoPerfil, usuarioEstado, usuarioFechaAlta, usuarioFechaDeModificacion) values (:usuarioNombre, :usuarioApellido, :usuarioEmail, :usuarioTelefono, :usuarioFechaDeNacimiento, :usuarioGenero, :usuarioPassword, :usuarioFotoPerfil, :usuarioEstado, :usuarioFechaAlta, :usuarioFechaDeModificacion)");
			}

			$stmt->bindValue(":usuarioNombre", $miUsuario->getNombre());
			$stmt->bindValue(":usuarioApellido", $miUsuario->getApellido());
			$stmt->bindValue(":usuarioEmail", $miUsuario->getMail());
			$stmt->bindValue(":usuarioTelefono", $miUsuario->getTelefono());
			$stmt->bindValue(":usuarioFechaDeNacimiento", $miUsuario->getFechaNacimiento());
			$stmt->bindValue(":usuarioGenero", $miUsuario->getGenero());
			$stmt->bindValue(":usuarioPassword", $miUsuario->getPassword());
			$stmt->bindValue(":usuarioFotoPerfil", $miUsuario->getFotoPerfil());
			$stmt->bindValue(":usuarioEstado", $miUsuario->getEstado());
			$stmt->bindValue(":usuarioFechaAlta", $miUsuario->getFechaAlta());
			$stmt->bindValue(":usuarioFechaDeModificacion", $miUsuario->getFechaDeModificacion());

			$stmt->execute();
			// var_dump($query);exit;
			// var_dump($stmt->debugDumpParams());

			if ($miUsuario->getId() == null){
				$miUsuario->setId($this->miConexion->lastInsertId());
			}
		}
		public function crearUsuario(Array $miUsuario){
			$usuarioAGuardar = [
				"usuarioNombre" => $miUsuario['name'],
				"usuarioApellido" => $miUsuario['lastName'],
				"usuarioEmail" => $miUsuario['email'],
				"usuarioTelefono" => $miUsuario['telefono'],
				"usuarioFechaDeNacimiento" => $miUsuario['fechaNacimiento'],
				"usuarioGenero" => $miUsuario['genero'],
				"usuarioPassword" => password_hash($miUsuario["password"], PASSWORD_DEFAULT),
				"usuarioFotoPerfil" => 'avatar_2x.png',
				"usuarioEstado" => 1,
				"usuarioFechaAlta" => date("Y-m-d H:i:s")
			];
			return $this->arrayToUsuario($usuarioAGuardar);
		}
		public function deleteProfile(Usuario $miUsuario, $opcion){
			if ($opcion == 2) {
				$miUsuario->setEstado(2);
			}else{
				$miUsuario->setEstado(3);
			}
			$miUsuario->setFechaDeModificacion(date("Y-m-d H:i:s"));

			return $miUsuario;
		}
		public function getAllUsers(){
			$stmt = $this->miConexion->prepare("SELECT * from usuario");

			$stmt->execute();

			$usuariosArray = $stmt->fetchAll();

			return $this->muchosArraysAMuchosUsuarios($usuariosArray);
		}
		private function muchosArraysAMuchosUsuarios(Array $usuariosArray){
			$usuarios = [];

			foreach ($usuariosArray as $usuarioArray) {
				$usuarios[] = $this->arrayToUsuario($usuarioArray);
			}

			return $usuarios;
		}
		private function arrayToUsuario(Array $miUsuario) {
			$usuario = new Usuario($miUsuario);
			$usuario->verUsuario($miUsuario);
			return $usuario;
		}
		public function usuarioAModificar($usuario, $usuarioAvatar){
			//consulto si se envio la foto
			if ($usuarioAvatar['name'] !== "") {
					//si se envio la capturo
					$fotoPerfil = $usuarioAvatar['name'];
			}else{
				//si no se envio, uso el nombre ya guardado
				$fotoPerfil = $this->getUsuarioByMail($usuario['email'])->getFotoPerfil();
			}
			if ($usuario['password'] == "") {
				$password = $this->getUsuarioByMail($usuario['email'])->getPassword();		
			}else{
				$password = password_hash($usuario['newPassword'],PASSWORD_DEFAULT);
			}
			$usuarioAModificar = [
				"usuarioId" => $_SESSION["usuarioLogueado"],
				"usuarioNombre" => $usuario['name'],
				"usuarioApellido" => $usuario['lastName'],
				"usuarioEmail" => $usuario['email'],
				"usuarioTelefono" => $usuario['telefono'],
				"usuarioFechaDeNacimiento" => $usuario['fechaNacimiento'],
				"usuarioGenero" => $usuario['genero'],
				"usuarioPassword" => $password,
				"usuarioFotoPerfil" => $fotoPerfil,
				"usuarioEstado" => $this->getUsuarioByMail($usuario['email'])->getEstado(),
				"usuarioFechaAlta" => $this->getUsuarioByMail($usuario['email'])->getFechaAlta(),
				"usuarioFechaDeModificacion" => date("Y-m-d H:i:s")
			];
			return $this->arrayToUsuario($usuarioAModificar);
		}
		public function getUsuarioByMail($usuarioEmail){
			$stmt = $this->miConexion->prepare("SELECT * from usuario where usuarioEmail = :usuarioEmail");

			$stmt->bindValue(":usuarioEmail", $usuarioEmail);

			$stmt->execute();

			$usuarioArray = $stmt->fetch();

			if ($usuarioArray == false)
			{
				return null;
			}
			// var_dump($this->arrayToUsuario($usuarioArray));exit;
			return $this->arrayToUsuario($usuarioArray);//esta ok
		}
		public function getUsuarioById($usuarioId){
			// echo "hola desde getUsuarioByMail";exit;
			$stmt = $this->miConexion->prepare("SELECT * from usuario where usuarioId = :usuarioId");

			$stmt->bindValue(":usuarioId", $usuarioId);

			$stmt->execute();

			$usuarioArray = $stmt->fetch();

			if ($usuarioArray == false)
			{
				return null;
			}

			return $this->arrayToUsuario($usuarioArray);//esta ok
		}
		/********************************
			    Hash
		*********************************/
		public function crearHash($qtd){
			//Under the string $Caracteres you write all the characters you want to be used to randomly generate the code. 
			$Caracteres = 'ABCDEFGHIJKLMOPQRSTUVXWYZ0123456789'; 
			$QuantidadeCaracteres = strlen($Caracteres); 
			$QuantidadeCaracteres--; 

			$hash=NULL; 
			    for($x=1;$x<=$qtd;$x++){ 
			        $Posicao = rand(0,$QuantidadeCaracteres); 
			        $hash .= substr($Caracteres,$Posicao,1); 
			    } 
			return $hash; 
		}
		public function hashAGuardar($hash,$userId){
			// var_dump(intval($userId));exit;
			$hashAGuardar = [
				'hashUserId' => intval($userId),
				'hashHash'=> $hash,
				'hashFechaDeAlta' => date("Y-m-d H:i:s")
			];

			if (!$this->checkHash($hashAGuardar['hashHash'])) {
				$hashAGuardar['hashHash'] = $this->crearHash(30);
				return $hashAGuardar;
			}
			return $hashAGuardar;
		}
		public function checkHash($hashHash){
			// var_dump("check if exist ".$hashHash);
			$stmt = $this->miConexion->prepare("SELECT hashHash from hash WHERE hashHash = :hashHash");

			$stmt->bindValue(":hashHash", $hashHash);
			$stmt->execute();

			$stmt->fetchAll();

			if ($stmt->rowCount() == 0){
				return false;
			}else{
				return true;
			}
		}
		public function getAllHashes(){
			$stmt = $this->miConexion->prepare("SELECT * from hash");

			$stmt->execute();

			$hashesArray = $stmt->fetchAll();

			return $this->muchosArraysAMuchosHases($hashesArray);
		}
		private function muchosArraysAMuchosHases(Array $hashesArray){
			$hashes = [];

			foreach ($hashesArray as $hashArray) {
				$hashes[] = $this->arrayToHash($hashArray);
			}

			return $hashes;
		}
		private function arrayToHash(Array $miHash) {	
			$hashArray = new Hash();
			$hashArray->verHash($miHash);
			return $hashArray;
		}
		public function guardarHash($hashAGuardar){
			$stmt = $this->miConexion->prepare("INSERT INTO hash ( hashHash, hashUserId, hashFechaDeAlta) VALUES (:hashHash, :hashUserId, :hashFechaDeAlta) ");
			// var_dump($hashAGuardar['hashFechaDeAlta']);exit;
			$stmt->bindValue(":hashHash", $hashAGuardar['hashHash']);
			$stmt->bindValue(":hashUserId", $hashAGuardar['hashUserId']);
			$stmt->bindValue(":hashFechaDeAlta", $hashAGuardar['hashFechaDeAlta']);
			// var_dump($stmt);exit;
			$stmt->execute();
		}
		public function eliminarHashesViejos(){
			$stmt = $this->miConexion->prepare("DELETE FROM hash 
												WHERE TIMESTAMPDIFF(hour, hashFechaDeAlta, NOW())>12;");
			$stmt->execute();
		}
		public function eliminarHash($hash){
			$stmt = $this->miConexion->prepare("DELETE FROM hash
												WHERE hashHash = :hashHash");

			$stmt->bindValue(":hashHash", $hash);
			$stmt->execute();
		}
		public function usuarioPasswordAModificar($userId, $password, $estado){
			$usuarioParaModificar = $this->getUsuarioById($userId);
			// var_dump($estado);exit;
			if ($estado !== NULL) {
				$estado = 1;
			}else {
				$estado = $usuarioParaModificar->getEstado();
			}

			$usuarioAModificar = [
				"usuarioId" => $usuarioParaModificar->getId(),
				"usuarioNombre" => $usuarioParaModificar->getNombre(),
				"usuarioApellido" => $usuarioParaModificar->getApellido(),
				"usuarioEmail" => $usuarioParaModificar->getMail(),
				"usuarioTelefono" => $usuarioParaModificar->getTelefono(),
				"usuarioFechaDeNacimiento" => $usuarioParaModificar->getFechaNacimiento(),
				"usuarioGenero" => $usuarioParaModificar->getGenero(),
				"usuarioPassword" => password_hash($password, PASSWORD_DEFAULT),
				"usuarioFotoPerfil" => $usuarioParaModificar->getFotoPerfil(),
				"usuarioEstado" => $estado,
				"usuarioFechaAlta" => $usuarioParaModificar->getFechaAlta(),
				"usuarioFechaDeModificacion" => date("Y-m-d H:i:s")
			];
			return $this->arrayToUsuario($usuarioAModificar);
		}
		public function getUserIdByHash($miHash){
			// var_dump($miHash);exit;
			$stmt = $this->miConexion->prepare("SELECT hashUserId from hash WHERE hashHash = :hashHash");

			$stmt->bindValue(":hashHash", $miHash);
			$stmt->execute();

			$hashUserId = $stmt->fetch();
			return $hashUserId;
				
		}
	}
 ?>