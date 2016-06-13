<?php 

	Class Redirect{

		public function redirigirALogin(){
			header("location:login.php");
			exit;	
		}
		public function redirigirAIndex(){
			header("location:index.php");
			exit;
		}
		public function redirigirALoginBackDoor(){
			header("location:login.php?errorLogin");
			exit;
		}
		public function redirigirAPanel(){
			header("location:myproducts.php");
			exit;
		}


	}


 ?>