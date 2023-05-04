<?php
    require_once "dbaseconnect.php";
    
    if(isset($_POST['submit'])){
        $key = $_POST['id'];
        $name = $_POST['gasname'];
        $types = $_POST['type'];
        $price = $_POST['price'];
        $gasonhand = $_POST['onhand'];
        $gstored = $_POST['gasstored'];
        $query = "UPDATE `gasoline` SET `name`=?,`type`=?,`price`=?,`available`=?,`stored`=? WHERE `id`=?";
        $statement = mysqli_stmt_init($dbCon);
        if(!mysqli_stmt_prepare($statement, $query)){
            $_SESSION['text']= "Database preparetion statement error";
            $_SESSION['status'] = "error";
            header("Location:../productlist.php#dataTable1");
        }else{
            mysqli_stmt_bind_param($statement, "ssssss",$name,$types,$price,$gasonhand,$gstored,$key);
            mysqli_stmt_execute($statement);
            if (mysqli_stmt_affected_rows($statement)>0) {
                $_SESSION['text']= "Product updated successfully.";
                $_SESSION['status'] = "success";
                header("Location:../productlist.php#dataTable1");
            } else {
                $_SESSION['text']= "Attempt update failed.";
                $_SESSION['status'] = "error";
                header("Location:../productlist.php#dataTable1");
            }

        }
    }
?>