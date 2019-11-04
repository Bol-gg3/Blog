<?php
require_once("$conector.php");
if(isset($_POST["enviar"])){

    if(empty($_POST["email"]) || empty($_POST["contraseña"])){

       header("location:login.html?Por favor inserte email o contraseña");

    }
    else{
       $query="select * from usuario where $_POST['email']=email and $_POST['contraseña']=paswrd";
       $result=mysqli.query();
    }
    else{

        echo "Error al Logear";
    }

}




?>