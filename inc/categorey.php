<?php
require_once "db.php";
include_once "form_checker.php";

if (isset($_POST['submit'])) {

    $categorey = mysqli_real_escape_string($link, $_POST['categorey']);

    date_default_timezone_set('Africa/Lagos');
    $date_time = strftime("%B-%d-%Y %H:%M:%S");
    $author = "admin";

    if (empty($categorey)) {
        $_SESSION['errormessage'] = "This musn't be empty";
        new_location('../category.php');

    }elseif(strlen($categorey) > 40){
        $_SESSION['errormessage'] = "Characters can't be more than 40";
        new_location('../category.php');

    }else{
        $sql = "INSERT INTO  cms_post_categorey(author,timedate,categorey)";
        $sql .="VALUES('$author','$date_time','$categorey')";

        // Attempt to insert into the database
        $query = mysqli_query($link, $sql);  
        if(!$query){
            $_SESSION['errormessage'] = "Opps something went wrong try again";
            new_location('../category.php');
        }else{
            $_SESSION['successmessage'] = "Categorey successfuly added";
            new_location('../category.php');
        }
    }
    // close connection
    mysqli_close($link);
}