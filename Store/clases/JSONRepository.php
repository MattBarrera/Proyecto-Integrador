<?php

require_once("Repository.php");
require_once("UserJSONRepository.php");
require_once("ProductJSONRepository.php");

class JSONRepository extends Repository {
	
	private $userRepository;
	private $productRepository;

	public function getUserRepository()
	{
		if ($this->userRepository == null)
		{
			$this->userRepository = new UserJSONRepository();
		}

		return $this->userRepository;
	}
	public function getProductRepository()
	{
		if ($this->productRepository == null)
		{
			$this->productRepository = new ProductJSONRepository();
		}

		return $this->productRepository;
	}
}