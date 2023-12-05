<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>User Information</title>
    <link rel="shortcut icon" type="x-icon" href="logo.png">

</head>

<body style="background-image: url('pexels-pixabay-207247.jpg');">
    <!--<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="index.php">Database</a>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="index.php">Home</a>
            </li>
            <li class="nav-item">
              <a type="button" class="btn btn-primary nav-link active" href="create.php">Add New User</a>
            </li>
          </ul>
        </div>
      </div>
    </nav> -->

    <!-- Top heading -->
    <h2 style="padding-left:585px; color:white; background-color: green; padding-top:15px; padding-bottom:15px">
        <strong>User
            Details - Admin Page</strong>
    </h2>

   <!-- Table to display user details -->

    <div class="container my-4">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th></th>
                    <th>IMAGE</th>
                    <th>NAME</th>
                    <th>EMAIL</th>
                    <th>USER TYPE</th>
                    <th>ACTIONS</th>
                    <th>USER LISTNINGS  </th>
                </tr>
            </thead>
            <tbody>
                <?php
                //Include configuration file
                include 'config.php';

                //SQL query to fetch data from table in the database
                $sql = 'select * from users';
                $result = $conn->query($sql);
                if (!$result) {
                    die('Invalid query!');
                }
                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    echo "
      <tr>

    
        <th>$row[id]</th>
        
        <td><td><img src='uploaded_img/" .
                        $row['image'] .
                        "' height='100' alt=''></td></td>
                <td>$row[name]</td>
                <td>$row[email]</td>
                <td>$row[user_type]</td>

                <td>
                    <a class='btn btn-success' href='edit.php?id=$row[id]'>Edit</a>
                    <a class='btn btn-danger' href='delete.php?id=$row[id]'>Delete</a>
                </td>

                <td>
                <a class='btn btn-success' href='userdbproducts1.php?user_id=" . $row['id'] . "'>See Listings</a>

            </td>


                </tr>
                ";
                }
                ?>
            </tbody>
        </table>
    </div>

                <!-- Include bootstrap links -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>
