<?php require_once("config.php"); 

	if (!$auth->estaLogueado()) {
		$redirect->redirigirALoginBackDoor();
	}
	$titulo = "Products";

	$productos = $repositorio->getProductRepository()->getProductoByUserId($_SESSION['usuarioLogueado']);
	$productosOK = $repositorio->getProductRepository()->getProductoByEstado($productos,2);
	// var_dump($productos);exit;
?>
<?php require_once("include/head.php"); ?>
 <body>
	<?php require_once("include/header.php"); ?>
	<section id="productosStore">
			<div class="title"><h2>Todos tus Productos Historicos!!</h2></div>

			<div class="productosDestacados">			
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
									<button><a href="ReactivarProduct.php?id=<?php echo $value->getProductoId();?>" title="">Reactivar Producto</a></button>
						</div>
						<?php } ?>

			</div>
			<div class="clear"></div>
		</section>
	<?php require_once("include/footer.php") ?>
</body>
</html>
