<?php
// include_once "../partials/header.php";
// include_once "./db.php";
// include_once "./form_c";

function check_input($result){
    $result = stripslashes(trim($result));
    return   $result;
    
}

function error_message(){
    
    if(isset($_SESSION['errormessage'])){
        $error_alert = "<div class='alert alert-danger mt-4'>";
        $error_alert .= htmlentities($_SESSION['errormessage']);
        $error_alert  .= "</div>";
        $_SESSION['errormessage'] = null;

        return $error_alert;
    }
}

function success_message(){
    
    if(isset($_SESSION['successmessage'])){
        $success_alert = "<div class='alert alert-success mt-4'>";
        $success_alert .= htmlentities($_SESSION['successmessage']);
        $success_alert  .= "</div>";
        $_SESSION['successmessage'] = null;

        return $success_alert;
    }
}

// function to redirect users to a new location;
function new_location($directe){
    header("location:". $directe);
}

// function for uploading of image into the database;
function app_upload_img($target_file, $upload_dir){
    $file_name = $_FILES[$target_file]['name']; 
    $extension =  pathinfo($file_name, PATHINFO_EXTENSION);
    $new_name = 'cms_pix_'.time().'.'.$extension;
    $tmp_name        = $_FILES[$target_file]['tmp_name'];
    move_uploaded_file($tmp_name,"$upload_dir/$new_name");
    return $new_name;
}

// function upload_images($target_file, $upload_dir){
//     $file_name = $_FILES[$target_file]['name'];
//     $extension = pathinfo($file_name, PATHINFO_EXTENSION);
//     $new_name = 'gskills_pixs' .time() . '.' . $extension;
//     move_uploaded_file($_FILES[$target_file]['temp_name'],"$upload_dir/$new_name");
    
// }
