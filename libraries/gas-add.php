<?php
    session_start();
    require "dbaseconnect.php";

    if(isset($_POST["submit"])){
        $Gasname = $_POST["gasname"];
        $forTypes = $_POST['type'];
        $price = $_POST['price'];
        $avail= $_POST['onhand'];
        $stored = $_POST['gasstored'];

        // checking the input if empty....
        if(empty($Gasname) || empty($forTypes) || empty($price) || empty($avail) || empty($stored)){
           header("Location:../productlist.php?error=InvalidData");
        }else{
            //all good...
            // adding now the data to database....
            $sqlquery = "SELECT * FROM gasoline where name=?";
            $statement = mysqli_stmt_init($dbCon);
            if(!mysqli_stmt_prepare($statement,$sqlquery)){
                header("Location:../productlist.php?error=DatabaseError");
            }else{
                mysqli_stmt_bind_param($statement, "s", $Gasname);
                mysqli_stmt_execute($statement);
                mysqli_stmt_store_result($statement);
                $rcount = mysqli_stmt_num_rows($statement);
                if($rcount>0){
                    $_SESSION['text']= "Product already exist";
                    $_SESSION['status'] = "warning";
                    header("Location:../productlist.php#dataTable1");
                }else{
                    $sqlInsert = "INSERT INTO `gasoline`(`name`,`type`,`price`,`available`,`stored`) VALUES (?,?,?,?,?)";
                    $statement = mysqli_stmt_init($dbCon);
                    if(!mysqli_stmt_prepare($statement, $sqlInsert)){
                        header("Location:../productlist.php?error=statementError");
                    }else{
                        mysqli_stmt_bind_param($statement, "sssss", $Gasname,$forTypes, $price,$avail,$stored);
                        mysqli_stmt_execute($statement);
                        if(mysqli_stmt_affected_rows($statement)>0){
                            $_SESSION['text']= "Product successfully added.";
                            $_SESSION['status'] = "success";
                            header("Location:../productlist.php#dataTable1");
                        }else{
                            $_SESSION['text']= "Product register failed.";
                            $_SESSION['status'] = "error";
                            header("Location:../productlist.php#dataTable1");
                        }
                    } 
                }
            }
        }
        
    }
?>