<?php
session_start();
// Include your database connection code here
include 'config.php';

// Check if the product ID is provided in the URL
if (isset($_GET['id'])) {
    $productID = $_GET['id'];

    // Query to retrieve product details based on the provided product ID
    $sql = "SELECT * FROM products WHERE id = $productID";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        // Check if a product with the given ID exists
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
        } else {
            echo 'Product not found.';
        }
    } else {
        echo 'Error fetching product details: ' . mysqli_error($conn);
    }
} else {
    echo 'Product ID not provided.';
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

    <title>CPlus Products</title>
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

    <br><br><br>

    <div class="product-display">
        <h2>Product Details</h2>
        <table class="product-details-table">
            <tr>
                <th>Item ID</th>
                <td><?php echo $row['id']; ?></td>
            </tr>
            <tr>
                <th>Product Image</th>
                <td><img src="uploaded_img/<?php echo $row[
                    'image'
                ]; ?>" height="100" alt=""></td>
            </tr>
            <tr>
                <th>Product Name</th>
                <td><?php echo $row['name']; ?></td>
            </tr>
            <tr>
                <th>Product Price</th>
                <td>Rs. <?php echo $row['price']; ?>/-</td>
            </tr>
            <tr>
                <th>Product Description</th>
                <td><?php echo $row['description']; ?></td>
            </tr>
            <tr>
                <th>Phone Number</th>
                <td><?php echo $row['pnumber']; ?></td>
            </tr>
            <tr>
                <th>Contact</th>
                <td>
                    <!-- Add any contact details or button here -->
                </td>
            </tr>
        </table>
    </div>

</body>

</html>
<?php

// Closing the database connection
mysqli_close($conn);
?>