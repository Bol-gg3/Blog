<?php

  session_start();

  if (isset($_SESSION['user_id'])) {
    header('Location: /php-login');
  }
  require 'conector.php';

  if (!empty($_POST['email']) && !empty($_POST['passwrd'])) {
    $sentencia = $conn->prepare('SELECT id_usuario, email, passwrd FROM usuarios WHERE email = :email');
    $sentencia->bindParam(':email', $_POST['email']);
    $sentencia->execute();
    $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);

    $message = '';

    if (count($resultado) > 0 && password_verify($_POST['passwrd'], $resultado['passwrd'])) {
      $_SESSION['user_id'] = $resultado['id'];
      header("Location: /php-login");
    } else {
      $message = 'Lo siento, Los datos introducidos';
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

    <?php if(!empty($message)): ?>
      <p> <?= $message ?></p>
    <?php endif; ?>

    <h1>Login</h1>
    <span>or <a href="Registro.php">Crear Usuario</a></span>

    <form action="login.php" method="POST">
      <input name="email" type="text" placeholder="introduce tu email">
      <input name="passwrd" type="password" placeholder="introduce tu password">
      <input type="submit" value="iniciar">
      <input type="submit" value="Submit">
    </form>
  </body>
</html>