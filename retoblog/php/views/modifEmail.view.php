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
	<title>G3>Config>Email</title>
</head>
<script>
	function salir() {
		window.location = "reto.php";
	}

	function cerrar() {
		window.location = "cerrar.php";
	}
	function volver() {
		window.history.back();
	}
</script>

<body>
	<div>
		<h1 class="titulo">Modificar Email</h1>

		<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" class="formulario"
			name="login">
			<div class="form-group">
				<input type="text" name="email" class="email" placeholder="Email actual del suario">
			</div>
			<br>
			<div>
			<input type="text" name="email1" class="email1"  placeholder="Email nuevo">
			</div>
			<br>
			<div class="form-group">
			<input type="text" name="email2" class="email2"  placeholder="Confirmar email nuevo"><br><br>
				<button type="button" onclick="login.submit()">Modificar</button>
			</div>
			<br><br>
			<button type="button" onclick="salir()">Salir</button>
			<input type="button" value="Cerrar Session" name="cerrarse" id="cerrarse" onclick="cerrar()">
			<input type="button" value="Volver" name="volver" id="volver" onclick="volver()">

			<!--Mensaje de error -->
			<?php if(!empty($errores)): ?>
			<div>
				<ul>
					<?php echo $errores; ?>
				</ul>
			</div>
			
		</form>
		<input type="button" value="Volver" name="volver" id="volver" onclick="volver()">
		<?php endif; ?>
	</div>
</body>

</html>