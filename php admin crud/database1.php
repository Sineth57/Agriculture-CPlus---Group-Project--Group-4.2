<?php
@include 'config.php';

// Check if the 'delete' parameter is set in the URL
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    // Use prepared statement to prevent SQL injection
    $deleteStmt = $conn->prepare("DELETE FROM products WHERE pid = ?");
    $deleteStmt->bind_param("i", $id);
    
    if ($deleteStmt->execute()) {
        // Successful deletion
        header('location:admin_page.php');
    } else {
        // Error in deletion
        echo 'Error deleting product: ' . $deleteStmt->error;
    }

    // Close the prepared statement
    $deleteStmt->close();
}

// Retrieve search query from the search bar
if (isset($_POST['submit'])) {
    $search = $_POST['search'];
    
    // Search for data that matches the search query by id or name
    $sql = "SELECT * FROM products WHERE pid LIKE '%$search%' OR name LIKE '%$search%'";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        // Display the SQL query error and stop the script
        die('Error in SQL query: ' . mysqli_error($conn));
    }
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

    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .search-container {
            text-align: center;
            padding: 20px;
        }

        .search-bar {
            width: 70%;
            max-width: 800px;
            padding: 10px;
            border: 2px solid #ccc;
            border-radius: 5px;
            margin-right: 10px;
            box-sizing: border-box;
        }

        .search-button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            box-sizing: border-box;
            transition: background-color 0.3s ease;
        }

        .search-button:hover {
            background-color: #45a049;
        }

        .product-card {
            display: flex;
            max-width: 1250px;
            margin: 20px auto;
            padding: 5px;
            background-color: #f1eeee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            /* min-height: 100px; */
            border: 1px solid gray;
            border-radius: 10px;
            overflow: hidden;
            transition: transform 0.3s ease;

            
        }
        
        .product-card:hover {
            transform: scale(1.05);
        }
        
        .product-image {
            width: 40%;
            padding-right: 10px;
        }
        
        .product-image img {
            width: 60%;
            height: auto;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            flex-grow: 1;
        }
        
        .product-details {
            width: 60%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 10px;
        }
        
        .product-details h3 {
            margin: 0;
            font-size: 18px;
        }
        
        .product-details p {
            margin-bottom: 15px;
            font-size: 14px;
        }
        
        .product-price {
            color: #4CAF50;
            font-weight: bold;
        }
        
        .contact-button {
            display: inline-block;
            font-size: 18px;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            text-align:center;
        }
        
        .contact-button:hover {
            background-color: #45a049;
        }

        .flex-container {
            display: flex;
            flex-wrap: wrap;
            /* justify-content: space-between; */
            
        }

        .flex-box {
            display: flex;
            width: 45%;
            max-width: 1250px;
            margin: 20px auto;
            margin-bottom: 20px;
            padding: 10px;
            background-color: #f1eeee;
            /* box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            box-sizing: border-box;
            min-height: 300px;
            /* border: 4px solid green; */
            border-radius: 10px;
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        .flex-box:hover {
            transform: scale(1.05);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }
        
        .left {
            width: 40%;
            padding-right: 10px;
        }
        
        .flex-container .pro-image img {
            max-width: 100%;
            max-height: 100%;
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
            margin-bottom: px;
        }
        .product-name{
            font-size:25px;
            color: green;
            font-weight: bold;
            margin-top: 5px;
        }
        .product-description{
            font-size:15px;
            color: gray;
            margin-top: 5px;
        }

        @media screen and (max-width: 600px) {
            .search-bar,
            .search-button {
                width: 100%;
                margin-right: 0;
            }
        }

        @media screen and (max-width: 768px) {
            .flex-box {
                width: 100%;
            }
        }
    </style>

</head>

<body style="background-image: url('B1.jpg');">
    <div>
        <a href="database2.php" type="button" class="btn2">Edit your product</a>
    </div>

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
        <div class="search-container">
            <form action="" method="POST">
                <input class="search-bar" type="text" name="search" placeholder="Search products...">
                <input class="search-button" type="submit" name="submit" value="Search">
            </form>
        </div>

      

        <?php
        if (isset($_POST['submit'])) {
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<div class="product-card">';
                    echo '<div class="product-image">';
                    echo "<img src='uploaded_img/" . $row['image'] . "' alt='Product Image'>";
                    echo '</div>';
                    echo '<div class="product-details">';
                    echo '<h3>Product Name: ' . $row['name'] . '</h3>';
                    echo '<p><strong>Item ID:</strong> ' . $row['pid'] . '</p>';
                    echo '<p><strong>Price:</strong> Rs. ' . $row['price'] . '/-</p>';
                    echo '<p><strong>Description:</strong> ' . $row['description'] . '</p>';
                    echo '<a href="userDetails.php?pid=' . $row['pid'] . '" class="contact-button">';
                    echo '<i class="fas fa-edit"></i> Contact';
                    echo '</a>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo 'No results found.';
            }
        }
        ?>
        
    </div>

    <br><br>

    <?php $select = mysqli_query($conn, 'SELECT * FROM products'); ?>
    <div class="product-display">
        <h2 class="seemore">See newly listed products</h2>

        <br>

        <div class="flex-container">
        
            <?php while ($row = mysqli_fetch_assoc($select)) { ?>
            
                <div class="flex-box">
                    <div class="left">
                        <div class="pro-image">
                            <img src="uploaded_img/<?php echo $row['image']; ?>" alt="Product Image">
                        </div>
                        
                    </div>
                    <div class="right">
                        <div class="product-name">
                            <p> <?php echo $row['name']; ?></p>
                        </div>
                        <div class="product-description">
                            <p>Description: <?php echo $row['description']; ?></p>
                        </div>
                        <div class="product-price">
                            <p>Price: Rs. <?php echo $row['price']; ?>/-</p>
                        </div>
                        <div class="button"><a href="userDetails.php?pid=<?php echo $row['pid']; ?>" class="btn">
                            <i class="fas fa-edit"></i> Contact
                        </a></div>
                        <form method="POST" action="cart.php">
                            <input type="hidden" name="product_id" value="<?php echo $row['pid']; ?>">
                            <input type="submit" name="add_to_cart" value="Add to Cart" class="btn">
                        </form>
                    </div>
                </div>
            <?php } ?>
    </div>
</body>

</html>
