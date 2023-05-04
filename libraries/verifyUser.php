<?php
session_start();
if(isset($_POST["submit"])){
    require "dbaseconnect.php";

    $username = $_POST["username"];
    $password = $_POST["password"];
    
    if(empty($username) || empty($password)){
        header("Location:..\index.php?error=InvalidData");
    }else{
        //all good
        //check whether the username exists
        $sql = "SELECT * FROM `users` where `username`=?";
        $statement = mysqli_stmt_init($dbCon);
        if(!mysqli_stmt_prepare($statement, $sql)){
            header("Location:..\index.php?error=DatabaseError");
        }else{
            mysqli_stmt_bind_param($statement, "s", $username);
            mysqli_stmt_execute($statement);
            mysqli_stmt_store_result($statement);
            $recordCount = mysqli_stmt_num_rows($statement);
            if ($recordCount > 0) {
                $query = "SELECT approval, password, userType, firstname, lastname FROM users WHERE username = '" . $username . "'";
                $resultSet = mysqli_query($dbCon, $query);
                $rowCount = mysqli_num_rows($resultSet);
                if ($rowCount > 0) {
                    $record = mysqli_fetch_assoc($resultSet);
                    // verify the hashed password from database......
                    if (password_verify($password, $record['password'])) {
                        $appr = $record['approval'];
                        if ($appr == "Approved") {
                            $_SESSION["fname"] = $record["firstname"];
                            $_SESSION["lname"] = $record["lastname"];
                            $_SESSION["position"] = $record['userType'];

                            //recaptcha..........
                            $secretKey="6LfeuIEiAAAAABsPlyauxY4mGxZfhNwzNTrT623D";
                            $response = $_POST['g-recaptcha-response'];
                            $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$response";
                            $fire = file_get_contents($url);
                            $data = json_decode($fire);
                            if('admin' == $record['userType']){
                                if($data->success==true){
                                    header("Location: ../admin-dashboard.php");
                                }else{
                                    $_SESSION['text']= "Please check the ReCaptcha!";
                                    $_SESSION['status'] = "warning";
                                    header("Location:../index.php");
                                }     
                            }else{
                                if($data->success==true){
                                header("Location:../users/user-dashboard.php");
                                }else{
                                    $_SESSION['text']= "Please check the ReCaptcha!";
                                    $_SESSION['status'] = "warning";
                                    header("Location:../index.php");
                                }
                            }    
                        } else {
                            $_SESSION['text']= "Login restricted! Admin approval is needed";
                            $_SESSION['status'] = "warning";
                            header("Location:../index.php");
                        }
                    }else{
                        $_SESSION['text']= "Password is incorrect";
                        $_SESSION['status'] = "warning";
                        header("Location:../index.php");
                    }
                }  
            }else{
                $_SESSION['text']= "Access Denied";
                $_SESSION['status'] = "error";
                header("Location:../index.php");
            }
        }
    }

}else{
    header("Location:..\index.php?error=AccessDenied");
}
?>