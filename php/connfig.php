<?php
$dsn = "mysql:host=localhost;dbname=chat;charset=UTF8";
$pass = '';
$dbname = 'chat';
$user = 'root';

try {
    $conn = new PDO($dsn, $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connected successfully";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

?>