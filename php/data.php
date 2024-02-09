<?php
include_once 'connfig.php';
while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
   # code...

   $sql = "SELECT * FROM messages
   WHERE (incoming_id = :unique_id OR outgoing_id = :unique_id)
   ORDER BY message_id DESC
   LIMIT 1";
   $stmt2 = $conn->prepare($sql);

   $stmt2->bindParam(':outgoing_id', $_SESSION['unique_id']);
   $stmt2->bindParam(':unique_id', $result['unique_id']);
   $stmt2->execute();

   if ($stmt2->rowCount() > 0) {
      $result2 = $stmt2->fetch(PDO::FETCH_ASSOC);
      $row = $result2['messages'];
   } else {
      $row = "No Messages available";
   }

   // trimming msg if word are more than 28
   (strlen($row) > 28) ? $msg = substr($row, 0, 28) : $msg = $row;
   ($_SESSION['unique_id'] == $result2['outgoing_id']) ? $you = "You: " : $you = "";

   ($result['status'] == "offline_now") ? $offline = "offline" : $offline = " ";
   $output .= '  
        <a href=chat.php?user_id=' . $result["unique_id"] . '>
          <div class="content">
             <img src=php/images/' . $result["img"] . ' >
               <div class="details">
                   <span>' . $result['fname'] . " " . $result['lname'] . '</span>
                   <p>' . $you . $row . '</p>
                </div>
             </div>
           <div class="status_dot ' . $offline . '"><i class="fas fa-circle"></i></div>
        </a>';
}


?>