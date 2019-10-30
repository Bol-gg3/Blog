<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Registrate</title>
</head>
<script type="text/javascript">
	function closeSelf() {
		opener.location.reload();
		self.close();
		return true;
	}
</script>
<body>
	<div><p>
			<a href="reto.php">Iniciar Secion como Invitado sin registrarse</a>
		</p>
		<h1 class="titulo">Registrate</h1>

		<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" class="formulario" name="login">
			<div class="form-group">
				<input type="text" name="nombre" class="nombre" placeholder="Nombre usuario">
			</div>
			<div class="form-group">
				<input type="email" name="email" class="email" placeholder="Email del suario">
			</div>
			<div>
				<input type="password" name="password" class="password" placeholder="Contraseña">
			</div>

			<div class="form-group">
				<input type="password" name="password2" class="password_btn" placeholder="Confirmar Contraseña"><br><br>
				<button type="button" onclick="login.submit()">Registrate</button>
				<input type="submit" id="cancelar" name="cancelar" value="Cancelar" onClick="closeSelf()">
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
			¿Ya tienes cuenta? <br>
			<a href="login.php">Iniciar Sesión</a>
		</p>
	</div>
</body>
</html>