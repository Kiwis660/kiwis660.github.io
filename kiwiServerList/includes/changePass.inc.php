<?php
if(isset($_POST['change-pwd-submit'])){
  session_start();
  require '../settings.php';

  $userId = $_SESSION['userId'];
  $oldPwd = $_POST['pwd-old'];
  $pwd = $_POST['pwd'];
  $pwdRepeat = $_POST['pwd-repeat'];

  if (empty($oldPwd) || empty($pwd) || empty($pwdRepeat)) {
      header("Location: ../profile?id=$userId&error=emptyfields");
      exit();
  }
  elseif (empty($userId)) {
    header("Location: ../profile?id=$userId&error=logout");
    exit();
  }
  else{
    $sql = "SELECT * FROM users WHERE idUsers=?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("Location: ../profile?id=$userId&error=sqlerror");
      exit();
    }
    else {
      mysqli_stmt_bind_param($stmt, "s", $userId);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      if ($row = mysqli_fetch_assoc($result)) {
        $pwdCheck = password_verify($oldPwd, $row['pwdUsers']);
        if ($pwdCheck == false){
          header("Location: ../profile?id=$userId&error=wrongpwd");
          exit();
        }
        else if ($pwdCheck == true){
          if ($pwd !== $pwdRepeat) {
            header("Location: ../profile?id=$userId&error=passwordcheck");
            exit();
          }else {
            $sql = "UPDATE users SET pwdUsers = ? WHERE idUsers=?";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql)){
              header("Location: ../profile?id=$userId&error=sqlerror");
              exit();
            }else{
              $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

              mysqli_stmt_bind_param($stmt, "ss", $hashedPwd, $userId);
              mysqli_stmt_execute($stmt);
              header("Location: ../profile?id=$userId&change=psuccess");
              exit();
            }
          }
        }
        else {
          header("Location: ../profile?id=$userId&error=wrongpwd");
          exit();
        }
      }
      else {
        header("Location: ../profile?id=$userId&error=nouser");
        exit();
      }
    }
  }
  mysqli_stmt_close($stmt);
  mysqli_close($conn);
}
else {
  header("Location: ../profileid=$userId&");
  exit();
}
