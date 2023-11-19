<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>User Listings</title>
</head>
<body style="background-image: url('pexels-pixabay-207247.jpg');">
    <h2 style="padding-left: 585px; color: white; background-color: green; padding-top: 15px; padding-bottom: 15px">
        <strong>User Listings - Admin Page</strong>
        
    </h2>
    <div class="container my-4">
        <table class="table">
            <thead>
                <tr>
                    <th>Item ID</th>
                    <th>Product Image</th>
                    <th>Product Name</th>
                    <th>Product Price</th>
                    <th>Product Description</th>
                    <th>Phone Number</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'config.php';

                // Check if user_id is provided in the URL
                if (isset($_GET['user_id'])) {
                    $user_id = $_GET['user_id'];

                    // Fetch products for the specific user
                    $sql = "SELECT * FROM products WHERE userid = $user_id";
                    $result = $conn->query($sql);

                    if ($result->rowCount() > 0) {
                        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                            echo "
                            <tr>
                                <td>{$row['pid']}</td>
                                <td><img src='php admin crud/uploaded_img/" .
                        $row['image'] .
                        "' height='100' alt=''></td></td>
                                <td>{$row['name']}</td>
                                <td>Rs.{$row['price']}/-</td>
                                <td>{$row['description']}</td>
                                <td>{$row['pnumber']}</td>
                                <td>
                                <a href='php admin crud/database.php' class='btn btn-primary'>Edit Listning</a>
                            </td>
                            </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>No listings found for this user.</td></tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>User ID not provided.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>



<!-- <td><img src='uploaded_img/{$row['image']}' height='100' alt=''></td> -->