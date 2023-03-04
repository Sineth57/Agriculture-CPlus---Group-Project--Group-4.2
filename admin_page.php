<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:login1.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin Page</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <link rel="shortcut icon" type="x-icon" href="logo.png">
    <link rel="stylesheet" href="css/style.css">

</head>

<body style="background-image: url('B1.jpg');">

    <h1 class="title"> <span>admin</span> profile page </h1>

    <div class="fab-container">
        <div class="fab fab-icon-holder">
            <i class="fa fa-bars"></i>
        </div>

        <ul class="fab-options">

            <a href="/site-home/index.php/#home">
                <li>

                    <div class="fab-icon-holder">
                        <i class="fas fa-home"></i>
                    </div>

                    <span class="fab-label">Home</span>

                </li>
            </a>

            <a href="/site-home/#service">
                <li>
                    <div class="fab-icon-holder">
                        <i class="fas fa-book" aria-hidden="true"></i>
                    </div>
                    <span class="fab-label">Service</span>
                </li>
            </a>

            <a href="/site-home/#contact">
                <li>
                    <div class="fab-icon-holder">
                        <i class="fas fa-comments"></i>
                    </div>
                    <span class="fab-label">Contacts</span>
                </li>
            </a>

            <a href="">
                <li>
                    <div class="fab-icon-holder">
                        <i class="fas fa-user-circle"></i>
                    </div>
                    <span class="fab-label">Profile</span>
                </li>
            </a>

        </ul>
    </div>


    <section class="profile-container">

        <?php
        $select_profile = $conn->prepare('SELECT * FROM `users` WHERE id = ?');
        $select_profile->execute([$admin_id]);
        $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
        ?>

        <div class="profile">
            <img src="uploaded_img/<?= $fetch_profile['image'] ?>" alt="">
            <h3>User ID: <?= $fetch_profile['id'] ?></h3>
            <h3>Name: <?= $fetch_profile['name'] ?></h3>
            <a href="admin_profile_update.php" class="btn">Update profile</a>
            <a href="logout.php" class="delete-btn">Logout</a>
            <div class="flex-btn">

                <a href="userdb.php" class="btn">Registered User Details</a>

                <a href="php admin crud/database.php" class="btn">User Listning Requests</a>

            </div>
            <br>
            <a href="site-home/index.php" class="option-btn">Go to Home</a>
        </div>

    </section>

</body>

</html>