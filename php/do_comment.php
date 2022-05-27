<?php
    ini_set('display_erros','On');
    require __DIR__. '/db_connection.php';
    session_start();
    $db = get_db_connection_or_die();

    $id_usuario = $_SESSION['user_id'];
    $comentario = $_POST['comment'];
    $id_serie = $_POST['id_serie'];
    $id_comentario = mt_rand(2,999);

    if(empty($comentario) or empty($id_serie) or empty($id_usuario)or empty($id_comentario)){
        die("Introduce los datos");
    }

    try{    
        $sql = "INSERT INTO Comentario (id,id_usuario,id_serie,comentario) VALUES (?,?,?,?)";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("iiis",$id_comentario,$id_usuario,$id_serie,$comentario);
        $stmt->execute();
    }catch(Exception $e){
        error_log($e);
        header('Location: /detalle.php?comment_failed=True');
    }
    header('Location: /detalle.php?id='.$id_serie.'');
    $stmt->close();
    mysqli_close($db);
?>
