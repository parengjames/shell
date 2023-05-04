<?php
require "dbaseconnect.php";

if (isset($_POST["submit"])) {
    $title = $_POST["soldtitle"];
    $product = $_POST['prodname'];
    $stocksold = $_POST['stocksold'];
    $recievedDate = $_POST['date'];
    $datesold = date("Y-m-d", strtotime($recievedDate));


    $soldID = "";

    // checking the input if empty....
    if (empty($title) || empty($product) || empty($datesold) || empty($stocksold)) {
        header("Location:../products-sold.php");
    } else {
        //all good...
        // adding now the data to database....
        $sqlInsert = "INSERT INTO `sold`(`title`,`date_sold`,`stock_sold`,`product_id`) VALUES (?,?,?,?)";
        $statement = mysqli_stmt_init($dbCon);
        if (!mysqli_stmt_prepare($statement, $sqlInsert)) {
            header("Location:../products-sold.php");
        } else {
            mysqli_stmt_bind_param($statement, "ssss", $title, $datesold, $stocksold, $product);
            mysqli_stmt_execute($statement);
            if (mysqli_stmt_affected_rows($statement) > 0) {
                 
                // deduct the quantity of the product in product list...
                $sqldeduct = "SELECT * FROM product WHERE id='" . $product . "'";
                $queryResult = mysqli_query($dbCon, $sqldeduct);
                $rowCount = mysqli_num_rows($queryResult);
                if ($rowCount > 0) {
                    $rec = mysqli_fetch_assoc($queryResult);
                    $onhand = $rec['stockonhand'] - $stocksold;
                    $query = "UPDATE `product` SET `stockonhand`=? WHERE `id`=?";
                    $statement = mysqli_stmt_init($dbCon);
                    if (!mysqli_stmt_prepare($statement, $query)) {
                    }
                    mysqli_stmt_bind_param($statement, "ss", $onhand, $product);
                    mysqli_stmt_execute($statement);
                    
                }

                $notif = "SELECT * FROM product WHERE id='" . $product . "'";
                $queryResult = mysqli_query($dbCon, $notif);
                $rowCount = mysqli_num_rows($queryResult);
                if ($rowCount > 0) {
                    $rec = mysqli_fetch_assoc($queryResult);
                    $left = $rec["stockonhand"];
                    $pnames = $rec["name"];
                    if($left <= 10){
                        $_SESSION["titleText"] = $pnames;
                        header("Location:../products-sold.php");
                    }
                }
                $_SESSION['text'] = "Sold item successfully added.";
                $_SESSION['status'] = "success";
                header("Location:../products-sold.php");
            } else {
                $_SESSION['text'] = "Sold item register failed.";
                $_SESSION['status'] = "error";
                header("Location:../products-sold.php");
            }
        }
        // updating the total price.....
        $qryfind = "SELECT `sold`.`stock_sold` * `product`.`price` AS `totalPrice`
                        FROM `sold`
                        JOIN `product` ON `sold`.`product_id`= `product`.`id`
                        WHERE `sold`.`product_id` = '" . $product . "' AND `sold`.`title` = '" . $title . "' AND `sold`.`stock_sold`='" . $stocksold . "'";
        $queryResult = mysqli_query($dbCon, $qryfind);
        $rowCount = mysqli_num_rows($queryResult);
        if ($rowCount > 0) {
            $record = mysqli_fetch_assoc($queryResult);
            $total = $record['totalPrice'];
            $query = "UPDATE `sold` SET `total`=? WHERE `title`=? AND `product_id`=? AND `stock_sold`=?";
            $statement = mysqli_stmt_init($dbCon);
            if (!mysqli_stmt_prepare($statement, $query)) {
            }
            mysqli_stmt_bind_param($statement, "ssss", $total, $title, $product, $stocksold);
            mysqli_stmt_execute($statement);
        }
    }

    //...........  

}
        
    // }
