<?php
session_start();
if (isset($_SESSION['unique_id'])) {
    header('Location: ../users.php');
}
include_once "header.php";
?>

<body>
    <div class="wrapper">
        <section class="form login">
            <header>
                RealTime Chat App
            </header>
            <form action="#">
                <div class="error_text"></div>
                <div class="field input">
                    <label>Email Address</label>
                    <input type="text" name="email" placeholder="Enter Your Email" required>
                </div>
                <div class="field input">
                    <label>Password</label>
                    <input type="text" name="password" placeholder="Enter Your Password" class="password" required>
                    <i class="fas fa-eye"></i>
                </div>
                <div class="field btn">
                    <input type="submit" value="Continue To Chat">
                </div>
            </form>
            <div class="link">Not yet signed up? <a href="index.php">signup now</a></div>
        </section>
    </div>
    <script src="./js/pass_show_hide.js"></script>
    <script src="./js/login.js"></script>
</body>

</html>