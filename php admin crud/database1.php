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
        <form action="" method="POST">
            <input class="searchbar" type="text" name="search" placeholder="Search products...">
            <input class="searchbutton" type="submit" name="submit" value="Search">
        </form>

        <br><br>
        <table class="product-display-table">
            <thead>
                <tr style="background-color: green; color:white">
                    <th>Item ID</th>
                    <th>product image</th>
                    <th>product Name</th>
                    <th>product price</th>
                    <th>product description</th>
                    <th>Contact</th>
                </tr>
            </thead>

            <?php
            if (isset($_POST['submit'])) {
                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<tr>';
                        echo '<td>' . $row['pid'] . '</td>';
                        echo "<td><img src='uploaded_img/" . $row['image'] . "' height='100' alt=''></td>";
                        echo '<td>' . $row['name'] . '</td>';
                        echo '<td>' . $row['price'] . '</td>';
                        echo '<td>' . $row['description'] . '</td>';

                        echo '<td>';
                        echo '<a href="userDetails.php?pid=' . $row['pid'] . '" class="btn">';
                        echo '<i class="fas fa-edit"></i> Contact';
                        echo '</a>';

                        echo '<form method="POST" action="cart.php">';
                        echo '<input type="hidden" name="product_id" value="' . $row['pid'] . '">';
                        echo '<input type="submit" name="add_to_cart" value="Add to Cart" class="btn">';
                        echo '</form>';
                        echo '</td>';

                        echo '</tr>';
                    }
                } else {
                    echo 'No results found.';
                }
            }
            ?>
        </table>
    </div>

    <br><br>

    <?php
    $select = mysqli_query($conn, 'SELECT * FROM products');
    ?>
    <div class="product-display">
        <h2 class="seemore">See newly listed products</h2>
        <br>
        <table class="product-display-table">
            <thead>
                <tr style="background-color: green; color:white">
                    <th>Item ID</th>
                    <th>product image</th>
                    <th>product name</th>
                    <th>product price</th>
                    <th>product description</th>
                    <th>Contact</th>
                </tr>
            </thead>

            <?php
            while ($row = mysqli_fetch_assoc($select)) {
            ?>
                <tr>
                    <td><?php echo $row['pid']; ?></td>
                    <td><img src="uploaded_img/<?php echo $row['image']; ?>" height="100" alt=""></td>
                    <td><?php echo $row['name']; ?></td>
                    <td>Rs.<?php echo $row['price']; ?>/-</td>
                    <td><?php echo $row['description']; ?></td>

                    <td>
                        <a href="userDetails.php?pid=<?php echo $row['pid']; ?>" class="btn">
                            <i class="fas fa-edit"></i> Contact
                        </a>

                        <form method="POST" action="cart.php">
                            <input type="hidden" name="product_id" value="<?php echo $row['pid']; ?>">
                            <input type="submit" name="add_to_cart" value="Add to Cart" class="btn">
                        </form>
                    </td>
                </tr>
            <?php
            }
            ?>
        </table>
    </div>
</body>

</html>
