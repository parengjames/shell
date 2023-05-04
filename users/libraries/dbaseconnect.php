<?php
    $dbhost = "localhost:3307";
    $dbuser = "root";
    $dbpass = "1234567890";
    $dbname = "inventoryshell";
    session_start();

    $dbCon = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

   if($dbCon){
       $GLOBALS["dbaseStatusValue"] = 1;
    }else{
        $GLOBALS["dbaseStatusValue"] = 0;
    }

    function displayAlert($message){
        echo "<script>alert('$message');</script>";
    }
?>