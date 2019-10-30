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
		<br> Identificador: <?= $email['id_usuario']; ?>
		<br> Nombre: <?= $email['nombre']; ?>
		<br> Email: <?= $email['email']; ?>
		<br> Tipo de usuario: <?= $email['password']; ?>
		<br><br>
		<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" class="formulario"
			name="login">
		<div class="form-group">
			<button type="button" id="borrarUser" onclick="login.submit()">Eliminar cuenta</button>
		</form>
			<button type="button" onclick="modificarNombre()">Modificar nombre</button>
			<button type="button" onclick="modificarEmail()">Modificar email</button>
			<button type="button" onclick="modificarContraseña()">Modificar contraseña</button>
			<br><br>
			<button type="button" onclick="salir()">Inicio</button>
			<input type="button" value="Cerrar Session" name="cerrarse" id="cerrarse" onclick="cerrar()">

		</div>
	</div>
</body>

</html>