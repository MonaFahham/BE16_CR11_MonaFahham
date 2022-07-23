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
        <?php require_once '../components/navbar.php' ?>
            <div class="row text-center justify-content-center">
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