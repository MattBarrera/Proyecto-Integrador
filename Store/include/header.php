<?php require_once("config.php"); ?>
<header>
		<a href="index.php"><img src="../img/final4.png" alt="Logo" id="logo"></a>
	<nav>
		<ul>
			<li>
				<form action="resultadoBusqueda.php" method="GET" >
					<input type="text" placeholder="busqueda" name="busqueda">
				</form>
			</li>
			<?php 
				if ($auth->estaLogueado() ) {
					//consulto, si la foto es la Default
					if ($repositorio->getUserRepository()->getUsuarioById($_SESSION['usuarioLogueado'])->getFotoPerfil() == "avatar_2x.png") {
						$comunAvatar = '<img class="fotoPerfil" src="assets/'.$repositorio->getUserRepository()->getUsuarioById($_SESSION['usuarioLogueado'])->getFotoPerfil().'" alt="">';
					}else{
						$comunAvatar = 
							'<img class="fotoPerfil" src="assets/'.$_SESSION['usuarioLogueado'].'/profile/'.$repositorio->getUserRepository()->getUsuarioById($_SESSION['usuarioLogueado'])->getFotoPerfil().'" alt="">';
					}
					//Menu Privado
					echo('<li class="acount nav img"><a href="#"><span>'.$repositorio->getUserRepository()->getUsuarioById($_SESSION['usuarioLogueado'])->getNombre(). $comunAvatar.'</a>
						    <ul class="dropDown">
						      <li><a href="myproducts.php">My Products</a></li>
						      <li class="separator"></li>
						      <li><a href="myHistoryPproducts.php">My Historics Products</a></li>
						      <li class="separator"></li>
						      <li><a href="UsuariosSeguidos.php">Usuarios Seguidos</a></li>
						      <li class="separator"></li>
						      <li><a href="empresas.php">Mis Empresas</a></li>
						      <li class="separator"></li>
						      <li><a href="myacount.php">My Acount</a></li>
						      <li class="separator"></li>
						      <li><a href="logout.php">Log Out</a></li>
						    </ul>
						  </li>');
				}else{
					//Menu Privado
					echo('<li class="acount nav"><a href="#"><span>Acount</span></a>
						    <ul class="dropDown">
						      <li><a href="register.php">Register</a></li>
						      <li class="separator"></li>
						      <li><a href="login.php">Login</a></li>
						    </ul>
						  </li>');
				}
			?>
			<li><a href="carrito.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Shop (0)</a></li>
		</ul>
	</nav>
</header>
