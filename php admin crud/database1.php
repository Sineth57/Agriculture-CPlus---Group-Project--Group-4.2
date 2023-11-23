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
    <link rel="stylesheet" href="css/database1.css">
    <title>CPlus Products</title>

   
</head>

<body style="background-image: url('B1.jpg');">
    <!-- <div>
        <a href="database2.php" type="button" class="btn2">Edit your product</a>
    </div> -->

    <h1 class="title1"> <span>CPlus</span> <br>product list </h1>
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

    <br><br>
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
                    echo '<h3> ' . $row['name'] . '</h3>';
                    // echo '<p><strong>Item ID:</strong> ' . $row['pid'] . '</p>';
                    echo '<p><strong>Description:</strong> ' . $row['description'] . '</p>';
                    echo '<p><strong>Price:</strong> Rs. ' . $row['price'] . '/-</p>';
                    echo '<a href="userDetails.php?pid=' . $row['pid'] . '" class="contact-button">';
                    echo '<i class="fas fa-edit"></i> Contact';                 
                    echo '</a>';

                    echo '<form method="POST" action="cart.php" class="add-to-cart-form">';
            echo '<input type="hidden" name="product_id" value="' . $row['pid'] . '">';
            echo '<input type="submit" name="add_to_cart" value="Add to Cart" class="btn">';
            echo '</form>';
            
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo 'No results found.';
            }
        }
        ?>
        
    </div>

    <br>

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
