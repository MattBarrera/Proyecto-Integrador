<?php 
	require_once("config.php"); 
	if (!$auth->estaLogueado()) {
		$redirect->redirigirALoginBackDoor();
	}
	$titulo = "New Products";
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
	if ($_POST) {
		//validacion de datos
		$errores = $validar->validarProducto($_POST)['errores'];
		$datosProducto = $validar->validarProducto($_POST)['datosProducto'];

		if (empty($errores)) {
			//capturo el avatar
			if (isset($_FILES['productoFoto'])) {
				$productoFoto = $_FILES['productoFoto'];
				// var_dump($productoFoto);exit;
			}
			//rutina subir fotos
			Producto::uploadProductoFoto($_SESSION['usuarioLogueado'],$productoFoto);//
			//preparo el producto a guardar
			$productoAGuardar = $repositorio->getProductRepository()->crearProducto($_POST, $productoFoto);
			//guardo el producto
			$repositorio->getProductRepository()->guardarProducto($productoAGuardar);
			// Redireccion al panel
			$redirect->redirigirAPanel();
		}
	}
?>
<?php require_once("include/head.php"); ?>
 <body>
	<?php require_once("include/header.php"); ?>
	<section id="register">
			<div class="title"><h2>Agregar Nuevo Producto</h2></div>	
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
				<input type="text" name="nombre" id="nombre"><br>
				<label for="descripcion">Descripcion:</label>
				<textarea name="descripcion" id="descripcion" cols="30" rows="10"></textarea><br>
				<label for="precio">Precio:</label>
				<input type="number" name="precio" id="precio"><br>

				<label for="genero">Genero:</label>
				<select name="genero" id="genero">
					<?php 
					foreach ($genero as $key => $value) {
						?>
						<option value="<?php echo $key;?>"> <?php echo $value;?> </option> 
						<?php
					}
					 ?>
				</select><br>
				<label for="categoria">Categorias:</label>
				<select name="categoria" id="categoria">
					<?php 
					foreach ($categoria as $key => $value) {
						?>
						<option value="<?php echo $key;?>"> <?php echo $value;?> </option> 
						<?php
					}
					 ?>
				</select><br>
				<label for="subCategoria">SubCategorias:</label>
				<select name="subCategoria" id="subCategoria">
					<?php 
					foreach ($subCategoria as $key => $value) {
						?>
						<option value="<?php echo $key;?>"> <?php echo $value;?> </option> 
						<?php
					}
					 ?>
				</select><br>
				<label for="productoFoto">Fotos</label>
				<input type="file" name="productoFoto" id="productoFoto" multiple><br>
				<input type="submit" value="Enviar">
			</form>
			
	</section>		
</body>
</html>