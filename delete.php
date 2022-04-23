<?php
session_start();
    include_once "./partials/header.php";
    include_once "./inc/db.php";
    include_once "./inc/form_checker.php";

if(isset($_GET['delete']))
{

	$delete = $_GET['delete'];

	$sql= "DELETE FROM cms_add_post WHERE id = $delete";

    if(!mysqli_query($link, $sql))
    {
        $_SESSION['errormessage'] = "Opps something went wrong. Try again later";
        die("erro" . mysqli_error($link));
        new_location('dashboard.php');
    }
    else
    {
        $_SESSION['successmessage'] = "Post successfuly Deleted";
        new_location('dashboard.php');
    }
}