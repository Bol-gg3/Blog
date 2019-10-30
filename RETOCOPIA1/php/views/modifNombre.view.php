<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>G3>Config>Nombre</title>
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
		<h1 class="titulo">Modificar Nombre</h1>

		<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" class="formulario"
			name="login">
			<div>
			<input type="text" name="nombre" class="nombre"  placeholder="El nuevo nombre">
			</div>
			<br>
			<div class="form-group">
			<input type="text" name="nombre2" class="nombre2"  placeholder="Confirmar nuevo nombre"><br><br>
				<button type="button" onclick="login.submit()">Modificar</button>
			</div>
			<br><br>
			<button type="button" onclick="salir()">Salir</button>
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