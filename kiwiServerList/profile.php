<?php
 require 'header.php';
 require 'settings.php';

 if(isset($_SESSION['userId'])){
   $userId = $_SESSION['userId'];
   if(isset($_GET['id'])){
     if($userId == $_GET['id']){
 ?>

 <main class="profileMain">
     <div class="leftContainer">
       <label style="text-align: center; display:block">Your Servers</label>
       <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Server name</th>
      <th scope="col">Status</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $strSQL = "SELECT * FROM servers WHERE UserId =" . $userId;
  $rs = mysqli_query($conn,$strSQL);
  $number_of_results = mysqli_num_rows($rs);
  $number_of_pages = ceil($number_of_results/$results_per_page);

  if(!isset($_GET['page'])){
    $page = 1;
  }else{
    $page = $_GET['page'];
  }

  $this_page_first_result = ($page-1)*$results_per_page;

  $sql = "SELECT * FROM servers WHERE UserId =$userId LIMIT " . $this_page_first_result . "," . $results_per_page;
  $result = mysqli_query($conn,$sql);
    $num = $this_page_first_result;
    while($row = mysqli_fetch_array($result)){
    $num++;
  ?>
  <tr>
    <a href="#">
    <td class="nr"><span class="ridgeSpanDecoration"><?=$num?></span></td>
    <td class="serverName"><a> <?=$row['serverName']?></a></td>
    <?php
    if($row['confirmed'] == 1){
      echo '<td class="vote"><a  href="serverInfo?id=' . $row['idServer']. '" class="btn btn-success" role="button">GOOD</a></td>';
    }else if($row['confirmed'] == 2){
      echo '<td class="vote"><a href="serverInfo?id=' . $row['idServer']. '" class="btn btn-danger" role="button">BLOCKED</a></td>';
    }else{
      echo '<td class="vote"><a href="serverInfo?id=' . $row['idServer']. '" class="btn btn-warning" role="button">UNCONFIRMED</a></td>';
    }
     ?>
    </a>
  </tr>
  <?php
}
    print "</table>";
    if($number_of_pages > 1){
  ?>
  <nav aria-label="Page navigation example">

    <ul class="pagination justify-content-center">
      <?php
      if($page > 1){
        echo '<li class="page-item"><a class="page-link" href="profile?id='. $userId .'&page=' . ($page-1) . '">Previous</a></li>';
      }
      for($i = 1; $i <= $number_of_pages; $i++){
        echo '<li class="page-item"><a class="page-link" href="profile?id='. $userId .'&page=' . $i . '">'. $i .'</a></li>';
      }
      if(!($page == $number_of_pages)){
        echo '<li class="page-item"><a class="page-link" href="profile?id='. $userId .'&page=' . ($page+1) . '">Next</a></li>';
      }
      ?>
    </ul>
    </nav>
      <?php } ?>
    </tr>
  </tbody>
  <?php
    }
    ?>
</table>
     </div>
     <div class="rightContainer">
        <div class="block1" style="margin:10px;">
          <label style="text-align: center; display:block">Change password</label>
          <form  action="includes/changePass.inc.php" method="post">
            <div class="form-group">
              <label for="pwd-old">Old Password</label>
              <input type="password" name="pwd-old" placeholder="Old Password" class="form-control form-control-sm" id="pwd-old">
            </div>
            <div class="form-group">
              <label for="pwd">New Password</label>
              <input type="password" name="pwd" placeholder="New Password" class="form-control form-control-sm" id="pwd">
            </div>
            <div class="form-group">
              <label for="pwd-repeat">Repeat new Password</label>
              <input type="password" name="pwd-repeat" placeholder="Repeat new Password" class="form-control form-control-sm" id="pwd-repeat">
            </div>
            <button type="submit" name="change-pwd-submit"class="btn btn-warning">Change</button>
          </form>
        </div>
        <br>
        <div class="block2" style="margin:10px;">
          <label style="text-align: center; display:block">Change E-mail</label>
          <form action="includes/changeMail.inc.php" method="post">
            <div class="form-group">
              <label for="mail">New Email</label>
              <input type="email" placeholder="New Email" name="mail" class="form-control form-control-sm" id="mail">
            </div>
            <div class="form-group">
              <label for="mail-repeat">Repeat new Email</label>
              <input type="email" placeholder="Repeat new Email" name="mail-repeat" class="form-control form-control-sm" id="mail-repeat">
            </div>
            <div class="form-group">
              <label>Password</label>
              <input type="password" placeholder="Password" name="pwd" class="form-control form-control-sm">
            </div>
            <button type="submit" name="change-mail-submit" class="btn btn-warning">Change</button>
          </form>
        </div>
        
     </div>

 </main>

 <?php
    }else{
      header("Location: index");
      exit();
    }
  }else{
    header("Location: index");
    exit();
  }
