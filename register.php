<?php

//if you login the page, you cannot go to the register page. you have to logout and then go to the register page
session_start(); // start a new session or continue the previous require_once 'components/db_connect.php';

//maybe a user try to connect to this page but he is already logged in. so i will redirect him and not allow him to come to this page. it will never let you open index (login) page if session is set
if (isset($_SESSION['user']) ){ // if the session user exist
    header("Location: home.php"); // redirects to home.php
    exit;
}

if (isset($_SESSION['adm']) ){
    header("Location: dashboard.php"); // redirects to dashboard.php
    exit;
}

require_once 'components/db_connect.php';
require_once 'components/file_upload.php';

// it will start with false and if you put the inut empty or write the wrong format of the email for exapmle in the input, the $error change to true and u will not able to insert.
$error = false;

$fname = $lname = $email = $date_of_birth = $pass = $picture = $phone = $address = ''; // The value of each input
$fnameError = $lnameError = $emailError = $dateError = $passError = $picError = $phoneError = $addressError = '';  // The error of each input

// It means when I click the btn, what will happen
// We use POST, because we have a form with POST method
if (isset($_POST['btn-signup'])) {

    // sanitise user input to prevent sql injection
    // trim - strips whitespace (or other characters) from the beginning and end of a string
    $fname = trim($_POST['fname']); //(clean the input from spaces)

    // strip_tags -- strips HTML and PHP tags from a string
    $fname = strip_tags($fname);

    // htmlspecialchars converts special characters to HTML entities(e.g. & , < , > , @ , ...)
    $fname = htmlspecialchars($fname);

    $lname = trim($_POST['lname']);
    $lname = strip_tags($lname);
    $lname = htmlspecialchars($lname);

    $email = trim($_POST['email']);
    $email = strip_tags($email);
    $email = htmlspecialchars($email);

    $date_of_birth = trim($_POST['date_of_birth']);
    $date_of_birth = strip_tags($date_of_birth);
    $date_of_birth = htmlspecialchars($date_of_birth);

    $pass = trim($_POST['pass']);
    $pass = strip_tags($pass);
    $pass = htmlspecialchars($pass);

    $phone = trim($_POST['phone']);
    $phone = strip_tags($phone);
    $phone = htmlspecialchars($phone);

    $address = trim($_POST['address']);
    $address = strip_tags($address);
    $address = htmlspecialchars($address);

   // these two lines reated to (if (!$error) {... '$picture->fileName'})
   $uploadError = '';
   $picture = file_upload($_FILES['picture']);


   // ***basic name validation
   if (empty($fname) || empty($lname)) { //if one of the variables are empty->show error
       $error = true; //($error=false;) that we have on top of the page change to true
       $fnameError = "Please enter your full name and surname";
   } else if (strlen($fname) < 3 || strlen($lname) < 3) { // if the lenght of the first name is less than 3->show error
       $error = true;
       $fnameError = "Name and surname must have at least 3 characters.";

   // This is a pattern: ("/^[a-zA-Z]+$/", $fname) that tell u that it need to start with a small-letter(a-z) or capital-letter(A-Z), and it doesn;t take spaces($)
   } else if (!preg_match("/^[a-zA-Z]+$/", $fname) || !preg_match("/^[a-zA-Z]+$/", $lname)) { // if there is a number in firstname or lastname->show error
       $error = true;
       $fnameError = "Name and surname must contain only letters and no spaces.";
   }

   if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {  //Check if the format of the email doesnt have the filter of an email, then show the error (e.g. abc@gmail.com) (in which filter i wanna check? FILTER_VALIDATE_EMAIL)
       $error = true;
       $emailError = "Please enter valid email address.";
   } else { // checks whether the email exists or not
       $query = "SELECT email FROM user WHERE email='$email'"; //write the query 
       $result = mysqli_query($connect, $query); //run the query(GO btn in SQL)(i need the connection and the $query that i wanna trigger)
       $count = mysqli_num_rows($result); //check how many results I have when I run the query
       if ($count != 0) { //if it is not zero. if there is a result(1 or more)
           $error = true;
           $emailError = "Provided Email is already in use.";
       }
   }

   // password validation
   if (empty($pass)) {
       $error = true;
       $passError = "Please enter your password.";
   }else if (strlen($pass) < 6) {
       $error = true;
       $passError = "Password must have at least 6 characters.";
   }
   
   // checks if the date input was left empty
   if (empty($date_of_birth)) {
       $error = true;
       $dateError = "Please enter your date of birth.";
   }

    if (empty($phone)) {
        $error = true;
        $phoneError = "Please enter your phone number.";
    }

    if (empty($address)) {
        $error = true;
        $addressError = "Please enter your address.";
    }

   // password hashing for security(hash the password and put it into database)
   $password = hash('sha256', $pass);

   // if there's no error, continue to sign up
   if (!$error) { //if not $error=false; 
       $query = "INSERT INTO user(first_name, last_name, password, date_of_birth, email, picture)  
                 VALUES('$fname', '$lname', '$password', '$date_of_birth', '$email', '$picture->fileName')";
       
       $res = mysqli_query($connect, $query); //run the query

       if ($res) { //if everything is fine and the result is ok
           $errTyp = "success"; //add an alert with green color
           $errMSG = "Successfully registered, you may login now";
           $uploadError = ($picture->error != 0) ? $picture->ErrorMessage : ''; //show the picture massage
       } else {
           $errTyp = "danger";
           $errMSG = "Something went wrong, try again later...";
           $uploadError = ($picture->error != 0) ? $picture->ErrorMessage : '';
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
    <title>Register</title>
    <?php require_once 'components/boot.php' ?>
</head>

<body class="body_style">
<?php require_once 'components/navbar.php' ?>

    <div class="container">

        <!-- We write (action="php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>) for the security -->
        <!-- We write (enctype="multipart/form-data") because we have a picture -->
        <form class="w-75" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off" enctype="multipart/form-data">
            <h2>Sign Up.</h2>
            <hr />
            <?php
            if (isset($errMSG)) {
            ?>
                <div class="alert alert-<?php echo $errTyp ?>">
                    <p><?php echo $errMSG; ?></p>
                    <p><?php echo $uploadError; ?></p>
                </div>

            <?php
            }
            ?>

            <!-- We write (value="php echo $fname ?>) because when we fill the form, the input will use the value that we wrote, so we define them in top at php with the empty string-->
            <input type="text" name="fname" class="form-control" placeholder="First name" maxlength="50" value="<?php echo $fname ?>" />
            <span class="text-danger"> <?php echo $fnameError; ?> </span>

            <input type="text" name="lname" class="form-control" placeholder="Surname" maxlength="50" value="<?php echo $lname ?>" />
            <span class="text-danger"> <?php echo $fnameError; ?> </span>

            <input type="email" name="email" class="form-control" placeholder="Enter Your Email" maxlength="40" value="<?php echo $email ?>" />
            <span class="text-danger"> <?php echo $emailError; ?> </span>
            
            <input type="number" name="phone" class="form-control" placeholder="Enter Your phone number" maxlength="40" value="<?php echo $phone ?>" />
            <span class="text-danger"> <?php echo $phoneError; ?> </span>
            
            <input type="text" name="address" class="form-control" placeholder="Enter Your address" maxlength="60" value="<?php echo $address ?>" />
            <span class="text-danger"> <?php echo $addressError; ?> </span>

            <div class="d-flex">
                <input class='form-control w-50' type="date" name="date_of_birth" value="<?php echo $date_of_birth ?>" />
                <span class="text-danger"> <?php echo $dateError; ?> </span>

                <input class='form-control w-50' type="file" name="picture">
                <span class="text-danger"> <?php echo $picError; ?> </span>
            </div>
            <input type="password" name="pass" class="form-control" placeholder="Enter Password" maxlength="15" />
            <span class="text-danger"> <?php echo $passError; ?> </span>
            <hr />
            <button type="submit" class="btn btn-block btn-primary" name="btn-signup">Sign Up</button>
            <hr />
            <a href="index.php">Sign in Here...</a>
        </form>
    </div>
</body>
</html>