<?php
    require "dbaseconnect.php";

    if(isset($_POST["submit"])){
        $supname = $_POST["suppliername"];
        $supaddress = $_POST['address'];

        // checking the input if empty....
        if(empty($supname) || empty($supaddress) ){
            $_SESSION['text']= "Invalid Data";
            $_SESSION['status'] = "error";
            header("Location:../supplierList.php");
        }else{
            //all good...
            // adding now the data to database....
            $sqlquery = "SELECT * FROM supplier where supplier_name=?";
            $statement = mysqli_stmt_init($dbCon);
            if(!mysqli_stmt_prepare($statement,$sqlquery)){
                $_SESSION['text']= "Database prepared statement error";
                $_SESSION['status'] = "error";
                header("Location:../supplierList.php");
            }else{
                mysqli_stmt_bind_param($statement, "s", $supname);
                mysqli_stmt_execute($statement);
                mysqli_stmt_store_result($statement);
                $rcount = mysqli_stmt_num_rows($statement);
                if($rcount>0){
                    $_SESSION['text']= "Supplier already exist";
                    $_SESSION['status'] = "warning";
                    header("Location:../supplierList.php");
                }else{
                    $sqlInsert = "INSERT INTO `supplier`(`supplier_name`,`address`) VALUES (?,?)";
                    $statement = mysqli_stmt_init($dbCon);
                    if(!mysqli_stmt_prepare($statement, $sqlInsert)){
                        $_SESSION['text']= "Database prepared statement error";
                        $_SESSION['status'] = "error";
                        header("Location:../supplierList.php");
                    }else{
                        mysqli_stmt_bind_param($statement, "ss", $supname,$supaddress);
                        mysqli_stmt_execute($statement);
                        if(mysqli_stmt_affected_rows($statement)>0){
                            $_SESSION['text']= "Supplier successfully added.";
                            $_SESSION['status'] = "success";
                            header("Location:../supplierList.php");
                        }else{
                            $_SESSION['text']= "Supplier register failed.";
                            $_SESSION['status'] = "error";
                            header("Location:../supplierList.php");
                        }
                    } 
                }
            }
        }
        
    }
?>
