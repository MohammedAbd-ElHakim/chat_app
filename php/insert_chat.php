<?php
session_start();
if (isset($_SESSION['unique_id'])) {
    include_once 'connfig.php';
    $outgoing_id = $_POST['outgoind_id'];
    $incoming_id = $_POST['incoming_id'];
    $message = $_POST['message'];

    if (!empty($message)) {
        $sql = "INSERT INTO messages (outgoing_id, incoming_id, messages) VALUES (:outgoing_id,:incoming_id,:message)";
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':outgoing_id', $outgoing_id);
        $stmt->bindParam(':incoming_id', $incoming_id);
        $stmt->bindParam(':message', $message);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            echo "success to save messages";

        } else {
            echo "something went wrong cant save message!";
        }
    }

} else {
    header('Location:../login.php');
    exit();
}

?>