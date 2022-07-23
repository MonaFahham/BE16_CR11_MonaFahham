<?php

session_start();

require_once "./components/db_connect.php";

$id = $_SESSION["user"];
$id = $_GET["id"];
$sql1 = "SELECT * FROM animal WHERE animal_id = $id";
$sql2 = "INSERT INTO pet_adoption ( fk_animal_id, fk_user_id, adoption_date) VALUES ( $id, {$id}, CURDATE())";
$sql3 = "UPDATE animal SET status = status - 1 WHERE animal_id = {$id}";
$res1 = mysqli_query($connect, $sql1);
$res2 = mysqli_query($connect, $sql2);
$res3 = mysqli_query($connect, $sql3);
$data = mysqli_fetch_all($res1, MYSQLI_ASSOC);
$result = mysqli_query($connect, $sql1);

$tbody="";

if(mysqli_num_rows($result)>0){
    while($row = mysqli_fetch_assoc($result)){ 
        $tbody .= " 
        
        <div class='row text-center justify-content-center'>
            <div class='nsl'></div>
            <div class='col-12 nsl'>
                <h1 class='dit'>
                
                  ".$row['animal_name']."
                </h1>
                <div class='dimgbox'>
                    <img class='ditimg' src='./pictures/".$row['picture']."'>
      
                </div>
            </div>
            <div class='col-12 nsl'>
              <h1>Breed: ".$row['breed']." </a>
              </h1>
            </div>  
        </div>";
    };
}else {
    $tbody="
       <tr>
         <td> colspan='5' class='text-center'>Not Data </td>
        </tr> 
    ";
}

mysqli_close($connect);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> -->
    <title>Take Me</title>
    <?php require_once 'components/boot.php' ?></head>

    
<body class="body_style">
<?php require_once 'components/navbar.php' ?>
  
  <div id="items">

    <div class="row text-center dit justify-content-center">
      <div class="col-12">
        <h3 class="heading text-center">Congratulations</h3>
      </div>
      
      <div class="col-12 row">
         <?php echo $tbody; ?>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>