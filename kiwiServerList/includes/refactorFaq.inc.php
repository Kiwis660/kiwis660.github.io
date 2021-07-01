<?php
 require '../settings.php';

 if(isset($_POST['add_faq'])){
   $question = $_POST['question'];
   $answer = $_POST['answer'];

   if(empty($question) && empty($answer)){
     header("Location: ../faq?error=emptyfields");
     exit();
   }else{
     $sql = "INSERT INTO faq (Question, Answer) VALUES (?, ?)";
     $stmt = mysqli_stmt_init($conn);
     if(!mysqli_stmt_prepare($stmt, $sql)){
       header("Location: ../faq?error=sqlerror");
       exit();
     }else{
       mysqli_stmt_bind_param($stmt, "ss", $question, $answer);
       mysqli_stmt_execute($stmt);
       header("Location: ../faq?added=success");
       exit();
     }
   }
 }elseif (isset($_POST['delete_faq'])) {
   $faqId = $_POST['delete_faq'];
   $sql = "DELETE FROM faq WHERE faqId = ?";
   $stmt = mysqli_stmt_init($conn);
   if(!mysqli_stmt_prepare($stmt, $sql)){
     header("Location: ../faq?error=sqlerror");
     exit();
   }else{
     mysqli_stmt_bind_param($stmt, "s", $faqId);
     mysqli_stmt_execute($stmt);
     header("Location: ../faq?deleted=success");
     exit;
   }
 }else {
   header("Location: ..");
   exit();
 }
