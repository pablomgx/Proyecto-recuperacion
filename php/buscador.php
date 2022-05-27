
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
      p{
        text-align:center;
        color:white;
        font-size:20px;
      }
      .form-element{
        text-align:center;
        color:white;
        font-size:20px;
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

<form action="buscador.php" method="post">
  <div class="form-element">
    <label>Buscador   
      <input type="search" id="texto_busqueda" name="texto_busqueda" placeholder="Título, autor...">
    </label>
    <input type="submit" value="Buscar" name="search" id="search">
  </div>
</form>

<?php
  if(isset($_POST['search'])){
    $value = $_POST['texto_busqueda']; 
    require __DIR__ . '/db_connection.php';
    $db = get_db_connection_or_die();
    $query = "SELECT id,nombre,fecha_creacion FROM Serie WHERE nombre LIKE '%".$value."%'";
    $query_searched = mysqli_query($db,$query);

    $count_results = mysqli_num_rows($query_searched);

    if($count_results==0){
      echo '<h2 style="color:white;">No se encuentran resultados con esa búsqueda</h2>';
    }else{
      echo '<h2 style="color:white;">Se han encontrado '.$count_results.'resultados.</h2>';

      while($row_searched = mysqli_fetch_array($query_searched)){
        echo '<div style="display:flex;justify-content:center;">';
        echo '<p style="color:white;">'.$row_searched['nombre'].'</p>'.",, ";
        echo '<p style="color:white;">'.$row_searched['fecha_creacion'].'</p>';
        echo '<a href="detalle.php?id='.$row_searched['id'].'"><img style="width:35px;height:35px;border-radius:30%;" src="/static/detalle.jpg" alt="detalle"/></a>';
        echo '</div>';
      }
    }
  }
   ?>
</body>
</html>
