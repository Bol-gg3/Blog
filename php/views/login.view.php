<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>Iniciar Sesion</title>
</head>
<script type="text/javascript">
	function closeSelf() {
		self.close();
		return true;
	}
</script>

<body>
	<div>
		<h1 class="titulo">Iniciar Sesion</h1>

		<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" class="formulario"
			name="login">
			<div>
				<input type="text" name="email" class="email" placeholder="Email">
			</div>
			<br>
			<div>
				<input type="password" name="password" class="password_btn" placeholder="Contraseña">
				<br><br>
				<input type="submit" id="cancelar" name="cancelar" value="Cancelar" onClick="closeSelf()">
				<input type="reset" name="limpiar" value="Limpiar">
				<button type="button" onclick="login.submit() or ">Iniciar Sesion</button>
			</div>

			<!--Mensaje de error -->
			<?php if(!empty($errores)): ?>
			<div>
				<ul>
					<?php echo $errores; ?>
				</ul>
			</div>
			<?php endif; ?>

		</form>

		<p>
			¿Aun no tienes cuenta? <br>
			<a href="registrate.php">Registrate</a>
		</p>
	</div>
</body>

</html>