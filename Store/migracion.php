<?php

require_once("clases/JSONRepository.php");
require_once("clases/MySQLRepository.php");

$jsonRepo = new JSONRepository();
$mySQLRepo = new MySQLRepository();

$userJsonRepo = $jsonRepo->getUserRepository();
$userSQLRepo = $mySQLRepo->getUserRepository();

$usuariosJSON = $userJsonRepo->getAllUsers();
// var_dump($usuariosJSON);exit;

try {
	$mySQLRepo->startTransaction();
	foreach ($usuariosJSON as $usuarioJSON) {
		$userSQLRepo->guardarUsuario($usuarioJSON);
	}
 
    $mySQLRepo->commitTransaction();
} catch(PDOException $ex) {
    //Something went wrong rollback!
    $mySQLRepo->rollBack();
    echo $ex->getMessage();
}

?>