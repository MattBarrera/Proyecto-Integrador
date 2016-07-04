<?php 

	Class Producto {

		Private $productoId;
		Private $productoNombre;
		Private $productoDescripcion;
		Private $productoPrecio;
		Private $productoGenero;
		Private $productoCategoria;
		Private $productoSubCategoria;
		Private $productoFoto;
		Private $productoEstado;
		Private $productoFechaAlta;
		Private $productoFechaDeModificacion;
		Private $usuarioId;

		public function getProductoId(){
			return $this->productoId;
		}
		public function setProductoId($id){
			$this->productoId = $id;
		}

		public function getProductoNombre(){
			return $this->productoNombre;
		}
		public function setProductoNombre($nombre){
			$this->productoNombre = $nombre;
		}

		public function getProductoDescripcion(){
			return $this->productoDescripcion;
		}
		public function setProductoDescripcion($descripcion){
			$this->productoDescripcion = $descripcion;
		}

		public function getProductoPrecio(){
			return $this->productoPrecio;
		}
		public function setProductoPrecio($precio){
			$this->productoPrecio = $precio;
		}

		public function getProductoGenero(){
			return $this->productoGenero;
		}
		public function setProductoGenero($genero){
			$this->productoGenero = $genero;
		}

		public function getProductoCategoria(){
			return $this->productoCategoria;
		}
		public function setProductoCategoria($categoria){
			$this->productoCategoria = $categoria;
		}

		public function getProductoSubCategoria(){
			return $this->productoSubCategoria;
		}
		public function setProductoSubCategoria($subCategoria){
			$this->productoSubCategoria = $subCategoria;
		}

		public function getProductoFoto(){
			return $this->productoFoto;
		}
		public function setProductoFoto($foto){
			$this->productoFoto = $foto;
		}

		public function getProductoEstado(){
			return $this->productoEstado;
		}
		public function setProductoEstado($estado){
			$this->productoEstado = $estado;
		}

		public function getProductoFechaAlta(){
			return $this->productoFechaAlta;
		}
		public function setProductoFechaAlta($fechaAlta){
			$this->productoFechaAlta = $fechaAlta;
		}

		public function getProductoFechaDeModificacion(){
			return $this->productoFechaDeModificacion;
		}
		public function setProductoFechaDeModificacion($fechaDeModificacion){
			$this->productoFechaDeModificacion = $fechaDeModificacion;
		}

		public function getProductoUsuarioId(){
			return $this->usuarioId;
		}
		public function setProductoUsuarioId($usuarioId){
			$this->usuarioId = $usuarioId;
		}
		public function verProducto(Array $producto){
			$this->productoId = $producto["id"];
			$this->productoNombre = $producto["nombre"];
			$this->productoDescripcion = $producto["descripcion"];
			$this->productoPrecio = $producto["precio"];
			$this->productoGenero = $producto["genero"];
			$this->productoCategoria = $producto["categoria"];
			$this->productoSubCategoria = $producto["subCategoria"];
			$this->productoFoto = $producto["productoFoto"];
			$this->productoEstado = $producto['estado'];
			$this->productoFechaAlta = $producto['fechaAlta'];
			$this->usuarioId = $producto['usuarioId'];
		}
		public static function uploadProductoFoto($userId,$productoFoto){
			if ($_FILES["fotoProducto"]["error"] == UPLOAD_ERR_OK){
				//No hubo errores :)
				$directory = dirname(__FILE__);
				$directory = $directory . "/../assets/".$userId."/products/";
				if (!is_dir($directory)) {
					mkdir($directory, 0777,true);
				}
				$destino = $directory . $_FILES['fotoProducto']['name'];
				move_uploaded_file($_FILES["fotoProducto"]["tmp_name"], $destino);
			}
		}
	}
 ?>