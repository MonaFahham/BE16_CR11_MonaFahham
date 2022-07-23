<?php
//check the session
session_start();

// if you try to go to the logout page from the url, you will not be able to
if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {// you don't have a session user and a session admin
    header("Location: index.php"); // redirect to index page(login)
    exit;
} else if (isset($_SESSION['user']) != "") { //if the session user exist
    header("Location: home.php"); // send user to the home page
} else if (isset($_SESSION['adm']) != "") {
    header("Location: dashboard.php");
}

// you must have a get ?logout in the home.php file (logout.php?logout)
if (isset($_GET['logout'])) {
    unset($_SESSION['user']); //clear the session user that we created earlier
    unset($_SESSION['adm']); //clear the session adm that we created earlier
    session_unset(); //to be more sure that we unset the session
    session_destroy(); //the session completely killed
    header("Location: index.php"); //redirect to the index(login)
    exit;
}