<?php 
session_start();
include_once "conector.php";
$sentencia = $base_de_datos->query("SELECT * FROM usuario;");
$usuario = $sentencia->fetchAll(PDO::FETCH_OBJ);


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$email1 = filter_var(strtolower($_POST['email1']), FILTER_SANITIZE_STRING);
	$email2 = filter_var(strtolower($_POST['email2']), FILTER_SANITIZE_STRING);

	$errores = '';

	if (empty($email1) or empty($email2)) {
		$errores .= '<li>Por favor rellena todos los datos</li>';
	} else {
		include_once "conector.php";

		$sentencia = $base_de_datos->prepare('SELECT * FROM usuario WHERE email = :email');
		$sentencia->execute(array(':email' => $email1));
		$resultado = $sentencia->fetch();

		if ($resultado != false) {
			$errores .= '<li>El correo introducido ya existe</li>';
		}
		
		if ($email1 != $email2) {
			$errores .= '<li>Los email no son iguales</li>';
		}
	}
	if ($errores == '') {
	
		$sentencia = $base_de_datos->prepare('UPDATE usuario SET email=:email VALUES  WHERE email = :email');
		$resultado = $sentencia->execute(array(':email' => $email1));
		
		


		//$sentencia = $base_de_datos->prepare("UPDATE usuario SET email = ? WHERE email = ?;");
		//$resultado = $sentencia->execute($_SESSION['email']);
	
	if ($resultado === true)  header('Location: login.php');	
			else echo "Algo salió mal al Modificar";
	}
}

require 'views/modifEmail.view.php';
?>