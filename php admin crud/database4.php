<?php
@include 'config.php';

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM products WHERE pid = $pid");
    header('location:admin_page.php');
}
?>
<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'user_form';
$conn = mysqli_connect($servername, $username, $password, $dbname);
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


    <title>CPlus Products</title>

    <style>
            .product-card {
                display: flex;
                max-width: 1450px;
                margin: 20px auto;
                padding: 10px;
                background-color: #f1eeee;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                min-height: 300px;
                border: 2px solid #0c0c0c;
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
                width: 100%;
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
                padding: 10px;
                background-color: #4CAF50;
                color: white;
                text-decoration: none;
                border-radius: 5px;
                transition: background-color 0.3s ease;
            }
        
            .contact-button:hover {
                background-color: #45a049;
            }
            
            .product-card {
                display: flex;
                max-width: 1450px;
                margin: 20px auto;
                padding: 10px;
                background-color: #f1eeee;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                min-height: 300px;
                border: 2px solid #0c0c0c;
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
                width: 100%;
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
                padding: 10px;
                background-color: #4CAF50;
                color: white;
                text-decoration: none;
                border-radius: 5px;
                transition: background-color 0.3s ease;
            }
        
            .contact-button:hover {
                background-color: #45a049;
            }
        
            .flex-container{
            display: flex;
            flex-direction: grid;
            
        }        
        .flex-box {
           
            display: flex;
            max-width: 1450px;
            margin: 20px auto;
            padding: 10px;
            background-color: #f1eeee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            min-height: 300px;
            border: 2px solid #0c0c0c;
            border-radius: 10px;
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        .flex-box:hover {
            transform: scale(1.05);
        }
        
        .left {
            width: 40%;
            padding-right: 10px;
        }
        
        .product-image img {
            width: 300px;
            height: 300px;
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
            margin-bottom: 25px;
        }
        
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

        @media screen and (max-width: 600px) {
            .search-bar,
            .search-button {
                width: 100%;
                margin-right: 0;
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

        <br><br>
       
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
        
        
            <?php while ($row = mysqli_fetch_assoc($select)) { ?>

                <div class="flex-container">
            
                <div class="flex-box">
                    <div class="left">
                        <div class="product-image">
                            <img src="uploaded_img/<?php echo $row['image']; ?>" alt="Product Image">
                        </div>
                        
                    </div>
                    <div class="right">
                        <div class="product-name">
                            <p>Product Name: <?php echo $row['name']; ?></p>
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
                    </div>
                </div>
                </div>    


            <?php } ?>
        
    </div>

 
</body>

</html>