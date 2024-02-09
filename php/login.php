<?php
session_start();
include_once 'connfig.php';
if (!empty($_POST['email']) && !empty($_POST['password'])) {
    //lets check users enterd email & password matched to database any table row email and password
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email =:email AND password = :password");
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->execute();
    if ($stmt->rowCount() > 0) { //if users credential mathed
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $_SESSION['unique_id'] = $result['unique_id']; //using this session we used user unique_id in other php file     }else{
        $status = 'active now';
        $sql2 = "UPDATE users SET status = :status WHERE unique_id =:login";
        $stmt2 = $conn->prepare($sql2);
        $stmt2->bindParam(':status', $status);
        $stmt2->bindParam(':login', $result['unique_id']);
        $stmt2->execute();
        echo "success";
    } else {
        die("Email or Password is incorect");
    }
} else {
    die("All Input Field Are Required!");
}


?>