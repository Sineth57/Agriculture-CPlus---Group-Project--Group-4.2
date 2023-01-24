<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:login.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin page</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <link rel="shortcut icon" type="x-icon" href="logo.png">
    <link rel="stylesheet" href="css/style.css">

</head>

<body style="background-image: url('tea-plantations-fields-working-women-wallpaper.jpg');">

    <h1 class="title"> <span>admin</span> profile page </h1>
    <h5>Click 'Home' button to go to Home </h5>


    <section class="profile-container">

        <?php
        $select_profile = $conn->prepare('SELECT * FROM `users` WHERE id = ?');
        $select_profile->execute([$admin_id]);
        $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
        ?>

        <div class="profile">
            <img src="uploaded_img/<?= $fetch_profile['image'] ?>" alt="">
            <h3> Hello <?= $fetch_profile['name'] ?></h3>
            <a href="admin_profile_update.php" class="btn">update profile</a>
            <a href="logout.php" class="delete-btn">logout</a>
            <div class="flex-btn">


                <a href="php admin crud/database.php" class="btn">Item Informtion</a>

            </div>
            <br>
            <a href="site-home/index.php" class="option-btn">Go to Home</a>
        </div>

    </section>

</body>

</html>