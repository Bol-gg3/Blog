<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>G3>Config>Contraseña</title>
</head>
<script>
	function salir() {
		window.location = "reto.php";
	}

	function cerrar() {
		window.location = "../cerrar.php";
	}
</script>

<body>
	<div>
		<h1 class="titulo">Modificar Contraseña</h1>

		<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" class="formulario"
			name="login">
			<div>
			<input type="password" name="password" class="password"  placeholder="Contraseña">
			</div>
			<br>
			<div class="form-group">
			<input type="password" name="password2" class="password2"  placeholder="Confirmar contraseña"><br><br>
				<button type="button" onclick="login.submit()">Modificar</button>
			</div>
			<br><br>
			<button type="button" onclick="salir()">Inicio</button>
			<input type="button" value="Cerrar Session" name="cerrarse" id="cerrarse" onclick="cerrar()">


			<!--Mensaje de error -->
			<?php if(!empty($errores)): ?>
			<div>
				<ul>
					<?php echo $errores; ?>
				</ul>
			</div>
			<?php endif; ?>
		</form>
	</div>
</body>

</html>