<?php 
session_start();
include_once "conector.php";
$sentencia = $base_de_datos->query("SELECT * FROM usuario;");
$usuario = $sentencia->fetchAll(PDO::FETCH_OBJ);

if (isset($_SESSION['email'])) {
	header('Location: index.php');
}
$errores = '';

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$email = filter_var(strtolower($_POST['email']), FILTER_SANITIZE_STRING);
	$password = $_POST['password'];

	include_once "conector.php";

	$sentencia = $base_de_datos->prepare('SELECT * FROM usuario WHERE email = :email AND password = :password');
	$resultado = $sentencia->execute(array(':email' => $email, ':password' => $password));

	$resultado = $sentencia->fetch();
	if ($resultado !== false) {
		$_SESSION['email'] = $email;
		echo "<script>alert(window.opener.location.href)

		window.opener.location.reload(true);
		self.close();
		return true;</script>";
		header('Location: index.php');
	} else {
		$errores .= '<li>Datos Incorrectos</li>';
	}
}


require 'views/login.view.php';

?>