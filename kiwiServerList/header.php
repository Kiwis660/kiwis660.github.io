<?php
session_start();
 require 'settings.php';
 //Made by Th3Skeletas -->Discord: !Tadas (Th3Skeletas)#2020;
 $divText = "";
 if(isset($_GET['error'])){
   $error = $_GET['error'];
   $divDisplay = "";
   if($error  == "wrongpwd"){
     $divText = "Wrong password.";
   }elseif ($error  == "emptyfields") {
     $divText = "You must field all fields.";
   }elseif ($error  == "logout") {
     $divText = "You are offline.";
   }elseif ($error  == "invalidmail") {
     $divText = "Invalid email.";
   }elseif ($error  == "sqlerror") {
     $divText = "System error. Please try again.";
   }elseif ($error  == "mailcheck") {
     $divText = "Please entry same email.";
   }elseif ($error  == "mailcheck") {
     $divText = "Please entry same email.";
   }elseif ($error  == "passwordcheck") {
     $divText = "Please entry same passwords.";
   }elseif ($error  == "voted") {
     $divText = "You can only 1 time vote in " . $one_vote_in_hour;
   }elseif ($error  == "emptyDescription") {
     $divText = "Please fiel Description.";
   }elseif ($error  == "invaliduid") {
     $divText = "Please fiel valid username.";
   }elseif ($error  == "usertaken") {
     $divText = "Username already exist.";
   }elseif ($error  == "emailtaken") {
     $divText = "Email already exist.";
   }else{
     $divText = "System error. Please try again.";
   }
 }elseif(isset($_GET['change'])){
   $change = $_GET['change'];
   $divDisplay = "";
   if($change == "esuccess"){
     $divText = "Successfully change email.";
   }elseif($change == "psuccess"){
     $divText = "Successfully change password.";
   }elseif($change == "edited"){
     $divText = "Successfully edited server.";
   }elseif($change == "confirm"){
     $divText = "Successfully set status: confirmed.";
   }elseif($change == "block"){
     $divText = "Successfully set status: blocked.";
   }elseif($change == "unconfirm"){
     $divText = "Successfully set status: unconfirmed.";
   }else{
     $divText = "System error. Please try again.";
   }
 }else if(isset($_GET['login'])){
   $change = $_GET['login'];
   $divDisplay = "";
   if($change == "success"){
     $divText = "Successfully loged in.";
   }else{
     $divText = "System error. Please try again.";
   }
 }else if(isset($_GET['signup'])){
   $change = $_GET['signup'];
   $divDisplay = "";
   if($change == "success"){
     $divText = "Successfully registered. Please log in.";
   }else{
     $divText = "System error. Please try again.";
   }
 }else if(isset($_GET['added'])){
   $change = $_GET['added'];
   $divDisplay = "";
   if($change == "success"){
     $divText = "Successfully added.";
   }elseif($change == "successvoted"){
     $divText = "Successfully voted.";
   }else{
     $divText = "System error. Please try again.";
   }
 }else if(isset($_GET['deleted'])){
   $change = $_GET['deleted'];
   $divDisplay = "";
   if($change == "success"){
     $divText = "Successfully deleted.";
   }else{
     $divText = "System error. Please try again.";
   }
 }else{
   $divDisplay = "display:none";
 }



?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta name="author" content="Th3Skeletas">
    <meta charset="utf-8">
    <title></title>
    <meta name="description" content="">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  </head>
  <body>
    <div class="pageTop">
<nav class="navbar navbar-expand-lg sticky-top navbar-light bg-light">

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="/">Home </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="rules">Rules</a>
      </li>
      <li class="nav-item ">
        <a class="nav-link" href="faq">F.A.Q</a>
      </li>
      <li class="nav-item ">
        <a class="nav-link" href="partners">Partners</a>
      </li>
      <div style="<?=$divDisplay?>; margin:auto" class="alert alert-primary " role="alert" style="margin:auto">
        <?=$divText?>
      </div>
    </ul>
    <?php
      if(isset($_SESSION['userId'])){

        $userId = $_SESSION['userId'];

        $adminSql = "SELECT * FROM users WHERE idUsers = " . $userId;
        $adminResult = $conn->query($adminSql);
        $adminRow = $adminResult->fetch_assoc();
        if($adminRow['role'] == "ADMIN"){?>
          <form action="fullList" method="post" name="admin" class="form-inline my-2 my-lg-0">
            <button class="btn btn-outline-primary" name="admin" type="submit" style="margin-right:10px;">Full List</button>
          </form>

          <div class="btn-group" role="group" style="margin-right:10px;">
            <button id="btnGroupDrop1" type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              ADMIN
            </button>
            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
              <form action="fullList" method="post" name="admin" class="form-inline my-2 my-lg-0">
                <button name="admin" class="dropdown-item" type="submit">Full List</button>
              </form>
              <form action="types" method="post" name="admin" class="form-inline my-2 my-lg-0">
                <button name="admin" class="dropdown-item" type="submit">Types</button>
              </form>
              <form action="language" method="post" name="admin" class="form-inline my-2 my-lg-0">
                <button name="admin" class="dropdown-item" type="submit">Language</button>
              </form>
            </div>
          </div>
<?php   }
?>

        <form action="includes/logout.inc.php" method="post" name="logout-submit" class="form-inline my-2 my-lg-0">
          <a href="profile?id=<?=$userId?>" class="btn btn-outline-primary" style="margin-right: 10px;">Profile</a>
          <a href="newProject" class="btn btn-outline-primary" style="margin-right: 10px;">Add Server</a>
          <button class="btn btn-success my-2 my-sm-1" name="logout-submit" type="submit">Logout</button>
        </form>
    <?php
      }else{
    ?>
        <form action="includes/login.inc.php" method="post"   class="form-inline my-2 my-lg-0">
          <input name="mailuid" class="form-control mr-sm-2" type="text" placeholder="Username" aria-label="Login">
          <input name="pwd" class="form-control mr-sm-2" type="password" placeholder="Password" aria-label="Login">
          <button name="login-submit" class="btn btn-success my-2 my-sm-1" type="submit">Login</button>
          <a href="register" class="btn btn-primary my-2 my-sm-1" type="submit" style=" margin-left:5px;">Register</a>
        </form>
    <?php
    }
    ?>
  </div>
</nav>
    </div>

  </body>
</html>
