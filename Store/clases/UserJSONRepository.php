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
		public function guardarUsuario($usuarioAGuardar){
			$usuarioJSON = json_encode($usuarioAGuardar);
			file_put_contents("usuarios.json", $usuarioJSON . PHP_EOL, FILE_APPEND);
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
		public function usuarioAModificarEnJSON($usuario, $usuarioAvatar){//
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
				"estado" => $usuario['estado'],
				"fechaAlta" => $this->getUsuarioByMail($usuario['email'])->getFechaAlta(),
				"fechaDeModificacion" => date("d-m-Y H:i:s")
			];
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
		private function hashToArray(Usuario $miUsuario) {
			$hashToArray = [];
			$hashToArray["id"] = $miUsuario->getId();
			$hashToArray["hash"] = $miUsuario->getNombre();
			$hashToArray["fechaAlta"] = $miUsuario->getApellido();
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
			$date = strtotime(date("d-m-Y H:i:s"));
			
			$intervalo = 10;
			$todosLosHashes = "";
			foreach ($hashesArray as $key => $hash) {
				// var_dump($date);exit;
				$fechaHash = $hash->getHashFechaAlta();
				$fechaHash = strtotime($fechaHash);
				var_dump(floor($fechaHash/3600));exit;
				echo date('d M Y H:i:s',$horas);
				exit;
				if ($intervalo < date_diff($hash->getHashFechaAlta(),$date) ){
					// si la diferencia es menor a lo estipulado lo agrego a la variable, sino no
					$todosLosHashes .= json_encode($hash) . PHP_EOL;
				}
			}
			exit;
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