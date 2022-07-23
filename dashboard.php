<?php
session_start();
require_once 'components/db_connect.php';

// if session is not set this will redirect to login page (secure the url)
if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) { //if there is no session adm and no session user
    header("Location: index.php"); // redirect to index.php
    exit;
}
//if session user exist it shouldn't access dashboard.php
if (isset($_SESSION["user"])) {//if user/adm try to go to dashboard, hewill not be able to
    header("Location: home.php");// redirect to home.php
    exit;
}

$id = $_SESSION['adm'];
$status = 'adm';
$sql = "SELECT * FROM user WHERE status != '$status'";
$result = mysqli_query($connect, $sql);
 
//this variable will hold the body for the table
$tbody = '';
if ($result->num_rows > 0) {
    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
        $tbody .= "<tr>
            <td><img class='img-thumbnail rounded-circle' src='pictures/" . $row['picture'] . "' alt=" . $row['first_name'] . "></td>
            <td>" . $row['first_name'] . " " . $row['last_name'] . "</td>
            <td>" . $row['date_of_birth'] . "</td>
            <td>" . $row['email'] . "</td>
            <td><a href='update.php?id=" . $row['user_id'] . "'><button class='btn btn-primary btn-sm' type='button'>Edit</button></a>
            <a href='delete.php?id=" . $row['user_id'] . "'><button class='btn btn-danger btn-sm' type='button'>Delete</button></a></td>
         </tr>";
    }
} else {
    $tbody = "<tr><td colspan='5'><center>No Data Available </center></td></tr>";
}

mysqli_close($connect);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <?php require_once 'components/boot.php' ?>
    <title>Adm-Dashboard</title>
    <style type="text/css">
        .img-thumbnail {
            width: 70px !important;
            height: 70px !important;
        }

        td {
            text-align: left;
            vertical-align: middle;
        }

        tr {
            text-align: center;
        }

        .userImage {
            width: 100px;
            height: auto;
        }
    </style>
</head>

<body class="body_style">
<nav class="navbar navbar-expand-lg navbar-light lit" style="padding-inline:4rem;">
      <div class="container-fluid">
          <a class="navbar-brand" href="home.php">
            <img src="https://i0.wp.com/ebsalter.com/wp-content/uploads/revslider/slide-3/lion.png?ssl=1" alt="" width="40" height="40" class="d-inline-block align-text-top">
          
          </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class=" collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="animals/admin_index.php">Animals</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="index.php">Senior</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logout.php?logout">Sign Out</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="index.php">Login</a>
            </li>
          </ul>
        </div>
      </div>
  </nav>
    <div class="container">
        <div class="row">
            <div class="col-2">
                <img class="userImage" src="pictures/admavatar.png" alt="Adm avatar">
                <p class="">Administrator</p>
                <div>
                    <a class="btn btn-success" href="animals/admin_index.php">Animals</a>
                    <a class="btn btn-danger" href="dashboard.php">Users</a>
                </div>
                <a href="logout.php?logout">Log Out</a>
            </div>
            <div class="col-8 mt-2">
                <p class='h2'>Users</p>
                <table class='table table-striped'>
                    <thead class='table-success'>
                        <tr>
                            <th>Picture</th>
                            <th>Name</th>
                            <th>Date of birth</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?= $tbody ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>