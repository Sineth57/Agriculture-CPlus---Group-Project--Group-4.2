<?php

include 'config.php';

session_start();

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);
    $pass = md5($_POST['pass']);
    $pass = filter_var($pass, FILTER_SANITIZE_STRING);

    $select = $conn->prepare(
        'SELECT * FROM `users` WHERE email = ? AND password = ?'
    );
    $select->execute([$email, $pass]);
    $row = $select->fetch(PDO::FETCH_ASSOC);

    if ($select->rowCount() > 0) {
        if ($row['user_type'] == 'admin') {
            $_SESSION['admin_id'] = $row['id'];
            header('location:admin_page.php');
        } elseif ($row['user_type'] == 'user') {
            $_SESSION['user_id'] = $row['id'];
            header('location:user_page.php');
        } else {
            $message[] = 'no user found!';
        }
    } else {
        $message[] = 'incorrect email or password!';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login1.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <title>Login landing page</title>
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
            <p class="title">Welcome back</p>
            <div class="separator"></div>
            <p class="welcome-message">Please, provide login credential to proceed and have access to all our services
            </p>

            <form action="" method="post" enctype="multipart/form-data" class="login-form">
                <div class="form-control">
                    <input type="email" required placeholder="Enter your email" class="box" name="email">
                    <i class="fas fa-user"></i>
                </div>
                <div class="form-control">
                    <input type="password" required placeholder="Enter your password" class="box" name="pass">
                    <i class="fas fa-lock"></i>
                </div>

                <button type="submit" value="login now" class="submit" name="submit">Login</button>
            </form>
            <p class="register">Don't have a account?</p>
            <a href="register1.php">Create account</a>
        </div>
    </section>

</body>

</html>