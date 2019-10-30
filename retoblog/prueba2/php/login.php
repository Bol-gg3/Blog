<?php

  session_start();

  if (isset($_SESSION['user_id'])) {
    header('Location: /php-login');
  }
  require 'conector.php';
  if (!empty($_POST['email']) && !empty($_POST['passwrd'])) {
    $sentencia = $base_de_datos->prepare('SELECT id_usuario,email, passwrd FROM usuarios WHERE email = :email');
    $sentencia->bindParam(':email', $_POST['email']);
    $sentencia->execute();
    $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);

    $mensage = '';

    if (($resultado) > 0 && password_verify($_POST['passwrd'], $resultado['passwrd'])) {
      $_SESSION['user_id'] = $resultado['id_usuario'];
      header("Location: /php-login");
    } else {
      $mensage = 'Lo siento, Los datos introducidos';
    }
  }

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
    <?php require 'header.php' ?>

    <?php if(!empty($mensage)): ?>
    <p> <?= $mensage ?></p>
    <?php endif; ?>

    <h1>Login</h1>
    <span>o <a href="Registro.php">Crear Usuario</a></span>

    <form action="login.php" method="POST">
        <br>
        <label for="email">Email del usuario:</label>
        <input name="email" type="text" placeholder="introduce tu email">
        <br><br>
        <label for="email">Contraseña del usuario:</label>
        <input name="passwrd" type="password" placeholder="introduce tu password">
        <br><br>
        <input type="submit" id="iniciar" name="iniciar" value="Iniciar">
        <input type="submit" id="cancelar" name="cancelar" value="Cancelar" onClick="closeSelf()">
        <input type="reset" name="limpiar" value="Limpiar">
    </form>
</body>

</html>