<?php
	$servidor="127.0.0.1";
	$usuario="root";
	$clave="";
	$baseDeDatos="proyecto";

	try {

		$conexion = new PDO("mysql:host=$servidor;dbname=$baseDeDatos",$usuario,$clave);
		if($conexion){
			
		}

	}catch (Exception $ex){

		echo $ex->getMessage();

	}
?>	