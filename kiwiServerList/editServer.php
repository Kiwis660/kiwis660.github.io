<?php
if(isset($_POST['edit-project'])){
  require 'header.php';
  require 'settings.php';

  $typesSQL = "SELECT * FROM types";
  $typesResult = mysqli_query($conn,$typesSQL);

  $languageSQL = "SELECT * FROM language";
  $languageResult = mysqli_query($conn,$languageSQL);

  $idServer = $_POST['edit-project'];
  $infoSql = "SELECT * FROM servers WHERE idServer = " . $idServer;
  $infoResult = $conn->query($infoSql);
  $infoRow = $infoResult->fetch_assoc();
?>
<main class="newProjectMain">
  <div class="newProjectDiv">
    <label class="topLabel">Edit Server</label>
    <form action="includes/editServer.inc.php" method="post">
      <div class="form-group">
        <label for="serverName">Server Name</label>
        <input value="<?=$infoRow['serverName']?>" type="text" name="serverName" class="form-control " id="serverName" aria-describedby="serverNameHelp" placeholder="Server Name" required>
        <div class="valid-feedback">
        Looks good!
        </div>
        <div class="invalid-feedback">
        Server name can't be empty.
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-4">
          <label for="type">Type</label>
          <select id="type" class="form-control" name="type" required>
            <option disabled value="">Choose...</option>
<?php         while ($typesRow = mysqli_fetch_array($typesResult)) {
                if($infoRow['type'] == $typesRow['type']){
                  echo '<option value="' . $typesRow['type'] . '" selected>' . $typesRow['type'] . '</option>';
                }else{
                  echo '<option value="' . $typesRow['type'] . '">' . $typesRow['type'] . '</option>';
                }
              } ?>
          </select>
          <div class="invalid-feedback">
            Please select a valid Type.
          </div>
        </div>
        <div class="form-group col-md-4">
          <label for="language">Language</label>
          <select id="language" class="form-control" name="language" required>
            <option selected disabled value="">Choose...</option>
<?php       while ($languageRow = mysqli_fetch_array($languageResult)) {
              if($infoRow['language'] == $languageRow['language']){
                echo '<option value="' . $languageRow['language'] . '" selected>' . $languageRow['language'] . '</option>';
              }else{
                echo '<option value="' . $languageRow['language'] . '">' . $languageRow['language'] . '</option>';
              }
            } ?>
          </select>
          <div class="invalid-feedback">
            Please select a Language.
          </div>
        </div>
      </div>
      <div class="form-group">
        <label for="inviteLink">Invite Link</label>
        <input value="<?=$infoRow['invite_link']?>" type="text" name="inviteLink" class="form-control" id="inviteLink" placeholder="Invite Link">
        <div class="valid-feedback">
        Looks good!
        </div>
        <div class="invalid-feedback">
        Invite link can't be empty.
        </div>
      </div>
      <div class="form-group">
        <label for="description">Description</label>
        <textarea  type="text" name="description" class="form-control" id="description" placeholder="Description" rows="3"><?=$infoRow['description']?></textarea>
        <div class="valid-feedback">
        Looks good!
        </div>
        <div class="invalid-feedback">
        Descriptione can't be empty.
        </div>
      </div>
      <button name="editProject-submit"  id="editProjectButton" type="submit" class="btn btn-primary" value="<?=$idServer?>">Edit</button>
    </form>
  </div>
  <script src="scripts/newProjectScripts.js" ></script>
</main>
<?php
}
