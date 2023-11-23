<?php
session_start();

// Include your database connection code here
include 'config.php';

// Check if the 'add_to_cart' form is submitted
if (isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    $user_id = $_SESSION['user_id'];

    // Check if the product is already in the user's cart
    $checkCartQuery = "SELECT * FROM cart WHERE user_id = $user_id AND product_id = $product_id";
    $checkCartResult = mysqli_query($conn, $checkCartQuery);

    if (mysqli_num_rows($checkCartResult) == 0) {
        // Add the product to the user's cart
        $addToCartQuery = "INSERT INTO cart (user_id, product_id) VALUES ($user_id, $product_id)";
        mysqli_query($conn, $addToCartQuery);
        echo 'Product added to cart successfully.';
    } else {
        echo 'Product is already in the cart.';
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

// Check if the 'delete_cart_item' form is submitted
if (isset($_POST['delete_cart_item'])) {
    $cart_item_id = $_POST['cart_item_id'];
    $deleteCartItemQuery = "DELETE FROM cart WHERE pid = $cart_item_id";
    mysqli_query($conn, $deleteCartItemQuery);
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

<br><br><br> <br><br><br>

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
                <th>Contact</th>
                <th>Action</th>
            </tr>
        </thead>

        <?php
        $user_id = $_SESSION['user_id'];
        $cartItems = getUserCart($conn, $user_id);

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
                echo '<i class="fas fa-edit"></i> Contact';
                echo '</a>';
                echo '</td>';
                echo '<td>';
                echo '<form method="post">';
                echo '<input type="hidden" name="cart_item_id" value="' . $item['pid'] . '">';
                echo '<input type="submit" class="btn" name="delete_cart_item" value="Delete">';
                echo '</form>';
                echo '</td>';
                echo '</tr>';
            }
        } else {
            echo '<p>Your cart is empty.</p>';
        }
        ?>
    </table>
</div>

<br>
<!-- <a href="checkout.php">Proceed to Checkout</a> -->
</body>

</html>
