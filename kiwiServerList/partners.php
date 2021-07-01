<?php
require 'header.php';

?>

<main class="rulesMain">
  <div class="rulesDiv">
    <label>Partners</label>

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
          $sql = "SELECT * FROM partners";
          $result = mysqli_query($conn, $sql);
          $num = 0;
          while ($row = mysqli_fetch_array($result)) {
            $num++;
            ?>
            <form action="includes/refactorPartners.inc.php" method="post">
              <p style="font-weight: bold; color: #00A942;margin-top: -10px;"><button type="submit" value="<?=$row['partnerId']?>" name="delete_partners" style="float:left; margin-right:10px;" class="btn btn-warning btn-sm">Delete</button>
                <?php if($row['link'] != ""){
                  echo '<a style="float:left; margin-right:10px;" class="btn btn-danger btn-sm" href="http://'. $row['link'] . '">Link</a>';
                }
                ?>
                <?=$num?>. <?=$row['title']?></p>
              <span> <?=$row['description']?></span>
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
            <label>Create new Partner</label>
            <form class="" action="includes/refactorPartners.inc.php" method="post">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">Title</span>
                </div>
                <textarea class="form-control" name="title" aria-label="With textarea"></textarea>
              </div>
              <br>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">Description</span>
                </div>
                <textarea class="form-control" name="description" aria-label="With textarea"></textarea>
              </div>
              <br>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">Link</span>
                </div>
                <textarea class="form-control" name="link" aria-label="With textarea"></textarea>
              </div>
              <br>
            <button type="submit" name="add_partners" class="btn btn-outline-success">Submit</button>
            </form>
          </div>
        </div>
          <?php
        }else{
          $sql = "SELECT * FROM partners";
          $result = mysqli_query($conn, $sql);
          $num = 0;
          while ($row = mysqli_fetch_array($result)) {
            $num++;
            ?>
            <form action="includes/refactorPartners.inc.php" method="post">
              <p style="font-weight: bold; color: #00A942;margin-top: -10px;">
                <?php if($row['link'] != ""){
                  echo '<a style="float:left; margin-right:10px;" class="btn btn-danger btn-sm" href="http://'. $row['link'] . '">Link</a>';
                }
                ?><?=$num?>. <?=$row['title']?></p>
              <span> <?=$row['description']?></span>
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
      $sql = "SELECT * FROM partners";
      $result = mysqli_query($conn, $sql);
      $num = 0;
      while ($row = mysqli_fetch_array($result)) {
        $num++;
        ?>
        <form action="includes/refactorPartners.inc.php" method="post">
          <p style="font-weight: bold; color: #00A942;margin-top: -10px;">
            <?php if($row['link'] != ""){
              echo '<a style="float:left; margin-right:10px;" class="btn btn-danger btn-sm" href="http://'. $row['link'] . '">Link</a>';
            }
            ?>
            <?=$num?>. <?=$row['title']?></p>
          <span> <?=$row['description']?></span>
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
