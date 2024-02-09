<?php
session_start();
include_once 'connfig.php';
$outgoing_id = $_SESSION['unique_id'];
$sql = "SELECT * FROM users WHERE unique_id  <> :unique_id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':unique_id', $_SESSION["unique_id"]);
$output = " ";
$stmt->execute();
if ($stmt->rowCount() == 1) {
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $output .= "No users are available to chat";

} else if ($stmt->rowCount() > 1) {
    // $result = $stmt->fetch(PDO::FETCH_ASSOC);

    include_once "data.php";
}

echo $output;
?>