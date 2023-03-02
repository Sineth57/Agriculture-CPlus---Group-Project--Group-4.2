<?php

include 'config.php';

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);
    $pass = md5($_POST['pass']);
    $pass = filter_var($pass, FILTER_SANITIZE_STRING);
    $cpass = md5($_POST['cpass']);
    $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

    $image = $_FILES['image']['name'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_size = $_FILES['image']['size'];
    $image_folder = 'uploaded_img/' . $image;

    $select = $conn->prepare('SELECT * FROM `users` WHERE email = ?');
    $select->execute([$email]);

    if ($select->rowCount() > 0) {
        $message[] = 'user already exist!';
    } else {
        if ($pass != $cpass) {
            $message[] = 'confirm password not matched!';
        } elseif ($image_size > 2000000) {
            $message[] = 'image size is too large!';
        } else {
            $insert = $conn->prepare(
                'INSERT INTO `users`(name, email, password, image) VALUES(?,?,?,?)'
            );
            $insert->execute([$name, $email, $cpass, $image]);
            if ($insert) {
                move_uploaded_file($image_tmp_name, $image_folder);
                $message[] = 'registered succesfully!';
                header('location:login1.php');
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="register1.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <title>Register page</title>
</head>

<body>

    <?php if (isset($message)) {
        foreach ($message as $message) {
            echo '
         <div class="message">
            <span>' .
                $message .
                '</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
         </div>
         ';
        }
    } ?>


    <section class="side">
        <img src="./img/img.svg" alt="">
    </section>

    <section class="main">
        <div class="login-container">
            <p class="title">Register Now</p>
            <div class="separator"></div>
            <p class="welcome-message">Please, fill in the infomation asked below to proceed and have access to all our
                services</p>

            <form action="" method="post" enctype="multipart/form-data" class="login-form">
                <div class="form-control">
                    <input type="text" required placeholder="Enter your username" class="box" name="name">
                    <i class="fas fa-user"></i>
                </div>
                <div class="form-control">
                    <input type="email" required placeholder="Enter your email" class="box" name="email">
                    <i class="fas fa-user"></i>
                </div>
                <div class="form-control">
                    <input type="password" required placeholder="Enter your password" class="box" name="pass">
                    <i class="fas fa-lock"></i>
                </div>
                <div class="form-control">
                    <input type="password" required placeholder="Confirm your password" class="box" name="cpass">
                    <i class="fas fa-lock"></i>
                </div>
                <!--  <div class="form-control">
                    <input type="number" placeholder="Enter your Contact number">
                    <i class="fas fa-user"></i>
                </div> -->

                <div class="form-control">
                    <input type="file" name="image" required class="box" accept="image/jpg, image/png, image/jpeg">
                    <i class="fas fa-user"></i>
                </div>

                <button type="submit" value="" class="submit" name="submit">Submit</button>
            </form>
            <p class="register">Already have a account?</p>
            <a href="login1.php">Login to your account</a>
        </div>
    </section>

</body>

</html>