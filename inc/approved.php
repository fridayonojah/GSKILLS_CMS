<?php
session_start();
require_once "./db.php";
include_once "./form_checker.php";

if(isset($_GET['approved'])){
    $approved = $_GET['approved'];

        $sql = "UPDATE cms_users_comments SET status = 'ON' WHERE id = '{$approved}'";
        if(!mysqli_query($link, $sql)){

        $_SESSION['errormessage'] = "Opps somwthing went wrong. Try again later";
        new_location("../comments.php");
    }else{
        $_SESSION['successmessage'] = "Comment Successfuly Approved.". mysqli_error($link);
        new_location("../comments.php");
    
    }
}