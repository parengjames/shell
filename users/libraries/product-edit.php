<?php
    require_once "dbaseconnect.php";
    
    if(isset($_POST['submit'])){
        $key = $_POST['id'];
        $name = $_POST['productname'];
        $liters = $_POST['liters'];
        $price = $_POST['price'];
        $sonhand = $_POST['stockonhand'];
        $sstored = $_POST['stockstored'];
        $query = "UPDATE `product` SET `name`=?,`liters`=?,`price`=?,`stockonhand`=?,`stockstored`=? WHERE `id`=?";
        $statement = mysqli_stmt_init($dbCon);
        if(!mysqli_stmt_prepare($statement, $query)){
            $_SESSION['text']= "Database preparetion statement error";
            $_SESSION['status'] = "error";
            header("Location:../productlist.php");
        }else{
            mysqli_stmt_bind_param($statement, "ssssss",$name,$liters,$price,$sonhand,$sstored,$key);
            mysqli_stmt_execute($statement);
            if (mysqli_stmt_affected_rows($statement)>0) {
                $_SESSION['text']= "Product updated successfully.";
                $_SESSION['status'] = "success";
                header("Location:../productlist.php");
            } else {
                $_SESSION['text']= "Attempt update failed.";
                $_SESSION['status'] = "error";
                header("Location:../productlist.php");
            }

        }
    }
?>