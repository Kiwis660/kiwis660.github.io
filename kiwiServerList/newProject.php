<?php
require 'header.php';
require 'settings.php';

$typesSQL = "SELECT * FROM types";
$typesResult = mysqli_query($conn,$typesSQL);

$languageSQL = "SELECT * FROM language";
$languageResult = mysqli_query($conn,$languageSQL);
?>
<main class="newProjectMain">
  <div class="newProjectDiv">
    <label class="topLabel">Add Server</label>
    <form action="includes/newProject.inc.php" method="post">
      <div class="form-group">
        <label for="serverName">Server Name</label>
        <input type="text" name="serverName" class="form-control " id="serverName" aria-describedby="serverNameHelp" placeholder="Server Name" required>
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
            <option selected disabled value="">Choose...</option>
            <?php while ($typesRow = mysqli_fetch_array($typesResult)) { ?>
              <option value="<?=$typesRow['type']?>"><?=$typesRow['type']?></option>
            <?php } ?>
          </select>
          <div class="invalid-feedback">
            Please select a valid Type.
          </div>
        </div>
        <div class="form-group col-md-4">
          <label for="language">Language</label>
          <select id="language" class="form-control" name="language" required>
            <option selected disabled value="">Choose...</option>
            <?php while ($languageRow = mysqli_fetch_array($languageResult)) { ?>
              <option value="<?=$languageRow['language']?>"><?=$languageRow['language']?></option>
            <?php } ?>
          </select>
          <div class="invalid-feedback">
            Please select a Language.
          </div>
        </div>
      </div>
      <div class="form-group">
        <label for="inviteLink">Invite Link</label>
        <input type="text" name="inviteLink" class="form-control" id="inviteLink" placeholder="Invite Link">
        <div class="valid-feedback">
        Looks good!
        </div>
        <div class="invalid-feedback">
        Invite link can't be empty.
        </div>
      </div>
      <div class="form-group">
        <label for="description">Description</label>
        <textarea type="text" name="description" class="form-control" id="description" placeholder="Description" rows="3"></textarea>
        <div class="valid-feedback">
        Looks good!
        </div>
        <div class="invalid-feedback">
        Descriptione can't be empty.
        </div>
      </div>
      <button name="newProject-submit"  id="newProjectButton" type="submit" class="btn btn-primary">Create</button>
    </form>
  </div>
  <script src="scripts/newProjectScripts.js" ></script>
</main>
