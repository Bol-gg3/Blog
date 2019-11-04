<?php
  session_start();

  require 'conector.php';

  if (isset($_SESSION['email'])) {
    $sentencia = $base_de_datos->prepare('SELECT id_usuario,nombre,password,email,tipo  password FROM usuario WHERE email = :email');
    $sentencia->bindParam(':email', $_SESSION['email']);
    $sentencia->execute();
    $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);

    $sentencia2 = $base_de_datos->prepare('SELECT * FROM comentario');
    $sentencia2->execute();
    $resultado2 = $sentencia->fetch(PDO::FETCH_ASSOC);

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
            window.location = "configCuenta.php";
        }

        function cerrar() {
            window.location = "cerrar.php";
        }

        function adminSession() {
            window.location = "GestionUsuariosAdmin.php";
        }
    </script>
</head>

<body>
    <div id="cont">

        <header id="h">
            <img src="../Recursos/logo.png" alt="" id="logo">

            <?php if(!empty($email)): ?>
            <div>
                <br> Bienvenid@ <?= $email['nombre']; ?><br>
                <br>
                <input type="button" value="Cerrar Session" name="cerrarse" id="cerrarse" onclick="cerrar()">
                <input type="button" value="Configurar cuenta" name="config" id="config" onclick="configC()">
                <?php if($email['password']=="Admin"|| $email['password']=="SuperAdmin" ): ?>
                <input type="button" value="Acceso Admin" name="adminSession" id="adminSession"
                    onclick="adminSession()">
                <?php endif; ?>
                <br><br>
            </div>
            <?php else: ?>
            <form action="" method="POST">
                <label>Accede a la pagina:
                    <input type="submit" value="Registro" name="registro" onclick="popupUploadForm()">
                    <input type="submit" value="Login" name="login" id="login" onclick="login1()">
                </label>
            </form>

            <?php endif; ?>
        </header>
        <section id="ContEnt">
             <p>Escribe una entrada</p>
            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <textarea name="entrada" id="entrada" cols="100" rows="5"></textarea><br>
                <input type="submit" name="insertar" value="Insertar">
            </form>
            <?php
            include_once "conector.php";
            $consulta = "SELECT * FROM entrada";

            foreach($base_de_datos->query($consulta) as $fila){
                $id_entrada=$fila['id_entrada'];
                $fecha_entrada=$fila['fecha_entrada'];
                $entradas=$fila['entradas'];
                $id_usuario=$fila['id_usuario'];
            
            ?>
            <center><h2>Entradas</h2></center>
            <article class="entrada"> 
                    <h4>
                        <address>Usuario: <?php echo  $id_entrada; ?>
                    </h4>
                    <p>
                        <address>Fecha: <?php echo  $fecha_entrada; ?>
                    </p>
                    <address><?php echo $entradas; ?></address>
                    <h6>
                        <address>Ref: <?php echo  $id_entrada; ?>
                    </h6>
            </article>
            <?php
                }
            ?>
        </section>


        <section id="ContCom">
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <p>Escribe un comentario</p>
                <textarea name="comentario" id="comentario" cols="100" rows="5"></textarea><br>
                <input type="submit" name="Comentar" value="Comentar">
                <input type="submit" name="Eliminar" value="Eliminar mis comentarios">
                <input type="reset" value="Borrar" name="borrar" id="borrar">
            </form>    
            <?php
            include_once "conector.php";
            $consulta = "SELECT * FROM comentario";

            foreach($base_de_datos->query($consulta) as $fila){
                $id_comentario=$fila['id_comentario'];
                $fecha_comentario=$fila['fecha_comentario'];
                $comentarios=$fila['comentarios'];
                $id_usuario=$fila['id_usuario'];
            
            ?>
            <center><h2>Comentarios</h2></center>
            <article class="comentario">
                    <h4>
                        <address>Usuario: <?php echo  $id_usuario; ?>
                    </h4>
                    <p>
                        <address>Fecha: <?php echo  $fecha_comentario; ?>
                    </p>
                    <address><?php echo $comentarios; ?></address>
                    <h6>
                        <address>Ref: <?php echo  $id_comentario; ?>
                    </h6>
            </article>
            <?php
                }
            ?>
        </section>

        <section id="btnaburro">

            <button id="btnmodo"><img src="../Recursos/lunita.png" id="btnnoche"></button>

            <div id="digitos">

                <img src="../Recursos/nuevo reloj/0.jpg" name="h1" class="reloj"><img class="reloj"
                    src="../Recursos/nuevo reloj/0.jpg" name="h2">
                <img src="../Recursos/nuevo reloj/numer.png">

                <img class="reloj" src="../Recursos/nuevo reloj/0.jpg" name="m1"><img class="reloj"
                    src="../Recursos/nuevo reloj/0.jpg" name="m2">
                <img src="../Recursos/nuevo reloj/numer.png">

                <img class="reloj" src="../Recursos/nuevo reloj/0.jpg" name="segundo1"><img class="reloj"
                    src="../Recursos/nuevo reloj/0.jpg" name="s2">

            </div>

            <form action="aburro.php" method="POST">
                <input style="padding: 20px;" type="submit" value="Me Aburro" name="aburro">
            </form>
        </section>

    </div>

    <?php
    require 'conector.php';
    
    if(isset($_POST["Comentar"])){
        if(!isset($_POST["comentario"]))  exit();
	    $comentario = filter_var($_POST['comentario']);
        $id_usuario =$email['id_usuario'];     
        /*
		$sentencia = $base_de_datos->prepare('INSERT INTO comentario (id_comentario, fecha_comentario, comentarios, id_usuario) VALUES (null, null, :fecha_comentario, :id_usuario)');
        $resultado = $sentencia->execute(array(':comentarios' => $comentario, ':id_usuario' => $id));*/
        $sentencia = $base_de_datos->prepare("INSERT INTO comentario VALUES (NULL,NUll,?,?);");
        $resultado = $sentencia->execute([$comentario, $id_usuario]);
        
     }
        elseif(isset($_POST["insertar"])){
        if(!isset($_POST["entrada"]))  exit();

         $entrada = filter_var($_POST['entrada']);
             
           $id_usuario =$email['id_usuario']; 
           /*
           $sentencia = $base_de_datos->prepare('INSERT INTO comentario (id_comentario, fecha_comentario, comentarios, id_usuario) VALUES (null, null, :fecha_comentario, :id_usuario)');
           $resultado = $sentencia->execute(array(':comentarios' => $comentario, ':id_usuario' => $id));*/
           $sentencia = $base_de_datos->prepare("INSERT INTO entrada VALUES (NULL,NUll,?,?);");
           $resultado = $sentencia->execute([$entrada, $id_usuario]);
     
        }

     #ELIMINAR MIS COMENTARIOS UNO A UNO EN LA TABLA EN MYSQL
		elseif(isset($_POST["Eliminar"])){
            $id_usuario =$email['id_usuario']; 
            $sentencia = $base_de_datos->prepare("DELETE FROM comentario WHERE id_usuario = ? order by id_comentario desc limit 1;");
            $resultado = $sentencia->execute([$id_usuario]);
            }
    ?>
</body>


<script>
    /*Reloj*/
    var array_chulo = new Array();
    //mega imagenes
    array_chulo[0] = "../Recursos/nuevo reloj/0.jpg";
    array_chulo[1] = "../Recursos/nuevo reloj/1.jpg";
    array_chulo[2] = "../Recursos/nuevo reloj/2.jpg";
    array_chulo[3] = "../Recursos/nuevo reloj/3.jpg";
    array_chulo[4] = "../Recursos/nuevo reloj/4.jpg";
    array_chulo[5] = "../Recursos/nuevo reloj/5.jpg";
    array_chulo[6] = "../Recursos/nuevo reloj/6.jpg";
    array_chulo[7] = "../Recursos/nuevo reloj/7.jpg";
    array_chulo[8] = "../Recursos/nuevo reloj/8.jpg";
    array_chulo[9] = "../Recursos/nuevo reloj/9.jpg";
    var intervalo = setInterval("actualizar()", 1000);

    function actualizar() {


        var tiempo_actual = new Date();


        var hora_actual = tiempo_actual.getHours();
        var hora_izquierda = Math.floor(hora_actual / 10);
        var hora_derecha = hora_actual % 10;

        document.images["h1"].src = array_chulo[hora_izquierda];
        document.images["h2"].src = array_chulo[hora_derecha];

        var minuto_actual = tiempo_actual.getMinutes();
        var minuto_izquierdo = Math.floor(minuto_actual / 10);
        var minuto_derecho = minuto_actual % 10;
        document.images["m1"].src = array_chulo[minuto_izquierdo];
        document.images["m2"].src = array_chulo[minuto_derecho];

        var segundo_actual = tiempo_actual.getSeconds();
        var segundo_izquierdo = Math.floor(segundo_actual / 10);
        var segundo_derecho = segundo_actual % 10;
        document.images["segundo1"].src = array_chulo[segundo_izquierdo];
        document.images["s2"].src = array_chulo[segundo_derecho];
    }
</script>

<script>
    /*Modo noche*/
    document.getElementById("btnmodo").onclick = cambia;
    var modo = "noche"

    function cambia() {

        console.log("1")

        if (modo === "noche") {

            document.getElementById("logo").src = '../Recursos/logolight.jpg';
            document.getElementById("btnnoche").src = '../Recursos/sol.png';
            document.getElementById("cont").style.backgroundColor = 'lightgray';

            document.getElementById("ContEnt").style.borderColor = 'black';
            document.getElementById("ContEnt").style.fontcolor = 'black';
            document.getElementById("ContEnt").style.backgroundColor = 'white';
            document.getElementById("ContEnt").style.borderColor = 'black';
            document.getElementById("ContEnt").style.fontcolor = 'black';

            document.getElementById("h").style.backgroundColor = 'grey';
            document.getElementById("h").style.borderColor = 'black';
            document.getElementById("h").style.fontcolor = 'black';

            document.getElementById("btnaburro").style.backgroundColor = 'grey';
            document.getElementById("btnaburro").style.borderColor = 'black';
            document.getElementById("btnaburro").style.fontcolor = 'black';

            document.getElementById("ContCom").style.backgroundColor = 'white';
            document.getElementById("ContCom").style.borderColor = 'black';
            document.getElementById("ContCom").style.fontcolor = 'black';

            console.log("dia");
            modo = "dia";
        } else if (modo === "dia") {

            document.getElementById("logo").src = '../Recursos/logo.png'
            document.getElementById("btnnoche").src = '../Recursos/lunita.png'
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

            console.log("noche")
            modo = "noche"
        }
        console.log("2")

    }
</script>

</html>