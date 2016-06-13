<?php require_once("config.php"); 

	if (!$auth->estaLogueado()) {
		$redirect->redirigirALoginBackDoor();
	}
	$titulo = "Products";

	$productos = $repositorio->getProductRepository()->getProductoByUserId($_SESSION['usuarioLogueado']);
	$productosOK = $repositorio->getProductRepository()->getProductoByEstado($productos,1);
	// var_dump($productosOK);exit;
?>
<?php require_once("include/head.php"); ?>
 <body>
	<?php require_once("include/header.php"); ?>
	<section id="register">
			<div class="title"><h2>Tus Productos!!</h2></div>

			<div class="halfInput">
				<button><a href="newProduct.php">Nuevo Producto</a></button>
			</div>
			<div class="clear">	</div>
			<section id="productos">
			<div class="productosDestacados">

							<!-- <?php var_dump($productos);?> -->
						<?php foreach ($productosOK as $key => $value) { ?>
							
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
							<button><a href="editProduct.php?id=<?php echo $value->getProductoId();?>" title="">Editar Producto</a></button>
							<button><a href="deleteProduct.php?id=<?php echo $value->getProductoId();?>" title="">Eliminar Producto</a></button>
						</div>
						<?php } ?>


			</div>
			<div class="clear"></div>
		</section>
			
	</section>		
</body>
</html>