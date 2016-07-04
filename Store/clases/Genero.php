<?php 

	Class Genero {

		private $generoId;
		private $generoNombre;
		private $generoNombreFantasia;

		public function getGeneroId(){
			return $this->generoId;
		}
		public function setGeneroId(){
			$this->generoId = $generoId;
		}
		public function getGeneroNombre(){
			return $this->generoNombre;
		}
		public function setGeneroNombre(){
			$this->generoNombre = $generoNombre;
		}
		public function getGeneroNombreFantasia(){
			return $this->generoNombreFantasia;
		}
		public function setGeneroNombreFantasia(){
			$this->generoNombreFantasia = $generoNombreFantasia;
		}

		public function verGenero($miGenero){
			$this->generoId = $miGenero['generoId'];
			$this->generoNombre = $miGenero['generoNombre'];
			$this->generoNombreFantasia = $miGenero['generoNombreFantasia'];
		}


	}



 ?>