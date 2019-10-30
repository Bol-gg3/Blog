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
	<title>Admin cuentas</title>
	<style>
		table,
		th,
		td {
			border: 2px solid black;
		}
	</style>
</head>
<script>

	function modificarTipoUsuario() {
		window.location = "modifEmail.php";
	}

	function eliminarCuentas() {
		window.location = "eliminarCuentas.php";
	}

	function salir() {
		window.location = "reto.php";
	}

	function cerrar() {
		window.location = "cerrar.php";
	}
</script>

<body><center>
	<div>
		<h1 class="titulo">Administración de cuentas</h1>
		<br>
		<button type="button" onclick="salir()">Inicio</button>
		<input type="button" value="Cerrar Session" name="cerrarse" id="cerrarse" onclick="cerrar()">
		<br><br>
		<button type="button" onclick="modificarTipoUsuario()">Modificar tipo de usuario</button>
		<button type="button" onclick="eliminarCuentas()">Eliminar usuario</button>
		<br><br>
		
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
		<br>
	</div>
	</div>
	</center>
</body>

</html>