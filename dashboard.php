<?php
  session_start();
  include_once "partials/style.php";
  include_once "partials/header.php";
  include_once "partials/sidebar.php";
  
?>



  <section class="home-section">
    <?php 
      include_once "partials/navbar.php"; 
      require_once "inc/db.php";
      require_once "inc/form_checker.php";
    ?>

    <div class="home-content  container">
      <?php  
        echo error_message();
        echo success_message();
 
      ?>

      
      <table class="table table-bordered">
        <thead class="bg-primary">
          <tr>
          <th class="text-light">S/N</th>
            <th class="text-light">AUTHOR</th>
            <th class="text-light">TITLE</th>
            <th class="text-light">CATEGORY</th>
            <th class="text-light">DATE/TIME</th>
            <th class="text-light">BANNER</th>
            <th class="text-light">COMMENTS</th>
            <th class="text-light">PREVIEW</th>
            <th class="text-light">ACTION</th>
          </tr>
        </thead>

        <?php
                        
          $query = "SELECT * FROM cms_add_post ORDER BY id DESC";

            $result = mysqli_query($link, $query);
            $sn= 0;
            while($row = mysqli_fetch_assoc($result)){
            $db_id             = $row['id'];
            $db_author      = $row['author'];
            $db_title       = $row['posttitle'];
            $db_categorey   = $row['postcategorey'];
            $db_datetime    = $row['datetime'];
            $db_image       =$row['postimage'];
            $db_content       =$row['postcontent'];
            $sn++; // this helps us generate a numerial order of number in ASC
        ?>

          <tr>
            <td><?= $sn?></td>
            <td><?= $db_author; ?></td>
            <td>
              <?php
                if(strlen($db_title) >15 ){
                    $db_title = substr($db_title, 0, 15);
                }
                echo $db_title;
              ?>
            </td>
            <td><?= $db_categorey; ?></td>
            <td><?= $db_datetime; ?></td>
            <td> <img src="./uploads/<?=$db_image;?>" alt="" style="height:5rem; width: 6rem;"> </td>
            <td>
              
            <?php

              $query = "SELECT COUNT(*) FROM cms_users_comments WHERE post_comment_id = '{$db_id}' AND status = 'OFF'";
                
                $sql = mysqli_query($link, $query);
                $row = mysqli_fetch_array($sql);
                $count_un_app = array_shift($row);
                if($count_un_app > 0){
               ?>

                <span class="badge bg-warning"><?=$count_un_app;}?></span>
              <?php    
              $sql = "SELECT COUNT(*) FROM cms_users_comments WHERE post_comment_id = '{$db_id}' AND status = 'ON'";
                
                $query = mysqli_query($link, $sql);
                $row = mysqli_fetch_array($query);
                $count = array_shift($row);
                if($count > 0){
              ?>
                 
                <span class="badge bg-success ml-3"><?=$count;?></span>
              <?php }?>    
                
            </td>
            
            <td>
                <a href='../revision/readmore.php?readmore=<?=$db_id?>'> <span class="btn btn-primary mt-3"><i class="fa fa-eye" aria-hidden="true"></i></span></a>
            </td>
           
            <td class="d-flex mt-3">
                <a href='./update.php?update=<?=$db_id;?>'> <span class="btn text-light" style="background-color:green;"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span></a>
                <a href='./delete.php?delete=<?=$db_id;?>'><span class="btn btn-danger ml-3"><i class="fa fa-trash" aria-hidden="true"></i></span></a>
            </td>
          </tr>
        <?php }?>    
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
 </script>

</body>
</html>
