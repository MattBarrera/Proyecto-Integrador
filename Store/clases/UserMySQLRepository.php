<?php 
	
	require_once("UserRepository.php");
	require_once("Usuario.php");

	class UserMySQLRepository extends UserRepository {

		private $miConexion;
		
		public function __construct($miConexion){
			$this->miConexion = $miConexion;
		}

		public function existeElMail($mail){
			$stmt = $this->miConexion->prepare("SELECT * from usuario where mail = :mail");

			$stmt->bindValue(":mail", $mail);

			$stmt->execute();

			if ($stmt->rowCount() == 0){
				return false;
			}
			else
			{
				return true;
			}
		}
		public function guardarUsuario(Usuario $miUsuario){
			if ($miUsuario->getId()){
				if ($this->getUsuarioById($miUsuario->getId())){
					$stmt = $this->miConexion->prepare("Update usuario set nombre = :nombre, apellido = :apellido, mail = :mail, sexo = :sexo, password = :password WHERE id = :id");
				}else{
					$stmt = $this->miConexion->prepare("INSERT INTO usuario (id, nombre, apellido, sexo, password, mail) values (:id, :nombre, :apellido, :sexo, :password, :mail)");
				}


				$stmt->bindValue(":id", $miUsuario->getId());

			}else{
				$stmt = $this->miConexion->prepare("INSERT INTO usuario (nombre, apellido, sexo, password, mail) values (:nombre, :apellido, :sexo, :password, :mail)");
			}

			$stmt->bindValue(":nombre", $miUsuario->getNombre());
			$stmt->bindValue(":apellido", $miUsuario->getApellido());
			$stmt->bindValue(":sexo", $miUsuario->getSexo());
			$stmt->bindValue(":password", $miUsuario->getPassword());
			$stmt->bindValue(":mail", $miUsuario->getMail());

			$stmt->execute();

			if ($miUsuario->getId() == null){
				$miUsuario->setId($miConexion->lastInsertId());
			}
		}
		public function crearUsuario(Array $miUsuario){
			$usuarioAGuardar = [
				"id" => $this->getNewID(),
				"name" => $miUsuario['name'],
				"lastName" => $miUsuario['lastName'],
				"email" => $miUsuario['email'],
				"telefono" => $miUsuario['telefono'],
				"fechaNacimiento" => $miUsuario['fechaNacimiento'],
				"genero" => $miUsuario['genero'],
				"password" => password_hash($miUsuario["password"], PASSWORD_DEFAULT),
				"estado" => 1,
				"fechaAlta" => date("d-m-Y H:i:s"),
				"fotoPerfil" => 'avatar_2x.png'
			];
			return $usuarioAGuardar;
		}
		public function deleteProfile(){
			$usuarioAModificar = [
				"id" => $_SESSION["usuarioLogueado"],
				"name" => $usuario['name'],
				"lastName" => $usuario['lastName'],
				"email" => $usuario['email'],
				"telefono" => $usuario['telefono'],
				"fechaNacimiento" => $usuario['fechaNacimiento'],
				"genero" => $usuario['genero'],
				"password" => $password,
				"fotoPerfil" => $fotoPerfil,
				"estado" => 2,
				"fechaAlta" => $this->getUsuarioByMail($usuario['email'])->getFechaAlta(),
				"fechaDeModificacion" => date("d-m-Y H:i:s")
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
		public function modificarUsuario($usuarioAModificar){
			//COMENTARIO: Cada vez que digo imprimir, en verdad acumulas TODO en un a variable de tipo string.			
			// Te traes todos los usuarios.
			$usuariosEnJSONParaModificar = $this->getAllUsers();
			//paso el array a un objeto
			$usuarioAModificarObjeto = $this->arrayToUsuario($usuarioAModificar); 
			$todosLosUsuarios = "";
			// Los recorres
				foreach ($usuariosEnJSONParaModificar as $key => $usuario) {
					// Por cada uno...
					// echo $key."=>".$usuario."<br>";
					if ($usuarioAModificarObjeto->getId() == $usuario->getId()) {
						// Si el id es el mismo del que estoy modificando
							$todosLosUsuarios .= json_encode($usuarioAModificar) . PHP_EOL;
					}else{
						// Si no
						// Directamente IMPRIMO el usuario como estaba
							$usuarioToArray = $this->usuarioToArray($usuario);
							$todosLosUsuarios .= json_encode($usuarioToArray) . PHP_EOL;
							// var_dump($todosLosUsuarios);exit;
					}
				}
			// modificar la linea que sea igual a mi ID
			file_put_contents("usuarios.json", $todosLosUsuarios);
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
				"id" => $_SESSION["usuarioLogueado"],
				"name" => $usuario['name'],
				"lastName" => $usuario['lastName'],
				"email" => $usuario['email'],
				"telefono" => $usuario['telefono'],
				"fechaNacimiento" => $usuario['fechaNacimiento'],
				"genero" => $usuario['genero'],
				"password" => $password,
				"fotoPerfil" => $fotoPerfil,
				"estado" => $this->getUsuarioByMail($usuario['email'])->getEstado(),
				"fechaAlta" => $this->getUsuarioByMail($usuario['email'])->getFechaAlta(),
				"fechaDeModificacion" => date("d-m-Y H:i:s")
			];
			// var_dump($usuarioAModificar);exit;
			return $usuarioAModificar;
		}
		private function usuarioToArray(Usuario $miUsuario) {
			$usuarioToArray = [];
			$usuarioToArray["id"] = $miUsuario->getId();
			$usuarioToArray["name"] = $miUsuario->getNombre();
			$usuarioToArray["lastName"] = $miUsuario->getApellido();
			$usuarioToArray["email"] = $miUsuario->getMail();
			$usuarioToArray["telefono"] = $miUsuario->getTelefono();
			$usuarioToArray["fechaNacimiento"] = $miUsuario->getFechaNacimiento();
			$usuarioToArray["genero"] = $miUsuario->getGenero();
			$usuarioToArray["password"] = $miUsuario->getPassword();
			$usuarioToArray["fotoPerfil"] = $miUsuario->getFotoPerfil();
			$usuarioToArray["estado"] = $miUsuario->getEstado();
			$usuarioToArray["fechaAlta"] = $miUsuario->getFechaAlta();
			$usuarioToArray["fechaDeModificacion"] = $miUsuario->getFechaDeModificacion();
			return $usuarioToArray;
		}
		public function getNewID(){
			if (!file_exists("usuarios.json"))
			{
				return 1;
			}
			$usuariosEnJSON = file_get_contents("usuarios.json");
			$usuariosArrayEnJSON = explode(PHP_EOL, $usuariosEnJSON);
			$ultimoUsuario = $usuariosArrayEnJSON[count($usuariosArrayEnJSON) - 2 ];
			$ultimoUsuarioArray = json_decode($ultimoUsuario, 1);

			return $ultimoUsuarioArray["id"] + 1;
		}
		public function getUsuarioByMail($usuarioMail){
			$usuarios = $this->getAllUsers();
			foreach ($usuarios as $key => $usuario) {
				if ($usuarioMail == $usuario->getMail()) {
					return $usuario;
				}
			}
			return null;
		}
		public function getUsuarioById($usuarioId){
			// echo "hola desde getUsuarioByMail";exit;
			$usuarios = $this->getAllUsers();
			foreach ($usuarios as $key => $usuario) {
				if ($usuarioId == $usuario->getId()) {
					return $usuario;
				}
			}
			return null;
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
				'fechaAlta' => date("d-m-Y H:i:s")
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
			$now = strtotime(date("d-m-Y H:i:s"));
			
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
				"id" => $usuarioParaModificar->getId(),
				"name" => $usuarioParaModificar->getNombre(),
				"lastName" => $usuarioParaModificar->getApellido(),
				"email" => $usuarioParaModificar->getMail(),
				"telefono" => $usuarioParaModificar->getTelefono(),
				"fechaNacimiento" => $usuarioParaModificar->getFechaNacimiento(),
				"genero" => $usuarioParaModificar->getGenero(),
				"password" => password_hash($password, PASSWORD_DEFAULT),
				"fotoPerfil" => $usuarioParaModificar->getFotoPerfil(),
				"estado" => $usuarioParaModificar->getEstado(),
				"fechaAlta" => $usuarioParaModificar->getFechaAlta(),
				"fechaDeModificacion" => date("d-m-Y H:i:s")
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