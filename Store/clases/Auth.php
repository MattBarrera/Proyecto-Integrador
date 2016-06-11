<?php

	require_once("UserRepository.php");

Class Auth {

		//tengo que generar que se instancie una sola vez
	private static $instance = null;
	private $userRepository;

	public static function getInstance(UserRepository $userRepository)
    {
        if (Auth::$instance === null) {
            session_start();
            Auth::$instance = new Auth();
            Auth::$instance->setUserRepository($userRepository);
            Auth::$instance->checkLogin();
        }

        return Auth::$instance;
    }

    private function setUserRepository(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }

		public function checkLogin(){
			//si no existe en session un usuario logeado...
			if (!isset($_SESSION['usuarioLogueado'])) {
				// busco a ver si hay una cookie
				if (isset($_COOKIE['usuarioLogueado'])) {
					$usuarioId = $_COOKIE["usuarioLogueado"];

					$usuarioALogear = $repositorio->getUserRepository()->getUsuarioById($usuarioId);

					$this->loguearUsuario($usuarioALogear);
				}
			}
		}
		public function estaLogueado(){

			return isset($_SESSION["usuarioLogueado"]);
		}

		public function loguearUsuario($usuarioALogear){
			
			$_SESSION["usuarioLogueado"] = $usuarioALogear->getId();

			if (isset($_POST['recordarme'])) {
				setcookie('usuarioLogueado', $usuarioALogear->getId(), time() + 60 * 60 * 24 * 3);
			}	
		}
		public function logOut(){

			session_destroy();
			$this->unsetCookie("usuarioLogueado");
		}
		public function unsetCookie($cookie){
			// echo "Hola desde unSetCookie";
			setcookie($cookie, "", -1);
		}
	




}

?>