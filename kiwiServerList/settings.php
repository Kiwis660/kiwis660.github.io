<?php
  //Database settings
  $serverName = "localhost"; //Not change
  $username = "root";
  $password = "";
  $data_base_name = "discordservers";

  $conn = mysqli_connect($serverName, $username, $password, $data_base_name);

  if(!$conn){
    die("Connection failed: " . mysqli_connect_error());
  }

//Define how many results you want per page
  $results_per_page = 10;

  //How many hours must wait to vote. (Hours)
  $one_vote_in_hour = 24;
