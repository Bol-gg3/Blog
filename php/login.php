<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <script type="text/javascript">
function closeSelf(){
    self.close();
    return true;
}
</script>
</head>
<body>
    <form action  method="POST">
        <table>
            <tr>
<td><label>Email</label></td>
<td><input type="email" name="email" id="email" placeholder="..@gmail.com"></td> 
</tr>
<tr>
<td><label>Password</label></td>
<td><input type="password" name="contraseña" id="contraseña"></td>
           </tr>
           <tr>
               <td><input type="submit" name="enviar" id="enviar" value="enviar" onClick="closeSelf()"></td>
           </tr>
        </table>
    </form>
</body>
</html>