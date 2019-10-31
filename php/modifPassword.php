<?php 
session_start();
include_once "conector.php";
$sentencia = $base_de_datos->query("SELECT * FROM usuario;");
$usuario = $sentencia->fetchAll(PDO::FETCH_OBJ);

if (isset($_SESSION['email'])) {
	$sentencia = $base_de_datos->prepare('SELECT id_usuario,nombre, email,tipo,password    password FROM usuario WHERE email = :email');
	$sentencia->bindParam(':email', $_SESSION['email']);
	$sentencia->execute();
	$resultado = $sentencia->fetch(PDO::FETCH_ASSOC);

	$email = null;

	if (count($resultado) > 0) {
	  $email = $resultado;
	}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	include_once "conector.php";
	$password4 = filter_var(strtolower($email['password']), FILTER_SANITIZE_STRING);
	$password = filter_var($_POST['password']);
	$password2 = filter_var($_POST['password2']);
	$password3 = filter_var($_POST['password3']);

	$errores = '';

	if (empty($password) or empty($password2)) {
		$errores .= '<li>Por favor rellena todos los datos</li>';
	} else {

		if ($password3 != $password4) {
			$errores .= '<li>La contraseña antigua no es correcta</li>';
		}
		
		if ($password != $password2) {
			$errores .= '<li>La contraseña nueva y de confrimación no son iguales</li>';
		}
	}
	if ($errores == '') {
		$email = filter_var(strtolower($email['email']), FILTER_SANITIZE_STRING);				
		$sentencia = $base_de_datos->prepare("UPDATE usuario SET password = ? WHERE email = ?;");
		$resultado = $sentencia->execute([$password,$email]); 
		
		
		
		//$sentencia = $base_de_datos->prepare("UPDATE usuario SET email = ? WHERE email = ?;");
		//$resultado = $sentencia->execute($_SESSION['email']);
	
	if ($resultado === true)  header('Location: cerrar.php');	
			else echo "Algo salió mal al Modificar la contraseña";
	}
	}
}

require 'views/modifPassword.view.php';
?>