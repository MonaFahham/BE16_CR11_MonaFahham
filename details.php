<?php

session_start();

require_once 'components/db_connect.php';

$sql = "SELECT * FROM animal WHERE animal_id = $_GET[animal_id]";
$result = mysqli_query($connect, $sql);

$tbody="";

if(mysqli_num_rows($result)>0){
    while($row = mysqli_fetch_assoc($result)){
        $tbody .= "
        <div class='row text-center justify-content-center'>
        <div class='card mb-3'>
        <h1 class='text-danger'>
         ".$row['animal_name']."
        </h1>
        <img src='./pictures/".$row['picture']."' class='card-img-top' alt='...'>
            <div class='card-body'>
              <h5 class='card-title'>
                <p class=' text-decoration-none'>  
                    Breed: ".$row['breed']." </a>
                 </p>
              </h5>
              <p class='card-text'>
                   Age: ".$row['age']."
              </p>
              <p>  
                <a class=' text-decoration-none text-dark' href='".$row['size'].".php'>
                    Animal Size: ".$row['size']." </a>
              </p>
              <p> 
                   Availability: ".$row['status']."
              </p>
              <div class='col-12'>
                <p>
                
                     ".$row['description']."
                </p>
            </div>  
              <p class='card-text'><small class='text-muted'>Last updated 3 hours ago</small></p>
            </div>
        </div>
        </div>



        ";

        if(isset($_SESSION["user"])){
            $tbody .= " 
            <div class='row text-center justify-content-center'>
                <div class='col-12'>
                    <a href='take.php?id=".$row['animal_id']."'><button class='btn btn-success mb-4' type='button'>Take Me</button></a>
                </div>
            </div>
            ";
        }
        if(isset($_SESSION["adm"])){
            $tbody .= " 
            <div class='row text-center justify-content-center'>
                <div class='col-12'>
                    <a href='./animals/update.php?id=".$row['animal_id']."'><button class='button' type='button'>Edit</button></a>
                    <a href='delete.php?id=".$row['animal_id']."'><button class='button button2' type='button'>Delete</button></a>

                </div>
            </div>
            ";
        }
    };
}else {
    $tbody="
       <tr>
         <td> colspan='5' class='text-center'>Not Data </td>
        </tr>
    ";
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> -->
    <title>Details</title>
    <?php require_once 'components/boot.php' ?>

</head>

<body class="body_style">
<?php require_once 'components/navbar.php' ?>
    
      <div class="container">   
        <?php  
           echo $tbody;
        ?>   
      </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
</html>