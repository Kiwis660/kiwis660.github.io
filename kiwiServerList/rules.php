<?php
require 'header.php';

?>

<main class="rulesMain">
  <div class="rulesDiv">
    <label>Rules</label>

    <div>
      <hr>
      <span>
      <?php
      require 'settings.php';
      if(isset($_SESSION['userId'])){

        $userId = $_SESSION['userId'];

        $adminSql = "SELECT * FROM users WHERE idUsers = " . $userId;
        $adminResult = $conn->query($adminSql);
        $adminRow = $adminResult->fetch_assoc();
        if($adminRow['role'] == "ADMIN"){
          $sql = "SELECT * FROM rules";
          $result = mysqli_query($conn, $sql);
          $num = 0;
          while ($row = mysqli_fetch_array($result)) {
            $num++;
            ?>
            <form action="includes/refactorRules.inc.php" method="post">

            <?php
            if($row['important']){
              echo '<p style="color: #C84141; margin-top:23px;"><button type="submit" value="'. $row['idRules'] .'" name="delete_rule" style="float:left; margin-right:10px;" class="btn btn-warning btn-sm">Delete</button>'. $num . '. ' . $row['Description'] .'</p>';
            }else{
              echo '<p style="margin-top:23px;"><button type="submit" value="'. $row['idRules'] .'" style="float:left;margin-right:10px;" name="delete_rule" class="btn btn-warning btn-sm">Delete</button>'. $num . '. ' . $row['Description'] .'</p>';
            }
            ?>
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
            <label>Create new Rule</label>
            <form class="" action="includes/refactorRules.inc.php" method="post">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">Description</span>
                </div>
                <textarea class="form-control" name="description" aria-label="With textarea"></textarea>
              </div>
              <div class="form-group">
                <div class="form-check">
                  <input class="form-check-input" name="check" type="checkbox" id="gridCheck">
                  <label class="form-check-label" for="gridCheck">
                    Important
                  </label>
                </div>
            </div>
            <button type="submit" name="add_rule" class="btn btn-outline-success">Submit</button>
            </form>
          </div>
        </div>
          <?php
        }else{
          $sql = "SELECT * FROM rules";
          $result = mysqli_query($conn, $sql);
          $num = 0;
          while ($row = mysqli_fetch_array($result)) {
            $num++;
            ?>
            <form action="includes/refactorRules.inc.php" method="post">

            <?php
            if($row['important']){
              echo '<p style="color: #C84141; margin-top:23px;">'. $num . '. ' . $row['Description'] .'</p>';
            }else{
              echo '<p style="margin-top:23px;">'. $num . '. ' . $row['Description'] .'</p>';
            }
            ?>
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
      $sql = "SELECT * FROM rules";
      $result = mysqli_query($conn, $sql);
      $num = 0;
      while ($row = mysqli_fetch_array($result)) {
        $num++;
        ?>
        <form action="includes/refactorRules.inc.php" method="post">

        <?php
        if($row['important']){
          echo '<p style="color: #C84141; margin-top:23px;">'. $num . '. ' . $row['Description'] .'</p>';
        }else{
          echo '<p style="margin-top:23px;">'. $num . '. ' . $row['Description'] .'</p>';
        }
        ?>
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
