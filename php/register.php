<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Página registro</title>

<style>
    * {
    padding: 0;
    margin: 0;
    box-sizing: border-box;
}
 
body {
  margin: 0;
  background-color: black;
  color: white;
}
 
h1 {
    font-family: 'Passion One';
    font-size: 2rem;
    text-transform: uppercase;
}
 
label {
    width: 150px;
    display: inline-block;
    text-align: left;
    font-size: 1.5rem;
    font-family: 'Lato';
}
 
input {
    border: 2px solid #ccc;
    font-size: 1.5rem;
    font-weight: 100;
    font-family: 'Lato';
    padding: 10px;
}
 
form {
    
    margin: 25px auto;
    padding: 20px;
    border: 5px solid #ccc;
    width: 500px;
    background: #eee;
}
 
div.form-element {
    margin: 20px 0;
}
 
button {
    padding: 10px;
    font-size: 1.5rem;
    font-family: 'Lato';
    font-weight: 100;
    background: #FF3333;
    color: white;
    border: none;
    align:center;
}
 
p.success,
p.error {
    color: white;
    font-family: lato;
    background: yellowgreen;
    display: inline-block;
    padding: 2px 10px;
}
 
p.error {
    background: orangered;
}
.title{
  text-align: center;
  font-size:3rem;
  text-shadow: 0 0 10px #fff, 0 0 20px #fff, 0 0 30px #FF3333, 0 0 40px #FF3333,
    0 0 50px #FF3333, 0 0 60px #FF3333, 0 0 70px #FF3333;
    font-family: 'Bebas Neue', cursive;
}
</style>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Hubballi&display=swap" rel="stylesheet">
</head>
<body>
    <?php
        if($_GET['register_success'] == 'True'){
            echo "<p>Usuario registrado</p>";
            echo "<br>";
            echo "<a href='login.php'>Login</a>";
            echo "<br>";
        }
        if($_GET['register_failed_phone'] == 'True'){
            echo "<p>Ya existe un usuario con ese número de teléfono</p>";
        }
        if($_GET['register_failed_unknown'] == 'True') {
            echo "<p>El registro fallo por motivos desconocidos</p>";
        }
    ?>      
<p class="title">WebSeries</p>
<div class="formulario">
<form method="post" action="/do_register.php" name="signup-form">
    <div class="form-element">
        <label style="color:black;">Nombre</label>
        <input id="name" name="name" type="text" style="width : 150px; heigth : 10px" required>
    </div>
    <div class="form-element">
        <label style="color:black;">Primer apellido</label>
        <input  id="surname" name="surname" type="text" style="width : 150px; heigth : 10px" required>
    </div>
    <div class="form-element">
        <label style="color:black;">Segundo apellido</label>
        <input  id="surname2" name="surname2" type="text" style="width : 150px; heigth : 10px" required>
    </div>
    <div class="form-element">
        <label style="color:black;">Num. teléfono</label>
        <input  id="phone" name="phone" type="text" name="numTelefono" style="width : 150px; heigth : 10px" required>
    </div>
    <div class="form-element">
        <label style="color:black;">Contraseña</label>
        <input  id="password" name="password" type="password" name="password" style="width : 150px; heigth : 10px" required>
    </div>
    <div class="form-element">
        <label style="color:black;">Verifica la contraseña</label>
        <input  id="password2" name="password2" type="password" name="password" style="width : 150px; heigth : 10px" required>
    </div>
    <center>
    <button type="submit" name="register" value="register">Registro</button>
    </center>
    
</div>
</body>
</html>
