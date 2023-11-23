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
      body {
    font-family: 'Arial', sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
}

.header {
    color: #333;
    text-align: center;
    padding: 20px;
    font-size: 36px;
    background-color: #fff;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.flex-box {
    display: flex;
    max-width: 1200px;
    margin: 40px auto;
    padding: 30px;
    background-color: #fff;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    border-radius: 15px;
    overflow: hidden;
}

.left {
    width: 50%;
    padding-right: 20px;
}

.big-img{
    width: 90%;
    border-radius: 15px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
}
.big-img img {
            width: 100%;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

.images {
    display: flex;
    justify-content: space-between;
    width: 90%;
    margin-top: 15px;
}

.small-img {
    width: 30%;
    overflow: hidden;
    border-radius: 15px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.small-img img {
    width: 100%;
    border-radius: 15px;
    cursor: pointer;
    transition: transform 0.3s ease;
}

.small-img1:hover img {
    transform: scale(1.2);
}

.right {
    width: 50%;
    flex-direction: column;
    justify-content: space-between;
}

.product-id,
.product-name,
.product-description,
.phone-number,
.product-price,
.product-address {
    padding: 7px;
    font-size: 18px;
    margin-bottom: 20px;
    background-color: #f9f9f9;
    border-radius: 15px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}
.product-name{
    font-size: 30px;
    text-align:center;
    font-weight: bold;
}
.product_name p {
    text-align:center;
}
.product-price p1 {
    color: #2ed32e;
}

.btn1 {
    padding: 15px;
    font-size: 18px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.btn1:hover {
    background-color: #0056b3;
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

    
<!-- 
    <div class="header">
        <h1><?php echo $row['name']; ?></h1>
    </div> -->
    <h1 class="title"> <span>user</span> profile page </h1>
  
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
                <p>Description: </p>
                <p><?php echo $row['description']; ?></p>
            </div>
            <div class="product-price">
                <p>Price: <p1>Rs. <?php echo $row['price']; ?>/-</p1> </p>
            </div>
            <div class="product-address">
                <p>Name and Address: </p>
                <p><?php echo $row['nameAddress']; ?></p>
            </div>
            <div class="phone-number">
                <p>Phone: <?php echo $row['pnumber']; ?></p>
            </div>
            <form method="POST" action="cart.php">
                            <input type="hidden" name="product_id" value="<?php echo $row['pid']; ?>">
                            <input type="submit" name="add_to_cart" value="Add to Cart" class="btn">
                        </form>
        </div>
    </div>

</body>

</html>
