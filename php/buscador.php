
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Hubballi&display=swap" rel="stylesheet">
    <title>Buscador</title>
    <style>
      body{
        background-color:black;
      }
      .title{
        text-align: center;
        font-size:3rem;
        color:white;
        text-shadow: 0 0 10px #fff, 0 0 20px #fff, 0 0 30px #FF3333, 0 0 40px #FF3333,
        0 0 50px #FF3333, 0 0 60px #FF3333, 0 0 70px #FF3333;
        font-family: 'Bebas Neue', cursive;
      }
      a{
        color:white;
      }
    </style>
</head>
<body>
<p class="title">WebSeries</p>
<?php
  session_start();
  if(!isset($_SESSION['user_id'])){
    echo '<a href="./login.php">Login</a></br>';
    echo '<a href="./register.php">Register</a>';
  }else{
    echo '<p class="title">Bienvenido a WebSeries</p>';
  }
?>
</body>
</html>
