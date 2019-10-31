<?php 
session_start();
include_once "conector.php";
$sentencia = $base_de_datos->query("SELECT * FROM entrada;");
$usuario = $sentencia->fetchAll(PDO::FETCH_OBJ);


if (isset($_SESSION['email'])) {
	$sentencia = $base_de_datos->prepare('SELECT id_entrada,fecha_entrada, entradas, id_usuario FROM entrada');
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
		
		
		if ($id_usuario1 != $id_usuario2) {
			$errores .= '<li>Los id no son iguales</li>';
		}
	}
	if ($errores == '') {
	
	include_once "conector.php";

		$id_usuario1 = $_POST['id_usuario1'];
		$sentencia = $base_de_datos->prepare("DELETE FROM usuario WHERE id_usuario = ?;");
		$resultado = $sentencia->execute([$id_usuario1]);	


	if ($resultado === true) header("Location: GestionUsuariosAdmin.php");
	else echo "Algo salió mal al eliminar";
	
	}
} 
}

require 'views/eliminarEntradas.view.php';
?>