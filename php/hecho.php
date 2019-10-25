<?php
include_once "conector.php";
$sentencia = $base_de_datos->query("SELECT * FROM usuario;");
$usuario = $sentencia->fetchAll(PDO::FETCH_OBJ);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<script type="text/javascript">
    function closeSelf() {
        self.close();
        return true;
    }
</script>

<body>  
  <center>
    <form action="reto.php" method="POST">
        <br>
        <h3>USUARIO CREADO</h3>
        <input type="submit" id="aceptar" name="aceptar" value="aceptar" onClick="closeSelf()">
    </form>
  </center>
</body>

</html>