<?php
require '../settings.php';

$wait = $one_vote_in_hour * 60;
$ip = $_SERVER['REMOTE_ADDR'];
$ipAddress = ip2long($ip);

// $sql = "SELECT * FROM votestime WHERE ipAddress =" .  ip2long($ipAddress);

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


	$minute = ($interval ->days * 24 * 60) +
           ($interval ->h * 60) + $interval ->i;

      if($minute >= $wait){
        header("Location: ../confirm?id=" . $_GET['idServer']);
        exit();
      }else{
        // TODO: alert
        header("Location: ../serverInfo?id=" . $_GET['idServer'] ."&error=voted");
        exit();
      }
    }else{
      header("Location: ../confirm?id=" . $_GET['idServer']);
      exit();
    }

  }else{
    header("Location: ../confirm?id=" . $_GET['idServer']);
    exit();
  }
}
exit(); ?>
