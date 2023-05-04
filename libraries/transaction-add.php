<?php
require "dbaseconnect.php";

if (isset($_POST["submit"])) {
    $transaction = $_POST["transactType"];
    $oilKey = $_POST["id"];
    $oilName = $_POST["oilname"];
    $supplierID = $_POST["suppName"];
    $date = $_POST["purchaseDate"];
    $formattedDate = date("Y-m-d", strtotime($date));
    $qty = $_POST["quantityNeed"];

    if ($transaction == "oil") {
        // checking the input if empty....
        if (empty($oilKey) || empty($oilName) || empty($supplierID) || empty($date) || empty($qty)) {
            header("Location:../productlist.php?error=InvalidData");
        } else {
            //all good...
            // adding now the data to database.... 
            $insertquery = "INSERT INTO `purchase`(`supplier_id`,`product_id`,`stock_order`,`purchase_date`) VALUES (?,?,?,?)";
            $statement = mysqli_stmt_init($dbCon);
            if (!mysqli_stmt_prepare($statement, $insertquery)) {
                header("Location:../productlist.php");
            } else {
                mysqli_stmt_bind_param($statement, "ssss", $supplierID, $oilKey, $qty, $formattedDate);
                mysqli_stmt_execute($statement);
                if (mysqli_stmt_affected_rows($statement) > 0) {
                    // transaction added successfully............
                    // Add the inserted quantity in product onhand and stocks....
                    $addquery = "SELECT * FROM product WHERE id= '" . $oilKey . "'";
                    $queryResult = mysqli_query($dbCon, $addquery);
                    $rowCount = mysqli_num_rows($queryResult);
                    if ($rowCount > 0) {
                        $rec = mysqli_fetch_assoc($queryResult);
                        $stockonhand = $rec["stockonhand"] + $qty;
                        $totalstocks = $rec["stockstored"] + $qty;
                        $query = "UPDATE `product` SET `stockonhand`=?, `stockstored`=?  WHERE `id`=?";
                        $statement = mysqli_stmt_init($dbCon);
                        if (!mysqli_stmt_prepare($statement, $query)) {
                        }
                        mysqli_stmt_bind_param($statement, "sss", $stockonhand, $totalstocks, $oilKey);
                        mysqli_stmt_execute($statement);
                    }
                    // notifying the success.....
                    $_SESSION['text'] = "Transaction Success";
                    $_SESSION['status'] = "success";
                    header("Location:../productlist.php");
                } else {
                    $_SESSION['text'] = "Transaction Failed";
                    $_SESSION['status'] = "error";
                    header("Location:../productlist.php");
                }
            }
        }
    } else {
        // GASOLINE SUPPLY TRANSACTION..................
        $gasKey = $_POST["id"];
        $gasName = $_POST["gasname"];
        $supplierID1 = $_POST["suppName1"];
        $date1 = $_POST["purchaseDate1"];
        $formattedDate1 = date("Y-m-d", strtotime($date1));
        $qty1 = $_POST["quantityNeed1"];

        // checking the input if empty....
        if (empty($gasKey) || empty($gasName) || empty($supplierID1) || empty($date1) || empty($qty1)) {
            header("Location:../productlist.php?error=InvalidData");
        } else {
            //all good...
            // adding now the data to database.... 
            $insertquery = "INSERT INTO `gas_purchase`(`supplier_id`,`gasoline_id`,`quantity`,`date_purchase`) VALUES (?,?,?,?)";
            $statement = mysqli_stmt_init($dbCon);
            if (!mysqli_stmt_prepare($statement, $insertquery)) {
                header("Location:../productlist.php");
            } else {
                mysqli_stmt_bind_param($statement, "ssss", $supplierID1, $gasKey, $qty1, $formattedDate1);
                mysqli_stmt_execute($statement);
                if (mysqli_stmt_affected_rows($statement) > 0) {
                    // transaction added successfully............
                    // Add the inserted quantity in product onhand and stocks....
                    $addquery = "SELECT * FROM gasoline WHERE id= '" . $gasKey . "'";
                    $queryResult = mysqli_query($dbCon, $addquery);
                    $rowCount = mysqli_num_rows($queryResult);
                    if ($rowCount > 0) {
                        $rec = mysqli_fetch_assoc($queryResult);
                        $stockonhand1 = $rec["available"] + $qty1;
                        $totalstocks1 = $rec["stored"] + $qty1;
                        $query = "UPDATE `gasoline` SET `available`=?, `stored`=?  WHERE `id`=?";
                        $statement = mysqli_stmt_init($dbCon);
                        if (!mysqli_stmt_prepare($statement, $query)) {
                        }
                        mysqli_stmt_bind_param($statement, "sss", $stockonhand1, $totalstocks1, $gasKey);
                        mysqli_stmt_execute($statement);
                    }
                    // notifying the success.....
                    $_SESSION['text'] = "Transaction Success";
                    $_SESSION['status'] = "success";
                    header("Location:../productlist.php#dataTable1");
                } else {
                    $_SESSION['text'] = "Transaction Failed";
                    $_SESSION['status'] = "error";
                    header("Location:../productlist.php#dataTable1");
                }
            }
        }

        }
}
