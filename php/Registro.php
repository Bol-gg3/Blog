
<!--Recordemos que podemos intercambiar HTML y PHP como queramos-->
<!DOCTYPE html>
<html lang="es">
<script type="text/javascript">
        function closeSelf() {
            self.close();
            return true;
        }
    </script>
<head>
	<meta charset="UTF-8">
	<title>Tabla Usuarios</title>
	
</head>

<body>
	
	<br>
	<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" >

		<label for="id_usuario">ID Usuario:</label>
		<br>
		<input name="id_usuario" required type="text" id="id_usuario" placeholder="Escribe el id del usuario..."
			required>
		<br><br>
		<label for="nombre">Nombre del usuario:</label>
		<br>
		<input name="nombre" type="text" id="nombre" placeholder="Escribe el nombre..." required>
		<br><br>
		<label for="passwrd">Contraseña del usuario:</label>
		<br>
		<input name="passwrd" type="password" id="passwrd" placeholder="Escribe el contraseña...">
		<br><br>
		<label for="email">Email del usuario:</label>
		<br>
		<input name="email" type="email" id="email" placeholder="Escribe el correo electonico..." required>
		<br><br>
		<input name="email" type="email" id="email" placeholder="Repite el correo electro..." required>
		<br><br>
		<label for="tipo">Tipo de usuario: Usuario</label>
		<br><br>
		<input type="submit" name="insertar" value="Registrar"  onClick="closeSelf()">
		<input type="submit" name="cancelar" value="Cancelar"  onClick="closeSelf()">
	</form>
	<?php
		
        #Salir si alguno de los datos no está presente
		if(isset($_POST['submit']));
		if(!isset($_POST["id_usuario"]) ||!isset($_POST["nombre"])|| 
		!isset($_POST["passwrd"])|| !isset($_POST["email"])|| !isset($_POST["tipo"]))  exit();
        #Si todo va bien, se ejecuta esta parte del código...
        include_once "conector.php";
        $id_usuario = $_POST["id_usuario"];
        $nombre = $_POST["nombre"];
        $passwrd = $_POST["passwrd"];
        $email = $_POST["email"];
        $tipo = "usuarios";
     
        $sentencia = $base_de_datos->prepare("INSERT INTO usuario(id_usuario, nombre, passwrd, email, tipo) VALUES (?,?,?,?,?);");
        $resultado = $sentencia->execute([$id_usuario, $nombre, $passwrd, $email, $tipo]);
        if($resultado === TRUE) header("Location: reto.php");
		else echo "Algo salió mal. Por favor verifica que el id del usuario y el correo electronico no existan.";
		//else echo "Algo salió mal al pulsar. Por favor verifica que el id del usuario y el correo electronico no existan.";
    ?>
</body>

</html>