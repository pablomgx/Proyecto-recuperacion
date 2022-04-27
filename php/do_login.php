<?php
    require __DIR__. '/db_connection.php';
    $db = get_db_connection_or_die();

    $phone = $_POST['phone'];
	$password = $_POST['password'];

    $query = "SELECT id, password_hashed, num_telefono FROM Usuario WHERE num_telefono = '".$phone."'";

    $result = mysqli_query($db, $query) or die(header('Location: login.php?login_failed_unknown=True'));
    if (mysqli_num_rows($result) == 0) {
        header("Location: login.php?login_failed_phone=True");
        exit;
    } else {
        $only_row = mysqli_fetch_array($result);
        if (password_verify($password,$only_row[1])) {
            session_start();
            $_SESSION['user_id'] = $only_row[0];
            header("Location: buscador.php");
            exit;
        }else{
            header("Location: login.php?login_failed_password=True");
            exit;
        }
    }
    
?>

