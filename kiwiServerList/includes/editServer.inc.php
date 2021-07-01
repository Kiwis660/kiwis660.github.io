<?php
if(isset($_POST['editProject-submit'])){
    require '../settings.php';
    session_start();

    $serverName = $_POST['serverName'];
    $type = $_POST['type'];
    $language = $_POST['language'];
    $invite_link = $_POST['inviteLink'];
    $description = $_POST['description'];
    $userId = $_SESSION['userId'];
    $serverId = $_POST['editProject-submit'];
    if(empty($serverName) || empty($type) || empty($language) || empty($invite_link) || empty($description)){
        header("Location: ../editServer?error=emptyfields");
        exit();
    }else{
        $sql = "UPDATE servers SET serverName = ? , type = ?, language = ?, invite_link = ?, description = ? WHERE idServer = ?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
          header("Location: ../editServer?error=sqlerror");
          exit();
        }else{
          mysqli_stmt_bind_param($stmt, "ssssss", $serverName, $type, $language, $invite_link, $description, $serverId);
          mysqli_stmt_execute($stmt);
          header("Location: ../?change=edited");
          exit();
        }

    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}else{
  header("Location: ..");
  exit();
}

session_unset();
