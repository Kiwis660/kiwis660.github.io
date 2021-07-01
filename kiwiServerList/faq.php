<?php
require 'header.php';

?>

<main class="rulesMain">
  <div class="rulesDiv">
    <label>F.A.Q</label>

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
          $sql = "SELECT * FROM faq";
          $result = mysqli_query($conn, $sql);
          $num = 0;
          while ($row = mysqli_fetch_array($result)) {
            $num++;
            ?>
            <form action="includes/refactorFaq.inc.php" method="post">
              <p style="font-weight: bold; color: #00A942;margin-top: -10px;"><button type="submit" value="<?=$row['faqId']?>" name="delete_faq" style="float:left; margin-right:10px;" class="btn btn-warning btn-sm">Delete</button><?=$num?>. <?=$row['Question']?></p>
              <span> <?=$row['Answer']?></span>
              <hr class="end">
            </form>
            <?php

          }
          ?>
        </span>
        </div>
        <?php

          ?>
          <div class="">
            <label>Create new F.A.Q</label>
            <form class="" action="includes/refactorFaq.inc.php" method="post">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">Question</span>
                </div>
                <textarea class="form-control" name="question" aria-label="With textarea"></textarea>
              </div>
              <br>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">Answer</span>
                </div>
                <textarea class="form-control" name="answer" aria-label="With textarea"></textarea>
              </div>
              <br>
            <button type="submit" name="add_faq" class="btn btn-outline-success">Submit</button>
            </form>
          </div>
        </div>
          <?php
        }else{
          $sql = "SELECT * FROM faq";
          $result = mysqli_query($conn, $sql);
          $num = 0;
          while ($row = mysqli_fetch_array($result)) {
            $num++;
            ?>
            <form action="includes/refactorRules.inc.php" method="post">
              <p style="font-weight: bold; color: #00A942;margin-top: -10px;"><?=$num?>. <?=$row['Question']?></p>
              <span> <?=$row['Answer']?></span>
              <hr class="end">
            </form>
            <?php
        }
        ?>
      </span>
      </div>
      <?php
      }
    }else{
      $sql = "SELECT * FROM faq";
      $result = mysqli_query($conn, $sql);
      $num = 0;
      while ($row = mysqli_fetch_array($result)) {
        $num++;
        ?>
        <form action="includes/refactorRules.inc.php" method="post">
          <p style="font-weight: bold; color: #00A942;margin-top: -10px;"><?=$num?>. <?=$row['Question']?></p>
          <span> <?=$row['Answer']?></span>
          <hr class="end">
        </form>
        <?php
      }
      ?>
    </span>
    </div>
    <?php
  }?>

</main>
