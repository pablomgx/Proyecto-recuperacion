<?php
    ini_set('display_erros','On');
    require __DIR__. '/db_connection.php';
    session_start();
    $db = get_db_connection_or_die();

    $comentario = $_POST['comment'];
    $id_serie = $_POST['id_serie'];
    $id_usuario = $_SESSION['user_id'];
    $id_comentario = mt_rand(2,999);
    try{    
        $stmt = $db->prepare("INSERT INTO Comentario (id,id_usuario,id_serie,comentario) VALUES (?,?,?,?)");
        $stmt->bind_param("iiis",$id_comentario,$id_usuario,$id_serie,$comentario);
        $stmt->execute();
        header('Location: buscador.php');
        $stmt->close();
    }catch(Exception $e){
        error_log($e);
        header('Location: detalle.php?comment_failed=True');
    }
    mysqli_close($db);
?>
