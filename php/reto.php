<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script>
        /*window.onload=function(){
            document.write("funciona");
        }*/
        function popupUploadForm(){
        var newWindow = window.open('../html/certificado.html', 'name', 'height=500,width=600');
    }
    fuction login(){
        var newWindow = window.open('../html/login.html', 'name', 'height=500,width=600');
    }
    </script>
</head>
<body>
    <header>
        <form action="" method="POST">
        <label>Entra en Login si te has registrado sino registrate en Registro:
            <input type="submit" value="Registro" name="registro" onclick="popupUploadForm()">
            <input type="submit" value="Login" name="login" id="login">
            </label>
        </form>
    </header>
    <section>

    </section>
    <section>
        <form action="comentario.php" method="POST">
        <p>Escribe un comentario</p>
            <textarea name="comentario" id="comentario" cols="30" rows="10"></textarea><br>
        <input type="submit" name="enviar" value="enviar">
        <input type="reset" value="borrar" name="borrar" id="borrar">
        </form>
    </section>
    <section>
        <form action="aburro.php" method="POST">
        <input style="padding: 20px;" type="submit" value="Me Aburro" name="aburro">
    </form>
    </section>
</body>
</html>