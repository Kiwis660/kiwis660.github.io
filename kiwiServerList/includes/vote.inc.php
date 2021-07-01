<?php

require '../settings.php';

$ip = $_SERVER['REMOTE_ADDR'];
$ipAddress = ip2long($ip);




$sql = "SELECT * FROM votestime WHERE ipAddress = ?";
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
  header("Location: ../serverInfo?id=" . $_GET['ServerId'] ."&error=sqlerror");
  exit();
}
else {

  mysqli_stmt_bind_param($stmt, "s", $ipAddress);

  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);

  $date = new DateTime();
  $last_vote = $date->format('Y-m-d H:i:s');
   // $last_vote = new DateTime();

  if ($row = mysqli_fetch_assoc($result)) {
    $last_vote = new DateTime();
    if($row['ipAddress'] == $ipAddress){

      $first_vote = new DateTime($row['times']);

      $interval = $first_vote->diff($last_vote);
      $hours   = $interval->format('%h');
      $minutes = $interval->format('%i');

      $deferences = $hours + $minutes;
      $minute = ($interval ->days * 24 * 60) +
               ($interval ->h * 60) + $interval ->i;

      $wait = $one_vote_in_hour * 60;
      if($minute >= $wait){
        $sql = "UPDATE servers SET votes = votes + 1 WHERE idServer = ?";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
              header("Location: ../serverInfo?id=" . $_GET['id'] . "&error=sqlerror");
              exit();
        }else{
          mysqli_stmt_bind_param($stmt, "s", $_GET['id']);
          mysqli_stmt_execute($stmt);
          mysqli_stmt_store_result($stmt);

          $sql = "UPDATE votestime SET times = ? WHERE ipAddress = ?";
          $stmt = mysqli_stmt_init($conn);

          if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("Location: ../serverInfo?id=" . $_GET['id'] . "&error=sqlerror");
                exit();
          }else{
            $date = new DateTime();
            $last_vote = $date->format('Y-m-d H:i:s');
            mysqli_stmt_bind_param($stmt, "ss", $last_vote, $ipAddress);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            header("Location: ../serverInfo?id=" . $_GET['id'] . "&added=successvoted");
            exit();
          }
        }
      }else{
        // TODO: alert
        header("Location: ../serverInfo?id=" . $_GET['id'] . "&error=voted");
        exit();
      }
    }else{
      $sql = "INSERT INTO votestime (ipAddress, times) VALUES (?, ?)";
      $stmt = mysqli_stmt_init($conn);
      if(!mysqli_stmt_prepare($stmt, $sql)){
        header("Location: ../serverInfo?id=" . $_GET['id'] . "&error=sqlerror");
        exit();
      }else{

        mysqli_stmt_bind_param($stmt, "ss", $ipAddress, $last_vote);
        mysqli_stmt_execute($stmt);
        header("Location: ../index");
        exit();
      }


    }

  }else{
    $sql = "INSERT INTO votestime (ipAddress, times) VALUES (?, ?)";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
      header("Location: ../serverInfo?id=" . $_GET['id'] . "&error=sqlerror");
      exit();
    }else{

      mysqli_stmt_bind_param($stmt, "ss", $ipAddress, $last_vote);
      mysqli_stmt_execute($stmt);


      $sql = "UPDATE servers SET votes = votes + 1 WHERE idServer = ?";
      $stmt = mysqli_stmt_init($conn);

      if (!mysqli_stmt_prepare($stmt, $sql)) {
          header("Location: ../serverInfo?id=" . $_GET['id'] . "&error=sqlerror");
          exit();
      }else{
        mysqli_stmt_bind_param($stmt, "s", $_GET['id']);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
      }
    header("Location: ../serverInfo?id=" . $_GET['id'] . "&added=successvoted");
    exit();
    }
  }
}
exit();
