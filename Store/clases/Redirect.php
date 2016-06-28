<?php 

	Class Redirect{

		public function redirigirALogin($redirectTo = ""){
			if ($redirectTo == "") {
				header("location:login.php");
				exit;
			}
			header("location:login.php?redirectTo=" . $redirectTo);
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