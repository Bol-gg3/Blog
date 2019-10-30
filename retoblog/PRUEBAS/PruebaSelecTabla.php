<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ejercicio 7</title>
</head>

<body>
    <table id="modeloUsuarios" width="500" border="1" cellspacing="0" cellpadding="4">
        <caption>Listado de usuarios modelo</caption>
        <thead>
            <tr>
                <th scope="col" id="col_seleccion" class="oculto">Selección</th>
                <th scope="col" id="cab_centro">Centro</th>
                <th scope="col" id="cab_especialidad">Especialidad</th>
                <th scope="col" id="cab_categoria">Categor&iacute;a</th>
                <th scope="col" id="cab_tipo">Tipo personal</th>
                <th scope="col" id="cab_ambito">&Aacute;mbito</th>
                <th scope="col" id="cab_unidad">Unidad</th>
                <th scope="col" id="cab_modelo">Modelo</th>
            </tr>
        </thead>
        <tbody style="cursor:pointer">
            <tr id="seleccionar">
                <td><input type="checkbox" name="check[]" value="1" id="chk1"></td>
                <td>AAAAAA</td>
                <td>AAAAAA</td>
                <td>AAAAAA</td>
                <td>AAAAAA</td>
                <td>AAAAAA</td>
                <td>AAAAAA</td>
                <td>AAAAAA</td>
            </tr>
            <tr onclick="seleccionar(this,2)">
                <td><input type="checkbox" name="check[]" value="2" id="chk2"></td>
                <td>BBBBBB</td>
                <td>BBBBBB</td>
                <td>BBBBBB</td>
                <td>BBBBBB</td>
                <td>BBBBBB</td>
                <td>BBBBBB</td>
                <td>BBBBBB</td>
            </tr>
            <tr onclick="seleccionar(this,3)">
                <td><input type="checkbox" name="check[]" value="3" id="chk3"></td>
                <td>CCCCCC</td>
                <td>CCCCCC</td>
                <td>CCCCCC</td>
                <td>CCCCCC</td>
                <td>CCCCCC</td>
                <td>CCCCCC</td>
                <td>CCCCCC</td>
            </tr>
        </tbody>
        <script>
            function seleccionar(tr,value){
                $(function(){
                    if($("#chk"+value).attr("checked")=="checked"){
                        $("#chk"+value).removeAttr("checked");
                        $(tr).css("backgroud-color","#FFFFFF")
                    }else{
                        $("#chk"+value).attr("checked","true");
                        $("#chk"+value).prop("checked","true");
                        $(tr).css("backgroud-color","#BEDAE8")
                    }
                })
            }
        </script>
        <?php
        if(isset($_REQUEST["guardar"])){
            $checkes=$_REQUEST["check"];
            echo $checkes[2];
        }
        ?>
        
</body>

</html>