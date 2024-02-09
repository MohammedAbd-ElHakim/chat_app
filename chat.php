<?php
include_once "header.php";
include_once 'php/connfig.php';

session_start();
if (!isset($_SESSION['unique_id'])) {
    header('Location:login.php');
}

?>

<body>
    <div class="wrapper">
        <section class="chat_area">
            <header>
                <?php
                $user_id = $_GET['user_id'];
                $sql = "SELECT * FROM users WHERE unique_id = :user_id";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam('user_id', $user_id);
                $stmt->execute();
                if ($stmt->rowCount() > 0) { //if users credential mathed
                    $result = $stmt->fetch(PDO::FETCH_ASSOC);

                    ?>
                    <a href="users.php" class="back_icon"><i class="fas fa-arrow-left"></i></a>
                    <img src="php/images/<?php echo $result["img"]; ?>" alt="">
                    <div class="details">
                        <span>
                            <?php echo $result['fname'] . " " . $result['lname'] ?>
                        </span>
                        <p>
                            <?php echo $result['status'] ?>
                        </p>
                    </div>
                    <?php

                } else {
                }
                ?>
            </header>
            <!-- شات -->
            <div class="chat_box">
                <!-- out -->
                <!-- <div class="chat outgoing">
                    <div class="details">
                        <p>
                            Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                        </p>
                    </div>
                </div> -->
                <!-- in -->
                <!-- <div class="chat incomig">
                    <img src="./img/download.jpeg" alt="">
                    <div class="details">
                        <p>
                            Lorem ipsum dolor sit amet
                            consectetur adipisicing elit.
                        </p>
                    </div>
                </div> -->
            </div>
            <form action="#" class="typing_area" autocomplete="off">
                <input type="text" name="outgoind_id" value="<?php echo $_SESSION['unique_id']; ?>" hidden>
                <input type="text" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
                <input type="text" name="message" class='input_field' placeholder="Type a message here...">
                <button><i class="fab fa-telegram-plane"></i></button>
            </form>
        </section>
    </div>
    <script src="js/chat.js"></script>
</body>

</html>