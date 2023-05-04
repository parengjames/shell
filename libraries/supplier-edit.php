<?php
    require_once "dbaseconnect.php";
    
    if(isset($_POST['submit'])){
        $key = $_POST['id'];
        $name = $_POST['suppliername'];
        $address = $_POST['address'];

        $query = "UPDATE `supplier` SET `supplier_name`=?,`address`=? WHERE `id`=?";
        $statement = mysqli_stmt_init($dbCon);
        if(!mysqli_stmt_prepare($statement, $query)){
            $_SESSION['text']= "Database preparation statement error";
            $_SESSION['status'] = "error";
            header("Location:../supplierList.php");
        }else{
            mysqli_stmt_bind_param($statement, "sss",$name,$address,$key);
            mysqli_stmt_execute($statement);
            if (mysqli_stmt_affected_rows($statement)>0) {
                $_SESSION['text']= "Supplier updated successfully.";
                $_SESSION['status'] = "success";
                header("Location:../supplierList.php");
            } else {
                $_SESSION['text']= "Attempt update failed.";
                $_SESSION['status'] = "error";
                header("Location:../supplierList.php");
            }

        }
    }
?>