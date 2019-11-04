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
	include_once "conector.php";
	$nombre = $_POST['nombre'];

	$errores = '';

	if (empty($nombre)) {
		$errores .= '<li>Por favor rellena el campo nombre</li>';
	} 
	if ($errores == '') {
		$email = filter_var(strtolower($email['email']), FILTER_SANITIZE_STRING);				
		$sentencia = $base_de_datos->prepare("UPDATE usuario SET nombre = ? WHERE email = ?;");
		$resultado = $sentencia->execute([$nombre,$email]); 
		
		
		
		//$sentencia = $base_de_datos->prepare("UPDATE usuario SET email = ? WHERE email = ?;");
		//$resultado = $sentencia->execute($_SESSION['email']);
	
	if ($resultado === true)  header('Location: login.php');	
			else echo "Algo salió mal al modificar el nombre";
	}
	}
}
require 'views/modifNombre.view.php';
?>