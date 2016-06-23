<?php 
	
	require_once("ProductRepository.php");
	require_once("Producto.php");

	class ProductJSONRepository extends ProductRepository {

		public function guardarProducto($productoAGuardar){
			$productoJSON = json_encode($productoAGuardar);
			file_put_contents("productos.json", $productoJSON . PHP_EOL, FILE_APPEND);
		}
		public function crearProducto(Array $miProducto, Array $fotoProducto){
			if ($fotoProducto['name'] !== "") {
					//si se envio la capturo
					$productoFoto = $fotoProducto['name'];
			}else{
				//si no se envio, uso el nombre de default
				$productoFoto = 'artsinfoto.gif';
			}
			$productoAGuardar = [
				"id" => $this->getNewID(),
				"nombre" => $miProducto['nombre'],
				"descripcion" => $miProducto['descripcion'],
				"precio" => $miProducto['precio'],
				"genero" => $miProducto['genero'],
				"categoria" => $miProducto['categoria'],
				"subCategoria" => $miProducto['subCategoria'],
				"productoFoto" => $productoFoto,
				"estado" => 1,
				"fechaAlta" => date("d-m-Y - H:i:s"),
				"usuarioId" => $_SESSION['usuarioLogueado'],
			];
			return $productoAGuardar;
		}
		public function getAllProducts(){
			$productos = file_get_contents("productos.json");
			$productosArray = explode(PHP_EOL, $productos);
			array_pop($productosArray);
			return $this->muchosArraysAMuchosProductos($productosArray);
		}
		public function getAllProductsIndex(){
			$productos = file_get_contents("Store/productos.json");
			$productosArray = explode(PHP_EOL, $productos);
			array_pop($productosArray);
			return $this->muchosArraysAMuchosProductos($productosArray);
		}
		private function muchosArraysAMuchosProductos(Array $productoArray){
			$productos = [];
			foreach ($productoArray as $productoArray) {
				$productos[] = $this->arrayToProducto(json_decode($productoArray,1));
			}
			return $productos;
		}
		private function arrayToProducto(Array $miProducto) {
			
			$productoArray = new Producto();
			$productoArray->verProducto($miProducto);
			return $productoArray;
		}
		public function modificarProducto($productoAModificar){
			// Te traes todos los usuarios.
			$productoEnJSONParaModificar = $this->getAllProducts();
			//paso el array a un objeto
			$productoAModificarObjeto = $this->arrayToProducto($productoAModificar); 
			$todosLosProductos = "";
			// Los recorres
				foreach ($productoEnJSONParaModificar as $key => $producto) {
					// Por cada uno...
					if ($productoAModificarObjeto->getProductoId() == $producto->getProductoId()) {
						// Si el id es el mismo del que estoy modificando
							$todosLosProductos .= json_encode($productoAModificar) . PHP_EOL;
					}else{
						// Si no
						// Directamente IMPRIMO el producto como estaba
							$productoToArray = $this->productoToArray($producto);
							$todosLosProductos .= json_encode($productoToArray) . PHP_EOL;
					}
				}
			// modificar la linea que sea igual a mi ID
			file_put_contents("productos.json", $todosLosProductos);
		}
		public function productoAModificarEnJSON($producto, $productoFoto){//, $productoFoto
			//consulto si se envio la foto
			if ($productoFoto['name'] !== "") {
					//si se envio la capturo
					$fotoProducto = $productoFoto['name'];
			}else{
				//si no se envio, uso el nombre ya guardado
				$fotoProducto = $this->getProductoById(intval($producto['id']))->getProductoFoto();
			}
			$productoAModificar = [
				"id" 					=> intval($producto['id']),
				"nombre" 				=> $producto['nombre'],
				"descripcion" 			=> $producto['descripcion'],
				"precio" 				=> $producto['precio'],
				"genero" 				=> $producto['genero'],
				"categoria" 			=> $producto['categoria'],
				"subCategoria" 			=> $producto['subCategoria'],
				"productoFoto" 			=> $fotoProducto,
				"estado" 				=> $this->getProductoById($producto['id'])->getProductoEstado(),
				"fechaAlta" 			=> $this->getProductoById($producto['id'])->getProductoFechaAlta(),
				"fechaDeModificacion" 	=> date("d-m-Y - H:i:s"),
				"usuarioId" 			=> $_SESSION["usuarioLogueado"],
			];
			return $productoAModificar;
		}
		public function productoAEliminarEnJSON($producto){//, $productoFoto
			$productoAEliminar = [
				"id" => intval($producto['id']),
				"nombre" => $producto['nombre'],
				"descripcion" => $producto['descripcion'],
				"precio" => $producto['precio'],
				"genero" => $producto['genero'],
				"categoria" => $producto['categoria'],
				"subCategoria" => $producto['subCategoria'],
				"productoFoto" => 'avatar_2x.png',
				"estado" => 2,
				"fechaAlta" => $this->getProductoById($producto['id'])->getProductoFechaAlta(),
				"fechaDeModificacion" => date("d-m-Y - H:i:s"),
				"usuarioId" => $_SESSION["usuarioLogueado"],
			];
			return $productoAEliminar;
		}
		public function productoAReactivarEnJSON($producto, $productoFoto){
			var_dump($producto);exit;
			//consulto si se envio la foto
			if ($productoFoto['name'] !== "") {
					//si se envio la capturo
					$fotoProducto = $productoFoto['name'];
			}else{
				//si no se envio, uso el nombre ya guardado
				$fotoProducto = $this->getProductoById(intval($producto['id']))->getProductoFoto();
			}
			$productoAReactivar = [
				"id" => intval($producto['id']),
				"nombre" => $producto['nombre'],
				"descripcion" => $producto['descripcion'],
				"precio" => $producto['precio'],
				"genero" => $producto['genero'],
				"categoria" => $producto['categoria'],
				"subCategoria" => $producto['subCategoria'],
				"productoFoto" => $producto['productoFoto'],
				"estado" => 1,
				"fechaAlta" => $this->getProductoById($producto['id'])->getProductoFechaAlta(),
				"fechaDeModificacion" => date("d-m-Y - H:i:s"),
				"usuarioId" => $_SESSION["usuarioLogueado"],
			];
			return $productoAReactivar;
		}
		private function productoToArray( $miProducto) {
			$productoToArray = [];

			$productoToArray["id"] = $miProducto->getProductoId();
			$productoToArray["nombre"] = $miProducto->getProductoNombre();
			$productoToArray["descripcion"] = $miProducto->getProductoDescripcion();
			$productoToArray["precio"] = $miProducto->getProductoPrecio();
			$productoToArray["genero"] = $miProducto->getProductoGenero();
			$productoToArray["categoria"] = $miProducto->getProductoCategoria();
			$productoToArray["subCategoria"] = $miProducto->getProductoSubCategoria();
			$productoToArray["productoFoto"] = $miProducto->getProductoFoto();
			$productoToArray["estado"] = $miProducto->getProductoEstado();
			$productoToArray["fechaAlta"] = $miProducto->getProductoFechaAlta();
			$productoToArray["fechaDeModificacion"] = $miProducto->getProductoFechaDeModificacion();
			$productoToArray["usuarioId"] = $miProducto->getProductoUsuarioId();

			return $productoToArray;

		}
		public function getNewID(){
			if (!file_exists("productos.json"))
			{
				return 1;
			}
			$productosEnJSON = file_get_contents("productos.json");

			$productosArrayEnJSON = explode(PHP_EOL, $productosEnJSON);
			$ultimoProducto = $productosArrayEnJSON[count($productosArrayEnJSON) - 2 ];
			$ultimoProductoArray = json_decode($ultimoProducto, 1);

			return $ultimoProductoArray["id"] + 1;
		}
		public function getProductoByUserId($userId){
			$productos = $this->getAllProducts();
		        $productosFinal = [];
			foreach ($productos as $producto) {
				if ($userId == $producto->getProductoUsuarioId()) {
					$productosFinal[] = $producto;
				}
			}	
                return $productosFinal;
		}
		public function getProductoByEstado($productos, $estado){
		    $productosFinal = [];
			foreach ($productos as $producto) {
				if ($estado == $producto->getProductoEstado()) {
					$productosFinal[] = $producto;
				}
			}
            return $productosFinal;
		}
		public function getProductoById($productoId){
			$productos = $this->getAllProducts();
			foreach ($productos as $key => $producto) {
				if ($productoId == $producto->getProductoId()) {
					return $producto;
				}
			}
			return null;
		}
		public function getProductoByIdIndex($productoId){
			$productos = $this->getAllProductsIndex();
			foreach ($productos as $key => $producto) {
				if ($productoId == $producto->getProductoId()) {
					return $producto;
				}
			}
			return null;
		}
	}
 ?>