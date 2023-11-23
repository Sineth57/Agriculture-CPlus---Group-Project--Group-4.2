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
    <link rel="stylesheet" href="css/product.css">

    <title>CPlus Products</title>
</head>

<body style="background-image: url('B1.jpg');">

<h1 class="title1"> <span><?php echo $row['name']; ?></span> <br>product details </h1>

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

    
<!-- 
    <div class="header">
        <h1><?php echo $row['name']; ?></h1>
    </div> -->
    
  
    <div class="flex-box">
        
        <div class="left">
            <div class="big-img">
                <img src="uploaded_img/<?php echo $row['image']; ?>" alt="Product Image">
            </div>
            <div class="images">
                <div class="small-img">
                    <img src="uploaded_img/<?php echo $row['image']; ?>" alt="Product Image" onclick="showImg(this.src);">
                </div>
                <div class="small-img">
                    <img src="uploaded_img/<?php echo $row['image2']; ?>" alt="Product Image" onclick="showImg(this.src);">
                </div>
                <div class="small-img">
                    <img src="uploaded_img/<?php echo $row['image3']; ?>" alt="Product Image" onclick="showImg(this.src);">
                </div>
            </div> 
        </div>

        <script>
            let bigImg = document.querySelector('.big-img img');
            function showImg(pic){
                bigImg.src = pic;
            }
        </script>

        <div class="right">
            <div class="product-name">
                <p><?php echo $row['name']; ?></p>
            </div>
            <div class="product-id">
                <p>Product ID: <?php echo $row['pid']; ?></p>
            </div>
            <div class="product-description">
                <p class="desp">Description: </p>
                <p class="desd"><?php echo $row['description']; ?></p>
            </div>
            <div class="product-address">
                <p class="desp">Name and Address: </p>
                <p class="desd"><?php echo $row['nameAddress']; ?></p>
            </div>
            <div class="product-price">
              <p1>Rs. <?php echo $row['price']; ?>/-</p1> 
            </div>
            <div class="phone-number">
                <p>Phone:  <?php echo $row['pnumber']; ?></p>
            </div>
            <form method="POST" action="cart.php">
                            <input type="hidden" name="product_id" value="<?php echo $row['pid']; ?>">
                            <input type="submit" name="add_to_cart" value="Add to Cart" class="btn">
                        </form>
        </div>
    </div>

</body>

</html>
