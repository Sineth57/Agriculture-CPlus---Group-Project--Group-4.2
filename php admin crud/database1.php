<?php
@include 'config.php';

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM products WHERE id = $id");
    header('location:admin_page.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">


    <link rel="shortcut icon" type="x-icon" href="logo.png">
    <link rel="stylesheet" href="css/style.css">


    <title>Database</title>
</head>

<body style="background-image: url('B1.jpg');">

    <div class="fab-container">
        <div class="fab fab-icon-holder">
            <i class="fa fa-bars"></i>
        </div>

        <ul class="fab-options">

            <a href="../site-home/#home">
                <li>

                    <div class="fab-icon-holder">
                        <i class="fas fa-home"></i>
                    </div>

                    <span class="fab-label">Home</span>

                </li>
            </a>

            <a href="../site-home/#service">
                <li>
                    <div class="fab-icon-holder">
                        <i class="fas fa-book" aria-hidden="true"></i>
                    </div>
                    <span class="fab-label">Service</span>
                </li>
            </a>

            <a href="../site-home/#contact">
                <li>
                    <div class="fab-icon-holder">
                        <i class="fas fa-comments"></i>
                    </div>
                    <span class="fab-label">Contacts</span>
                </li>
            </a>

            <a href="../site-home/#profile">
                <li>
                    <div class="fab-icon-holder">
                        <i class="fas fa-user-circle"></i>
                    </div>
                    <span class="fab-label">Profile</span>
                </li>
            </a>

        </ul>
    </div>



    <?php $select = mysqli_query($conn, 'SELECT * FROM products'); ?>
    <div class="product-display">
        <table class="product-display-table">
            <thead>
                <tr style="background-color: green; color:white">
                    <th>Item ID</th>
                    <th>product image</th>
                    <th>User ID</th>
                    <th>product name</th>
                    <th>product price</th>
                    <th>product description</th>
                    <th>phone number</th>

                </tr>
            </thead>
            <?php while ($row = mysqli_fetch_assoc($select)) { ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><img src="uploaded_img/<?php echo $row[
                    'image'
                ]; ?>" height="100" alt=""></td>
                <td><?php echo $row['userid']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td>Rs.<?php echo $row['price']; ?>/-</td>
                <td><?php echo $row['description']; ?></td>
                <td><?php echo $row['pnumber']; ?></td>


            </tr>
            <?php } ?>
        </table>
    </div>
</body>

</html>