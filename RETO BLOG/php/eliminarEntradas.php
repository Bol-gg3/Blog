<?php 
session_start();
include_once "conector.php";
$sentencia = $base_de_datos->query("SELECT * FROM entrada;");
$usuario = $sentencia->fetchAll(PDO::FETCH_OBJ);


if (isset($_SESSION['email'])) {
	$sentencia = $base_de_datos->prepare('SELECT id_entrada,fecha_entrada, entradas, id_usuario FROM entrada');
	$sentencia->execute();
	$resultado = $sentencia->fetch(PDO::FETCH_ASSOC);


	
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	include_once "conector.php";
	$id_entrada1 = $_POST['id_entrada1'];
	$id_entrada2 =$_POST['id_entrada2'];

	$errores = '';

	if (empty($id_entrada1) or empty($id_entrada2)) {
		$errores .= '<p>Por favor rellena todos los datos</p>';
	} else {
		
		include_once "conector.php";
		
		$sentencia = $base_de_datos->prepare('SELECT * FROM entrada WHERE id_entrada = :id_entrada');
		$sentencia->execute(array(':id_entrada' => $id_entrada1));
		$resultado = $sentencia->fetch();

		if ($resultado != true) {
			$errores .= '<li>No existe ninguna entrada con ese id</li>';
		}
		
		if ($id_entrada1 != $id_entrada2) {
			$errores .= '<p>Los id no son iguales</p>';
		}
	}
	if ($errores == '') {
	
	include_once "conector.php";

		$id_usuario1 = $_POST['id_usuario1'];
		$sentencia = $base_de_datos->prepare("DELETE FROM entrada WHERE id_entrada = ?;");
		$resultado = $sentencia->execute([$id_entrada1]);	


	if ($resultado === true) header("Location: EliminarEntradas.php");
	else echo "Algo salió mal al eliminar";
	
	}
} 
}

require 'views/eliminarEntradas.view.php';
?>