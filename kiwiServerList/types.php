<?php
require 'header.php';

if(isset($_SESSION['userId'])){
  $userId = $_SESSION['userId'];

  $adminSql = "SELECT * FROM users WHERE idUsers = " . $userId;
  $adminResult = $conn->query($adminSql);
  $adminRow = $adminResult->fetch_assoc();
  if($adminRow['role'] == "ADMIN"){
?>

<main class="rulesMain">
  <div class="rulesDiv">
    <label>Types</label>

    <div>
      <hr>
      <span>
      <?php
      require 'settings.php';
      if(isset($_SESSION['userId'])){

        if($adminRow['role'] == "ADMIN"){
          $sql = "SELECT * FROM types";
          $result = mysqli_query($conn, $sql);
          $num = 0;
          while ($row = mysqli_fetch_array($result)) {
            $num++;
            ?>
            <form action="includes/refactorTypes.inc.php" method="post">
              <p><button type="submit" value="<?=$row['typesId']?>" name="delete_type" style="float:left; margin-right:10px;" class="btn btn-warning btn-sm">Delete</button><?=$num?>. <?=$row['type']?></p>
            </form>
            <?php

          }
          ?>
        </span>
          <hr>
        </div>
        <?php

          ?>
          <div class="">
            <label>Create new Type</label>
            <form class="" action="includes/refactorTypes.inc.php" method="post">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">Type</span>
                </div>
                <textarea class="form-control" name="type" aria-label="With textarea"></textarea>
              </div>
            <button type="submit" name="add_type" class="btn btn-outline-success">Submit</button>
            </form>
          </div>
        </div>
          <?php
        }else{
          $sql = "SELECT * FROM types";
          $result = mysqli_query($conn, $sql);
          $num = 0;
          while ($row = mysqli_fetch_array($result)) {
            $num++;
            ?>
            <form action="includes/refactorTypes.inc.php" method="post">
              <p style="color: #C84141; margin-top:23px;">'.<?=$num?> . <?=$row['type']?></p>
            </form>
            <?php
        }
        ?>
      </span>
        <hr>
      </div>
      <?php
      }
    }else{
      $sql = "SELECT * FROM types";
      $result = mysqli_query($conn, $sql);
      $num = 0;
      while ($row = mysqli_fetch_array($result)) {
        $num++;
        ?>
        <form action="includes/refactorTypes.inc.php" method="post">
          <p style="color: #C84141; margin-top:23px;">'.<?=$num?> . <?=$row['type']?></p>
        </form>
        <?php
      }
      ?>
    </span>
      <hr>
    </div>
    <?php
  }?>

</main>

<?php
  }else{
    header("Location: index");
    exit();
  }

}else{
  header("Location: index");
  exit();
} ?>
