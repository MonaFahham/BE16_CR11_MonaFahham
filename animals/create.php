<?php
session_start();
require_once '../components/db_connect.php';

if (!isset($_SESSION['adm'])) {
    header("Location: ../home.php");
    exit;
}
 
require_once '../components/db_connect.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once '../components/boot.php' ?>
    <title>Add Animal</title>
    <style>
        fieldset {
            margin: auto;
            margin-top: 100px;
            width: 60%;
        }
    </style>
</head>

<body class="body_style">
<nav class="navbar navbar-expand-lg navbar-light" style="padding-inline:4rem;">
      <div class="container-fluid">
          <a class="navbar-brand" href="home.php">
            <img src="../pictures/logo9-removebg-preview.png" alt="" width="120" height="110" class="d-inline-block align-text-top">
          
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
              <a class="nav-link" href="../home.php">Animals</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../senior.php">Senior</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../junior.php">Junior</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../large.php">Large</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../small.php">Small</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../logout.php?logout">Sign Out</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../index.php">Login</a>
            </li>
          </ul>
        </div>
      </div>
  </nav>
    <fieldset>
        <legend class='h2'>Add Animal</legend>
        <form action="animal_create.php" method="post" enctype="multipart/form-data">
            <table class='table'>
                <tr>
                    <th>Animal Name</th>
                    <td><input class='form-control' type="text" name="animal_name" placeholder="Name" /></td>
                </tr>
                <tr>
                    <th>Size</th>
                    <td>
		 	              <select id="inputState" class="form-control" name="size">
                            <option value="small">Small</option> 
                            <option value="large">Large</option>
		 	              </select>
                    </td>
                </tr>
                <tr>
                    <th>Breed</th>
                    <td><input class='form-control' type="text" name="breed"  placeholder="Breed" /></td>
                </tr>
                <tr>
                    <th>Age</th>
                    <td><input class='form-control' type="number" name="age"  placeholder="Age" /></td>
                </tr>
                <tr>
                    <th>Photo</th>
                    <td><input class='form-control' type="file" name="picture"  placeholder="Photo" /></td>
                </tr>
                <tr>
                    <th>Address</th>
                    <td><input class='form-control' type="text" name="address"  placeholder="Address" /></td>
                </tr>
                
                <tr>
                    <th>Status</th>
                    <td>
		 	              <select id="inputState" class="form-control" name="status">
                            <option value="available">Available</option> 
                            <option value="adopted">Adopted</option>
		 	              </select>
                    </td>
                </tr>
                <tr>
                    <th>Description</th>
                    <td><input class='form-control' type="text" name="description"  placeholder="Description" /></td>
                     </tr>
                    
                <tr>
                    <td><button class='btn btn-success' type="submit">Insert Product</button></td>
                    <td><a href="../home.php"><button class='btn btn-warning' type="button">Home</button></a></td>
                </tr>
            </table>
        </form>
    </fieldset>
</body>
</html>


