<?php 
	
	require_once("ProductRepository.php");
	require_once("Producto.php");

	class ProductMySQLRepository extends ProductRepository {

		private $miConexion;
		
		public function __construct($miConexion){
			$this->miConexion = $miConexion;
		}

		public function guardarProducto($productoAGuardar){
			//ACA SE GUARDAN O ACUTIALIZAN LOS PRODUCOS IDEM A USUARIO MYSQL	
			
		}
		public function crearProducto(Array $miProducto, Array $fotoProducto){
			// var_dump($miProducto);

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
			// var_dump($productoAGuardar);exit;
		}
		public function getAllProducts(){
			$stmt = $this->miConexion->prepare("SELECT * from producto");

			$stmt->execute();

			$productoArray = $stmt->fetchAll();

			return $this->muchosArraysAMuchosProductos($productoArray);
		}

		private function muchosArraysAMuchosProductos(Array $productoArray){
			$productos = [];

			foreach ($productoArray as $productoArray) {
				$productos[] = $this->arrayToProducto($productoArray);
			}

			return $productos;
		}
		private function arrayToProducto(Array $miProducto) {
			
			$producto = new Producto();
			$producto->verProducto($miProducto);
			return $producto;
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
			// var_dump($productoAModificar);
		}
		public function productoAReactivarEnJSON($producto, $productoFoto){
			// var_dump($producto);exit;
			//consulto si se envio la foto
			if ($productoFoto['name'] !== "") {
					//si se envio la capturo
					$fotoProducto = $productoFoto['name'];
			}else{
				//si no se envio, uso el nombre ya guardado
				$fotoProducto = $this->getProductoById(intval($producto['id']))->getProductoFoto();
			}
			// var_dump($producto);
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
			// var_dump($productoAModificar);
			// echo arrayToString($productoAModificar);exit;
		}
		// private function productoToArray( $miProducto) {
		// 	// var_dump($miProducto);exit;
		// 	$productoToArray = [];

		// 	$productoToArray["id"] = $miProducto->getProductoId();
		// 	$productoToArray["nombre"] = $miProducto->getProductoNombre();
		// 	$productoToArray["descripcion"] = $miProducto->getProductoDescripcion();
		// 	$productoToArray["precio"] = $miProducto->getProductoPrecio();
		// 	$productoToArray["genero"] = $miProducto->getProductoGenero();
		// 	$productoToArray["categoria"] = $miProducto->getProductoCategoria();
		// 	$productoToArray["subCategoria"] = $miProducto->getProductoSubCategoria();
		// 	$productoToArray["productoFoto"] = $miProducto->getProductoFoto();
		// 	$productoToArray["estado"] = $miProducto->getProductoEstado();
		// 	$productoToArray["fechaAlta"] = $miProducto->getProductoFechaAlta();
		// 	$productoToArray["fechaDeModificacion"] = $miProducto->getProductoFechaDeModificacion();
		// 	$productoToArray["usuarioId"] = $miProducto->getProductoUsuarioId();


		// 	return $productoToArray;
		// 	// var_dump($productoToArray);exit;
		// }
		public function getProductoByUserId($userId){
			$stmt = $this->miConexion->prepare("SELECT * from producto WHERE usuario_usuarioId = :userId");

			$stmt->bindValue(":userId", $userId, PDO::PARAM_INT);
			$stmt->execute();

			$productoArray = $stmt->fetchAll();

			return $this->muchosArraysAMuchosProductos($productoArray);
		}
		public function getProductoByEstado($productos, $estado){
		    $productosFinal = [];
			foreach ($productos as $producto) {
				if ($estado == $producto->getProductoEstado()) {
					// var_dump($producto);
					$productosFinal[] = $producto;
				}
			}
            return $productosFinal;
		}
		public function getProductoById($productoId){
			$stmt = $this->miConexion->prepare("SELECT * from producto WHERE productoId = :productoId");

			$stmt->bindValue(":productoId", $productoId, PDO::PARAM_INT);
			$stmt->execute();

			$productoArray = $stmt->fetchAll();

			return $this->muchosArraysAMuchosProductos($productoArray);
		}
	}
 ?>