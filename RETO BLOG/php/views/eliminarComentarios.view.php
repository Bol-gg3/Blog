<?php
include_once "conector.php";
$sentencia = $base_de_datos->query("SELECT * FROM comentario;");
$comentario = $sentencia->fetchAll(PDO::FETCH_OBJ);
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>G3>Config</title>
	<style>
		table,
		th,
		td {
			border: 2px solid black;
		}
	</style>
</head>
<script>

	function salir() {
		window.location = "reto.php";
	}

	function cerrar() {
		window.location = "cerrar.php";
	}
</script>
<body>
<center>
	<div>
		<h1 class="titulo">Administración de Comentario</h1>
		<br>
		<button type="button" onclick="salir()">Inicio</button>
		<input type="button" value="Cerrar Session" name="cerrarse" id="cerrarse" onclick="cerrar()">
		<br><br><br><br>
		<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" class="formulario"
			name="formu">
			<div>
				<input type="text" name="id_comentario1" class="id_comentario1" placeholder="ID comentario a eliminar">
			</div>
			<br>
			<div>
				<input type="text" name="id_comentario2" class="id_comentario2" placeholder="Confirmar ID">
			</div>
			<br>
			<div class="form-group">
				<button type="submit" id="borrarEntrada" onclick="formu.submit()">Eliminar entrada</button>
			<!--Mensaje de error -->
			<?php if(!empty($errores)): ?>
			<div>
				<ul>
					<?php echo $errores; ?>
				</ul>
			</div>
			<?php endif; ?>
		</form>
		<br><br>
		
		<table>
			<thead>
				<tr>
					<th>ID Comentario</th>
					<th>Fecha</th>
					<th>Comentario</th>
					<th>ID Usuario</th>
				</tr>
			</thead>
			<tbody>
				<!--
				Atención aquí, sólo esto cambiará
				Pd: no ignores las llaves de inicio y cierre {}
			-->
				<?php foreach($comentario as $comentario){ ?>
				<tr>
					<td><?php echo $comentario->id_comentario?></td>
					<td><?php echo $comentario->fecha_comentario?></td>
					<td><?php echo $comentario->comentarios?></td>
					<td><?php echo $comentario->id_usuario?></td>
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