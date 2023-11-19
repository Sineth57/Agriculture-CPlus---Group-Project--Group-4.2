<?php
session_start();

include 'config.php';

// Check if the product ID is provided in the URL
if (isset($_GET['pid'])) {
    $productID = $_GET['pid'];

    // Query to retrieve product details based on the provided product ID
    $sql = "SELECT * FROM products WHERE pid = $productID";
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

    <style>
.flex-box {
    display: flex;
    max-width: 1400px;
    margin: 40px auto;
    padding: 20px;
    background-color: #f1eeee;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    min-height: 400px;
    border: 2px solid silver;
    border-radius: 10px;
}

.left {
    width: 40%;
    padding-right: 20px;
}

.product-image img {
    width: 100%;
    height: auto;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    flex-grow: 1;
}


.right {
    width: 60%;
    flex-direction: column;
    justify-content: space-between;
}

.product-id, .product-name, .product-description, .phone-number, .product-price {
    padding: 10px;
    font-size: 18px;
    margin-bottom: 25px;
}
    </style>

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

    <br><br><br> <br><br><br> <br><br><br> <br><br><br>

  
    <div class="flex-box">
        
        <div class="left">
            <div class="product-image">
                <img src="uploaded_img/<?php echo $row['image']; ?>" alt="Product Image">
            </div>
            
        </div>
        <div class="right">
            <div class="product-id">
                <p>Product ID: <?php echo $row['pid']; ?></p>
            </div>
            <div class="product-name">
                <p>Product Name: <?php echo $row['name']; ?></p>
            </div>
            <div class="product-description">
                <p>Description: <?php echo $row['description']; ?></p>
            </div>
            <div class="product-price">
                <p>Price: Rs. <?php echo $row['price']; ?>/-</p>
            </div>
            <div class="phone-number">
                <p>Phone: <?php echo $row['pnumber']; ?></p>
            </div>
        </div>
    </div>

</body>

</html>
