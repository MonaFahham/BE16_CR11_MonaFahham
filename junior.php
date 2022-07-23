<?php

require_once 'components/db_connect.php';

$sql = "SELECT * FROM animal WHERE age <= 8 "; 
$result = mysqli_query($connect, $sql);

$tbody="";

if(mysqli_num_rows($result)>0){
    while($row = mysqli_fetch_assoc($result)){
        
        $tbody .= "
        <div class='container col-4 nsl justify-content-center'>
          <div class='boox col-12 justify-content-center '>
                <a class='eddt' href='details.php?animal_id=".$row['animal_id']."'>
                  <img class='im-size' src='./pictures/" .$row['picture']."'>
                </a>
          </div>
          <div class='text-center nsl2'>
            <a class='eddt' href='details.php?animal_id=".$row['animal_id']."'>
              <h4>" .$row['animal_name']."</h4>
              <h4>" .$row['breed']."</h4>
            </a>
          </div>
        </div> ";
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
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> -->
    <title>Junior</title>
    <link rel="stylesheet" href="css/style.css">
    <?php require_once 'components/boot.php' ?>
</head>

<body class="body_style">
<?php require_once 'components/navbar.php' ?>

    
    <div id="items">
    
      <div class="row text-center dit justify-content-center">
        <div class="col-12">
          <h3 class="heading text-center">Junior</h3>
        </div>
        
        
        <div class="col-12 row">
           <?php echo $tbody; ?>
        </div>
    
      </div>
    
    </div>





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>