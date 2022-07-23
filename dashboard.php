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
            <td><a href='update.php?id=" . $row['user_id'] . "'><button class='btn btn-warning btn-sm' type='button'>Edit</button></a>
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
  <?php require_once 'components/navbar.php' ?>

    <div class="container">
        <div class="row">
            <div class="col-3">
                <img class="userImage mt-5 mb-3" src="pictures/admin.png" alt="Adm avatar">
                <p class="text-center mb-5 text-dark">Administrator</p>
                <a class="btn btn-warning" href="animals/admin_index.php">Animals</a>
                <a class="btn btn-danger" href="dashboard.php">Users</a>
                <p> <a href="logout.php?logout" class="text-danger text-right my-4">Log Out</a></p>
            </div>
            <div class="col-9 mt-2">
            <h2 class="txt text-center">Sign Up</h2>
                <table class='table table-striped'>
                    <thead class='table-danger'>
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