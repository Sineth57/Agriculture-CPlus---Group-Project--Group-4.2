<?php

// Include configuration file
include 'config.php';

// Check whether the form is submitted
if (isset($_POST['send_notification'])) {
    $message = $_POST['message'];

    // Fetch all user IDs from the users table
    $fetch_user_ids = $conn->query('SELECT id FROM users');
    $user_ids = $fetch_user_ids->fetchAll(PDO::FETCH_COLUMN);

    $fetch_admin_ids = $conn->query('SELECT id FROM users');
    $admin_ids = $fetch_admin_ids->fetchAll(PDO::FETCH_COLUMN);

    // Insert a new notification for each user
    foreach ($user_ids as $user_id ) {
        // Insert a new notification into the database
        $insert_notification = $conn->prepare('INSERT INTO notifications (user_id, message) VALUES (?, ?)');
        $insert_notification->execute([$user_id, $message]);
    }
}
?>

<?php
include 'config.php';

// Check whether the form is submitted
if (isset($_POST['send_notificationOne'])) {
    $user_id = $_POST['user_id'];
    $message = $_POST['message'];

    // Insert a new notification into the database
    $insert_notification = $conn->prepare('INSERT INTO notifications (user_id, message) VALUES (?, ?)');
    $insert_notification->execute([$user_id, $message]);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send Notifications</title>
    <link rel="stylesheet" href="css/sendingNotification.css"> 
    <link rel="shortcut icon" type="x-icon" href="logo.png">
  

<body style="background-image: url('B1.jpg');">

<h1 class="title"> <span>Admins Dashboard: </span> Manage Notifications </h1>

    <div class="container">
        <h2>Send Notifications</h2>

        <!-- Form for sending notifications to all users -->
        <form action="" method="post">
            <label for="message">Message:</label>
            <textarea name="message" required></textarea>

            <input type="submit" name="send_notification" value="Send Notification to All Users">
        </form>

        <!-- Form for sending notifications to a specific user -->
        <form action="" method="post">
            <label for="user_id">User ID:</label>
            <input type="text" name="user_id" required>

            <label for="message">Message:</label>
            <textarea name="message" required></textarea>

            <input type="submit" name="send_notificationOne" value="Send Notification">
        </form>
    </div>

</body>

</html>
