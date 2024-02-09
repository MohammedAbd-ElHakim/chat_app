<?php
session_start();
if (isset($_SESSION['unique_id'])) {
    include_once 'connfig.php';
    $outgoing_id = $_POST['outgoind_id'];
    $incoming_id = $_POST['incoming_id'];
    $message = $_POST['message'];
    $output = '';

    $sql = "SELECT * FROM  messages WHERE outgoing_id = :outgoing_id AND incoming_id=:incoming_id OR 
        outgoing_id = :incoming_id AND incoming_id=:outgoing_id ORDER BY message_id";
    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':outgoing_id', $outgoing_id);
    $stmt->bindParam(':incoming_id', $incoming_id);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
            # code...
            if ($result['outgoing_id'] == $outgoing_id) { //if this is equal to then he is a msg sender
                $output .= '
                    <div class="chat outgoing">
                      <div class="details">
                         <p>
                         ' . $result['messages'] . '
                         </p>
                      </div>
                   </div>';
            } else { // he is message receiver
                $output .= '
                    <div class="chat incomig">
                      <img src="./img/download.jpeg" alt="">
                          <div class="details">
                              <p>
                                 ' . $result['messages'] . '
                              </p>
                          </div>
                   </div>';
            }
        }
    }
    echo $output;

} else {
    header('Location:../login.php');
    exit();
}

?>