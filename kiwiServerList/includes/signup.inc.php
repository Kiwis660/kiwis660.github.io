<?php
if(isset($_POST['register-submit'])){
  require '../settings.php';

  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $passwordRepeat = $_POST['repeatPassword'];

  if (empty($username) || empty($email) || empty($password) || empty($passwordRepeat)) {
      header("Location: ../register?error=emptyfields");
      exit();
    }
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username)) {
      header("Location: ../register?error=invalidmail");
      exit();
    }
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      header("Location: ../register?error=invalidmail&uid=".$username);
      exit();
    }
    else if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
      header("Location: ../register?error=invaliduid&mail=".$email);
      exit();
    }
    else if ($password !== $passwordRepeat) {
      header("Location: ../register?error=passwordcheck");
      exit();
    }else{
      $sql = "SELECT uidUsers FROM users WHERE uidUsers=?";
      $stmt = mysqli_stmt_init($conn);
      if(!mysqli_stmt_prepare($stmt, $sql)){
        header("Location: ../register?error=sqlerror");
        exit();
      }else{
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $resultCheck = mysqli_stmt_num_rows($stmt);
        if($resultCheck > 0){
          header("Location: ../register?error=usertaken");
          exit();
        }
        else{
          $sql = "SELECT emailUsers FROM users WHERE emailUsers=?";
          $stmt = mysqli_stmt_init($conn);
          if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../register?error=sqlerror");
            exit();
          }else{
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);
            if($resultCheck > 0){
              header("Location ../register?error=emailtaken");
              exit();
            }else{
              $sql = "INSERT INTO users (uidUsers, emailUsers, pwdUsers) VALUES (?, ?, ?)";
              $stmt = mysqli_stmt_init($conn);
              if(!mysqli_stmt_prepare($stmt, $sql)){
                header("Location: ../register?error=sqlerror");
                exit();
              }else{
                $hashedPwd = password_hash($password, PASSWORD_DEFAULT);

                mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hashedPwd);
                mysqli_stmt_execute($stmt);
                header("Location: ../?signup=success");
                exit();
              }
            }
          }
        }
      }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
else {
  header("Location: ../register");
  exit();
}
