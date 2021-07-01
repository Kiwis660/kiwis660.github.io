<?php
require 'header.php';
require 'settings.php';


if(isset($_GET['id'])){
$idServer = $_GET['id'];
  $infoSql = "SELECT * FROM servers WHERE idServer = " . $idServer;
  $infoResult = $conn->query($infoSql);
  $infoRow = $infoResult->fetch_assoc();


?>

<main class="serverInfoMain">
  <div class="serverInfoDiv">
    <div class="serverName" style="text-align: center">
      <h6>Server Name</h6>
      <div class="justify-content-md-center"><?=$infoRow['serverName']?></div>
    </div>
    <br>
    <br>

    <div class="form-row col-auto h-100 justify-content-center align-items-center">
      <div class="col-auto">
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text" id="validationTooltipUsernamePrepend">Type:</span>
          </div>
          <input value="<?=$infoRow['type']?>" type="text" class="form-control" id="validationTooltipUsername" aria-describedby="validationTooltipUsernamePrepend" disabled>
        </div>
      </div>

      <div class="col-auto">
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text" id="validationTooltipUsernamePrepend">Language:</span>
          </div>
          <input value="<?=$infoRow['language']?>" type="text" class="form-control" id="validationTooltipUsername" aria-describedby="validationTooltipUsernamePrepend" disabled>
        </div>
      </div>
    </div>
    <br>
    <br>
    <div class="description" style="text-align: center">
      <h6>Description</h6>
      <textarea name="description" style="width:70%; text-align: center" class="" disabled><?=$infoRow['description']?></textarea>
    </div>
    <br>
    <div class="editButtons">
      <?php  if(isset($_SESSION['userId'])){
        $userId = $_SESSION['userId'];

        $adminSql = "SELECT * FROM users WHERE idUsers = " . $userId;
        $adminResult = $conn->query($adminSql);
        $adminRow = $adminResult->fetch_assoc();
        if(($userId == $infoRow['UserId']) || ($adminRow['role'] == "ADMIN")){ ?>
          <a href="includes/checkifvoted.inc.php?idServer=<?=$idServer?>" class = "btn btn-warning btn-sm" style="text-align: center; margin-left:5px;" role="button">Vote</a>
          <a href="<?=$infoRow['invite_link']?>" class="btn btn-success btn-sm" style="margin-left:5px;" role="button">Join</a>
          <form action="editServer" method="post">
            <button name="edit-project" type="submit" value="<?=$idServer?>" class="btn btn-info btn-sm" style="margin-left:5px;">Edit</button>
          </form>
          <form action="includes/refactorServer.inc.php" method="post">
            <button name="delete-project" type="submit" value="<?=$idServer?>" class="btn btn-danger btn-sm" style="margin-left:5px;">Delete</button>
<?php     if($adminRow['role'] == "ADMIN"){
            if($infoRow['confirmed'] == 1){
              echo '<button name="unconfirm-project" type="submit" value="' . $idServer . '" class="btn btn-danger btn-sm" style="margin-left:4px;">UNCONFIRM</button>';
            }else if($infoRow['confirmed'] == 0){
              echo '<button name="confirm-project" type="submit" value="' . $idServer . '" class="btn btn-success btn-sm" style="margin-left:4px;">Confirm</button>';
            }

            if($infoRow['confirmed'] == 2){
              echo '<button name="unconfirm-project" type="submit" value="' . $idServer . '" class="btn btn-success btn-sm" style="margin-left:4px;">UNBLOCK</button>';
            }else{
              echo '<button name="block-project" type="submit" value="' . $idServer . '" class="btn btn-danger btn-sm" style="margin-left:4px;">BLOCK</button>';
            }
          }
          echo '</form>';
       }
     }else{
        echo '<a href="includes/checkifvoted.inc.php?idServer=' . $idServer . '" class = "btn btn-warning btn-sm" style="text-align: center; margin-left:5px;" role="button">Vote</a>';
        echo '<a href="' . $infoRow['invite_link'] . '" class="btn btn-success btn-sm" style="text-align: center" role="button">Join</a>';
      }?>

    </div>


  </div>
</main>

<?php
}
if(isset($_GET['error'])){
  if($_GET['error'] == 'voted'){
    ?>
    <script type="text/javascript"> alert("You can vote every 24 hours.");</script>
    <?php
  }
  if($_GET['error'] == 'successvoted'){
    ?>
    <script type="text/javascript"> alert("You have successfully voted, next time you will be able to vote for 24 hours.");</script>
    <?php
  }
}
