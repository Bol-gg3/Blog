<?php session_start();
if (isset($_SESSION['email'])) {
	header('Location: contenido.php');
} else {
	header('Location: registrate.php');
}
?>