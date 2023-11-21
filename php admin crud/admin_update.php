<?php

@include 'config.php';

$id = $_GET['edit'];

if (isset($_POST['update_product'])) {
    $product_userid = $_POST['product_userid'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_FILES['product_image']['name'];
    $product_image_tmp_name = $_FILES['product_image']['tmp_name'];
    $product_image_folder = 'uploaded_img/' . $product_image;
    $product_description = $_POST['product_description'];
    $product_pnumber = $_POST['product_pnumber'];

    if (
        empty($product_userid) ||
        empty($product_name) ||
        empty($product_price) ||
        empty($product_image) ||
        empty($product_description) ||
        empty($product_pnumber)
    ) {
        $message[] = 'please fill out all!';
    } else {
        $update_data = "UPDATE products SET userid='$product_userid', name='$product_name', price='$product_price', image='$product_image', description='$product_description', pnumber='$product_pnumber'  WHERE id = '$id'";
        $upload = mysqli_query($conn, $update_data);

        if ($upload) {
            move_uploaded_file($product_image_tmp_name, $product_image_folder);
            header('location:database.php');
        } else {
            $$message[] = 'please fill out all!';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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


        <div class="admin-product-form-container centered">

            <?php
            $select = mysqli_query(
                $conn,
                "SELECT * FROM products WHERE pid = '$id'"
            );
            while ($row = mysqli_fetch_assoc($select)) { ?>

            <form action="" method="post" enctype="multipart/form-data">
                <h3 class="title">update the product</h3>
                <input type="text" class="box" name="product_userid" value="<?php echo $row[
                    'userid'
                ]; ?>" placeholder="enter the userid">

                <input type="text" class="box" name="product_name" value="<?php echo $row[
                    'name'
                ]; ?>" placeholder="enter the product name">
                <input type="number" min="0" class="box" name="product_price" value="<?php echo $row[
                    'price'
                ]; ?>" placeholder="enter the product price">
                <input type="file" class="box" name="product_image" accept="image/png, image/jpeg, image/jpg">
                <input type="text" class="box" name="product_description" value="<?php echo $row[
                    'description'
                ]; ?>" placeholder="enter the product description">
                <input type="text" class="box" name="product_pnumber" value="<?php echo $row[
                    'pnumber'
                ]; ?>" placeholder="enter the phone number">
                <input type="submit" value="update product" name="update_product" class="btn">

                <a href="database2.php" class="btn">go back!</a>
            </form>



            <?php }
            ?>



        </div>

    </div>

</body>

</html>