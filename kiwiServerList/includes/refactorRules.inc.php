<?php
 require '../settings.php';

 if(isset($_POST['add_rule'])){
   $description = $_POST['description'];
   if($_POST['check'] == "on"){
     $check = 1;
   }else{
     $check = 0;
   }

   if(empty($description)){
     header("Location: ../rules?error=emptyDescription");
     exit();
   }else{
     $sql = "INSERT INTO rules (Description, important) VALUES (?, ?)";
     $stmt = mysqli_stmt_init($conn);
     if(!mysqli_stmt_prepare($stmt, $sql)){
       header("Location: ../rules?error=sqlerror");
       exit();
     }else{
       mysqli_stmt_bind_param($stmt, "ss", $description, $check);
       mysqli_stmt_execute($stmt);
       header("Location: ../rules?added=success");
       exit();
     }
   }
 }elseif (isset($_POST['delete_rule'])) {
   $ruleId = $_POST['delete_rule'];
   $sql = "DELETE FROM rules WHERE idRules = ?";
   $stmt = mysqli_stmt_init($conn);
   if(!mysqli_stmt_prepare($stmt, $sql)){
     header("Location: ../rules?error=sqlerror");
     exit();
   }else{
     mysqli_stmt_bind_param($stmt, "s", $ruleId);
     mysqli_stmt_execute($stmt);
     header("Location: ../rules?deleted=success");
     exit;
   }
 }else {
   header("Location: ..");
   exit();
 }
