<?php
include_once 'connfig.php';
session_start();
$outgoing_id = $_SESSION['unique_id'];
$search_term = $_POST['searchTerm'];
$search_term = trim($search_term);
$search_term = htmlspecialchars($search_term);

$output = "";
$sql = "SELECT * FROM users WHERE fname LIKE :search_term OR lname LIKE :search_term";
$stmt = $conn->prepare($sql);
$search_term = "%{$search_term}%";
$stmt->bindParam(':search_term', $search_term);
$stmt->execute();
$stmt = $conn->prepare($sql);
$stmt->bindParam(":search_term", $search_term);
$stmt->execute();

if ($stmt->rowCount() > 0) {
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    include_once "data.php";
} else {
    $output .= "No users are found related to your search term";
}

echo $output;

?>