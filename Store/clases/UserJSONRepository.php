<?php 
	
	require_once("UserRepository.php");
	require_once("Usuario.php");

	class UserJSONRepository extends UserRepository {

		public function existeElMail($mail){
			$usuariosArray = $this->getAllUsers();
				foreach ($usuariosArray as $key => $usuario) {
					if ($mail == $usuario->getMail()){
						return true;
					}
				}
				return false;
		}
		public function guardarUsuario(Usuario $usuarioAGuardar){
			$usuarioJSON = json_encode($usuarioAGuardar);
			file_put_contents("usuarios.json", $usuarioJSON . PHP_EOL, FILE_APPEND);
		}
		public function crearUsuario(Array $miUsuario){
			$usuarioAGuardar = [
				"usuarioId" => $this->getNewID(),
				"usuarioNombre" => $usuario['name'],
				"usuarioApellido" => $usuario['lastName'],
				"usuarioEmail" => $usuario['email'],
				"usuarioTelefono" => $usuario['telefono'],
				"usuarioFechaDeNacimiento" => $usuario['fechaNacimiento'],
				"usuarioGenero" => $usuario['genero'],
				"usuarioPassword" => password_hash($miUsuario["password"], PASSWORD_DEFAULT),
				"usuarioEstado" => 1,
				"usuarioFechaAlta" => date("Y-d-m H:i:s"),
				"usuarioFotoPerfil" => 'avatar_2x.png'
			];
			return $usuarioAGuardar;
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
				"usuarioFechaDeModificacion" => date("Y-d-m H:i:s")
			];
		}
		public function getAllUsers(){
			$usuarios = file_get_contents("usuarios.json");
			$usuariosArray = explode(PHP_EOL, $usuarios);
			array_pop($usuariosArray);
			return $this->muchosArraysAMuchosUsuarios($usuariosArray);
		}
		private function muchosArraysAMuchosUsuarios(Array $usuariosArray){
			$usuarios = [];
			foreach ($usuariosArray as $usuarioArray) {
				$usuarios[] = $this->arrayToUsuario(json_decode($usuarioArray,1));
			}
			return $usuarios;
		}
		private function arrayToUsuario(Array $miUsuario) {
			$usuarioArray = new Usuario();
			$usuarioArray->verUsuario($miUsuario);
			return $usuarioArray;
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
				"usuarioFechaDeModificacion" => date("Y-d-m H:i:s")
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
				'fechaAlta' => date("Y-d-m H:i:s")
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
			$now = strtotime(date("Y-d-m H:i:s"));
			
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
				"usuarioFechaDeModificacion" => date("Y-d-m H:i:s")
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