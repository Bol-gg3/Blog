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
	$email1 = $_POST['email1'];
	$email2 =$_POST['email2'];
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
		
		$email = filter_var(strtolower($email['email']), FILTER_SANITIZE_STRING);
		$sentencia = $base_de_datos->prepare("UPDATE usuario SET email = ? WHERE email = ?;");
		$resultado = $sentencia->execute([$email2, $email]); 

		//$sentencia = $base_de_datos->prepare("UPDATE usuario SET email = ? WHERE email = ?;");
		//$resultado = $sentencia->execute($_SESSION['email']);
	
	if ($resultado === true)  header('Location: cerrar.php');	
			else echo "Algo salió mal al Modificar el email";
		}
	}
}


require 'views/modifEmail.view.php';
?>