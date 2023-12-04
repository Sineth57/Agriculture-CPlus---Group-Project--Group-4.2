<?php
// Include configuration file
@include 'config.php';

// Check whether the product add is submitted 
if (isset($_POST['add_product'])) {

    if (!isset($_SESSION['user_id'])) {
        // If User is not logged in, redirect to the login page
        header('Location: ../login1.php');
        exit();
    }
    $product_userid = $_POST['product_userid'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];

    // Get multiple images as inputs
    $product_images = array();
    for ($i = 1; $i <= 3; $i++) {
        $key = "product_image{$i}";
        $product_images[] = $_FILES[$key]['name'];
        ${"product_image_tmp_name{$i}"} = $_FILES[$key]['tmp_name'];
    }

    $product_description = $_POST['product_description'];
    $product_nameAddress = $_POST['product_nameAddress'];
    $product_pnumber = $_POST['product_pnumber'];

    // Check whether any required field is empty
    if (
        empty($product_userid) ||
        empty($product_name) ||
        empty($product_price) ||
        // Check whether any image field is empty
        in_array('', $product_images) || 
        empty($product_description) ||
        empty($product_nameAddress) ||
        empty($product_pnumber)
    ) {
        $message[] = 'Please fill out all fields.';
    } else {
        // Insert the products into table
        $insert = "INSERT INTO products(userid, name, price, image, image2, image3, description, nameAddress, pnumber) VALUES('$product_userid', '$product_name', '$product_price', '$product_images[0]', '$product_images[1]', '$product_images[2]', '$product_description', '$product_nameAddress', '$product_pnumber')";
        
        $upload = mysqli_query($conn, $insert);

        if ($upload) {
            // Move uploaded images to folder
            for ($i = 0; $i < 3; $i++) {
                $product_image_folder = "uploaded_img/{$product_images[$i]}";
                move_uploaded_file(${"product_image_tmp_name" . ($i + 1)}, $product_image_folder);
            }
            
            $message[] = 'New product added successfully';
        } else {
            $message[] = 'Could not add the product';
        }
    }
}

// Check whether delete is clicked
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM products WHERE pid = $id");
    header('location:database1.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin page</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" type="x-icon" href="logo.png">
    
</head>

<body style="background-image: url('B1.jpg');">

<!-- Button to navigate through pages -->
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

            <a href="../user_page.php">
                <li>
                    <div class="fab-icon-holder">
                        <i class="fas fa-user-circle"></i>
                    </div>
                    <span class="fab-label">Profile</span>
                </li>
            </a>

        </ul>
    </div>

    
    <h1 class="title1"> <span>CPlus</span> <br>list your products </h1>

    <!-- Display messages -->
    <?php if (isset($message)) {
        foreach ($message as $message) {
            echo '<span class="message">' . $message . '</span>';
        }
    } ?>

<!-- Form to add new products -->
    <div class="container">
        <div class="admin-product-form-container">
            <form action="<?php $_SERVER[
                'PHP_SELF'
            ]; ?>" method="post" enctype="multipart/form-data">
                <h3>add your new product details here</h3>

                <input type="number" placeholder="Enter User ID" name="product_userid" class="box">
                <input type="text" placeholder="Enter product name" name="product_name" class="box">

                <div class="input-group mb-3">
                    <span class="input-group-text"></span>
                    <textarea class="box1" placeholder="Enter product description" name="product_description"
                        required></textarea>
                </div>

                <input type="number" placeholder="Enter product price" name="product_price" class="box">

                <div class="input-group mb-3">
                    <span class="input-group-text"></span>
                    <textarea class="box1" placeholder="Enter your name and address" name="product_nameAddress"
                        required></textarea>
                </div>

                <input type="number" placeholder="Enter your phone number " name="product_pnumber" class="box">
                <input type="file" accept="image/png, image/jpeg, image/jpg" name="product_image1" class="box">
                <input type="file" accept="image/png, image/jpeg, image/jpg" name="product_image2" class="box">
                <input type="file" accept="image/png, image/jpeg, image/jpg" name="product_image3" class="box">
                <input type="submit" class="btn" name="add_product" href="database1.php" value="add product">
            </form>
        </div>
    </div>
</body>

</html>
