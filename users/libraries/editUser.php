<?php
    require_once "dbaseconnect.php";
    
    if(isset($_POST['submit'])){
        $key = $_POST['id'];
        $fname = $_POST['firstname'];
        $lname = $_POST['lastname'];
        $uname = $_POST['username'];
        $utype = $_POST['usertype'];
        $query = "UPDATE `users` SET `username`=?,`userType`=?,`firstname`=?,`lastname`=? WHERE `id`=?";
        $statement = mysqli_stmt_init($dbCon);
        if(!mysqli_stmt_prepare($statement, $query)){
            $_SESSION['text']= "Database preparetion statement error";
            $_SESSION['status'] = "error";
            header("Location:../userList.php");
        }else{
            mysqli_stmt_bind_param($statement, "sssss",$uname,$utype,$fname,$lname,$key);
            mysqli_stmt_execute($statement);
            if (mysqli_stmt_affected_rows($statement)>0) {
                $_SESSION['text']= "User account updated successfully.";
                $_SESSION['status'] = "success";
                header("Location:../userList.php");
            } else {
                $_SESSION['text']= "Attempt update failed.";
                $_SESSION['status'] = "error";
                header("Location:../userList.php");
            }

        }
      }
?>