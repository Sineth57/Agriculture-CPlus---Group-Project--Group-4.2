<?php
@include 'config.php';

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM products2 WHERE id = $id");
    header('location:admin_page.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">


    <link rel="stylesheet" href="css/style.css">

    <link rel="shortcut icon" type="x-icon" href="logo.png">

    <title>Database</title>
</head>

<body style="background-image: url('pexels-pixabay-207247.jpg');">

    <?php $select = mysqli_query($conn, 'SELECT * FROM products2'); ?>
    <div class="product-display">
        <table class="product-display-table">
            <thead>
                <tr style="background-color: black; color:gray">
                    <th>Item ID</th>
                    <th>product image</th>
                    <th>product name</th>
                    <th>product price</th>
                    <th>product description</th>
                    <th>phone number</th>
                    <th>action</th>
                </tr>
            </thead>
            <?php while ($row = mysqli_fetch_assoc($select)) { ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><img src="uploaded_img/<?php echo $row[
                'image'
            ]; ?>" height="100" alt=""></td>
                <td><?php echo $row['name']; ?></td>
                <td>Rs.<?php echo $row['price']; ?>/-</td>
                <td><?php echo $row['description']; ?></td>
                <td><?php echo $row['pnumber']; ?></td>

                <td>
                    <a href="admin_update.php?edit=<?php echo $row[
                   'id'
               ]; ?>" class="btn"> <i class="fas fa-edit"></i> edit </a>
                    <a href="admin_page.php?delete=<?php echo $row[
                   'id'
               ]; ?>" class="btn"> <i class="fas fa-trash"></i> delete </a>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>
</body>

</html>