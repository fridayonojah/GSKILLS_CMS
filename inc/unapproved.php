<?php
session_start();
require_once "./db.php";
include_once "./form_checker.php";

if(isset($_GET['unapproved'])){
    $unapproved = $_GET['unapproved'];

        $sql = "UPDATE cms_users_comments SET status = 'OFF' WHERE id = '{$unapproved}'";
        if(!mysqli_query($link, $sql)){

        $_SESSION['errormessage'] = "Opps somwthing went wrong. Try again later";
        new_location("../comments.php");
    }else{
        $_SESSION['successmessage'] = "Comment Successfuly unapproved.". mysqli_error($link);
        new_location("../comments.php");
    
    }
}