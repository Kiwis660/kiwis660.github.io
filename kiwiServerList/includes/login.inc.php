<?php

if(isset($_POST['login-submit'])){
  session_start();
  require '../settings.php';

  $mailuid = $_POST['mailuid'];
  $password = $_POST['pwd'];

  if(empty($mailuid) || empty($password)){
    header("Location: ../?error=emptyfields");
    exit();
  }else {
    $sql = "SELECT * FROM users WHERE uidUsers=? OR emailUsers=?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("Location: ../?error=sqlerror");
      exit();
    }
    else {

      mysqli_stmt_bind_param($stmt, "ss", $mailuid, $mailuid);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      if ($row = mysqli_fetch_assoc($result)) {
        $pwdCheck = password_verify($password, $row['pwdUsers']);
        if ($pwdCheck == false){
          header("Location: ../?error=wrongpwd");
          exit();
        }
        else if ($pwdCheck == true) {

          $_SESSION['userId'] = $row['idUsers'];
          $_SESSION['userUid'] = $row['uidUsers'];

          header("Location: ../?login=success");
          exit();
        }
        else {
          header("Location: ../?error=wrongpwd");
          exit();
        }
      }
      else {
        header("Location: ../?error=nouser");
        exit();
      }

    }

  }

}
else {
  exit();
}