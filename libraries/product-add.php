<?php
    session_start();
    require "dbaseconnect.php";

    if(isset($_POST["submit"])){
        $prodname = $_POST["productname"];
        $size = $_POST['liters'];
        $price = $_POST['price'];
        $onhand = $_POST['stockonhand'];
        $stored = $_POST['stockstored'];

        // checking the input if empty....
        if(empty($prodname) || empty($size) || empty($price) || empty($onhand) || empty($stored)){
           header("Location:../productlist.php?error=InvalidData");
        }else{
            //all good...
            // adding now the data to database....
            $sqlquery = "SELECT * FROM product where name=?";
            $statement = mysqli_stmt_init($dbCon);
            if(!mysqli_stmt_prepare($statement,$sqlquery)){
                header("Location:../productlist.php?error=DatabaseError");
            }else{
                mysqli_stmt_bind_param($statement, "s", $prodname);
                mysqli_stmt_execute($statement);
                mysqli_stmt_store_result($statement);
                $rcount = mysqli_stmt_num_rows($statement);
                if($rcount>0){
                    $_SESSION['text']= "Product already exist";
                    $_SESSION['status'] = "warning";
                    header("Location:../productlist.php");
                }else{
                    $sqlInsert = "INSERT INTO `product`(`name`,`liters`,`price`,`stockonhand`,`stockstored`) VALUES (?,?,?,?,?)";
                    $statement = mysqli_stmt_init($dbCon);
                    if(!mysqli_stmt_prepare($statement, $sqlInsert)){
                        header("Location:../productlist.php?error=statementError");
                    }else{
                        mysqli_stmt_bind_param($statement, "sssss", $prodname,$size, $price,$onhand,$stored);
                        mysqli_stmt_execute($statement);
                        if(mysqli_stmt_affected_rows($statement)>0){
                            $_SESSION['text']= "Product successfully added.";
                            $_SESSION['status'] = "success";
                            header("Location:../productlist.php");
                        }else{
                            $_SESSION['text']= "Product register failed.";
                            $_SESSION['status'] = "error";
                            header("Location:../productlist.php");
                        }
                    } 
                }
            }
        }
        
    }
?>
