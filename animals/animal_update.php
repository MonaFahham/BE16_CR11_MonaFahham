<?php

require_once '../components/db_connect.php';
require_once '../components/file_upload.php';



if ($_POST) {  
    $aname = $_POST['animal_name'];
    $photo = $_POST['picture'];
    $size = $_POST['size'];
    $breed = $_POST['breed'];
    $age = $_POST['age'];
    $address = $_POST['address'];
    $description = $_POST['description']; 
    $status = $_POST['status'];
    $id = $_POST['id'];
    
    $uploadError = '';


    $photo = file_upload($_FILES['picture']);
    if($photo->error===0){
        ($_POST["picture"]=="avatar2.jpg")?: unlink("../pictures/$_POST[picture]");           
        $sql = "UPDATE animal SET animal_name = '$aname', picture = '$photo->fileName', size = '$size', breed = '$breed', age = $age, address = '$address', description = '$description', status = '$status'  WHERE animal_id = {$id}";
    }else{
        $sql = "UPDATE animal SET animal_name = '$aname', size = '$size', breed = '$breed', age = $age, address = '$address', description = '$description', status = '$status' WHERE animal_id = {$id}";
    }    
    if (mysqli_query($connect, $sql) === TRUE) {
        $class = "success";
        $message = "The record was successfully updated";
        $uploadError = ($photo->error !=0)? $photo->ErrorMessage :'';
    } else {
        $class = "danger";
        $message = "Error while updating record : <br>" . mysqli_connect_error();
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
        <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"  integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> -->
        <link rel="stylesheet" href="../css/style.css">
        <?php require_once '../components/boot.php' ?>
        
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
        <div class="container">
            <div class="mt-3 mb-3">
                <h1>Update</h1>
            </div>
            <div class="alert alert-<?php echo $class;?>" role="alert">
                <p><?php echo ($message) ?? ''; ?></p>
                <p><?php echo ($uploadError) ?? ''; ?></p>
                <a href='update.php?id=<?=$id;?>'><button class="btn btn-warning" type='button'>Back</button></a>
                <a href='admin_index.php'><button class="btn btn-success" type='button'>Home</button></a>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    </body>
</html>



