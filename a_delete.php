<?php

require_once 'components/db_connect.php';

if ($_POST) {
    $id = $_POST['id'];
    $photo = $_POST['picture'];
    ($photo =="avatar2.jpg")?: unlink("pictures/$photo");

    
    $sql = "DELETE FROM user WHERE user_id = {$id}";
    if (mysqli_query($connect, $sql) === TRUE) {
        $class = "success";
        $message = "Successfully Deleted!";
    } else {
        $class = "danger";
        $message = "The entry was not deleted due to: <br>" . $connect->error;
    }
    mysqli_close($connect);
} else {
    header("location: home.php");
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Delete</title>
        <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> -->
        <?php require_once 'components/boot.php' ?>
   
        
    </head>
<body class="body_style">
<?php require_once 'components/navbar.php' ?>

        <div class="container">
            <div class="mt-3 mb-3">
                <h1>Delete</h1>
            </div>
            <div class="alert alert-<?=$class;?>" role="alert">
                <p><?=$message;?></p>
                <a href='home.php'><button class="btn btn-success" type='button'>Home</button></a>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    </body>
</html>

