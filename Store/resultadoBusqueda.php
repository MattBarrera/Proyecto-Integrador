<?php
	require_once("config.php");

	if ($auth->estaLogueado() ) {
			//redirigir al index de un usuario logeado
			$titulo = "Index - Privado";
		}else{
			//redirigir a index publico
			$titulo = "Index";
		}
		$busqueda = $_GET['busqueda'];
		// var_dump($busqueda);exit;
		$productos = $repositorio->getProductRepository()->getAllProducts();
		$productosOK = $repositorio->getProductRepository()->getProductoByEstado($productos,1);

 ?>
	<?php require_once("include/head.php"); ?>
<body>
	<?php  require_once("include/header.php");?>
<section id="productosStore">
	<div class="title">
		<h2>Resultado de busqueda</h2>
	</div>
	<div class="productosDestacados">
	<?php foreach ($productosOK as $key => $value) { ?>
			<div class="productoDestacado">
				<?php if ($repositorio->getProductRepository()->getProductoById($value->getProductoId())->getProductoFoto() == "artsinfoto.gif") {
							$productoFoto = '<img src="assets/'.$repositorio->getProductRepository()->getProductoById($value->getProductoId())->getProductoFoto().'" alt="">';
					}else{
						$productoFoto =
							'<img src="assets/'.$repositorio->getProductRepository()->getProductoById($value->getProductoId())->getProductoUsuarioId().'/products/'.$repositorio->getProductRepository()->getProductoById($value->getProductoId())->getProductoFoto().'" alt="">';
					}?>
						<?php echo $productoFoto; ?>
						<h3><a href="detalleProducto.php?id=<?php echo $value->getProductoId();?>" title=""><?php echo $value->getProductoNombre();?></a></h3>
						<p><?php echo $value->getProductoDescripcion();?></p>
						<p>Precio: $ <?php echo $value->getProductoPrecio();?></p>
						<p>Categoria:<?php echo $value->getProductoCategoria();?></p>
						<?php $datosUsuario = $repositorio->getUserRepository()->getUsuarioById($value->getProductoUsuarioId()); ?>
						<p>Usuario: <a href="profileDetalle.php?userId=<?php echo $value->getProductoUsuarioId() ?>"><?php echo $datosUsuario->getNombre()." ".$datosUsuario->getApellido(); ?></a></p>

						<button><a href="#" title="">Comprar</a></button>
			</div>
		<?php } ?>
	</div>
	</section>
	<?php require_once("include/footer.php") ?>
</body>
</html>
