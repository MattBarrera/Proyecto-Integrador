<?php 

	class Hash{

		private $hashUserId;
		private $hashHash;
		private $hashFechaAlta;


		public function getHashUserId() {
			return $this->hashUserId;
		}
		public function setHashUserId($id){
			$this->hashUserId = $id;
		}

		public function getHashHash() {
			return $this->hashHash;
		}
		public function setHashHash($hash){
			$this->hashHash = $hash;
		}
		
		public function getHashFechaAlta() {
			return $this->hashFechaAlta;
		}
		public function setHashFechaAlta($fechaAlta){
			$this->hashFechaAlta = $fechaAlta;
		}

		public function verHash(Array $hash){
			// var_dump($hash);exit;
			$this->hashUserId = $hash["userId"];
			$this->hashHash = $hash["hash"];
			$this->hashFechaAlta = $hash["fechaAlta"];

						
		}


		

	}
 ?>