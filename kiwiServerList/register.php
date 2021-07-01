<?php
require 'header.php';
if(isset($_GET['error'])){
  $error = $_GET['error'];

  if($error == "emptyfields"){
    ?>
      <script type="text/javascript">
        $('#empty').css({'display': 'block'});
      </script>
    <?php
  }else if($error == "passwordcheck"){
    ?>
      <script type="text/javascript">
        $('#passwordError').css({'display': 'block'});
      </script>
    <?php
  }else if($error == "usertaken"){
    ?>
      <script type="text/javascript">
        $('#userError').css({'display': 'block'});
      </script>
    <?php
  }else if($error == "emailtaken"){
    ?>
      <script type="text/javascript">
        $('#emailError').css({'display': 'block'});
      </script>
    <?php
  }
}

?>

<main class="registerMain">
  <div class="registerDiv">
    <small class="redError" id="empty" class="form-text text-muted" style="display:none; text-align: center">Fields can't be empty.</small>
    <small class="redError" id="passwordError" class="form-text text-muted" style="display:none; text-align: center">Password doesn't match.</small>
    <small class="redError" id="emailError" class="form-text text-muted" style="display:none; text-align: center">Thats email exist.</small>
    <small class="redError" id="userError" class="form-text text-muted" style="display:none; text-align: center">Thats username exist.</small>
    <form action="includes/signup.inc.php" method="post">
      <div class="form-group">
        <label for="username">Username</label>
        <input type="text" name="username" class="form-control" id="username" aria-describedby="usernameHelp" placeholder="Username">
        <small class="redError" id="usernameInfo" class="form-text text-muted" style="display:none">Username can't be empty.</small>
      </div>
      <div class="form-group">
        <label for="email">Email address</label>
        <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email">
        <small class="redError" id="mailInfo" class="form-text text-muted" style="display:none">Email can't be empty.</small>
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" class="form-control" id="password" placeholder="Password">
        <small class="redError" id="passwordInfo" class="form-text text-muted" style="display:none">Password can't be less than 8 character.</small>
      </div>
      <div class="form-group">
        <label for="repeatPassword">Reapeat Password</label>
        <input type="password" name="repeatPassword" class="form-control" id="repeatPassword" placeholder="Reapeat Password">
        <small class="redError" id="reapetPasswordInfo" class="form-text text-muted" style="display:none">Passwords must match.</small>
      </div>
      <button name="register-submit" disabled id="registerButton" type="submit" class="btn btn-primary">Register</button>
    </form>
  </div>
</main>

<script type="text/javascript">
  $('#password').on('blur', function() {
    var repeatPassword = $('#repeatPassword').val();
    var username = $('#username').val();
    var email = $('#email').val();
    if(this.value.length < 8){
      $('#passwordInfo').css({'display': 'inline-block'});
      $('#registerButton').prop('disabled', true);
      return false;
    }else{
      $('#passwordInfo').css({'display': 'none'});
      if(this.value == repeatPassword && username !== "" && email !== ""){
        $('#registerButton').prop('disabled', false);
      }
      return false;
    }
  })

  $('#repeatPassword').on('blur', function(){
    var password = $('#password').val();
    var username = $('#username').val();
    var email = $('#email').val();
    if(this.value != password){
      $('#reapetPasswordInfo').css({'display': 'inline-block'});
      $('#registerButton').prop('disabled', true);
      return false;
    }else{
      $('#reapetPasswordInfo').css({'display': 'none'});
      if (password.length >= 8 && username !== "" && email !== "") {
        $('#registerButton').prop('disabled', false);
      }
      return false;
    }
  })
  $('#username').on('blur', function(){
    var password = $('#password').val();
    var repeatPassword = $('#repeatPassword').val();
    var email = $('#email').val();
    if(this.value == ""){
      $('#usernameInfo').css({'display': 'inline-block'});
      $('#registerButton').prop('disabled', true);
      return false;
    }else{
      $('#usernameInfo').css({'display': 'none'});
      if (password >= 8 && password == repeatPassword && email !== "") {
        $('#registerButton').prop('disabled', false);
      }
      return false;
    }
  })
  $('#email').on('blur', function(){
    var password = $('#password').val();
    var username = $('#username').val();
    var repeatPassword = $('#repeatPassword').val();
    if(this.value == ""){
      $('#mailInfo').css({'display': 'inline-block'});
      $('#registerButton').prop('disabled', true);
      $('#email').addClass('is-invalid');
      return false;
    }else{
      $('#mailInfo').css({'display': 'none'});
      if (password >= 8 && password == repeatPassword && username !== "") {
        $('#registerButton').prop('disabled', false);
      }
      return false;
    }
  })
</script>
