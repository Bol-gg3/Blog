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
	$email2 = filter_var(strtolower($_POST['email2']), FILTER_SANITIZE_STRING);

	$errores = '';

	if (empty($email) or empty($email2)) {
		$errores .= '<li>Por favor rellena todos los datos</li>';
	} else {
		include_once "conector.php";

		$sentencia = $base_de_datos->prepare('SELECT * FROM usuario WHERE email = :email');
		$sentencia->execute(array(':email' => $email));
		$resultado = $sentencia->fetch();

		if ($resultado != false) {
			$errores .= '<li>El correo introducido ya existe</li>';
		}
		
		if ($email != $email2) {
			$errores .= '<li>Los email no son iguales</li>';
		}
	}
	if ($errores == '') {

		$email = filter_var(strtolower($email['email']), FILTER_SANITIZE_STRING);				
		$id_usuario = filter_var(strtolower($email['id_usuario']), FILTER_VALIDATE_INT);
		$sentencia = $base_de_datos->prepare("UPDATE usuario SET email = ? WHERE id_usuario = ?;");
		$resultado = $sentencia->execute([$id_usuario, $email]); 

		//$sentencia = $base_de_datos->prepare("UPDATE usuario SET email = ? WHERE email = ?;");
		//$resultado = $sentencia->execute($_SESSION['email']);
	
	if ($resultado === true)  header('Location: login.php');	
			else echo "Algo salió mal al Modificar el email";
		}
	}
}

require 'views/modifEmail.view.php';
?>