<?php 
	require_once("config.php");
	
	if ($auth->estaLogueado() ) {
			//redirigir al index de un usuario logeado
			$titulo = "Index - Privado";
		}else{
			//redirigir a index publico
			$titulo = "Index";
		}

		$productos = $repositorio->getProductRepository()->getAllProducts();
		$productosOK = $repositorio->getProductRepository()->getProductoByEstado($productos,1);
 ?>
	<?php require_once("include/head.php"); ?>
<body>
	<?php  require_once("include/header.php");?>
<br>
	<?php 
		if ($auth->estaLogueado() ) {
			//redirigir al index de un usuario logeado
			echo "<h2>Este es el index, para una persona logeada, es decir un index privado</h2>";
			foreach ($productosOK as $key => $value) { ?>
							<div class="productoDestacado">
							<?php if ($repositorio->getProductRepository()->getProductoById($value->getProductoId())->getProductoFoto() == "artsinfoto.gif") {
									$productoFoto = '<img src="assets/'.$repositorio->getProductRepository()->getProductoById($value->getProductoId())->getProductoFoto().'" alt="">';
								}else{
									$productoFoto = 
										'<img src="assets/'.$_SESSION['usuarioLogueado'].'/products/'.$repositorio->getProductRepository()->getProductoById($value->getProductoId())->getProductoFoto().'" alt="">';
								}?>

							<?php echo $productoFoto; ?>
							<h3><?php echo $value->getProductoNombre();?></h3>
							<p><?php echo $value->getProductoDescripcion();?></p>
							<p>Precio: $ <?php echo $value->getProductoPrecio();?></p> 
							<p>Categoria: <?php echo $value->getProductoCategoria();?></p> 
							<button><a href="#" title="">Detalle Producto</a></button>
						</div>
						<?php } 
			
		}else{
			//redirigir a index publico
			echo "<h2>Este es el index, para una persona deslogeada, es decir un index publico</h2>";
			foreach ($productosOK as $key => $value) { ?>
							
							<div class="productoDestacado">
							<?php if ($repositorio->getProductRepository()->getProductoById($value->getProductoId())->getProductoFoto() == "artsinfoto.gif") {
									$productoFoto = '<img src="assets/'.$repositorio->getProductRepository()->getProductoById($value->getProductoId())->getProductoFoto().'" alt="">';
								}else{
									$productoFoto = 
										'<img src="assets/'.$_SESSION['usuarioLogueado'].'/products/'.$repositorio->getProductRepository()->getProductoById($value->getProductoId())->getProductoFoto().'" alt="">';
								}?>

							<?php echo $productoFoto; ?>
							<h3><?php echo $value->getProductoNombre();?></h3>
							<p><?php echo $value->getProductoDescripcion();?></p>
							<p>Precio: $ <?php echo $value->getProductoPrecio();?></p> 
							<p>Categoria:<?php echo $value->getProductoCategoria();?></p> 
							<button><a href="#" title="">Detalle Producto</a></button>
						</div>
						<?php } 
		}

	 ?>


</body>
</html>