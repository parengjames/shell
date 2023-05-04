<?php
if(isset($_POST["submit"])){
    require "dbaseconnect.php";

    $username = $_POST["username"];
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirmpass"];
    $userType = $_POST["usertype"];
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $approval = "";
    $from = $_POST["type"];

    if(empty($username) || empty($password) || empty($confirmPassword) || empty($userType) || empty($firstname) || empty($lastname) ){
        if($from=="fromList"){
            header("Location:../registerUser.php?error=InvalidData&type=fromList");
        }else{
            header("Location:../registerUser.php?error=InvalidData&type=fromlogin");
        }
    }else if(!preg_match("/^[a-zA-Z0-9]*/",$username)){
        if($from=="fromList"){
            header("Location:../registerUser.php?error=InvalidUsername&type=fromList");
        }else{
            header("Location:../registerUser.php?error=InvalidUsername&type=fromlogin");
        }
    }else if($password != $confirmPassword){
        if($from=="fromList"){
            $_SESSION['text']= "Confirm password not match";
            $_SESSION['status'] = "error";
            header("Location:../registerUser.php?type=fromList");
        }else{
            $_SESSION['text']= "Confirm password not match";
            $_SESSION['status'] = "error";
            header("Location:../registerUser.php?type=fromlogin");
        }
    }else{
        //all good
        //check whether the username exists
        $sql = "SELECT * FROM users where username=?";
        $statement = mysqli_stmt_init($dbCon);
        if(!mysqli_stmt_prepare($statement, $sql)){
            if($from=="fromList"){
                header("Location:../registerUser.php?error=DatabaseError&type=fromList");
            }else{
                header("Location:../registerUser.php?error=DatabaseError&type=fromlogin");
            }
        }else{
            mysqli_stmt_bind_param($statement, "s", $username);
            mysqli_stmt_execute($statement);
            mysqli_stmt_store_result($statement);
            $recordCount = mysqli_stmt_num_rows($statement);
            if($recordCount>0){
                if($from=="fromList"){
                    $_SESSION['text']= "User account already exist!";
                    $_SESSION['status'] = "warning";
                    header("Location:../registerUser.php?type=fromList");
                }else{
                    $_SESSION['text']= "User account already exist!";
                    $_SESSION['status'] = "warning";
                    header("Location:../registerUser.php?type=fromlogin");
                }
            }else{
                $sql = "INSERT INTO `users`(`username`, `password`, `usertype`, `firstname`, `lastname`,`approval`) VALUES (?,?,?,?,?,?)";
                $statement = mysqli_stmt_init($dbCon);
                if(!mysqli_stmt_prepare($statement, $sql)){
                    if($from=="fromList"){
                        header("Location:../registerUser.php?error=DatabaseError&type=fromList");
                    }else{
                        header("Location:../registerUser.php?error=DatabaseError&type=fromlogin");
                    }
                }else{
                    //password hash...
                    $hashpass = password_hash($password, PASSWORD_DEFAULT);
                    //.....
                    if($userType=="admin"){
                        $approval = "Approved";
                        mysqli_stmt_bind_param($statement, "ssssss", $username,$hashpass, $userType, $firstname, $lastname,$approval);
                        mysqli_stmt_execute($statement);
                        if($from=="fromList"){
                            $_SESSION['text']= "User account register successfully";
                            $_SESSION['status'] = "success";
                            header("Location:../registerUser.php?type=fromList");
                        }else{
                            $_SESSION['text']= "User account register successfully";
                            $_SESSION['status'] = "success";
                            header("Location:../registerUser.php?type=fromlogin");
                        }
                        
                    }else{
                        $approval = "Pending";
                        mysqli_stmt_bind_param($statement, "ssssss", $username,$hashpass, $userType, $firstname, $lastname,$approval);
                        mysqli_stmt_execute($statement);
                        if($from=="fromList"){
                            $_SESSION['text']= "User account register successfully";
                            $_SESSION['status'] = "success";
                            header("Location:../registerUser.php?type=fromList");
                        }else{
                            $_SESSION['text']= "User account register successfully";
                            $_SESSION['status'] = "success";
                            header("Location:../registerUser.php?type=fromlogin");
                        }
                    }
                }
            }
        }
    }
}else{
    if($from=="fromList"){
        header("Location:../registerUser.php?error=AccessDenied&type=fromList");
    }else{
        header("Location:../registerUser.php?error=AccessDenied&type=fromlogin");
    }
}


?>