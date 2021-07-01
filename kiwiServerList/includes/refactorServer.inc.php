<?php
require '../settings.php';

if(isset($_POST['block-project'])){
    $confirmed = 2;
    $idServer = $_POST['block-project'];
    $sql = "UPDATE servers SET confirmed = ? WHERE idServer = ?";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
      header("Location: ../serverInfo?error=sqlerror&id=" . $idServer);
      exit();
    }else{
      mysqli_stmt_bind_param($stmt, "ss", $confirmed, $idServer);
      mysqli_stmt_execute($stmt);
      header("Location: ../serverInfo?change=block&id=" . $idServer);
      exit();
    }
}elseif (isset($_POST['confirm-project'])) {
  $confirmed = 1;
  $idServer = $_POST['confirm-project'];
  $sql = "UPDATE servers SET confirmed = ? WHERE idServer = ?";
  $stmt = mysqli_stmt_init($conn);
  if(!mysqli_stmt_prepare($stmt, $sql)){
    header("Location: ../serverInfo?error=sqlerror&id=" . $idServer);
    exit();
  }else{
    mysqli_stmt_bind_param($stmt, "ss", $confirmed, $idServer);
    mysqli_stmt_execute($stmt);
    header("Location: ../serverInfo?change=confirm&id=" . $idServer);
    exit();
  }
}elseif (isset($_POST['unconfirm-project'])) {
  $confirmed = 0;
  $idServer = $_POST['unconfirm-project'];
  $sql = "UPDATE servers SET confirmed = ? WHERE idServer = ?";
  $stmt = mysqli_stmt_init($conn);
  if(!mysqli_stmt_prepare($stmt, $sql)){
    header("Location: ../serverInfo?error=sqlerror&id=" . $idServer);
    exit();
  }else{
    mysqli_stmt_bind_param($stmt, "ss", $confirmed, $idServer);
    mysqli_stmt_execute($stmt);
    header("Location: ../serverInfo?change=unconfirm&id=" . $idServer);
    exit();
  }
}else if (isset($_POST['delete-project'])) {
  require '../settings.php';
  $idServer = $_POST['delete-project'];

  $sql = "DELETE FROM servers WHERE idServer = ?";
  $stmt = mysqli_stmt_init($conn);

  if(!mysqli_stmt_prepare($stmt, $sql)){
    header("Location: ../serverInfo?error=sqlerror&id=" . $idServer);
    exit();
  }else{
    mysqli_stmt_bind_param($stmt, "s", $idServer);
    mysqli_stmt_execute($stmt);
    header("Location: ../serverInfo?deleted=success");
    exit;
  }
}else{
  header("Location: ../");
  exit();
}
