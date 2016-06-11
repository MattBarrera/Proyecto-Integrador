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
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
	<!-- Scrips -->
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
	<script type="text/javascript" src="js/backToTop.js"></script>
	<!-- <script type="text/javascript" src="js/validate.js"></script> -->
	<!-- <script type="text/javascript" src="js/scroll.js"></script> -->
	<!-- <script type="text/javascript" src="js/activeMenu.js"></script> -->
	<script type="text/javascript" src="js/slider.js"></script>
	<script type="text/javascript" src="js/botonesHyM.js"></script>

</head>
<body>
	<header>
		<a href="#"><img src="img/final4.png" alt="Logo" id="logo"></a>
		<a href="#" onclick="Nav" class="btn-nav"><span>Menu</span></a>
		<nav>
			<ul>
				<li><a href="register.php">Register</a></li>
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

						<?php foreach ($productosOK as $key => $value) { ?>

							<div class="productoDestacado">
								<?php if ($repositorio->getProductRepository()->getProductoByIdIndex($value->getProductoId())->getProductoFoto() == "artsinfoto.gif") {
										$productoFoto = '<img src="Store/assets/'.$repositorio->getProductRepository()->getProductoByIdIndex($value->getProductoId())->getProductoFoto().'" alt="">';
									}else{
										$productoFoto = 
											'<img src="Store/assets/'.$repositorio->getProductRepository()->getProductoByIdIndex($value->getProductoId())->getProductoUsuarioId().'/products/'.$repositorio->getProductRepository()->getProductoByIdIndex($value->getProductoId())->getProductoFoto().'" alt="">';
									}?>
							<?php echo $productoFoto; ?>
							<h3><?php echo $value->getProductoNombre();?></h3>
							<p><?php echo $value->getProductoDescripcion();?></p>
							<p>Precio: $ <?php echo $value->getProductoPrecio();?></p> 
							<p>Categoria: <?php echo $value->getProductoCategoria();?></p> 
							<button><a href="#" title="">Detalle Producto</a></button>
						</div>
						<?php } ?>

			</div>
			<div class="clear"></div>
		</section>

	</main>
	<footer>
			<p> © Clothes Shop - All rights reserved</p>
	</footer>
</body>
</html>
