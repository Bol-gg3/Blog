<?php
include_once "conector.php";
$sentencia = $base_de_datos->query("SELECT * FROM usuario;");
$usuario = $sentencia->fetchAll(PDO::FETCH_OBJ);
?>
<!--Recordemos que podemos intercambiar HTML y PHP como queramos-->
<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<title>Tabla Usuarios</title>
	<style>
		table,
		th,
		td {
			border: 1px solid black;
		}
	</style>
</head>
<body>
	<br><br>
	<form method="post" id="formulario" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		<label for="nombre">Nombre del usuario:</label>
		<input name="nombre" type="text" id="nombre" placeholder="Escribe el nombre...">
		<br><br>
		<label for="passwrd">Contraseña del usuario:</label>
		<input name="passwrd" type="password" id="passwrd" placeholder="Escribe la contraseña...">
		<input name="passwrd2" type="password" id="passwrd2" placeholder="Repite la contraseña...">
		<br><br>
		<label for="email">Email del usuario:</label>
		<input name="email" type="email" id="email" placeholder="Escribe el correo electonico...">
		<input name="email2" type="email" id="email2" placeholder="Repite el correo electonico...">
		<br><br>
		<label for="tipo">Tipo de usuario: Usuario</label>
		<br><br>
		<input type="submit" id="insertar" name="insertar" value="Registrar" onclick="comprobarClave()">
		<input type="reset" name="limpiar" value="Limpiar">
		<br /><br />
	</form>
	<?php
		#INSERTAR DATOS A LA TABLA EN MYSQL
		 #Salir si alguno de los datos no está presente
		 if(isset($_POST["insertar"])){
			if(!isset($_POST["nombre"])||
			!isset($_POST["passwrd"])|| !isset($_POST["email"]))  exit();
			#Si todo va bien, se ejecuta esta parte del código...
			//include_once "conector.php";
			$nombre = $_POST["nombre"];
			$passwrd = $_POST["passwrd"];
			$email = $_POST["email"];
			$tipo = "usuarios";
	
			$sentencia = $base_de_datos->prepare("INSERT INTO usuario VALUES (NULL,?,?,?,?);");
			$resultado = $sentencia->execute([$nombre, $passwrd, $email, $tipo]);
			if($resultado === TRUE) header("Location: hecho.php");
			else echo "Algo salió mal al insertar";
			}
		else{ echo "Registrar usuario.";
			
		}
		//else echo "Algo salió mal al pulsar. Por favor verifica que el id del usuario y el correo electronico no existan.";
    		?>
</body>

</html>