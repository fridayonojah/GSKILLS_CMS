<?php
  session_start();
  include_once "partials/style.php";
  include_once "partials/header.php";
  include_once "partials/sidebar.php";
?>

<!DOCTYPE html>
<!-- Designined by CodingLab | www.youtube.com/codinglabyt -->
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title>Admin Dashboard | Gskills.com</title>
    <!-- <link rel="stylesheet" href="style.css"> -->
    
    <!-- Boxicons CDN Link -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <!-- font icons included -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--  bootstrap link -->
    <link rel="stylesheet" href="../assets/style/bootstrap.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>


  <section class="home-section">
    <?php 
      include_once "partials/navbar.php"; 
      require_once "inc/db.php";
      require_once "inc/form_checker.php";
    ?>
  
    <div class="home-content container">
        <?php
          echo error_message();
          echo success_message();
        ?>

        <div class="card">
            <div class="card-header text-center">
               MAKE A NEW POST
            </div>

            <div class="card-body">
              
            <form action="inc/addpost.php" method="POST" class="" enctype="multipart/form-data">
              <div class="row">
                <div class="col-md-4">
                  <label for="title">Title:</label>
                  <input type="text" placeholder="Enter title" name="title" required class="form-control">
                </div>

                <div class="col-md-4">
                  <label for="title">category:</label>
                  <select name="category" id="category" class="form-control">
                    <?php 
                      $query = "SELECT * FROM cms_post_categorey ORDER BY id DESC";
                      $result = mysqli_query($link, $query);
                
                      while($row = mysqli_fetch_assoc($result)){
                      $db_id  = $row['id'];
                      $category = $row['categorey'];
                    ?>
                    <option value="<?= $category;?>"><?= $category;?></option>
                    <?php }?>
                  </select>
                </div>

                <div class="col-md-4">
                  <label for="file">upload file:</label>
                  <input type="file"  name="image" required class="form-control">
                </div>
              </div>
              
              <label for="content">Make a post:</label>
              <textarea name="content" id="content" cols="30" rows="10" class="form-control" required></textarea>
              

              <input type="submit" class="form-control btn btn-primary mt-3" name="addpost" id="submit" value="ADD POST">
            </form>
            </div>
        </div> 
    </div> 
  </section>

<script>
let sidebar = document.querySelector(".sidebar");
let sidebarBtn = document.querySelector(".sidebarBtn");
sidebarBtn.onclick = function() {
  sidebar.classList.toggle("active");
  if(sidebar.classList.contains("active")){
  sidebarBtn.classList.replace("bx-menu" ,"bx-menu-alt-right");
}else
  sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
}
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
 </script>

</body>
</html>
