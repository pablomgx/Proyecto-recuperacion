
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
    * {
     padding: 0;
     margin: 0;
     box-sizing: border-box;
}
 body{
     background-color:black;
}
 .title{
     text-align: center;
     font-size:3rem;
     color:white;
     text-shadow: 0 0 10px #fff, 0 0 20px #fff, 0 0 30px #FF3333, 0 0 40px #FF3333, 0 0 50px #FF3333, 0 0 60px #FF3333, 0 0 70px #FF3333;
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
     padding-top:50px;
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

    </style>
</head>
<body>
<p class="title">WebSeries</p>
<?php

  require __DIR__ . '/db_connection.php';
  $mysqli = get_db_connection_or_die();
  session_start();
  if(!isset($_SESSION['user_id'])){
    header('Location: login.php');
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
   <form method="post" action="/do_comment.php" name="comment-form">
    <div class="form-element">
        <label style="color:black;">Comentario: </label>
        <input id="comment" name="comment" type="text" style="width : 150px; heigth : 10px" required>
    </div>

    <div class="form-element">
        <input id="id_serie" name="id_serie" type="hidden" value="<?php echo ($id_serie);?>"style="width : 150px; heigth : 10px">
    </div>

    <center>
    <button type="submit" name="enviar" value="enviar">Enviar</button>
    </center>
   </form>
</body>
</html