<?php session_start();
if (isset($_SESSION['email'])) {
	header('Location: reto.php');
} else {
	header('Location: registrate.php');
}
?>