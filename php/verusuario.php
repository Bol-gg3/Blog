<?php
include_once "conector.php";
$sentencia = $base_de_datos->query("SELECT * FROM usuario;");
$usuario = $sentencia->fetchAll(PDO::FETCH_OBJ);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
		table,
		th,
		td {
			border: 1px solid black;
		}
	</style>
    <title>Document</title>
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
				<td><?php echo $usuario->passwrd?></td>
				<td><?php echo $usuario->email?></td>
				<td><?php echo $usuario->tipo?></td>
			</tr>
			<?php } ?>
		</tbody>
	</table>

</body>
</html>