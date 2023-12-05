<?php

// Start the session
session_start();

// Include configuration file
@include 'config.php';

// Chech whether the delete is submitted and retrieve the query
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM products WHERE pid = $id");
    header('location:database2.php');
}
?>


<?php
// $servername = 'localhost';
// $username = 'root';
// $password = '';
// $dbname = 'user_form';
// $conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die('Connection failed: ' . mysqli_connect_error());
} // Retrieve search query from search bar
if (isset($_POST['submit'])) {
    $search = $_POST['search']; 
    // Search for data that matches the search query by id or name
    $sql = "SELECT * FROM products WHERE pid LIKE '%$search%' OR name LIKE '%$search%'";
    $result = mysqli_query($conn, $sql);
}

// Assuming the user's ID stored in $userID
$userID = $_SESSION['user_id']; 

// Query to retrieve products associated with the user
$sql = "SELECT * FROM products WHERE userid = $userID";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die('Invalid query!');
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


    <title>Products</title>
</head>

<body style="background-image: url('B1.jpg');">
<h1 class="title1"> <span>CPlus</span> <br>Your products </h1>


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

    <!-- Search bar -->
       
        <div class="search-container">
            <form action="" method="POST">
                <input class="search-bar" type="text" name="search" placeholder="Search products...">
                <input class="search-button" type="submit" name="submit" value="Search">
            </form>
        </div>
        <br><br>
        <!-- Display searched products -->
        <table class="product-display-table">
            <thead>
                <tr style="background-color: green; color:white">
                    <th>Item ID</th>
                    <th>product image</th>
                    <th>product Name</th>
                    <th>product price</th>
                    <th>product description</th>
                    <th>phone Number</th>


                </tr>
            </thead>

            <?php if (isset($_POST['submit'])) {
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<tr>';
                        echo '<td>' . $row['pid'] . '</td>';
                        echo "<td><img src='uploaded_img/" .
                            $row['image'] .
                            "' height='100' alt=''></td>";
                        echo '<td>' . $row['name'] . '</td>';
                        echo '<td>' . $row['price'] . '</td>';
                        echo '<td>' . $row['description'] . '</td>';
                        echo '<td>' . $row['pnumber'] . '</td>';
                        echo '</tr>';
                    }
                } else {
                    echo 'No results found.';
                }
            } ?>
        </table>
    </div>


    <br><br>


    <!-- Display all the products as a table -->
    <div class="product-display">
        <table class="product-display-table">
            <thead>
                <tr style="background-color: green; color:white">
                    <th>Item ID</th>
                    <th>Product image</th>
                    <th>User ID</th>
                    <th>product name</th>
                    <th>product price</th>
                    <th>product description</th>
                    <th>phone number</th>
                    <th>Action</th>
                </tr>
            </thead>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo $row['pid']; ?></td>
                <td><img src="uploaded_img/<?php echo $row[
                    'image'
                ]; ?>" height="100" alt=""></td>
                <td><?php echo $row['userid']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td>Rs.<?php echo $row['price']; ?>/-</td>
                <td><?php echo $row['description']; ?></td>
                <td><?php echo $row['pnumber']; ?></td>

                <td>
                    <a href="admin_update.php?edit=<?php echo $row[
                        'pid'
                    ]; ?>" class="btn"> <i class="fas fa-edit"></i> edit </a>
                    <a href="database2.php?delete=<?php echo $row[
                        'pid'
                    ]; ?>" class="btn"> <i class="fas fa-trash"></i> delete </a>
                </td>

                
            </tr>
            <?php } ?>
        </table>
    </div>
   

</body>

</html>
<?php

// Closing the database connection
mysqli_close($conn);
?>