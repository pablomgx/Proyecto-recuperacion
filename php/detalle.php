
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
        text-align:left;
        color:white;
        font-size:27px;
        
      }
      p:first-of-type{
        padding-top:20px;
      }
      .form-element{
        text-align:center;
        color:white;
        font-size:20px;
      }
      .info{
        margin-top:;
      }
    </style>
</head>
<body>
<p class="title">WebSeries</p>
<?php

  require __DIR__ . '/db_connection.php';
  $mysqli = get_db_connection_or_die();
  session_start();
  if(!isset($_SESSION['user_id'])){
    echo '<h2 style="color:white;">Debes loguearte</h2>';
    echo '<a style="color:white;" href="/login.php">Login</a>';
  }else{
    $id_serie = $_GET['id']; 
    if(empty($id_serie)){
      echo 'No se ha indicado un ID de serie';
      exit;
    }
    $query = 'SELECT * FROM Serie WHERE id='.$id_serie.'';
    $query_searched = mysqli_query($mysqli,$query);

    $count_results = mysqli_num_rows($query_searched);

    if($count_results>0){

      while($row_searched = mysqli_fetch_array($query_searched)){
        echo '<div style="justify-content:left;">';
        echo '<img style="float:left;width:30%;height:auto;padding:20px;" src="'.$row_searched['url_caractula'].'">';
        echo '<p>Título: '.$row_searched['nombre'].'</p>';
        echo '<p>Autor: '.$row_searched['autor'].'</p>';
        echo '<p>Fecha creación: '.$row_searched['fecha_creacion'].'</p>';
        echo '<p>Nº temporadas: '.$row_searched['num_temporadas'].'</p>';
        echo '<p>Nº episodios: '.$row_searched['num_episodios'].'</p>';
        echo '</div>';
      }
    }
}
  mysqli_close($mysqli);
   ?>
</body>
</html