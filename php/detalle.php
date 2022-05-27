
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
     text-align: left;
     font-size: 1.5rem;
     font-family: 'Lato';
}
 input {
     border: 2px solid #ccc;
     font-size: 1.5rem;
     font-weight: 100;
     font-family: 'Lato';
     padding: 50px;
}
form {
    
    margin: 25px;
    padding: 49px;
    border: 5px solid #ccc;
    width: 500px;
    background:   #eee;
    float:left;
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
.detalle{
  align-items:flex-start;
}
.detalle img{
  float:left;
  width:40%;
  height:auto;
  padding:20px;
}
.comentarios{
  clear:both;
display:flex;
flex-direction:column;
align-self:flex-end;
flex-wrap: wrap;

}
.comentarios p{
  font-size:15px;
  font-style:italic;
  text-align:center;

}

    </style>
</head>
<body>
<p class="title">WebSeries</p>
<a href="buscador.php">Volver al buscador</a>
<?php

  require __DIR__ . '/db_connection.php';
  $mysqli = get_db_connection_or_die();
  session_start();
  if(!isset($_SESSION['user_id'])){
    echo '<p style="color:white">Debes loguearte</p>';
    echo '<a href="login.php">Login</a>';
  }else{
    $id_serie = $_GET['id']; 
    if(empty($id_serie)){
      echo '<p style="color:white">No se ha indicado un ID de serie</p>';
      exit;
    }
    $query = 'SELECT * FROM Serie WHERE id='.$id_serie.'';
    $query_searched = mysqli_query($mysqli,$query);

    $count_results = mysqli_num_rows($query_searched);

    if($count_results>0){

      while($row_searched = mysqli_fetch_array($query_searched)){
        echo '<div class="detalle">';
        echo '<img src="'.$row_searched['url_caractula'].'">';
        echo '<p>Título: '.$row_searched['nombre'].'</p>';
        echo '<p>Autor: '.$row_searched['autor'].'</p>';
        echo '<p>Fecha creación: '.$row_searched['fecha_creacion'].'</p>';
        echo '<p>Nº temporadas: '.$row_searched['num_temporadas'].'</p>';
        echo '<p>Nº episodios: '.$row_searched['num_episodios'].'</p>';
        echo '</div>';
      }
    }
    
    
    # muestra los comentarios con el id_serie correspondiente
    #$query2 = 'SELECT * FROM Comentario WHERE id_serie = '.$id_serie.'';

    $query2 = 'SELECT * FROM Comentario JOIN Usuario on Comentario.id_usuario=Usuario.id WHERE id_serie = '.$id_serie.'';
    $result = mysqli_query($mysqli,$query2);

    $results = mysqli_num_rows($result);
    if($results>0){
      while($row_searched = mysqli_fetch_array($result)){
        echo '<div class="comentarios">';
        echo '<p>Nombre: '.$row_searched['nombre'].'</p>';
        echo '<p>Comentario: '.$row_searched['comentario'].'</p>';
        echo '</div>';
        
      }
    }else{
      echo '<p>No hay comentarios</p>';
    }
    if(isset($_SESSION['user_id'])){
      echo '<form method="post" action="/do_comment.php" name="comment-form">';
      echo '<div class="form-element">';
      echo '<label style="color:black;">Añade un nuevo comentario </label>';          
      echo '<input id="comment" name="comment" type="text" required>';
      echo '</div>';
  
      echo '<div class="form-element">';
          echo '<input id="id_serie" name="id_serie" type="hidden" value="'.$id_serie.'" style="width : 150px; heigth : 10px">';
      echo '</div>';
      echo '<center>';
      echo '<button type="submit" name="enviar" value="enviar">Enviar</button>';
    echo '</center>';
     echo '</form>';
    }
}
  mysqli_close($mysqli);
   ?>
</body>
</html