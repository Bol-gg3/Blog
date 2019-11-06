<?php 
session_start();
include_once "conector.php";
$sentencia = $base_de_datos->query("SELECT * FROM usuario;");
$usuario = $sentencia->fetchAll(PDO::FETCH_OBJ);

if (isset($_SESSION['email'])) {
	header('Location: index.php');
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$nombre = filter_var($_POST['nombre']);
	$email = filter_var(strtolower($_POST['email']), FILTER_SANITIZE_STRING);
	$password = $_POST['password'];
	$password2 = $_POST['password2'];

	$errores = '';

	if (empty($nombre) or empty($email) or empty($password) or empty($password2)) {
		$errores .= '<li>Por favor rellena todos los datos</li>';
	} else {
		include_once "conector.php";

		$sentencia = $base_de_datos->prepare('SELECT * FROM usuario WHERE email = :email');
		$sentencia->execute(array(':email' => $email));
		$resultado = $sentencia->fetch();

		if ($resultado != false) {
			$errores .= '<li>Ya existe un usuario con ese email</li>';
		}
		
		if ($password != $password2) {
			$errores .= '<li>Las contraseñas no son iguales</li>';
		}
	}
	if ($errores == '') {
		
			$tipo = "Usuario";
			
		$sentencia = $base_de_datos->prepare('INSERT INTO usuario (id_usuario, nombre, password,email,tipo) VALUES (null, :nombre, :password, :email, :tipo)');
		$resultado = $sentencia->execute(array(':nombre' => $nombre, ':password' => $password, ':email' => $email, ':tipo' => $tipo));
		header('Location: login.php');
	}
}
require 'views/registrate.view.php';
?>