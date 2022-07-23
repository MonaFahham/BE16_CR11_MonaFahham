<?php 

session_start();

require_once 'components/db_connect.php';

if (!isset($_SESSION['adm'])) {
    header("Location: index.php");
    exit;
}

if ($_GET['id']) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM user WHERE user_id = {$id}" ;
    $result = mysqli_query($connect, $sql);
    $data = mysqli_fetch_assoc($result);
    if (mysqli_num_rows($result) == 1) {
        $fname = $data['first_name'];
        $lname = $data['last_name'];
        $photo = $data['picture'];
        $address = $data['address'];
        $email = $data['email'];
        $date_of_birth = $data['date_of_birth'];
    } else {
        header("location: error.php");
    }
    mysqli_close($connect);
} else {
    header("location: error.php");
}  
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/style.css">
        <title>Delete Product</title>
        <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> -->
        <?php require_once 'components/boot.php' ?>
   
    </head>

<body class="body_style">
<?php require_once 'components/navbar.php' ?>
    
        <fieldset>
            <div class="row text-center justify-content-center">
                <div class="nsl"></div>
                <div class="col-12 nsl">
                    <h3>Delete request</h3>
                </div>
                <div class="col-6">
                    <div class="dimgbox">
                        <img class="dimg" src='./pictures/<?php echo $photo ?>' alt="<?php echo $fname ?>">
                    </div>
                </div>
                <h4 class="text-danger"><?php echo $fname?></h4>
                <h6>Do you really want to delete this user?</h6>
                <div class="col-12">
                    <form action ="./a_delete.php" method="post">
                        <input type="hidden" name="id" value="<?php echo $id ?>" />
                        <input type="hidden" name="picture" value="<?php echo $photo ?>" />
                        <button class="button button2" type="submit">Yes, delete it!</button>
                        <a href="home.php"><button class="button" type="button">No, go back!</button></a>
                    </form>
                </div>
            </div>

        </fieldset>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    </body>
</html>