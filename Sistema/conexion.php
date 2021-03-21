<?php
	$host= 'localhost';
	$user= 'root';
	$pass='';
	$db='urbano1';
	
	$conection= @mysqli_connect($server,$user,$pass,$db);
	//	$conection -> set_charset("utf8");

	if (!$conection){
		echo "Error en la conexión";
		}
?>