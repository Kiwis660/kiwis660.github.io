<?php
 require '../settings.php';

 if(isset($_POST['add_language'])){
   $language = $_POST['language'];

   if(empty($language)){
     header("Location: ../language?error=emptyType");
     exit();
   }else{
     $sql = "INSERT INTO language (language) VALUES (?)";
     $stmt = mysqli_stmt_init($conn);
     if(!mysqli_stmt_prepare($stmt, $sql)){
       header("Location: ../language?error=sqlerror");
       exit();
     }else{
       mysqli_stmt_bind_param($stmt, "s", $language);
       mysqli_stmt_execute($stmt);
       header("Location: ../language?added=success");
       exit();
     }
   }
 }elseif (isset($_POST['delete_language'])) {
   $languageId = $_POST['delete_language'];
   $sql = "DELETE FROM language WHERE languageId = ?";
   $stmt = mysqli_stmt_init($conn);
   if(!mysqli_stmt_prepare($stmt, $sql)){
     header("Location: ../language?error=sqlerror");
     exit();
   }else{
     mysqli_stmt_bind_param($stmt, "s", $languageId);
     mysqli_stmt_execute($stmt);
     header("Location: ../language?deleted=success");
     exit;
   }
 }else {
   header("Location: ../index");
   exit();
 }
