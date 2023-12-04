<?php
session_start();

// Include configuration file
include 'config.php';

// Check whether the add_to_cart form is submitted
if (isset($_POST['add_to_cart'])) {

    if (!isset($_SESSION['user_id'])) {
        // User is not logged in, redirect to the login page
        header('Location: ../login1.php');
        exit();

    }
    $product_id = $_POST['product_id'];
    $user_id = $_SESSION['user_id'];

    // Check whether the product is already in the user's cart
    $checkCartQuery = "SELECT * FROM cart WHERE user_id = $user_id AND product_id = $product_id";
    $checkCartResult = mysqli_query($conn, $checkCartQuery);

    if (mysqli_num_rows($checkCartResult) == 0) {
        // Add the product to the user's cart
        $addToCartQuery = "INSERT INTO cart (user_id, product_id) VALUES ($user_id, $product_id)";
        mysqli_query($conn, $addToCartQuery);
        $message[] = 'Product added to cart successfully.';
    } else {
        $message[] =  'Product is already in the cart.';
    }
}

// Function to get user's cart items
function getUserCart($conn, $userId)
{
    $sql = "SELECT products.* FROM cart
            INNER JOIN products ON cart.product_id = products.pid
            WHERE cart.user_id = $userId";
    $result = mysqli_query($conn, $sql);

    if ($result === false) {
        die('Error executing query: ' . mysqli_error($conn));
    }

    $cartItems = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $cartItems[] = $row;
    }

    return $cartItems;
}

// Check whether the 'delete_cart_item' form is submitted
if (isset($_POST['delete_cart_item'])) {
    $cart_item_id = $_POST['cart_item_id'];

    // Delete the cart item from the database
    $deleteCartItemQuery = "DELETE FROM cart WHERE product_id = $cart_item_id";
    $deleteCartItemResult = mysqli_query($conn, $deleteCartItemQuery);

    if ($deleteCartItemResult) {
        $message[] = 'Product removed from the cart successfully.';
    } else {
        $message[] = 'Error removing product from the cart: ' . mysqli_error($conn);
    }
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="css/style.css"> 



</head>

<body style="background-image: url('B1.jpg');">
<!-- Top heading -->
<h1 class="title1"> <span>CPlus</span> <br>Cart products </h1>

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

        <a href="../user_page.php">
            <li>
                <div class="fab-icon-holder">
                    <i class="fas fa-user-circle"></i>
                </div>
                <span class="fab-label">Profile</span>
            </li>
        </a>
    </ul>
</div>

  <!-- Display messages -->
  <?php if (isset($message)) {
        foreach ($message as $message) {
            echo '<span class="message">' . $message . '</span>';
        }
    } ?>

<!-- <br><br><br> <br><br><br> -->
<!-- Table to display cart products -->
<div class="product-display">
    <br><br>
    <table class="product-display-table">
        <h2 class="seemore">My Cart</h2>
        <thead>
            <tr style="background-color: green; color:white">
                <th>Item ID</th>
                <th>product image</th>
                <th>product Name</th>
                <th>product description</th>
                <th>product price</th>
                <!-- <th>Contact</th> -->
                <th>Action</th>
            </tr>
        </thead>

        <?php
        // Getting user id from the session
        $user_id = $_SESSION['user_id'];
        $cartItems = getUserCart($conn, $user_id);

        // Adding products to the cart tables if those products are already in the cart
        if (!empty($cartItems)) {
            foreach ($cartItems as $item) {
                echo '<tr>';
                echo '<td>' . $item['pid'] . '</td>';
                echo '<td><img src="uploaded_img/' . $item['image'] . '" height="50" alt="Product Image"></td>';
                echo '<td>' . $item['name'] . '</span></td>';
                echo '<td>' . $item['description'] . '</span></td>';
                echo '<td>Rs. ' . $item['price'] . '/-</span></td>';
                echo '<td>';
                echo '<a href="userDetails.php?pid=' . $item['pid'] . '" class="btn">';
                echo '<i class="fas fa-edit"></i> More Details';
                echo '</a>';
                // echo '</td>';
                // echo '<td>';
                echo '<form method="post">';
                echo '<input type="hidden" name="cart_item_id" value="' . $item['pid'] . '">';
                echo '<input type="submit" class="btn" id="deleteItem" name="delete_cart_item" value="Delete">';
                echo '</form>';
                echo '</td>';
                echo '</tr>';
            }
        } else {
           
        //  echo 'Your cart is empty.';
        }
        ?>
    </table>
</div>


<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("deleteItem").addEventListener("click", function() {
            this.disabled = false;
           
        });
    });
</script>


</body>

</html>