<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>Iniciar Sesion</title>
</head>
<script language="JavaScript" type="text/javascript">

	function closeSelf() {
		alert(window.opener.location.href)

		window.opener.location.reload(true);
		self.close();
		return true;
		
	}

	function validacion(){	
		return true;
		var valor = document.getElementById("email").value;
		if( !(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3,4})+$/.test(valor)) ){
			alert("vvfv");
			return false;
		}
	}

</script>
<script>

window.onunload = function(){
  window.opener.location.reload();
  }
</script>
<body>
	<div>
		<h1 class="titulo">Iniciar Sesion</h1>

		<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" class="formulario"
			name="formu" >
			<div>
				<input type="email" name="email" id="email" class="email" placeholder="Email">
			</div>
			<br>
			<div>
				<input type="password" name="password" class="password_btn" placeholder="Contraseña">
				<br><br>
				<input type="submit" id="iniciar" value="Iniciar Sesión" >
				<input type="button" id="cancelar" name="cancelar" value="Cancelar" onClick="closeSelf()">
				<input type="reset" name="limpiar" value="Limpiar">	
						
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