<?php

  if (isset($_SESSION['email'])) {
    $sentencia = $base_de_datos->prepare('SELECT id_usuario,nombre, password, email,tipo    password FROM usuario WHERE email = :email');
    $sentencia->bindParam(':email', $_SESSION['email']);
    $sentencia->execute();
    $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);

    $email = null;

    if (count($resultado) > 0) {
      $email = $resultado;
    }
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>G3>Config</title>
</head>
<script>
	function modificarNombre() {
		window.location = "modifNombre.php";
	}

	function modificarEmail() {
		window.location = "modifEmail.php";
	}

	function modificarContraseña() {
		window.location = "modifPassword.php";
	}

	function salir() {
		window.location = "reto.php";
	}

	function cerrar() {
		window.location = "cerrar.php";
	}
</script>

<body>
	<div>
		<h1 class="titulo">Configuración cuenta</h1>
		<br><br>
		<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" class="formulario"
			name="formu">
			<div>
				<input type="text" name="id_usuario1" class="id_usuario1" placeholder="ID usaurio a eliminar">
			</div>
			<br>
			<div>
				<input type="text" name="id_usuario2" class="id_usuario2" placeholder="Confirmar ID">
			</div>
			<br>
			<div class="form-group">
				<button type="submit" id="borrarUser" onclick="formu.submit()">Eliminar cuenta</button>
			<!--Mensaje de error -->
			<?php if(!empty($errores)): ?>
			<div>
				<ul>
					<?php echo $errores; ?>
				</ul>
			</div>
			<?php endif; ?>
		</form>
		<br><br>
		<button type="button" onclick="salir()">Inicio</button>
		<input type="button" value="Cerrar Session" name="cerrarse" id="cerrarse" onclick="cerrar()">

	</div>
	</div>
</body>

</html>