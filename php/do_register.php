<?php
    ini_set('display_erros','On');
    require __DIR__ . '/db_connection.php';
    $mysql = get_db_connection_or_die();

    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $surname2 = $_POST['surname2'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];

    if (empty($name) or empty($surname) or empty($surname2) or empty($phone) or empty($password) or empty($password2)){
        die("Introduce los datos");
    }

    if($password!=$password2){
        die("Las contraseñas deben ser iguales");
    }

    $sql = "SELECT * FROM Usuario WHERE num_telefono = ?";
    $stmt = $mysql->prepare($sql);
    $stmt->bind_param("s",$phone);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows==1){
        header("Location: register.php?register_failed_phone=True");
        exit;
    }else {
        try{
            $sql2 = "INSERT INTO Usuario (id,nombre,primer_apellido,segundo_apellido,num_telefono,password_hashed) VALUES (?,?,?,?,?,?)";
            $stmt = $mysql->prepare($sql2);
            $password = password_hash($_POST['password'],PASSWORD_BCRYPT);
            $id=mt_rand(2,999);
            $stmt -> bind_param("isssss",$id,$name,$surname,$surname2,$phone,$password);
            $stmt->execute();
            $stmt->close();
        }catch(Exception $e){
            error_log($e);
            header("Location: register.php?register_failed_unkown=True");
        }
        header("Location: login.php?register_success=True");
    }
    
    mysqli_close($mysql);

?>