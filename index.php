<?php
session_start();

require_once 'components/db_connect.php';

//maybe a user try to connect to this page but he is already logged in. so I will redirect him and not allow him to come to this page
// it will never let you open index (login) page if session is set
if (isset($_SESSION['user']) != "") { // if the session user exist
    header("Location: home.php"); // redirects to home.php
}
if (isset($_SESSION['adm']) != "") {
    header("Location: dashboard.php"); // redirects to dashboard.php
}

$error = false;
$email = $password = $emailError = $passError = '';

if (isset($_POST['btn-login'])) { //if you click on the button signin

    $email = trim($_POST['email']);
    $email = strip_tags($email);
    $email = htmlspecialchars($email);

    $pass = trim($_POST['pass']);
    $pass = strip_tags($pass);
    $pass = htmlspecialchars($pass);

    if (empty($email)) { //if email is empty->error
        $error = true;
        $emailError = "Please enter your email address.";
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { //if it is not the correct format of email->error
        $error = true;
        $emailError = "Please enter valid email address.";
    }

    if (empty($pass)) { //if password is empty->error
        $error = true;
        $passError = "Please enter your password.";
    }

    // if there's no error, continue to sign in
    if (!$error) {
        $password = hash('sha256', $pass); // password hashing

        $sql = "SELECT user_id, first_name, password, status FROM user WHERE email = '$email'";
        $result = mysqli_query($connect, $sql); //run the query

        //use fetch because I know that if I have a result, it will be only one result. because email is unique
        $row = mysqli_fetch_assoc($result);

        $count = mysqli_num_rows($result);//check how many result I have

        if ($count == 1 && $row['password'] == $password) { // if I have only one result

            // now we check if this person is a user or admin
            if ($row['status'] == 'adm') {
                $_SESSION['adm'] = $row['user_id'];
                header("Location: dashboard.php");
            } else {
                $_SESSION['user'] = $row['user_id'];
                header("Location: home.php");
            }
        } else {
            $errMSG = "Incorrect Credentials, Try again...";
        }
    }
}

mysqli_close($connect);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Sign In</title>
    <?php require_once 'components/boot.php' ?>
</head>

<body class="body_style">
  <?php require_once 'components/navbar.php' ?>

    <div class="container justify-content-center">
        <div class="row justify-content-center text-center text-danger">
            <form class="col-6 form_top" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
                <h2 class="txt">Sign In</h2>
                <!-- <p>adm: wall@mail.com   usr: some@mail.com  pass: 123456</p> -->
                <?php
                if (isset($errMSG)) {
                    echo $errMSG;
                }
                ?>
    
                <input type="email" autocomplete="off" name="email" class="form-control" placeholder="Your Email" value="<?php echo $email; ?>" maxlength="40" />
                <span class="text-danger"><?php echo $emailError; ?></span>
                <div class="nsl"></div>
    
                <input type="password" name="pass" class="form-control" placeholder="Your Password" maxlength="15" />
                <span class="text-danger"><?php echo $passError; ?></span>
                <div class="nsl"></div>
                
                <button class="btn btn-block btn-danger text-light mt-4" type="submit" name="btn-login">Sign In</button>
                
                <a class="btn btn-block btn-secondary mt-4" href="register.php">New User? Sign Up</a>
            </form>

        </div>
    </div>


</body>
</html>