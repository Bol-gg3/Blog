<?php 
session_start();
include_once "conector.php";
$sentencia = $base_de_datos->query("SELECT * FROM usuario;");
$usuario = $sentencia->fetchAll(PDO::FETCH_OBJ);
if (isset($_SESSION['email'])) {
	$sentencia = $base_de_datos->prepare('SELECT id_usuario,nombre, password, email,tipo    password FROM usuario WHERE email = :email');
	$sentencia->bindParam(':email', $_SESSION['email']);
	$sentencia->execute();
	$resultado = $sentencia->fetch(PDO::FETCH_ASSOC);

	$email = null;

	if (count($resultado) > 0) {
	  $email = $resultado;
	}
 


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$email = filter_var(strtolower($_POST['email']), FILTER_SANITIZE_STRING);
	
	$errores = '';

	if ($errores == '') {
	
	include_once "conector.php";

	$sentencia = $base_de_datos->prepare('DELETE FROM usuario WHERE email = :email');
	$resultado = $sentencia->execute($email['email']);
	if ($resultado === true) header("Location: cerrar.php");
	else echo "Algo salió mal al eliminar";
	}
} 
}
require 'views/configCuenta.view.php';
?>