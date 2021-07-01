<?php
 require '../settings.php';

 if(isset($_POST['add_partners'])){
   $title = $_POST['title'];
   $description = $_POST['description'];
   $link = $_POST['link'];

   if(empty($title) && empty($description)){
     header("Location: ../partners?error=emptyfields");
     exit();
   }else{
     $sql = "INSERT INTO partners (title, description, link) VALUES (?, ?, ?)";
     $stmt = mysqli_stmt_init($conn);
     if(!mysqli_stmt_prepare($stmt, $sql)){
       header("Location: ../partners?error=sqlerror");
       exit();
     }else{
       mysqli_stmt_bind_param($stmt, "sss", $title, $description, $link);
       mysqli_stmt_execute($stmt);
       header("Location: ../partners?added=success");
       exit();
     }
   }
 }elseif (isset($_POST['delete_partners'])) {
   $partnerId = $_POST['delete_partners'];
   $sql = "DELETE FROM partners WHERE partnerId = ?";
   $stmt = mysqli_stmt_init($conn);
   if(!mysqli_stmt_prepare($stmt, $sql)){
     header("Location: ../partners?error=sqlerror");
     exit();
   }else{
     mysqli_stmt_bind_param($stmt, "s", $partnerId);
     mysqli_stmt_execute($stmt);
     header("Location: ../partners?deleted=success");
     exit;
   }
 }else {
   header("Location: ../index");
   exit();
 }
