<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <?php
        #Salir si alguno de los datos no está presente
        if(!isset($_POST["id_usuario"]) ||!isset($_POST["nombre"])|| !isset($_POST["passwrd"])|| !isset($_POST["email"])|| !isset($_POST["tipo"])) exit();
        #Si todo va bien, se ejecuta esta parte del código...
        include_once "conector.php";
        $id_usuario = $_POST["id_usuario"];
        $nombre = $_POST["nombre"];
        $passwrd = $_POST["passwrd"];
        $email = $_POST["email"];
        $tipo = $_POST["tipo"];
     
        $sentencia = $base_de_datos->prepare("INSERT INTO usuario(id_usuario, nombre, passwrd, email, tipo) VALUES (?,?,?,?,?);");
        $resultado = $sentencia->execute([$id_usuario, $nombre, $passwrd, $email, $tipo]);
        if($resultado === TRUE) echo "Insertado correctamente";
        else echo "Algo salió mal. Por favor verifica que el id del usuario y el correo electronico no existan.";
    ?>
</body>

</html>