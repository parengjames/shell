<?php
require_once "dbaseconnect.php";
if(isset($_POST['submit'])){
  $ans = $_POST['submit'];
  $key = $_POST['id'];
  $query = "UPDATE `users` SET `approval` = ? WHERE `users`.`id` = ?;";
  $statement = mysqli_stmt_init($dbCon);
  if(!mysqli_stmt_prepare($statement, $query)){
    header("Location:../userList.php?error=databaseError");
  }
  else{
    if($ans=='yes'){
        $approve = "Approved";
        mysqli_stmt_bind_param($statement, "ss", $approve,$key);
        mysqli_stmt_execute($statement);
        if(mysqli_stmt_affected_rows($statement)>0){
          $_SESSION['text']= "User account approved successfully.";
          $_SESSION['status'] = "success";
          header("Location:../userList.php");
        }else{
          $_SESSION['text']= "User account approval failed.";
          $_SESSION['status'] = "error";
          header("Location:../userList.php");
        }
    }else{
        $approve = "Pending";
        mysqli_stmt_bind_param($statement, "ss", $approve,$key);
        mysqli_stmt_execute($statement);
        if(mysqli_stmt_affected_rows($statement)>0){
          $_SESSION['text']= "User account restrict successfully.";
          $_SESSION['status'] = "success";
          header("Location:../userList.php");
        }else{
          $_SESSION['text']= "User account approval failed.";
          $_SESSION['status'] = "error";
          header("Location:../userList.php");
        }
    }
  }
}
?>