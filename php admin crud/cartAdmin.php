<?php
session_start();

// Include your database connection code here
include 'config.php';

// Check if the 'add_to_cart' form is submitted
if (isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    $user_id = $_SESSION['admin_id'];

    // Check if the product is already in the user's cart
    $checkCartQuery = "SELECT * FROM cart WHERE admin_id = $admin_id AND product_id = $product_id";
    $checkCartResult = mysqli_query($conn, $checkCartQuery);

    if (mysqli_num_rows($checkCartResult) == 0) {
        // Add the product to the user's cart
        $addToCartQuery = "INSERT INTO cart (admin_id, product_id) VALUES ($user_id, $product_id)";
        mysqli_query($conn, $addToCartQuery);
        echo 'Product added to cart successfully.';
    } else {
        echo 'Product is already in the cart.';
    }
}

// Function to get user's cart items
function getUserCart($conn, $adminID)
{
    $sql = "SELECT products.* FROM cart
            INNER JOIN products ON cart.product_id = products.pid
            WHERE cart.admin_id = $adminID";
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

<body>

    <h2>Your Shopping Cart</h2>

    <?php
    $user_id = $_SESSION['admin_id'];
    $cartItems = getUserCart($conn, $user_id);

    if (!empty($cartItems)) {
        foreach ($cartItems as $item) {
            echo '<div>';
            echo '<img src="uploaded_img/' . $item['image'] . '" height="50" alt="Product Image">';
            echo '<span>' . $item['name'] . '</span>';
            echo '<span>' . $item['description'] . '</span>';

            echo '<span>Rs. ' . $item['price'] . '/-</span>';
            echo '</div>';
        }
    } else {
        echo '<p>Your cart is empty.</p>';
    }
    ?>

    <br>
    <a href="checkout.php">Proceed to Checkout</a>

</body>

</html>
