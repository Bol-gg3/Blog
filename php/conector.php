<!--Conectar a la base de datos-->
<?php
$contraseña = "2dw3123";
$usuario = "grupo3";
$nombre_base_de_datos = "grupo3bd";
$server = 'localhost:3306';
try{
    $base_de_datos = new PDO("mysql:host=$server;dbname=$nombre_base_de_datos;", $usuario, $contraseña);
    echo "Estas en Linea";
}catch(Exception $e){
	echo "Ocurrió algo con la base de datos: " . $e->getMessage();
}
?>