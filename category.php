<?php
  session_start();
  include_once "./partials/style.php";
  include_once "./partials/header.php";
  include_once "./partials/sidebar.php";
 
?>

  <section class="home-section">
    <?php 
      include_once "./partials/navbar.php"; 
      require_once "./inc/form_checker.php";
    ?>
           
    <div class="home-content  container">
        <?php
            require_once "./inc/db.php";
              echo error_message();
              echo success_message();
          ?>
          <form action="inc/categorey.php" method="POST" class="" enctype="multipart/form-data">
            <div class="form-group">
              <label for="categorey">categorey</label>
              <input type="text" name="categorey" id="categorey" class="form-control" required> 
              <input type="submit" value="ADD CATEGOREY" class="mt-3 btn btn-primary form-control" id="submit" name="submit">
            </div>
          </form>
          
      <table class="table table-bordered mt-5">
        <thead class="border-primay">
          <tr>
              <thead class="bg-primary text-light text-enter">
                  <th>S/N</th>
                  <th>AURTHOR</th>
                  <th>DATE/TIME</th>
                  <th>CATEGORY</th>
                  <th>DELETE</th>
              </thead>
          </tr>
        </thead>
          
          <?php
           

            $query = "SELECT * FROM cms_post_categorey ORDER BY id DESC";
            if(!$result = mysqli_query($link, $query)){
                die("OOPS SOMETHING WENT WRONG" . mysqli_error($link));
            }else{

           
            
            $sn= 0;
            while($row = mysqli_fetch_assoc($result)){
            $db_id        =$row['id'];
            $db_author    = $row['author'];
            $db_datetime  = $row['timedate'];
            $db_categorey = $row['categorey'];
            $sn++
          ?>

          <!-- table creation -->
            <tr>
              <td><?=$sn;?> </td>
              <td><?=$db_author;?></td>
              <td><?=$db_datetime;?></td>
              <td><?=$db_categorey;?></td>
              <td><a href='./inc/deletecat.php?delete=<?=$db_id;?>' <span class="btn btn-danger ml-3"><i class="fa fa-trash" aria-hidden="true"></i></a></span></td>
              
            </tr>

            <?php } }?>
                      
      </table>
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
</script>

</body>
</html>
