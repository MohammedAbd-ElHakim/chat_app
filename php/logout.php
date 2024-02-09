<?php
session_start();
if (isset($_SESSION['unique_id'])) {
    include_once 'connfig.php';
    $logout_id = $_GET['logout_id'];
    if (isset($logout_id)) {
        $status = 'offline_now';
        $sql = "UPDATE users SET status = :status WHERE unique_id =:logout_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':logout_id', $logout_id);
        // $stmt->execute();
        if ($stmt->execute()) {
            session_unset();
            session_destroy();
            header("Location:../login.php");
        } else {
            header("Location:../users.php");
        }
    }
} else {
    header("Location:../login.php");
}

?>