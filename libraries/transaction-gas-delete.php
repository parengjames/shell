<?php
require_once "dbaseconnect.php";
if(isset($_POST['submit'])){
  $ans = $_POST['submit'];
  $key = $_POST['id'];
  $query = "DELETE FROM gas_purchase WHERE `gas_purchase`.`id` =?";
  $statement = mysqli_stmt_init($dbCon);
  if(!mysqli_stmt_prepare($statement, $query)){
    $_SESSION['text']= "Database preparetion statement error";
    $_SESSION['status'] = "error";
    header("Location:../products-sold.php#dataTable1");
  }else{
      if($ans=='yes'){
        mysqli_stmt_bind_param($statement, "s",$key);
        mysqli_stmt_execute($statement);
        if (mysqli_stmt_affected_rows($statement)>0) {
          $_SESSION['text']= "Transaction successfully deleted";
          $_SESSION['status'] = "success";
          header("Location:../transaction.php#dataTable1");
        } else {
          $_SESSION['text']= "Item deletion failed.";
          $_SESSION['status'] = "error";
          header("Location:../transaction.php#dataTable1");
        }
      }else{
        header("Location:../transaction.php#dataTable1");
      } 
  }
}
?>