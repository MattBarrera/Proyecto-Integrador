<?php 

	require_once("clases/Auth.php");
	require_once("clases/Validar.php");
	require_once("clases/JSONRepository.php");
	require_once("clases/Usuario.php");
	require_once("clases/Redirect.php");
	require_once("clases/Hash.php");

	$tipoRepositorio = "json";
	$repositorio = null;

	if ($tipoRepositorio == "json")
	{
		$repositorio = new JSONRepository();
	}
	

	$auth = Auth::getInstance($repositorio->getUserRepository());
	$validar = Validar::getInstance($repositorio->getUserRepository());
	$redirect = new Redirect();



 ?>