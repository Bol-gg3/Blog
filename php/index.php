<?php session_start();
if (isset($_SESSION['email'])) {
	header('Location: hecho.php');
} else {
	header('Location: registrate.php');
}
?>