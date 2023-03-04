<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>User Information</title>

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
    <h2 style="padding-left:585px; color:white; background-color: green; padding-top:15px; padding-bottom:15px">
        <strong>User
            Details</strong>
    </h2>



    <div class="container my-4">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>IMAGE</th>
                    <th>NAME</th>
                    <th>EMAIL</th>
                    <th>USER TYPE</th>

                    <th>ACTIONS</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'config.php';
                $sql = 'select * from users';
                $result = $conn->query($sql);
                if (!$result) {
                    die('Invalid query!');
                }
                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    echo "
      <tr>
        <th>$row[id]</th>
        
        <td>$row[image]</td>
                <td>$row[name]</td>
                <td>$row[email]</td>
                <td>$row[user_type]</td>

                <td>
                    <a class='btn btn-success' href='edit.php?id=$row[id]'>Edit</a>
                    <a class='btn btn-danger' href='delete.php?id=$row[id]'>Delete</a>
                </td>
                </tr>
                ";
                }
                ?>
            </tbody>
        </table>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>