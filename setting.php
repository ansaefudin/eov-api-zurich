<?php 
    $database_host = 'localhost'; 
    $database_name = 'db_zurich'; 
    $database_table = 'data'; 
    $database_username='root'; 
    $database_password = ''; 
    try {   
        $pdo = new PDO("mysql:host=$database_host;dbname=$database_name", 
        $database_username, $database_password,
		array(
			PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
		));
    }catch (PDOException $e) {
        die('database connection failed: ' . $e->getMessage());
    }
?>