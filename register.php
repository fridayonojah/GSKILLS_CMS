<?php 
    session_start(); 
    require_once "./inc/form_checker.php";
    require_once "./partials/header.php";
?>
    <style>
        .register{
            margin-left: 27rem;
            padding:1rem;
        }
        .card-title{
            font-size: 1.3rem;
            font-weight: bold;
            font-family: Georgia, 'Times New Roman', Times, serif;
        }
        label{
            font-family: Geogia;
            font-size: 1rem;
        }
        body{
            background-color: rgb(25,25,125);
            /* overflow-y: hidden; */
        }
        .card{
            width: 30rem;
            
        }
        .container{
            margin-top: 4rem;
            margin-bottom: 4rem;
        }
        .error {
            width: 92%; 
            margin: 0px auto; 
            padding: 10px; 
            border: 1px solid #a94442; 
            color: #a94442; 
            background: #f2dede; 
            border-radius: 5px; 
            text-align: left;
        }
    </style>
    
    <section class="register">
        <div class="container">
            <div class="card border mt-5 p-3">

                <div class="card-title text-center mt-3 text-primary">Registeration Form</div>
                <?php
                   
                    require_once "./inc/register.inc.php";
                    echo error_message();
                    require_once "./inc/errors.php";
                
                ?>
                <div class="card-body">
                    
                    <form action="" method="POST" enctype="multipart/form-data">
                        <label for="name">Full name</label>
                        <input type="text" class="form-control" value="<?=$full_name; ?>" placeholder="John" name="fullname">
                        
                    
                        <label for="username">Username</label>
                        <input type="text" class="form-control" value="<?= $username; ?>" placeholder="John_paul" name="username">
                        

                        <label for="email">E-mail</label>
                        <input type="email" class="form-control" value="<?= $email; ?>" placeholder="johnpaul@gmail.com" name="email">
                        

                        <label for="password">Password</label>
                        <input type="password" class="form-control" placeholder="12345" name="password_1">
                       

                        <label for="password">confirm password</label>
                        <input type="password" class="form-control" placeholder="12345" name="password_2">
                        
                        <label for="image">profile image</label>
                        <input type="file" class="form-control" name="image" value="<?= $profile_img; ?>">

                        <button type="submit" class="form-control mt-4 btn btn-primary" name="register">Register</button>
                    </form>
                    <a href="index.php" class="nav-link mt-3">Already have an account Login</a>
                </div>
            </div>
        </div>
    </section>

</body>
</html>