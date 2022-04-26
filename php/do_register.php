<?php

include('config.php');
session_start();

if (isset($_POST['register'])){

    $username = $_POST['username'];
    $surname = $_POST['surname'];
    $surname2 = $_POST['surname2'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $password_hash = password_hash($password, PASSWORD_BCRYPT);

    $query = $connection->prepare("SELECT * FROM Usuario WHERE num_telefono=:phone");
    $query->bindParam("phone",$phone, PDO::PARAM_STR);
    $query->execute();

    if($query->rowCount() > 0){
        echo '<p class="error">The email address is already registered!</p>';
    }

    if($query->rowCount() == 0 ){
        $query=$connection->prepare("INSERT INTO Usuario(nombre,primer_apellido,segundo_apellido,num_telefono,password_hashed) VALUES (:username,:surname,:surname2,:phone,:password_hash)");
        $query->bindParam("username",$username, PDO::PARAM_STR);
        $query->bindParam("surname",$surname, PDO::PARAM_STR);
        $query->bindParam("surname2",$surname2, PDO::PARAM_STR);
        $query->bindParam("phone",$phone, PDO::PARAM_STR);
        $query->bindParam("password_hash",$password_hash, PDO::PARAM_STR);
        $result = $query->execute();

        if ($result) {
            echo '<p class="success">El registro se ha completado!</p>';
        } else {
            echo '<p class="error">Algo salió mal!</p>';
        }
    }
}
?>