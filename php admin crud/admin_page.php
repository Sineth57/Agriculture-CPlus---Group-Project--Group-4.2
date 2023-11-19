<?php

@include 'config.php';

if (isset($_POST['add_product'])) {
    $product_userid = $_POST['product_userid'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_FILES['product_image']['name'];
    $product_description = $_POST['product_description'];
    $product_pnumber = $_POST['product_pnumber'];
    $product_image_tmp_name = $_FILES['product_image']['tmp_name'];
    $product_image_folder = 'uploaded_img/' . $product_image;

    if (
        empty($product_userid) ||
        empty($product_name) ||
        empty($product_price) ||
        empty($product_image) ||
        empty($product_description) ||
        empty($product_pnumber)
    ) {
        $message[] = 'Please fill out all';
    } else {
        $insert = "INSERT INTO products(userid, name, price, image, description, pnumber) VALUES('$product_userid', '$product_name', '$product_price', '$product_image', '$product_description', '$product_pnumber')";
        $upload = mysqli_query($conn, $insert);
        if ($upload) {
            move_uploaded_file($product_image_tmp_name, $product_image_folder);
            $message[] = 'New product added successfully';
        } else {
            $message[] = 'Could not add the product';
        }
    }
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM products WHERE pid = $id");
    header('location:database.php');
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



    <?php if (isset($message)) {
        foreach ($message as $message) {
            echo '<span class="message">' . $message . '</span>';
        }
    } ?>



    <div class="container">

        <div class="admin-product-form-container">

            <form action="<?php $_SERVER[
                'PHP_SELF'
            ]; ?>" method="post" enctype="multipart/form-data">
                <h3>add your new product</h3>

                <input type="number" placeholder="Enter User ID" name="product_userid" class="box">
                <input type="text" placeholder="Enter product name" name="product_name" class="box">


                <div class="input-group mb-3">
                    <span class="input-group-text"></span>
                    <textarea class="box" placeholder="Enter product description" name="product_description"
                        required></textarea>
                </div>



                <input type="number" placeholder="Enter product price" name="product_price" class="box">
                <input type="number" placeholder="Enter phone number " name="product_pnumber" class="box">
                <input type="file" accept="image/png, image/jpeg, image/jpg" name="product_image" class="box">
                <input type="submit" class="btn" name="add_product" href="database.php" value="add product">

            </form>

        </div>



    </div>


</body>

</html>