<?php
require_once '../components/db_connect.php';
require_once '../components/file_upload.php';


if ($_POST) {   
    $aname = $_POST['animal_name'];
    $size = $_POST['size'];
    $breed = $_POST['breed'];
    // $photo = $_POST['picture'];
    $age = $_POST['age'];
    $address = $_POST['address'];
    $description = $_POST['description'];
    $status = $_POST['status'];
    $uploadError = '';
    
  $photo= file_upload($_FILES['picture']);  
  
  $sql = "INSERT INTO animal (animal_name, picture, size, breed, age, address, description ) 
  VALUES ('$aname', '$photo->fileName', '$size', '$breed', $age, '$address', '$description')";

  if (mysqli_query($connect, $sql) === true) {
      $class = "success";
      $message = " 
        <div class='container text-center justify-content-center'>
            <div class='row text-center justify-content-center'>
                <h3 class='col-12 text-danger'>$aname</h3>
            </div>
      
          <table class='table text-center'><tr>
          <td> $aname </td>
          <td> $size </td>
          <td> $breed </td>
          <td> $age </td>
          <td> $address </td>
          <td> $description </td>
          <td> $status </td>
          </tr></table><hr>
        </div>";
      $uploadError = ($photo->error !=0)? $photo->ErrorMessage :'';
      
  } else {
      $class = "danger";
      $message = "Error while creating record. Try again: <br>" . $connect->error;
      $uploadError = ($photo->error !=0)? $photo->ErrorMessage :'';
  }
  mysqli_close($connect);
} else {
    header("location: ../error.php");
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Update</title>
        <link rel="stylesheet" href="../css/style.scss">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    
    </head>
    <body>
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
  </nav>            <div class="row text-center justify-content-center">
                <div class="nsl"></div>
                <div class="col-12 nsl">
                    <h3>You have created your pet</h3>
                </div>
                <div class="col-6 nsl">
                    <div class="dimgbox">
                        
                    </div>
                </div>
            </div>
        <div class="container">

            <div class="text-center justify-content-center alert alert-<?=$class;?>" role="alert">
                <p><?php echo ($message) ?? ''; ?></p>
                <p><?php echo ($uploadError) ?? ''; ?></p>
                <a href='../home.php'><button class="btn btn-primary" type='button'>Home</button></a>
            </div>
        </div>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    </body>
</html>