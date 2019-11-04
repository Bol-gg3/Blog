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
	$id_usuario1 = $_POST['id_usuario1'];
	$id_usuario2 =$_POST['id_usuario2'];

	$errores = '';

	if (empty($id_usuario1) or empty($id_usuario2)) {
		$errores .= '<li>Por favor rellena todos los datos</li>';
	} else {
		include_once "conector.php";
		
		$sentencia = $base_de_datos->prepare('SELECT * FROM usuario WHERE id_usuario = :id_usuario');
		$sentencia->execute(array(':id_usuario' => $id_usuario1));
		$resultado = $sentencia->fetch();

		if ($resultado != true) {
			$errores .= '<li>No existe ninguna cuenta con ese id</li>';
		}
			
		if ($id_usuario1 != $id_usuario2) {
			$errores .= '<li>Los id no son iguales</li>';
		}
	}
	if ($errores == '') {
	
	include_once "conector.php";

		$id_usuario1 = $_POST['id_usuario1'];	
		$tipo = $_POST['tipo'];	
		$id_Admin= "SuperAdmin";		
		$sentencia = $base_de_datos->prepare("UPDATE usuario SET tipo = ? WHERE id_usuario = ? AND tipo != ?;");
		$resultado = $sentencia->execute([$tipo,$id_usuario1,$id_Admin]);


	if ($resultado === true) header("Location: GestionUsuariosAdmin.php");
	else echo "Algo salió mal al eliminar";
	
	}
} 
}

require 'views/cambiarTipoCuentas.view.php';
?>