<?php

	$server = 'localhost';
	$usuario = 'root';
	$contrasena = '';
	$database = 'base_de_datos';

	try {
  		$conn = new PDO("mysql:host=$server;dbname=$database;", $usuario, $contrasena);
	} catch (PDOException $e) {
  		die('Error en conexion: ' . $e->getMessage());
	}

?>
