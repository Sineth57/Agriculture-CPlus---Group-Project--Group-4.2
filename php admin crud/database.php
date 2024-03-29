<?php
// INclude configuration file 
@include 'config.php';

// Check whether the delete is submitted
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM products WHERE pid = $id");
    header('location:database.php');
}
?>


<?php
if (!$conn) {
    die('Connection failed: ' . mysqli_connect_error());
} // Retrieve search query from search bar
if (isset($_POST['submit'])) {
    $search = $_POST['search']; // Search for data that matches the search query by id or name
    $sql = "SELECT * FROM products WHERE pid LIKE '%$search%' OR name LIKE '%$search%'";
    $result = mysqli_query($conn, $sql);
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


    <title>Admin Page - User Products</title>
</head>

<body style="background-image: url('B1.jpg');">
<!-- Top heading -->
<h1 class="title1"> <span>Admin Page</span> <br>Listed products </h1>

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

    <!-- Table to display products in search -->
    <div class="product-display">

       <!-- Search bar -->
       <div class="search-container">
            <form action="" method="POST">
                <input class="search-bar" type="text" name="search" placeholder="Search products...">
                <input class="search-button" type="submit" name="submit" value="Search">
            </form>
        </div>

        <br><br>
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

            <!-- Check whether the search button is submitted and fetching the details -->
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

<!-- SQL query to select all the products to display -->
    <?php $select = mysqli_query($conn, 'SELECT * FROM products'); ?>
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
                    <th>Seller Address</th>
                    <th>phone number</th>
                    <th>action</th>
                </tr>
            </thead>
            <!-- Fetching all the products from the database -->
            <?php while ($row = mysqli_fetch_assoc($select)) { ?>
            <tr>
                <td><?php echo $row['pid']; ?></td>
                <td><img src="uploaded_img/<?php echo $row[
                    'image'
                ]; ?>" height="100" alt=""></td>
                <td><?php echo $row['userid']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td>Rs.<?php echo $row['price']; ?>/-</td>
                <td><?php echo $row['description']; ?></td>
                <td><?php echo $row['nameAddress']; ?></td>
                <td><?php echo $row['pnumber']; ?></td>

                <td>
                    <a href="admin_update.php?edit=<?php echo $row[
                        'pid'
                    ]; ?>" class="btn"> <i class="fas fa-edit"></i> edit </a>
                    <a href="database.php?delete=<?php echo $row[
                        'pid'
                    ]; ?>" class="btn"> <i class="fas fa-trash"></i> delete </a>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>
    <!-- <script>
    alert('A new product has been added!');
    </script> -->

</body>

</html>