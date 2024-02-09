<?php
include_once "header.php";
session_start();
if (isset($_SESSION['unique_id'])) {
    header('Location: users.php');
}
?>

<body>
    <div class="wrapper">
        <section class="form signup">
            <header>
                RealTime Chat App
            </header>
            <form action="#" enctype="multipart/form-data">
                <div class="error_text"></div>
                <div class="name_details">
                    <div class="field input">
                        <label>First Name</label>
                        <input type="text" name='fname' placeholder="First Name" required>
                    </div>
                    <div class="field input">
                        <label>Last Name</label>
                        <input type="text" name='lname' placeholder="Last Name" required>
                    </div>
                </div>
                <div class="field input">
                    <label>Email Address</label>
                    <input type="text" name='email' placeholder="Enter Your Email" required>
                </div>
                <div class="field input">
                    <label>Password</label>
                    <input type="password" name='password' placeholder="Enter new Password" class="password" required>
                    <i class="fas fa-eye"></i>
                </div>
                <div class="field image">
                    <label>Select Image</label>
                    <!-- <input type="file" name='image[]' required> -->
                    <input type="file" name="image" required>
                </div>
                <div class="field btn">
                    <input type="submit" value="Continue To Chat">
                </div>
            </form>
            <div class="link">Already signed up? <a href="login.php">Login now</a></div>
        </section>
    </div>
    <script src="./js/pass_show_hide.js"></script>
    <script src="./js/signup.js"></script>
</body>

</html>