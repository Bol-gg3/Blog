<?php 
session_start();
include_once "conector.php";
$sentencia = $base_de_datos->query("SELECT * FROM comentario;");
$comentario = $sentencia->fetchAll(PDO::FETCH_OBJ);


if (isset($_SESSION['email'])) {
	$sentencia = $base_de_datos->prepare('SELECT id_comentario,fecha_comentario, comentarios, id_usuario FROM comentario');
	$sentencia->execute();
	$resultado = $sentencia->fetch(PDO::FETCH_ASSOC);


	
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	include_once "conector.php";
	$id_comentario1 = $_POST['id_comentario1'];
	$id_comentario2 = $_POST['id_comentario2'];

	$errores = '';

	if (empty($id_comentario1) or empty($id_comentario2)) {
		$errores .= '<p>Por favor rellena todos los datos</p>';
	} else {

		include_once "conector.php";
		
		$sentencia = $base_de_datos->prepare('SELECT * FROM comentario WHERE id_comentario = :id_comentario');
		$sentencia->execute(array(':id_comentario' => $id_comentario1));
		$resultado = $sentencia->fetch();

		if ($resultado != true) {
			$errores .= '<li>No existe ningun comentario con ese id</li>';
		}
		
		if ($id_comentario1 != $id_comentario2) {
			$errores .= '<p>Los id no son iguales</p>';
		}
	}
	if ($errores == '') {
	
	include_once "conector.php";

		$id_comentario1 = $_POST['id_comentario1'];
		$sentencia = $base_de_datos->prepare("DELETE FROM comentario WHERE id_comentario = ?;");
		$resultado = $sentencia->execute([$id_comentario1]);	


	if ($resultado === true) header("Location: EliminarComentarios.php");
	else echo "Algo salió mal al eliminar";
	
	}
} 
}

require 'views/eliminarComentarios.view.php';
?>