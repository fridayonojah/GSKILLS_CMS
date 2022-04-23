<?php 
    session_start();
    include_once "./partials/header.php";
    include_once "./inc/db.php";
    include_once "./inc/form_checker.php";
    
    
?>

    <style>
        .register{
            margin-left: 21rem;
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
            width: 40rem;
            
        }
        .container{
            margin-top: 4rem;
            margin-bottom: 4rem;
        }
        
    </style>
    
    <?php
    if (isset($_GET['update'])) {   
        $update = $_GET['update'];  
    }

    if (isset($_POST['update'])) { 

        $title = mysqli_real_escape_string($link,  $_POST['post_title']);
        $category = mysqli_real_escape_string($link, $_POST['post_categorey']);
        $content= mysqli_real_escape_string($link, $_POST['post_content']);
        $image = app_upload_img('post_file', './uploads');

        $sql = "UPDATE cms_add_post SET posttitle = '{$title}', postcategorey = '{$category}', postcontent = '{$content}' WHERE id = '{$update}'";

        if(!mysqli_query($link, $sql))
        {
            $_SESSION['errormessage'] = "Opps something went wrong. Try again later.";
            new_location('dashboard.php');
            die('error' . mysqli_error($link));
        }
        else
        {
            $_SESSION['successmessage'] = "Post Successfuly Updated.";
            new_location('dashboard.php');
        }
        
    }
    ?>


    <section class="register">
        <div class="container">
            <div class="card border mt-5 p-3">
                <div class="card-title text-center mt-3 text-primary">Update Post</div>
                <div class="card-body">
                    
                    <form action="" method="POST" enctype="multipart/form-data">
                    
                        <?php
            
                            $query = "SELECT * FROM cms_add_post WHERE id = $update";

                            $result = mysqli_query($link, $query);
                            $sn= 0;
                            while($row = mysqli_fetch_assoc($result)){
                            $db_id          = $row['id'];
                            $db_title       = $row['posttitle'];
                            $db_categorey   = $row['postcategorey'];
                            $db_datetime    = $row['datetime'];
                            $db_image       =$row['postimage'];
                            $db_content       =$row['postcontent'];
                            $sn++; // this helps us generate a numerial order of number in ASC
                        ?>
                        <?php }?>
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control"  name="post_title" id="post_title" value="<?=$db_title?>">
                        </div>

            
                        <div class="form-group">
                            <label for="title">Add Categorey</label>
                            <select name="post_categorey" id="post_categorey" class="form-control form-select">
                                <?php
                                    $query = "SELECT * FROM cms_post_categorey ORDER BY timedate DESC";

                                    $result = mysqli_query($link, $query);
                                    $sn= 0;
                                    while($row = mysqli_fetch_assoc($result)){
                                    $db_id  = $row['id'];
                                    $db_author = $row['author'];
                                    $db_datetime = $row['timedate'];
                                    $db_categorey = $row['categorey'];
                                    $sn++;
                                ?>
                                <option value="<?=$db_categorey;?>"><?=$db_categorey;?></option>
                                <?php }?>
                            </select>
                        </div>
                
                        <div class="row">
                            <div class="col-md-6">
                                <label for="current image">Current Image</label>
                                <img src="./uploads/<?=$db_image;?>" alt="" style="height:3rem; width: 6rem;"> 
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="upload-image">change image</label>
                                    <input type="file" name="post_file" id="post_file" class="form-control" value="">
                                </div>
                            </div>
                        </div>
                        

                        <label for="content">Make a post</label>
                        <textarea name="post_content" id="post_content" cols="30" rows="10" class="form-control" value=""><?=$db_content;?></textarea>
                        
        
                        <input type="submit" class="form-control btn btn-primary mt-4" name="update" id="update" value="UPDATE POST">
                    </form>
                </div>
            </div>
    </section>
</body>
</html>