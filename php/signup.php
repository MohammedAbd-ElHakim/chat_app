<?php
session_start();
include_once 'connfig.php';
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$password = $_POST['password'];

// $fname = trim($fname);
// $lname = trim($lname);
// $email = trim($email);
// $password = trim($password);
// // تطهير البيانات المدخلة من الأحرف الخاصة
// $fname = htmlspecialchars($fname);
// $lname = htmlspecialchars($lname);
// $email = htmlspecialchars($email);
// $password = htmlspecialchars($password);

if (isset($_FILES['image'])) {
    $image = $_FILES['image'];
} else {
    die("choose image is reqired");
}


if (!empty($fname) && !empty($lname) && !empty($email) && !empty($password) && !empty($image)) {
    // lets check user email
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) { //if email is valid
        //lets check that email is already exist in the database or not
        // استخدم bindParam لتعيين قيم البارامترات بدلاً من mysqli_real_escape_string
        $stmt = $conn->prepare("SELECT email FROM users WHERE email =:email");
        // $stmt->bindParam(':fname', $fname);
        // $stmt->bindParam(':lname', $lname);
        $stmt->bindParam(':email', $email);
        // $stmt->bindParam(':password', $password);
        // $stmt->bindParam(':image', $image);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            echo "Email already exists";
        } else {
            // يمكنك استمرار العمل هنا إذا لم يتم العثور على سجلات متطابقة
            if (isset($_FILES['image'])) {
                $img_name = $_FILES['image']['name']; //getting user uploaded img name
                $tmp_name = $_FILES['image']['tmp_name']; //this temprory name is used to save/move file in our folder
                $img_type = $_FILES['image']['type']; //getting upload image type

                //lets explode image and get the last extension like jpg png
                $img_explode = explode('.', $img_name);

                $img_ext = end($img_explode); //these are some valid img ext and we have store them in array

                $extention = ['pmg', "jpeg", "jpg"];
                if (in_array($img_ext, $extention)) {
                    $time = time(); //this will return us current time
                    //we need this time because when you uploading user img to in our folder we rename user file with current time
                    //so all the img file will have a unique name
                    //lets move the user uploaded img to our particular folder
                    $new_img_name = $time . $img_name;
                    if (move_uploaded_file($tmp_name, "images/" . $new_img_name)) { //if user upload img move to our folder succefully
                        $status = "Active now"; //once user signed up then his status will be active now)
                        $random_id = rand(time(), 10000000); //creating random id for user

                        //lets insert all user data inside table

                        $sql2 = "INSERT INTO users (`unique_id`,`fname`,`lname`,`email`,`password`,`img`,`status`) VALUE (:random_id, :fname,:lname,:email,:password,:new_img_name,:status)";

                        $stmt = $conn->prepare($sql2);
                        $stmt->bindParam(':random_id', $random_id);
                        $stmt->bindParam(':fname', $fname);
                        $stmt->bindParam(':lname', $lname);
                        $stmt->bindParam(':email', $email);
                        $stmt->bindParam(':password', $password);
                        $stmt->bindParam(':new_img_name', $new_img_name);
                        $stmt->bindParam(':status', $status);
                        if ($stmt->execute()) {
                            $stmt = $conn->prepare("SELECT * FROM users WHERE email =:email");
                            $stmt->bindParam(':email', $email);
                            $stmt->execute();
                            if ($stmt->rowCount() > 0) {
                                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                                $_SESSION['unique_id'] = $result['unique_id']; //using this session we used user unique_id in other php file 
                                echo "success";
                            }
                        } else {
                            echo "something went wrong!";
                        }
                    }

                } else {
                    echo "please select an image file! - jpeg, jpg, png";
                }
            }
        }

    } else {
        echo $email . 'this is not valid email';
    }
} else {
    echo "All Input field are required!";
}


?>