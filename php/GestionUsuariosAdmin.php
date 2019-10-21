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
	<br>
	<table>
		<thead>
			<tr>
				<th>ID Usuario</th>
				<th>Nombre</th>
				<th>Contraseña</th>
				<th>Email</th>
				<th>Tipo</th>
			</tr>
		</thead>
		<tbody>
			<!--
				Atención aquí, sólo esto cambiará
				Pd: no ignores las llaves de inicio y cierre {}
			-->
			<?php foreach($usuario as $usuario){ ?>
			<tr>
				<td><?php echo $usuario->id_usuario?></td>
				<td><?php echo $usuario->nombre?></td>
				<td>*********</td>
				<td><?php echo $usuario->email?></td>
				<td><?php echo $usuario->tipo?></td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
	<br>
	<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">



		<label for="id_usuario">ID Usuario:</label>
		<input name="id_usuario" required type="text" id="id_usuario" placeholder="Escribe el id del usuario..."
			required><br><br>
		<label for="nombre">Nombre del usuario:</label>
		<input name="nombre" type="text" id="nombre" placeholder="Escribe el nombre...">
		<br><br>
		<label for="passwrd">Contraseña del usuario:</label>
		<input name="passwrd" type="password" id="passwrd" placeholder="Escribe el contraseña...">
		<br><br>
		<label for="email">Email del usuario:</label>
		<input name="email" type="email" id="email" placeholder="Escribe el correo electonico...">
		<br><br>
		<label for="tipo">Tipo de usuario:</label>
		<br>
		<select name="tipo" type="text">
			<option value="usuarios" selected>Usuarios</option>
			<option value="usuarios_verificado">Usuarios Verificado</option>
			<option value="administrador">Administrador</option>
		</select>
		<br><br>
		<input type="submit" id="insertar" value="insertar" name="insertar" value="Registrar">
		<input type="submit" id="eliminar" name="eliminar" value="Eliminar">
		<input type="submit" id="modificar" name="modificar" value="Modificar">
		<input type="reset" name="limpiar" value="Limpiar">
		<br>
	</form>
	<?php
		#INSERTAR DATOS A LA TABLA EN MYSQL
		 #Salir si alguno de los datos no está presente
		if(isset($_POST["insertar"]));
		if(!isset($_POST["id_usuario"]) ||!isset($_POST["nombre"])||
		!isset($_POST["passwrd"])|| !isset($_POST["email"])|| !isset($_POST["tipo"]))  exit();
        #Si todo va bien, se ejecuta esta parte del código...
        include_once "conector.php";
        $id_usuario = $_POST["id_usuario"];
        $nombre = $_POST["nombre"];
        $passwrd = $_POST["passwrd"];
        $email = $_POST["email"];
        $tipo = $_POST["tipo"];

        $sentencia = $base_de_datos->prepare("INSERT INTO usuario(id_usuario, nombre, passwrd, email, tipo) VALUES (?,?,?,?,?);");
        $resultado = $sentencia->execute([$id_usuario, $nombre, $passwrd, $email, $tipo]);
		if($resultado === TRUE) header("Location: GestionUsuariosAdmin.php");

		#ELEMINAR DATOS A LA TABLA EN MYSQL
		elseif(isset($_POST["eliminar"])){
		if(!isset($_POST["id_usuario"])){
			exit();
		}
		$id_usuario = $_POST["id_usuario"];
		$sentencia = $base_de_datos->prepare("DELETE FROM usuario WHERE id_usuario = ?;");
		$resultado = $sentencia->execute([$id_usuario]);
		if ($resultado === true) header("Location: GestionUsuariosAdmin.php");
		else echo "Algo salió mal al eliminar";
		}



		#MODIFICAR DATOS A LA TABLA EN MYSQL
		elseif(isset($_POST["modificar"])){
			if (
				!isset($_POST["id_usuario"]) ||
				!isset($_POST["nombre"]) ||
				!isset($_POST["passwrd"]) ||
				!isset($_POST["email"])||
				!isset($_POST["tipo"])
			) {
				exit();
			}
			#Si todo va bien, se ejecuta esta parte del código...
			$id_usuario = $_POST["id_usuario"];
			$nombre = $_POST["nombre"];
			$passwrd = $_POST["passwrd"];
			$email = $_POST["email"];
			$tipo = $_POST["tipo"];
			$sentencia = $base_de_datos->prepare("UPDATE usuario SET nombre = ?, passwrd = ?, email = ?, tipo = ? WHERE id_usuario = ?;");
			$resultado = $sentencia->execute([$nombre, $passwrd, $email, $tipo, $id_usuario]); # Pasar en el mismo orden de los ?
			if ($resultado === true)  header("Location: GestionUsuariosAdmin.php");
			else echo "Algo salió mal al eliminar";
		}
		else echo "Algo salió mal. Por favor verifica que el id del usuario y el correo electronico no existan.";
		//else echo "Algo salió mal al pulsar. Por favor verifica que el id del usuario y el correo electronico no existan.";
    ?>
</body>

</html>
