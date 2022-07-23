<!-- You will be able to access this page only if you logged in -->
<?php
session_start();

require_once 'components/db_connect.php';

// adm will redirect to dashboard
if (isset($_SESSION['adm'])) {  // if the admin try too acces this page and didnt log in before, he will not be able to
    header("Location: dashboard.php"); // redirect to dashboard.php
    exit; // stop the page from loading
}
// if session is not set this will redirect to login page
if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) { // if you have no session user and you try to acces home.php
    header("Location: index.php"); // redirect to index page(log in)
    exit;
}

// select logged-in users details - procedural style
$sql = "SELECT * FROM user WHERE user_id= {$_SESSION['user']}";
$result = mysqli_query($connect,$sql);
$row = mysqli_fetch_array($result);


$sql1 = "SELECT * FROM animal";
$result1 = mysqli_query($connect ,$sql1);
$row1 = mysqli_fetch_array($result1);

$tbody= ''; 
if(mysqli_num_rows($result1)  > 0) {     
    while($row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC)){ 
      $tbody .= "
      <div class='container col-lg-4 justify-content-center'>
        <div class='col-12 justify-content-center '>
              <a href='details.php?animal_id=".$row1['animal_id']."'>
                <img class='image-size' src='./pictures/" .$row1['picture']."'>
              </a>
        </div>
        <div class='text-center'>
          <a class='intro_animal' href='details.php?animal_id=".$row1['animal_id']."'>
            <h4 class='text-uppercase text-danger'>" .$row1['animal_name']."</h4>
            <h4 class='text-secondary'>" .$row1['breed']."</h4>
          </a>
        </div>
      </div>
      "
      ;
   };
} else {
    $tbody =  "<tr><td colspan='5'><center>No Data Available </center></td></tr>";
}

mysqli_close($connect); //close the connection so it will be very hard for others to access the database

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <!-- write the name of the user in title -->
    <title>Welcome <?php echo $row['first_name']; ?></title>
    <?php require_once 'components/boot.php' ?>
</head>

<body class="body_style">
<?php require_once 'components/navbar.php' ?>
    
  <div class="container">
        <div class="hero d-flex">
          <p class="text-white logged_user">Hi <?php echo $row['first_name'] . " " .$row['last_name'] ; ?></p>
          <img class="userImage" src="pictures/<?php echo $row['picture']; ?>" alt="<?php echo $row['first_name']; ?>">
          <p class="text-danger logged_user"><?php echo $row['email'] ; ?></p>
        </div>
        <p><a class="text-danger" href="logout.php?logout">Log Out</a></p>
  </div>


  <div class=" container caption text-center align-items-center">
    <h1 class="text-center txt">Adopt A Pet</h1>

  </div>

  <div id="items">

    <div class="row text-center justify-content-center">
      <div class="col-12">
        <h3 class="heading text-center text-danger py-4">Animals</h3>
      </div>
  
      <!-- <a class='col-3 sizes align-items-center' href='large.php'> <h3 class=" text-center">Large</h3> </a>
       
      <a class='col-3 sizes align-items-center' href='small.php'> <h3 class=" text-center">Small</h3> </a>
    
      <a class='col-3 sizes align-items-center' href='senior.php'> <h3 class=" text-center">Senior</h3> </a>
      
      <a class='col-3 sizes align-items-center' href='junior.php'> <h3 class=" text-center">Junior</h3> </a> -->

      <div class="col-12 row">
         <?php echo $tbody; ?>
      </div>

    </div>

  </div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
</html>