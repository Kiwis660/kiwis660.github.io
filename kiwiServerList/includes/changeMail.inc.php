<?php
if(isset($_POST['change-mail-submit'])){
  session_start();
  require '../settings.php';

  $userId = $_SESSION['userId'];
  $mail = $_POST['mail'];
  $mailRepeat = $_POST['mail-repeat'];
  $pwd = $_POST['pwd'];

  if(empty($mail) || empty($mailRepeat) || empty($pwd)){
    header("Location: ../profile?id=$userId&error=emptyfields");
    exit();
  }
  else if (empty($userId)) {
    header("Location: ../profile?id=$userId&error=logout");
    exit();
  }
  else if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
    header("Location: ../profile?id=$userId&error=invalidmail");
    exit();
  }
  else {
    $sql = "SELECT * FROM users WHERE idUsers=?";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
      header("Loaction: ../profile?id=$userId&error=sqlerror");
      exit();
    }else{
      mysqli_stmt_bind_param($stmt, "s", $userId);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      if($row = mysqli_fetch_assoc($result)) {
        $pwdCheck = password_verify($pwd, $row['pwdUsers']);
        if($pwdCheck == false){
          header("Location: ../profile?id=$userId&error=wrongpwd");
          exit();
        }
        else if($pwdCheck == true){
          if($mail !== $mailRepeat){
            header("Location: ../profile?id=$userId&error=mailcheck");
            exit();
          }
          else {
            $sql = "UPDATE users SET emailUsers = ? WHERE idUsers = ?";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql)){
              header("Location: ../profile?id=$userId&error=sqlerror");
              exit();
            }
            else{
              mysqli_stmt_bind_param($stmt, "ss", $mail, $userId);
              mysqli_stmt_execute($stmt);
              header("Location: ../profile?id=$userId&change=esuccess");
              exit();
            }
          }
        }else{
          header("Location ../profile?id=$userId&error=wrongpwd");
          exit();
        }
      }
      else {
        header("Location: ../profile?id=$userId&error=nouser");
        exit();
      }
    }
  }
}
else {
  header("Location: ../profile?id=$userId");
  exit();
}
