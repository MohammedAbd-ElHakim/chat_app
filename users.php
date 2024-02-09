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
        <section class="users">
            <header>
                <?php
                $sql = "SELECT * FROM users WHERE unique_id = :unique_id";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam('unique_id', $_SESSION['unique_id']);
                $stmt->execute();
                if ($stmt->rowCount() > 0) { //if users credential mathed
                    $result = $stmt->fetch(PDO::FETCH_ASSOC);

                } else {
                }
                ?>
                <div class="content">
                    <img src="php/images/<?php echo $result['img'] ?>" alt="">
                    <div class="details">
                        <span>
                            <?php echo $result['fname'] . " " . $result['lname'] ?>
                        </span>
                        <p>
                            <?php echo $result['status'] ?>
                        </p>
                    </div>
                </div>
                <a href="php/logout.php?logout_id=<?php echo $result['unique_id']; ?>" class="logout">Logout</a>
            </header>
            <div class="search">
                <span class="text">select an user to start chat</span>
                <input type="text" placeholder="Enter name to search..">
                <button><i class="fas fa-search"></i></button>
            </div>
            <div class="users_list">
                <!-- <a href="#">
                    <div class="content">
                        <img src="./img/download.jpeg" alt="">
                        <div class="details">
                            <span>Coding Nepal</span>
                            <p>this is test message</p>
                        </div>
                    </div>
                    <div class="status_dot"><i class="fas fa-circle"></i></div>
                </a> -->
            </div>
        </section>
    </div>
    <script src="./js/users.js"></script>
</body>

</html>