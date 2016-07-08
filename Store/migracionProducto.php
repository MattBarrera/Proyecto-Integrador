<?php

require_once("clases/JSONRepository.php");
require_once("clases/MySQLRepository.php");

$jsonRepo = new JSONRepository();
$mySQLRepo = new MySQLRepository();

$productJsonRepo = $jsonRepo->getProductRepository();
$productSQLRepo = $mySQLRepo->getProductRepository();

$productosJSON = $productJsonRepo->getAllProducts();
// var_dump($productosJSON);exit;

try {
	$mySQLRepo->startTransaction();
	foreach ($productosJSON as $productJSON) {
		$productSQLRepo->guardarProducto($productJSON);
	}
 
    $mySQLRepo->commitTransaction();
} catch(PDOException $ex) {
    //Something went wrong rollback!
    $mySQLRepo->rollBack();
    echo $ex->getMessage();
}

?>