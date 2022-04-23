<?php
  session_start();
  include_once "./partials/style.php";
  include_once "./partials/header.php";
  include_once "./partials/sidebar.php";
?>

  <section class="home-section">
  <?php 
    
    include_once "./partials/navbar.php"; 
    require_once "./inc/db.php";
    require_once "./inc/form_checker.php";
  ?>
  
    <div class="home-content  container">
      <?php  
        echo error_message();
        echo success_message();
      ?>

      <label for="" class="text-center">Unapproved comments</label>
    
        
      <table class="table table-bordered">
        
      <thead class="bg-primary">
        <tr>
          <th class="text-light">S/N</th>
          <th class="text-light">NAME</th>
          <th class="text-light">EMAIL</th>
          <th class="text-light">COMMENT</th>
          <th class="text-light">IMAGE</th>
          <th class="text-light">DATE/TIME</th>
          <th class="text-light">UNAPPROVED</th>
          <th class="text-light">DELETE</th>
        </tr>
        </thead>

        <?php
          
          $sql = "SELECT * FROM cms_users_comments WHERE status = 'OFF' ORDER BY id DESC";
          $result = mysqli_query($link, $sql);
          $sn = 0;
          while($row = mysqli_fetch_array($result)){
            
            
            $db_id = $row['id'];
            $db_name = $row['name'];
            $db_email = $row['email'];
            $db_comment = $row['comment'];
            $image = $row['image'];
            $db_date = $row['datetime'];
            $sn++;
        ?>
        

        <tbody>
          <tr>
            <td><?=$sn;?></td>
            <td><?=$db_name?></td>
            <td><?=$db_email?></td>
            <td><?php
                if(strlen($db_comment) >15 ){
                  $db_comment = substr($db_comment, 0, 15);
                }
                echo $db_comment;
              ?></td>
            <td><img src="../revision/comments/<?=$image;?>" alt="" style="height:5rem; width: 6rem;"></td>
            <td><?=$db_date?></td>
            <td><a href='./inc/approved.php?approved=<?= $db_id?>' class="btn btn-primary">APPROVED</a></td>
            <td><a href='./inc/delete.php?delete=<?=$db_id;?>' <span class="btn btn-danger ml-3"><i class="fa fa-trash" aria-hidden="true"></i></a></span></td>
          </tr>
        <?php }?>
            
        </tbody>
      </table> 
      
      <!-- LABEL FOR UNAPPROVED COMMENT -->
      <label for="" class="text-center">approved comments</label>
      <table class="table table-bordered">
        
      <thead class="bg-primary">
        <tr>
          <th class="text-light">S/N</th>
          <th class="text-light">NAME</th>
          <th class="text-light">EMAIL</th>
          <th class="text-light">COMMENT</th>
          <th class="text-light">IMAGE</th>
          <th class="text-light">DATE/TIME</th>
          <th class="text-light">UNAPPROVED</th>
          <th class="text-light">DELETE</th>
        </tr>
        </thead>

        <?php
          
          $sql = "SELECT * FROM cms_users_comments WHERE status = 'ON' ORDER BY id DESC";
          $result = mysqli_query($link, $sql);
          $sn = 0;
          while($row = mysqli_fetch_array($result)){
            
            
            $db_id = $row['id'];
            $db_name = $row['name'];
            $db_email = $row['email'];
            $db_comment = $row['comment'];
            $image = $row['image'];
            $db_date = $row['datetime'];
            $sn++;
        ?>
        

        <tbody>
          <tr>
            <td><?=$sn;?></td>
            <td><?=$db_name?></td>
            <td><?=$db_email?></td>
            <td><?php
                if(strlen($db_comment) >15 ){
                  $db_comment = substr($db_comment, 0, 15);
                }
                echo $db_comment;
              ?></td>
            <td><img src="../revision/comments/<?=$image;?>" alt="" style="height:5rem; width: 6rem;"></td>
            <td><?=$db_date?></td>
            <td><a href='./inc/unapproved.php?unapproved=<?= $db_id?>' class="btn btn-primary">UNAPPROVED</a></td>
            <td><a href='./inc/delete.php?delete=<?=$db_id;?>' <span class="btn btn-danger ml-3"><i class="fa fa-trash" aria-hidden="true"></i></a></span></td>
          </tr>
        <?php }?>
            
        </tbody>
      </table>
      
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
