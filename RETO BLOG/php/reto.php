<?php
session_start();
include_once "conector.php";
$sentencia = $base_de_datos->query("SELECT * FROM usuario;");
$usuario = $sentencia->fetchAll(PDO::FETCH_OBJ);

if (isset($_SESSION['email'])) {
	$sentencia = $base_de_datos->prepare('SELECT id_usuario,nombre, password, email,tipo FROM usuario WHERE email = :email');
	$sentencia->bindParam(':email', $_SESSION['email']);
	$sentencia->execute();
	$resultado = $sentencia->fetch(PDO::FETCH_ASSOC);

	$email = null;

	if (count($resultado) > 0) {
	  $email = $resultado;
	}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	  
    if(isset($_POST["Comentar"])){
        if(!isset($_POST["comentario"]))  exit();
	    $comentario = filter_var($_POST['comentario']);
        $id_usuario =$email['id_usuario'];     
        /*
		$sentencia = $base_de_datos->prepare('INSERT INTO comentario (id_comentario, fecha_comentario, comentarios, id_usuario) VALUES (null, null, :fecha_comentario, :id_usuario)');
        $resultado = $sentencia->execute(array(':comentarios' => $comentario, ':id_usuario' => $id));*/
        $sentencia = $base_de_datos->prepare("INSERT INTO comentario VALUES (NULL,NUll,?,?);");
        $resultado = $sentencia->execute([$comentario, $id_usuario]);
        header('Location: reto.php');
        
     }
        elseif(isset($_POST["insertar"])){
        if(!isset($_POST["entrada"]))  exit();

         $entrada = filter_var($_POST['entrada']);
             
           $id_usuario =$email['id_usuario']; 
           /*
           $sentencia = $base_de_datos->prepare('INSERT INTO comentario (id_comentario, fecha_comentario, comentarios, id_usuario) VALUES (null, null, :fecha_comentario, :id_usuario)');
           $resultado = $sentencia->execute(array(':comentarios' => $comentario, ':id_usuario' => $id));*/
           $sentencia = $base_de_datos->prepare("INSERT INTO entrada VALUES (NULL,NUll,?,?);");
           $resultado = $sentencia->execute([$entrada, $id_usuario]);
           header('Location: reto.php');
           
     
        }

     #ELIMINAR MIS COMENTARIOS UNO A UNO EN LA TABLA EN MYSQL
		elseif(isset($_POST["EliminarComentarios"])){
            $id_usuario =$email['id_usuario']; 
            $sentencia = $base_de_datos->prepare("DELETE FROM comentario WHERE id_usuario = ? order by id_comentario desc limit 1;");
            $resultado = $sentencia->execute([$id_usuario]);
            header('Location: reto.php');
        }elseif(isset($_POST["EliminarEntradas"])){
                $id_usuario =$email['id_usuario']; 
                $sentencia = $base_de_datos->prepare("DELETE FROM entrada WHERE id_usuario = ? order by id_entrada desc limit 1;");
                $resultado = $sentencia->execute([$id_usuario]);
                header('Location: reto.php');
                }
    }
}
require 'views/reto.view.php';
?>