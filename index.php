<?php 
    session_start(); 
    require_once "./inc/form_checker.php";
    require_once "./partials/header.php";
?>

    
    <style>
        .register{
            margin-left: 30rem;
            margin-top: 1rem;
        }
        .card-title{
            font-size: 1.4rem;
            font-weight: bold;
            font-family: Georgia, 'Times New Roman', Times, serif;
        }
        label{
            font-family: Geogia;
            font-size: 1rem;
        }
        body{
            background-color: rgb(25,25,125);
        }
        .card{
            width: 23rem;
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
        <div class="container" style="margin-top: 7rem;">
            <div class="card border mt-4 p-3">
                <div class="card-title text-center mt-3">Login Form</div>
                <?php
                    require_once "./inc/register.inc.php";
                    echo error_message();
                    require_once "./inc/errors.php";
                    
                ?>
                <div class="card-body">
                    <form action="" method="POST">

                        <label for="username">Username</label>
                        <input type="text" class="form-control" value="<?= $username; ?>" placeholder="John_paul" name="username">

                        <label for="password">Password</label>
                        <input type="password" class="form-control" value="<?= $password; ?>" placeholder="12345" name="password">
                        
                        <button type="submit" class="form-control mt-4 btn btn-primary" name="login">Login</button>
                    </form>
                    <a href="register.php" class="nav-link mt-3">Don't have an account Register</a>
                </div>
            </div>
        </div>
    </section>

</body>
</html>