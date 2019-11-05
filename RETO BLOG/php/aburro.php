<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="../newcss.css">
    <title>Document</title>
</head>
<body>
    <?php
if(isset($_POST["aburro"])){
echo "Bienvenido";
}
    ?>

    <div id ="ContendeorJuegos">

        <article id ="ItemJuego1"><h2>Calculadora</h2></article>
        <article id ="ItemJuego2"><h2>Dados</h2></article>
        <article id ="ItemJuego3"><h2>Memoria</h2></article>
        <article id ="ItemJuego4"><h2>chistes</h2></article>

    </div>

    <script>

window.onload = function() {
      document.getElementById("ItemJuego1").onmouseover = resalta;
      document.getElementById("ItemJuego1").onmouseout = resalta;
      document.getElementById("ItemJuego1").onclick = clicky;


      document.getElementById("ItemJuego2").onmouseover = resalta;
      document.getElementById("ItemJuego2").onmouseout = resalta;
      document.getElementById("ItemJuego2").onclick = clicky;

      document.getElementById("ItemJuego3").onmouseover = resalta;
      document.getElementById("ItemJuego3").onmouseout = resalta;
      document.getElementById("ItemJuego3").onclick = clicky;

      document.getElementById("ItemJuego4").onmouseover = resalta;
      document.getElementById("ItemJuego4").onmouseout = resalta;
      document.getElementById("ItemJuego4").onclick = clicky;
}
function clicky(elEvento) {
    if (this.id === "ItemJuego1"){window.open('../html/dados/dado.html')}
    else if (this.id === "ItemJuego2"){window.open('../html/dados/dado.html')}
    else if (this.id === "ItemJuego3"){window.open('../html/dados/dado.html')}
    else if (this.id === "ItemJuego4"){window.open('../html/chistes/chistes.html')}

}     
function resalta(elEvento) {
      var evento = elEvento || window.event;
        console.log(this.id)
        var identificador = this.id;

        var op1 = "ItemJuego1";
        var op2 = "ItemJuego2";
        var op3 = "ItemJuego3";
        var op4 = "ItemJuego4";

      switch (evento.type) {
        
        case 'mouseover':
        
        if(identificador === op1){
          this.style.backgroundImage = "url('../Recursos/calculadora-2.jpg')";
          }
        if(identificador === op2){
            this.style.backgroundImage = "url('../Recursos/dados-2.jpg')"; 
        }

        if(identificador === op3){
            this.style.backgroundImage = "url('../Recursos/memoria-2.jpg')"; 
        }

        if(identificador === op4){
            this.style.backgroundImage = "url('../Recursos/chistes-2.jpg')"; 
        }

          this.style.color="red"
          this.style.borderColor="red"
        break;
          
        case 'mouseout':
        if(identificador === op1){
          this.style.backgroundImage = "url('../Recursos/calculadora.jpg')";
          }
        if(identificador === op2){
            this.style.backgroundImage = "url('../Recursos/dados.jpg')"; 
        }

        if(identificador === op3){
            this.style.backgroundImage = "url('../Recursos/memoria.jpg')"; 
        }

        if(identificador === op4){
            this.style.backgroundImage = "url('../Recursos/chistes.jpg')"; 
        }
        this.style.color="gold";
        this.style.borderColor="gold";
          break;

      }
}
      </script>
</body>
</html>