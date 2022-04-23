<?php
require_once "db.php";
include_once "form_checker.php";

if(isset($_POST['addpost'])){

  $title = mysqli_real_escape_string($link, trim(htmlspecialchars($_POST['title'])));
  $content = mysqli_real_escape_string($link, trim(htmlspecialchars($_POST['content'])));
  $category = mysqli_real_escape_string($link, trim(htmlspecialchars($_POST['category'])));
  $author = "Admin";
  date_default_timezone_set('Africa/Lagos');
  $datetime = strftime("%B-%d-%Y %H:%M:%S");
  $image = app_upload_img('image', '../uploads');
  

  $sql = "INSERT INTO cms_add_post(posttitle,postcategorey,postimage,postcontent,datetime,author)";
  $sql .= "Values('$title','$category','$image','$content','$datetime','$author')";

  // Attempt to submit to the database
  if(!mysqli_query($link, $sql)){
      $_SESSION['errormessage'] = "Opps something went wrong try again";
      header("location: add_post.php");
      
     
  }else{
      $_SESSION['successmessage'] = "Post successfuly created";
      new_location('../dashboard.php');
  }  
    //close connection
    mysqli_close($link); 
}

