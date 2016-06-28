<?php
	require_once("Store/config.php");

	$productos = $repositorio->getProductRepository()->getAllProductsIndex();
	$productosOK = $repositorio->getProductRepository()->getProductoByEstado($productos,1);
	// var_dump($productosOK);exit;

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- <link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css"> -->
	<title>Clothes Shop</title>
	<!-- Styles -->
	<link rel="stylesheet" href="css/stylesFinal.css">
	<!-- Scrips -->
	<script type="text/javascript" src="js/backToTop.js"></script>
	<script type="text/javascript" src="js/slider.js"></script>
	<script type="text/javascript" src="js/navbar.js"></script>
	<script type="text/javascript" src="js/botonesHyM.js"></script>

</head>
<body>
	<header>
		<a href="#"><img src="img/final4.png" alt="Logo" id="logo"></a>
		<nav>
			<ul>
				<!-- <li class="acount">
					<a href="#">Acount</a>
					<ul class="dropDown">
						      <li><a href="Store/register.php">Register</a></li>
						      <li class="separator"></li>
						      <li><a href="Store/login.php">Login</a></li>
						    </ul>
				</li> -->
				<li><a href="Store/index.php">Store</a></li>
			</ul>
		</nav>
	</header>
	<main>
		<a href="#" class="cd-top cd-is-visible">Top</a>
		<section id="home">
			<div class="welcome">
			<ul id="galeria">
				<li><img src="img/fotobien1.jpg" alt="Rascafría" /></li>
				<li><img src="img/fotobien2.jpg" alt="Rascafría" /></li>
				<li><img src="img/fotobien3.jpg" alt="Rascafría" /></li>
			</ul>

			</div>
		</section>
		<section id="categorias">
			<section class="cateogias">
				<div>
					<div class="categoria">
						<h2>CLOTHING</h2>
						<img class= "fotoCategoria" src="img/jeans.jpg" alt="">
						<div class="botonFoto">
							<button class="buttonCategorias"><a href="Store/index.php">Hombre</a>Hombre</button>
							<button class="buttonCategorias"><a href="Store/index.php">Mujer</a>Mujer</button>
						</div>
					</div>
				</div>
				<div>
					<div class="categoria">
						<h2>SHOES</h2>
						<img class= "fotoCategoria" src="img/shoesmen.jpg" alt="">
						<div class="botonFoto">
							<button class="buttonCategorias"><a href="Store/index.php">Hombre</a>Hombre</button>
							<button class="buttonCategorias"><a href="Store/index.php">Mujer</a>Mujer</button>
						</div>
					</div>
				</div>
				<div>
					<div class="categoria">
						<h2>ACCESSORIES</h2>
						<img class="fotoCategoria" src="img/hola3.jpg" alt="">
						<div class="botonFoto">
							<button class="buttonCategorias"><a href="Store/index.php">Hombre</a>Hombre</button>
							<button class="buttonCategorias"><a href="Store/index.php">Mujer</a>Mujer</button>
						</div>
					</div>
				</div>
				<div class="clear"></div>
			</section>
		</section>
		<section id="store">
		      	<div>
		      		<button class="storeHombre"><a href="Store/index.php">Hombre</a></button>
		      		<button class="storeMujer"><a href="Store/index.php">Mujer</a></button>
		      	</div>
		</section>
		<section id="productos">
			<div class="productosDestacados">
					<h2>PRODUCTOS DESTACADOS</h2>
						<?php for ($i = 0; $i < 10; $i++) {
				                  if ($repositorio->getProductRepository()->getProductoByIdIndex($productosOK[$i]->getProductoId())->getProductoFoto() == "artsinfoto.gif") {
				                      $productoFoto = '<img src="Store/assets/'.$repositorio->getProductRepository()->getProductoByIdIndex($productosOK[$i]->getProductoId())->getProductoFoto().'" alt="">';
				                    }else{
				                      $productoFoto =
				                        '<img src="Store/assets/'.$repositorio->getProductRepository()->getProductoByIdIndex($productosOK[$i]->getProductoId())->getProductoUsuarioId().'/products/'.$repositorio->getProductRepository()->getProductoByIdIndex($productosOK[$i]->getProductoId())->getProductoFoto().'" alt="">';
						?>
				                   	<div class="productoDestacado">
				                        <?php echo $productoFoto; ?>
				                        <h3><a href="Store/detalleProducto.php?id=<?php echo $productosOK[$i]->getProductoId();?>" title=""><?php echo $productosOK[$i]->getProductoNombre();?></a></h3>
			                          	<p><?php echo $productosOK[$i]->getProductoDescripcion();?></p>
			                          	<p>Precio: $ <?php echo $productosOK[$i]->getProductoPrecio();?></p>
			                          	<p>Categoria:<?php echo $productosOK[$i]->getProductoCategoria();?></p>
										<?php $datosUsuario = $repositorio->getUserRepository()->getUsuarioById($productosOK[$i]->getProductoUsuarioId()); ?>
										<p>Usuario: <a href="Store/profileDetalle.php?userId=<?php echo $productosOK[$i]->getProductoUsuarioId() ?>"><?php echo $datosUsuario->getNombre()." ".$datosUsuario->getApellido(); ?></a></p>
				                        <button><a href="#" title="">Agregar al Carrito</a></button>
				                    </div>
			              	<?php } ?>
			          	<?php } ?>
			</div>
			<div class="clear"></div>
		</section>
		<section id="empresas" class="fondoAzul textoCentrado">
			<a href="http://www.twitter.com"> <img src="img/twitter.png"/></a>
      		<a href="http://www.facebook.com"> <img src="img/facebook.png" /></a>
			<a href="http://www.instagram.com"> <img src="img/instagram.png" /></a>
			<a href="mailto:biancapallaro@gmail.com"><img src="img/gmail.png"/></a>
    	</section>

	</main>
	<footer>
			<p> © Clothes Shop - All rights reserved</p>
	</footer>
</body>
</html>
