<?php
	require_once("config.php");

	$titulo = "Carrito";

	$productos = $repositorio->getProductRepository()->getAllProducts();
	$productosOK = $repositorio->getProductRepository()->getProductoByEstado($productos,1);

 ?>
	<?php require_once("include/head.php"); ?>
<body>
	<?php  require_once("include/header.php");?>
<section id="productosStore">
	<h1>Estos son los productos en tu carrito:</h1>
	<div class="productosDestacados">
		<div class="carrito">
			<form action="" method="POST">
				<table class="tableFull">
					<tr>
						<th></th>
						<th>Nombre:</th>
						<th>Precio Unitario:</th>
						<th>Cantidad:</th>
						<th>Subtotal:</th>
						<th></th>
					</tr>
					<?php foreach ($productosOK as $key => $value) { ?>
					<tr class="productoCarrito">
							<?php if ($repositorio->getProductRepository()->getProductoById($value->getProductoId())->getProductoFoto() == "artsinfoto.gif") {
										$productoFoto = '<img src="assets/'.$repositorio->getProductRepository()->getProductoById($value->getProductoId())->getProductoFoto().'" alt="">';
								}else{
									$productoFoto = '<img src="assets/'.$repositorio->getProductRepository()->getProductoById($value->getProductoId())->getProductoUsuarioId().'/products/'.$repositorio->getProductRepository()->getProductoById($value->getProductoId())->getProductoFoto().'" alt="">';
								} ?>
								<td>

									<div class="productoFotoCarrito"><?php echo $productoFoto; ?></div>
								</td>
								<td>	
									<div class="infoProdcuto">
										<h3><a href="detalleProducto.php?id=<?php echo $value->getProductoId();?>" title=""><?php echo $value->getProductoNombre();?></a></h3>
										<p><?php echo $value->getProductoDescripcion();?></p>
									</div>
								</td>
								<td>
									<div class="infoProducto">
										<p>$ <?php echo $value->getProductoPrecio();?></p>
									</div>
								</td>
								<td>
									<div class="infoProducto">
										
										<input type="number" id="cantidad" name="cantidad" min="1" value="1">
									</div>
								</td>
								<td>
									<div class="infoProducto">
										<p>$ 100</p>
									</div>
								</td>
								<td>
									<div class="infoProducto">
										<button><a href="#" title="">Eliminar</a></button>
									</div>
								</td>
					</tr>								
					<?php } ?>
				</table>
				<input type="submit" value="Comprar">
			</form>	
		</div>
	</div>
	</section>
	<?php require_once("include/footer.php") ?>
</body>
</html>
