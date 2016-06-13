<?php require_once("config.php"); ?>
<header>
		<a href="index.php"><img src="../img/final4.png" alt="Logo" id="logo"></a>
	<nav>
		<ul>
			<?php 
				// var_dump($_SESSION);exit;
				if ($auth->estaLogueado() ) {
					//redirigir al index de un usuario logeado
					// var_dump($repositorio->getUserRepository()->getUsuarioById($_SESSION['usuarioLogueado']));
					if ($repositorio->getUserRepository()->getUsuarioById($_SESSION['usuarioLogueado'])->getFotoPerfil() == "avatar_2x.png") {
						// var_dump($_SESSION);
						// var_dump($repositorio->getUserRepository()->getUsuarioById($_SESSION['usuarioLogueado'])->getFotoPerfil());exit;
						$comunAvatar = '<img class="fotoPerfil" src="assets/'.$repositorio->getUserRepository()->getUsuarioById($_SESSION['usuarioLogueado'])->getFotoPerfil().'" alt="">';
						// echo "1";
						// var_dump($comunAvatar);
					}else{
						$comunAvatar = 
							'<img class="fotoPerfil" src="assets/'.$_SESSION['usuarioLogueado'].'/profile/'.$repositorio->getUserRepository()->getUsuarioById($_SESSION['usuarioLogueado'])->getFotoPerfil().'" alt="">';
							// echo "2";
						// var_dump($comunAvatar);exit;
					}
					echo('<li class="acount nav img"><a href="#"><span>'.$repositorio->getUserRepository()->getUsuarioById($_SESSION['usuarioLogueado'])->getNombre(). $comunAvatar.'</a>
						    <ul class="dropDown">
						      <li><a href="myproducts.php">My Products</a></li>
						      <li class="separator"></li>
						      <li><a href="myHistoryPproducts.php">My Historics Products</a></li>
						      <li class="separator"></li>
						      <li><a href="myacount.php">My Acount</a></li>
						      <li class="separator"></li>
						      <li><a href="logout.php">Log Out</a></li>
						    </ul>
						  </li>');
				}else{
					//redirigir a index publico
					echo('<li class="acount nav"><a href="#"><span>Acount</span></a>
						    <ul class="dropDown">
						      <li><a href="register.php">Register</a></li>
						      <li class="separator"></li>
						      <li><a href="login.php">Login</a></li>
						    </ul>
						  </li>');
				}
			?>
		</ul>
	</nav>
</header>
