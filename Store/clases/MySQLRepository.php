<?php

require_once("Repository.php");
require_once("UserMySQLRepository.php");
require_once("ProductMySQLRepository.php");

class MySQLRepository extends Repository {
	
	private $userRepository;
	private $productRepository;
	private $connection;

	public function getUserRepository(){
		if ($this->userRepository == null)
		{
			$this->userRepository = new UserMySQLRepository($this->connection);
		}

		return $this->userRepository;
	}
	public function getProductRepository(){
		if ($this->productRepository == null)
		{
			$this->productRepository = new ProductMySQLRepository($this->connection);
		}
		
		return $this->productRepository;
	}
	public function __construct() {
		$this->connection = new PDO('mysql:host=localhost;dbname=ecommerce', "root", "alfabeta");
	}
	public function startTransaction(){
		$this->connection->beginTransaction();
	}
	public function commitTransaction(){
		$this->connection->commit();
	}
	public function rollBack() {
		$this->connection->rollBack();
	}

}