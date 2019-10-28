<?php
  session_start();

  require 'conector.php';

  if (isset($_SESSION['email'])) {
    $sentencia = $base_de_datos->prepare('SELECT nombre, email  password FROM usuario WHERE email = :email');
    $sentencia->bindParam(':email', $_SESSION['email']);
    $sentencia->execute();
    $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);

    $email = null;

    if (count($resultado) > 0) {
      $email = $resultado;
    }
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="../css.css">
    <title>G3</title>
    <script>
        function popupUploadForm() {
            var newWindow = window.open('registrate.php', 'name', 'height=400,width=600');
            
        }

        function login1() {
            var newWindow = window.open('login.php', 'name', 'height=300,width=400');
        }
        function configC() {
            window.location="configCuenta.php";
        }
        function cerrar() {
            window.location="cerrar.php";
        }
    </script>
</head>

<body>
    
    <?php if(!empty($email)): ?>
      <br> Bienvenido <?= $email['nombre']; ?><br>
      <br><input type="button" value="Cerrar Session" name="cerrarse" id="cerrarse" onclick="cerrar()">
      
      <input type="button" value="Configurar cuenta" name="config" id="config" onclick="configC()">
      <br><br>
    <?php else: ?>
    <div id="cont">
        <header>

            <img src="../Recursos/logo.png" alt="" id="logo">
            <form action="" method="POST">
                <label>Entra en Login si te has registrado sino registrate en Registro:
                    <input type="submit" value="Registro" name="registro" onclick="popupUploadForm()">
                    <input type="submit" value="Login" name="login" id="login" onclick="login1()">
                </label>
            </form>
        </header>
        <?php endif; ?>


        <section id="ContEnt">

            <article class="entrada">
                <h2>Esta es una entrada de prueba :</h2>

                <h3>Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto, deserunt deleniti! Natus
                    asperiores praesentium commodi temporibus officiis sint, cum vero esse hic? Ullam a consectetur
                    velit quisquam saepe ea odit!</h3>
            </article>

            <article class="entrada">
                <h2>Esta es una entrada de prueba :</h2>

                <h3>Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto, deserunt deleniti! Natus
                    asperiores praesentium commodi temporibus officiis sint, cum vero esse hic? Ullam a consectetur
                    velit quisquam saepe ea odit!</h3>
            </article>
            <form action="Entrada.php">
                <textarea name="entrada" id="entrada" cols="100" rows="10"></textarea>
                <input type="submit" name="insertar" value="insertar">
            </form>
        </section>


        <section id="ContCom">

            <article class="comentario">
                <h2>Esta es una entrada de prueba :</h2>

                <h3>Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto, deserunt deleniti! Natus
                    asperiores praesentium commodi temporibus officiis sint, cum vero esse hic? Ullam a consectetur
                    velit quisquam saepe ea odit!</h3>
            </article>

            <article class="comentario">
                <h2>Esta es una entrada de prueba :</h2>

                <h3>Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto, deserunt deleniti! Natus
                    asperiores praesentium commodi temporibus officiis sint, cum vero esse hic? Ullam a consectetur
                    velit quisquam saepe ea odit!</h3>
            </article>

            <form action="comentario.php" method="POST">
                <p>Escribe un comentario</p>
                <textarea name="comentario" id="comentario" cols="100" rows="5"></textarea><br>
                <input type="submit" name="enviar" value="enviar">
                <input type="reset" value="borrar" name="borrar" id="borrar">
            </form>
        </section>

        <section id="btnaburro">
            <form action="aburro.php" method="POST">
                <input style="padding: 20px;" type="submit" value="Me Aburro" name="aburro">
            </form>
        </section>

    </div>
</body>

</html>