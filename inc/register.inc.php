<?php
    require_once "db.php";
    include_once "form_checker.php";

    $full_name = "";
    $username = "";
    $email = "";
    $password = "";
    $confirm_password = "";
    $errors = array(); 

    function check_data_given($connection, $data){
        mysqli_real_escape_string($connection, $data);
        if(!empty($data)){
            $data = htmlspecialchars($data);
            $data = trim($data);
            $data = htmlentities($data);
        }
        return $data;
    }
    

if (isset($_POST['register'])) {
    

  // receive all input values from the form
  $fullname = check_data_given($link, $_POST['fullname']);
  $username = check_data_given($link, $_POST['username']);
  $email = check_data_given($link, $_POST['email']);
  $password_1 = check_data_given($link, $_POST['password_1']);
  $password_2 = check_data_given($link, $_POST['password_2']);
  $profile_img  = app_upload_img('image', 'uploads');
  
  // form validation: ensure that the form is correctly filled ...
  if(empty($fullname)) { array_push($errors, "fullname is required");}
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }

  if (empty($password_1))
    { 
       array_push($errors, "Password is required");
    }elseif(strlen($password_1) < 6){
        array_push($errors, "passwords must be aleast 6 characters");
    }

  if ($password_1 != $password_2) {
	array_push($errors, "passwords don't match");
  }

  
  $user_check_query = "SELECT * FROM cms_users_registration WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($link, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
//   to check if a user already
  if ($user) {
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }else{
        if(!preg_match('/^[a-zA-Z0-9_]+$/', $username)){
            array_push($errors, "Username can only contain letters, numbers, and underscores.");
        }
    }

    if ($user['email'] === $email) {
      array_push($errors, "Email already exists");
    }else{
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            array_push($errors, "Wrong email format");
        }
    }
  }

  // Finally, register user if there are no errors in the form
    if (count($errors) == 0) {

        // hash password
        $passwordhash = password_hash($password_1, PASSWORD_DEFAULT);

        $sql = "INSERT INTO cms_users_registration(fullname,username,email,password,image)";
        $sql .= "Values('{$fullname}', '{$username}', '{$email}', '{$passwordhash}', '{$profile_img}')";

        if(!mysqli_query($link, $sql)){
            $_SESSION['errormessage'] = "Opps somwthing went wrong. Try again later". mysqli_error($link);
        }else{
            header('location: ../login.php');
        }
    }
    // close connection
    // mysqli_close($link);
}

// LOGIN USER
if (isset($_POST['login'])) {
  $username = mysqli_real_escape_string($link, $_POST['username']);
  $password = mysqli_real_escape_string($link, $_POST['password']);

  if (empty($username)) {
  	array_push($errors, "Username is required");
  }
  if (empty($password)) {
  	array_push($errors, "Password is required");
  }
  
  if (count($errors) == 0) {
  	$password = password_hash($password, PASSWORD_DEFAULT);
    
  	$query = "SELECT * FROM cms_users_registration WHERE username='$username' OR password='$password'";
  	$results = mysqli_query($link, $query);
  	if (mysqli_num_rows($results) == 1) {
      while($row = mysqli_fetch_assoc($results)){
        $image = $row['image'];
        $fullname = $row['fullname'];

        $_SESSION['fullname'] = $fullname;
        $_SESSION['username'] = $username;
        $_SESSION['image'] = $image;
  	    header('location: dashboard.php');
      }
  	  
  	}else {
  		array_push($errors, "Wrong username or password");
  	}
  }
}

