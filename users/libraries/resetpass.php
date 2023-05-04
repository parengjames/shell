<?php
if (isset($_POST["submit"])) {
    require "dbaseconnect.php";

    $username = $_POST["username"];
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirmpass"];

    if (empty($username) || empty($password) || empty($confirmPassword)) {
        header("Location:../forgot-password.php?error=InvalidData");
    } else if ($password != $confirmPassword) {
        header("Location:../forgot-password.php?error=PasswordError");
    } else {
        //pasword hash 
        $hashpass = password_hash($password, PASSWORD_DEFAULT);
        //.....
        $sql = "UPDATE `users` SET `password` = ? WHERE `username`=?";
        $statement = mysqli_stmt_init($dbCon);
        if (!mysqli_stmt_prepare($statement, $sql)) {
            header("Location:../forgot-password.php?error=DatabaseError");
        } else {
            mysqli_stmt_bind_param($statement, "ss", $hashpass, $username);
            mysqli_stmt_execute($statement);
            header("Location:../login.php?error=resetPassword");
        }
        $sql = "SELECT * FROM users where username=?";
        $statement = mysqli_stmt_init($dbCon);
        if (!mysqli_stmt_prepare($statement, $sql)) {
            header("Location:../forgot-password.php?error=DatabaseError");
        } else {
            mysqli_stmt_bind_param($statement, "s", $username);
            mysqli_stmt_execute($statement);
            mysqli_stmt_store_result($statement);
            $recordCount = mysqli_stmt_num_rows($statement);
            if ($recordCount <= 0) {
                header("Location:../forgot-password.php?error=Usernotfound");
            }
        }
        
    }
} else {
    header("Location:../forgot-password.php?error=AccessDenied");
}
