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
    <link rel="stylesheet" type="text/css" href="../newcss.css">
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

    

<div id ="cont">

    <header id ="h">
        <img src="../Recursos/logo.png" alt="" id="logo">

        <?php if(!empty($email)): ?>
    <div>
      <br> Bienvenido <?= $email['nombre']; ?><br>
      <br><input type="button" value="Cerrar Session" name="cerrarse" id="cerrarse" onclick="cerrar()">
      
      <input type="button" value="Configurar cuenta" name="config" id="config" onclick="configC()">
      <br><br>
    </div>
    <?php else: ?>
    
    
           

             
            <form action="" method="POST">
                <label>Entra en Login si te has registrado sino registrate en Registro:
                    <input type="submit" value="Registro" name="registro" onclick="popupUploadForm()">
                    <input type="submit" value="Login" name="login" id="login" onclick="login1()">
                </label>
            </form>
    
        <?php endif; ?>
    </header>
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

        <button id ="btnmodo"><img src="../Recursos/luna.png" id ="btnnoche"></button>

        <div id="digitos">

        <img  src="../Recursos/nuevo reloj/0.jpg" name="h1" class="reloj"><img class="reloj" src="../Recursos/nuevo reloj/0.jpg" name="h2">
        <img src="../Recursos/nuevo reloj/numer.png">

        <img class="reloj" src="../Recursos/nuevo reloj/0.jpg" name="m1"><img class="reloj" src="../Recursos/nuevo reloj/0.jpg" name="m2">
        <img src="../Recursos/nuevo reloj/numer.png">

        <img class="reloj" src="../Recursos/nuevo reloj/0.jpg" name="segundo1"><img class="reloj" src="../Recursos/nuevo reloj/0.jpg" name="s2">

        </div>

            <form action="aburro.php" method="POST">
                <input style="padding: 20px;" type="submit" value="Me Aburro" name="aburro">
            </form>
        </section>

    </div>

<?php
?>
</body>


<script>
/*Reloj*/
var array_chulo = new Array() ;
//mega imagenes
array_chulo[0] = "../Recursos/nuevo reloj/0.jpg" ;
array_chulo[1] = "../Recursos/nuevo reloj/1.jpg" ;
array_chulo[2] = "../Recursos/nuevo reloj/2.jpg" ;
array_chulo[3] = "../Recursos/nuevo reloj/3.jpg" ;
array_chulo[4] = "../Recursos/nuevo reloj/4.jpg" ;
array_chulo[5] = "../Recursos/nuevo reloj/5.jpg" ;
array_chulo[6] = "../Recursos/nuevo reloj/6.jpg" ;
array_chulo[7] = "../Recursos/nuevo reloj/7.jpg" ;
array_chulo[8] = "../Recursos/nuevo reloj/8.jpg" ;
array_chulo[9] = "../Recursos/nuevo reloj/9.jpg" ;
var intervalo = setInterval("actualizar()", 1000) ;
function actualizar(){


var tiempo_actual = new Date() ;


var hora_actual = tiempo_actual.getHours() ;
var hora_izquierda = Math.floor(hora_actual / 10) ; 
var hora_derecha = hora_actual % 10 ;

document.images["h1"].src = array_chulo[hora_izquierda] ;
document.images["h2"].src = array_chulo[hora_derecha] ;

var minuto_actual = tiempo_actual.getMinutes() ;
var minuto_izquierdo = Math.floor(minuto_actual / 10) ;
var minuto_derecho = minuto_actual % 10 ;
document.images["m1"].src = array_chulo[minuto_izquierdo] ;
document.images["m2"].src = array_chulo[minuto_derecho] ;

var segundo_actual = tiempo_actual.getSeconds() ;
var segundo_izquierdo = Math.floor(segundo_actual / 10) ;
var segundo_derecho = segundo_actual % 10 ;
document.images["segundo1"].src = array_chulo[segundo_izquierdo] ;
document.images["s2"].src = array_chulo[segundo_derecho] ;
}

</script>

<script>
/*Modo noche*/
document.getElementById("btnmodo").onclick = cambia;
var modo = "noche"

function cambia() {

  console.log("1")

  var modo = "dia"

    if (modo ==="noche"){
        document.getElementById("logo").src = '../Recursos/logolight.jpg'

                    document.getElementById("cont").style.backgroundColor = 'lightgray'
                    document.getElementById("ContEnt").style.borderColor = 'black'
                    document.getElementById("ContEnt").style.fontcolor = 'black'

                    document.getElementById("ContEnt").style.backgroundColor = 'white'
                    document.getElementById("ContEnt").style.borderColor = 'black'
                    document.getElementById("ContEnt").style.fontcolor = 'black'

                    document.getElementById("h").style.backgroundColor = 'grey'
                    document.getElementById("h").style.borderColor = 'black'
                    document.getElementById("h").style.fontcolor = 'black'

                    document.getElementById("btnaburro").style.backgroundColor = 'grey'
                    document.getElementById("btnaburro").style.borderColor = 'black'
                    document.getElementById("btnaburro").style.fontcolor = 'black'

                    document.getElementById("ContCom").style.backgroundColor = 'white'
                    document.getElementById("ContCom").style.borderColor = 'black'
                    document.getElementById("ContCom").style.fontcolor = 'black'

                    modo = "dia"
    }

    else if (modo ==="dia"){

        document.getElementById("logo").src = '../Recursos/logo.png'

                    document.getElementById("cont").style.backgroundColor = '#404040'
                    document.getElementById("ContEnt").style.borderColor = 'black'
                    document.getElementById("ContEnt").style.fontcolor = 'black'

                    document.getElementById("ContEnt").style.backgroundColor = 'grey'
                    document.getElementById("ContEnt").style.borderColor = 'black'
                    document.getElementById("ContEnt").style.Color = 'white'

                    document.getElementById("h").style.backgroundColor = '#0D0D0D'
                    document.getElementById("h").style.borderColor = 'black'
                    document.getElementById("h").style.Color = 'white'

                    document.getElementById("btnaburro").style.backgroundColor = '#0D0D0D'
                    document.getElementById("btnaburro").style.borderColor = 'black'
                    document.getElementById("btnaburro").style.Color = 'white'

                    document.getElementById("ContCom").style.backgroundColor = 'grey'
                    document.getElementById("ContCom").style.borderColor = 'black'
                    document.getElementById("ContCom").style.Color = 'white'

                    modo = "noche"
    }
    console.log("2")

}
</script>
</html>