<?php
 require '../settings.php';

 if(isset($_POST['add_type'])){
   $type = $_POST['type'];

   if(empty($type)){
     header("Location: ../types?error=emptyType");
     exit();
   }else{
     $sql = "INSERT INTO types (type) VALUES (?)";
     $stmt = mysqli_stmt_init($conn);
     if(!mysqli_stmt_prepare($stmt, $sql)){
       header("Location: ../types?error=sqlerror");
       exit();
     }else{
       mysqli_stmt_bind_param($stmt, "s", $type);
       mysqli_stmt_execute($stmt);
       header("Location: ../types?added=success");
       exit();
     }
   }
 }elseif (isset($_POST['delete_type'])) {
   $typeId = $_POST['delete_type'];
   $sql = "DELETE FROM types WHERE typesId = ?";
   $stmt = mysqli_stmt_init($conn);
   if(!mysqli_stmt_prepare($stmt, $sql)){
     header("Location: ../types?error=sqlerror");
     exit();
   }else{
     mysqli_stmt_bind_param($stmt, "s", $typeId);
     mysqli_stmt_execute($stmt);
     header("Location: ../types?deleted=success");
     exit;
   }
 }else {
   header("Location: ../index");
   exit();
 }
