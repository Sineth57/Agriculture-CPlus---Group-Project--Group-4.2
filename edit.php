<?php
include 'config.php';
$id = '';
$name = '';
$email = '';
$user_type = '';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_GET['id'])) {
        header('location:crud100/index.php');
        exit();
    }
    $id = $_GET['id'];
    $sql = "select * from users where id=$id";
    $result = $conn->query($sql);
    $row = $result->fetch(PDO::FETCH_ASSOC);
    while (!$row) {
        header('location: crud100/index.php');
        exit();
    }
    $name = $row['name'];
    $email = $row['email'];
    $user_type = $row['user_type'];
} else {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $user_type = $_POST['user_type'];

    $sql = "update users set name='$name', email='$email', user_type='$user_type' where id='$id'";
    $result = $conn->query($sql);
    header('location:userdb.php');
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Database</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>

<body style="background-image: url('pexels-pixabay-207247.jpg');">
    <!--<nav class="navbar navbar-expand-lg navbar-dark bg-dark" class="fw-bold">
      <div class="container-fluid">
        <a class="navbar-brand" href="index.php">Database</a>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="create.php">Add New User</a>
            </li>
          </ul>
        </div>
      </div>
    </nav> -->
    <div class="col-lg-6 m-auto">

        <form method="post">

            <br><br>
            <div class="card">

                <div class="card-header bg-warning">
                    <h1 class="text-white text-center"> Update User </h1>
                </div><br>

                <input type="hidden" name="id" value="<?php echo $id; ?>" class="form-control"> <br>

                <label> NAME: </label>
                <input type="text" name="name" value="<?php echo $name; ?>" class="form-control"> <br>

                <label> EMAIL: </label>
                <input type="text" name="email" value="<?php echo $email; ?>" class="form-control"> <br>

                <label> USER TYPE: </label>
                <input type="text" name="user_type" value="<?php echo $user_type; ?>" class="form-control"> <br>



                <button class="btn btn-success" type="submit" name="submit"> Submit </button><br>
                <a class="btn btn-info" type="submit" name="cancel" href="userdb.php"> Cancel </a><br>

            </div>
        </form>
    </div>
</body>

</html>