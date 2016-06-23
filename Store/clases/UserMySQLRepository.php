<?php 
	
	require_once("UserRepository.php");
	require_once("Usuario.php");

	class UserMySQLRepository extends UserRepository {

		private $miConexion;
		
		public function __construct($miConexion){
			$this->miConexion = $miConexion;
		}

		public function existeElMail($usuarioEmail){
			$stmt = $this->miConexion->prepare("SELECT * from usuario where usuarioEmail = :usuarioEmail");

			$stmt->bindValue(":usuarioEmail", $usuarioEmail);

			$stmt->execute();

			if ($stmt->rowCount() == 0){
				return false;
			}else{
				return true;
			}
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
		public function deleteProfile(){
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
				"usuarioEstado" => 2,
				"usuarioFechaAlta" => $this->getUsuarioByMail($usuario['email'])->getFechaAlta(),
				"usuarioFechaDeModificacion" => date("Y-m-d H:i:s")
			];
		}
		public function getAllUsers(){
			$stmt = $this->miConexion->prepare("SELECT * from usuario");

			$stmt->execute();

			$usuariosArray = $stmt->fetchAll();

			return $this->muchosArraysAMuchosUsuarios($usuariosArray);
		}
		private function arrayToUsuario(Array $miUsuario) {
			$usuario = new Usuario($miUsuario);
			$usuario->verUsuario($miUsuario);
			return $usuario;
		}
		public function usuarioAModificarEnJSON($usuario, $usuarioAvatar){
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
			// var_dump($usuarioAModificar);exit;
			return $usuarioAModificar;
		}
		private function usuarioToArray(Usuario $miUsuario) {
			$usuarioToArray = [];
			$usuarioToArray["usuarioId"] = $miUsuario->getId();
			$usuarioToArray["usuarioNombre"] = $miUsuario->getNombre();
			$usuarioToArray["usuarioApellido"] = $miUsuario->getApellido();
			$usuarioToArray["usuarioEmail"] = $miUsuario->getMail();
			$usuarioToArray["usuarioTelefono"] = $miUsuario->getTelefono();
			$usuarioToArray["usuarioFechaDeNacimiento"] = $miUsuario->getFechaNacimiento();
			$usuarioToArray["usuarioGenero"] = $miUsuario->getGenero();
			$usuarioToArray["usuarioPassword"] = $miUsuario->getPassword();
			$usuarioToArray["usuarioFotoPerfil"] = $miUsuario->getFotoPerfil();
			$usuarioToArray["usuarioEstado"] = $miUsuario->getEstado();
			$usuarioToArray["usuarioFechaAlta"] = $miUsuario->getFechaAlta();
			$usuarioToArray["usuarioFechaDeModificacion"] = $miUsuario->getFechaDeModificacion();
			return $usuarioToArray;// me parece q no
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
			$hashAGuardar = [
				'userId' => $userId,
				'hash'=> $hash,
				'fechaAlta' => date("Y-m-d H:i:s")
			];
			if ($this->checkHash($hashAGuardar) == true) {
				$hashAGuardar['hash'] = $this->crearHash(30);
				return $hashAGuardar;
			}
			return $hashAGuardar;
		}
		public function checkHash($hashAGuardar){
			$hashesArray = $this->getAllHashes();
				foreach ($hashesArray as $key => $hash) {
					if ($hashAGuardar == $hash->getHashHash()){
						return true;
					}
				}
				return false;
		}
		private function hashToArray($hash) {

			$hashToArray = [];
			$hashToArray["userId"] = $hash->getHashUserId();
			$hashToArray["hash"] = $hash->getHashHash();
			$hashToArray["fechaAlta"] = $hash->getHashFechaAlta();
			return $hashToArray;
		}
		public function getAllHashes(){
			$hashes = file_get_contents("hashes.json");
			$hashesArray = explode(PHP_EOL, $hashes);
			array_pop($hashesArray);
			return $this->muchosArraysAMuchosHases($hashesArray);
		}
		private function muchosArraysAMuchosHases(Array $hashesArray){
			$hashes = [];

			foreach ($hashesArray as $hashArray) {
				$hashes[] = $this->arrayToHash(json_decode($hashArray,1));
			}

			return $hashes;
		}
		private function arrayToHash(Array $miHash) {	
			$hashArray = new Hash();
			$hashArray->verHash($miHash);
			return $hashArray;
		}
		public function guardarHashEnJSON($hashAGuardar){
			$hashJSON = json_encode($hashAGuardar);
			file_put_contents("hashes.json", $hashJSON . PHP_EOL, FILE_APPEND);
		}
		public function eliminarHashesViejos(){
			$hashesArray = $this->getAllHashes();
			// var_dump($hashesArray);
			$now = strtotime(date("Y-m-d H:i:s"));
			
			$intervaloHoras = 12;
			$todosLosHashes = "";
			foreach ($hashesArray as $key => $hash) {
				$fechaHash = strtotime($hash->getHashFechaAlta());
				$diferencia = ($now - $fechaHash)/3600;
				// echo $diferencia; echo "horas";
				if ($intervaloHoras > $diferencia  ){
					// echo "string";
					// si la diferencia es menor a lo estipulado lo agrego a la variable, sino no
					$hashToArray = $this->hashToArray($hash);
						
					$todosLosHashes .= json_encode($hashToArray) . PHP_EOL;
				}
			}
			
			file_put_contents("hashes.json", $todosLosHashes);
		}
		public function eliminarHash($hash){
			$hashesArray = $this->getAllHashes();
			$todosLosHashes = "";
			foreach ($hashesArray as $key => $hash) {
				if (!$hash == $hash->getHashHash()){
					// si la diferencia es menor a lo estipulado lo agrego a la variable, sino no
					$hashToArray = $this->hashToArray($hash);
					$todosLosHashes .= json_encode($hashToArray) . PHP_EOL;
				}
			}
			file_put_contents("hashes.json", $todosLosHashes);
		}
		public function usuarioPasswordAModificarEnJSON($userId, $password){//
			$usuarioParaModificar = $this->getUsuarioById($userId);
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
				"usuarioEstado" => $usuarioParaModificar->getEstado(),
				"usuarioFechaAlta" => $usuarioParaModificar->getFechaAlta(),
				"usuarioFechaDeModificacion" => date("Y-m-d H:i:s")
			];
			return $usuarioAModificar;
		}
		public function getUserIdByHash($miHash){
			$hashesArray = $this->getAllHashes();
				foreach ($hashesArray as $key => $hash) {
					if ($miHash == $hash->getHashHash() ){
						$userId = $hash->getHashUserId();
						return $userId;
					}
				}
			return false;
		}
	}
 ?>