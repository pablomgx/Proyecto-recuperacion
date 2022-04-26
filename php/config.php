<?php
define('USER', 'admin');
define('PASSWORD', 'admin');
define('HOST', 'localhost');
define('DATABASE', 'webseries');
 
try {
    $connection = new PDO("mysql:host=".HOST.";dbname=".DATABASE, USER, PASSWORD);
} catch (PDOException $e) {
    exit("Error: " . $e->getMessage());
}
?>
