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
        }

        .header {
            color: #000000;
            text-align: center;
            padding: 10px;
            font-size: 24px;
            letter-spacing: 1px;
        }

        .flex-box {
            display: flex;
            max-width: 1400px;
            margin: 40px auto;
            padding: 20px;
            background-color: #f1eeee;
            box-shadow: 0 0 10px rgba(102, 102, 102, 0.5);
            min-height: 400px;
            border: 2px solid silver;
            border-radius: 10px;
        }

        .left {
            width: 40%;
            padding-right: 20px;
        }

        .big-img {
            width: 450px;
            border: 0.5px solid black;
        }

        .big-img img {
            width: inherit;
        }

        .images {
            display: flex;
            justify-content: space-between;
            width: 60%;
            margin-left: 70px;
            margin-top: 15px;
        }

        .small-img {
            width: 80px;
            overflow: hidden;
            border: 0.5px solid black;
        }

        .small-img img {
            width: inherit;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .small-img:hover img {
            transform: scale(1.2);
        }

        .right {
            width: 60%;
            flex-direction: column;
            justify-content: space-between;
        }

        .product-id, .product-name, .product-description, .phone-number, .product-price, .product-address {
            padding: 10px;
            font-size: 24px;
            margin-bottom: 25px;
        }

        .product-price p1 {
            color: rgb(46, 211, 46);
        }
        


        @media (max-width: 768px) {
            .flex-box {
                flex-direction: column;
            }

            .left,
            .right {
                width: 100%;
            }

            .images {
                width: 100%;
                margin-left: 0;
                justify-content: center;
            }

            .big-img {
                margin: 0 auto;
                text-align: center;
            }
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

    <div class="header">
        <h1><?php echo $row['name']; ?></h1>
    </div>

  
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
            <!-- <div class="product-name">
                <p>Product Name: <?php echo $row['name']; ?></p>
            </div> -->
            <div class="product-id">
                <p>Product ID: <?php echo $row['pid']; ?></p>
            </div>
            <div class="product-description">
                <p>Description: <?php echo $row['description']; ?></p>
            </div>
            <div class="product-price">
                <p>Price: <p1>Rs. <?php echo $row['price']; ?>/-</p1> </p>
            </div>
            <div class="product-address">
                <p>Name and Address: <?php echo $row['nameAddress']; ?></p>
            </div>
            <div class="phone-number">
                <p>Phone: <?php echo $row['pnumber']; ?></p>
            </div>
        </div>
    </div>

</body>

</html>
