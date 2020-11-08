<?php
$servername = "localhost:3306";
$username = "root";
$password = "";

try {
    	$conn = new PDO("mysql:host=$servername;dbname=votacion_adp", $username, $password);
    // set the PDO error mode to exception
    	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    	//echo "Conexión exitosa";
    }
catch(PDOException $e)
    {
    	echo "Conexión fallida: " . $e->getMessage();
    }
?>