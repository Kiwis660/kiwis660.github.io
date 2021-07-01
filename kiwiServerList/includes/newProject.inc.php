<?php
if(isset($_POST['newProject-submit'])){
    require '../settings.php';
    session_start();

    $serverName = $_POST['serverName'];
    $type = $_POST['type'];
    $language = $_POST['language'];
    $invite_link = $_POST['inviteLink'];
    $description = $_POST['description'];
    $userId = $_SESSION['userId'];

    if(empty($serverName) || empty($type) || empty($language) || empty($invite_link) || empty($description)){
        header("Location: ../newProject?error=emptyfields");
        exit();
    }else{
        $sql = "INSERT INTO servers (serverName, type, language, invite_link, description, UserId) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
          header("Location: ../newProject?error=sqlerror");
          exit();
        }else{
          mysqli_stmt_bind_param($stmt, "ssssss", $serverName, $type, $language, $invite_link, $description, $userId);
          mysqli_stmt_execute($stmt);
          header("Location: ../newProject?added=success");
          exit();
        }

    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}else{
  header("Location: ../newProject");
  exit();
}

session_unset();
