<?php require_once("config.php"); 

	if (!$auth->estaLogueado()) {
		$redirect->redirigirALoginBackDoor();
	}
	$titulo = "Delete Products";

	$genero = [
				''=>' - Selecciona el genero - ',
				'Masculino'=>'Masculino',
				'Femenino'=>'Femenino',
				'Otro'=>'Otro'
			];
	$categoria = [
				''=>' - Selecciona una Categoria - ',
				'Clothing'=>'Clothing',
				'Accesories'=>'Accesories',
				'Shoes'=>'Shoes'
	];
	$subCategoria = [
				''=>' - Selecciona una SubCategoria - ',
				'Clothing'=>'Clothing',
				'Accesories'=>'Accesories',
				'Shoes'=>'Shoes'
	];
	
	$id = $_GET['id'];
	$producto = $repositorio->getProductRepository()->getProductoById($id);
	// var_dump($producto);
	if ($_POST) {

		$errores = $validar->validarProducto($_POST)['errores'];
		$datosProducto = $validar->validarProducto($_POST)['datosProducto'];

		if (empty($errores)) {
			$productoAEliminar = $repositorio->getProductRepository()->productoAEliminarEnJSON($_POST);
			// var_dump($productoAModificar);
			$repositorio->getProductRepository()->modificarProducto($productoAEliminar);
			$redirect->redirigirAPanel();
		}
	}
?>
<?php require_once("include/head.php"); ?>
 <body>
	<?php require_once("include/header.php"); ?>
	<section id="register">
			<div class="title"><h2>Eliminar Producto</h2></div>
			
			<form action="" method="POST" enctype="multipart/form-data">
			<?php if (!empty($errores)) {
						?>
					<div class="error" id="errorRegister">
						<h3>Los siguientes Campos tuvieron errores</h3>
						<ul class="listadoErrores">
							<?php foreach ($errores as $error) {
								?> <li><?php echo $error; ?></li><?php
							} ?>
						</ul>
					</div>
				<?php 
					} ?>
					<label for="nombre">Nombre:</label>
				<input type="text" name="nombre" id="nombre" value="<?php echo $producto->getProductoNombre(); ?>"><br>
				<label for="descripcion">Descripcion:</label>
				<textarea name="descripcion" id="descripcion" cols="30" rows="10"><?php echo $producto->getProductoDescripcion(); ?></textarea><br>
				<label for="precio">Precio:</label>
				<input type="number" name="precio" id="precio" value="<?php echo $producto->getProductoPrecio(); ?>"><br>

				<label for="genero">Genero:</label>
				<select id="genero" name="genero">
					    	<?php foreach ($genero as $key => $value) { ?>
								<?php if ($key == $producto->getProductoGenero()) { ?>
									<option selected value="<?php echo $key; ?>" ><?php echo $value;?></option>
								<?php } else { ?>
									<option value="<?php echo $key;?>"><?php echo $value;?></option>
								<?php } ?>
							<?php } ?>
				</select><br>
				
				
				<label for="categoria">Categorias:</label>
				<select name="categoria" id="categoria">
					<?php foreach ($categoria as $key => $value) { ?>
								<?php if ($key == $producto->getProductoCategoria()) { ?>
									<option selected value="<?php echo $key; ?>" ><?php echo $value;?></option>
								<?php } else { ?>
									<option value="<?php echo $key;?>"><?php echo $value;?></option>
								<?php } ?>
							<?php } ?>
				</select><br>

				<label for="subCategoria">SubCategorias:</label>
				<select name="subCategoria" id="subCategoria">
					<?php foreach ($subCategoria as $key => $value) { ?>
								<?php if ($key == $producto->getProductoSubCategoria()) { ?>
									<option selected value="<?php echo $key; ?>" ><?php echo $value;?></option>
								<?php } else { ?>
									<option value="<?php echo $key;?>"><?php echo $value;?></option>
								<?php } ?>
							<?php } ?>
				</select><br>
				<label for="fotoProducto">Fotos</label><br>
				<?php if ($producto->getProductoFoto() == "artsinfoto.gif") {
									$productoFoto = '<img src="assets/'.$producto->getProductoFoto().'" alt="">';
								}else{
									$productoFoto = 
										'<img src="assets/'.$_SESSION['usuarioLogueado'].'/products/'.$producto->getProductoFoto().'" alt="">';
								}?>

							<?php echo $productoFoto; ?><br>
				<input type="file" name="fotoProducto" id="fotoProducto" multiple><br>
				<input type="hidden" name="id" id="id" hidden value="<?php echo $producto->getProductoId(); ?>">
				<input type="submit" value="Eliminar Producto">
			</form>
			
	</section>
	<?php require_once("include/footer.php") ?>		
</body>
</html>