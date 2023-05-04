<?php
    require "dbaseconnect.php";

    if(isset($_POST["submit"])){
        $title = $_POST["soldtitle"];
        $product = $_POST['gasID'];
        $stocksold = $_POST['stocksold'];
        $recievedDate = $_POST['date'];
        $datesold = date("Y-m-d",strtotime($recievedDate));
        
        $soldID = "";

        // checking the input if empty....
        if(empty($title) || empty($product) || empty($datesold) || empty($stocksold)){
           header("Location:../products-sold.php");
        }else{
            //all good...
            // adding now the data to database....
                    $sqlInsert = "INSERT INTO `gasolinesold`(`title`,`date_sold`,`quantity`,`gas_id`) VALUES (?,?,?,?)";
                    $statement = mysqli_stmt_init($dbCon);
                    if(!mysqli_stmt_prepare($statement, $sqlInsert)){
                        header("Location:../products-sold.php");
                    }else{
                        mysqli_stmt_bind_param($statement, "ssss", $title,$datesold,$stocksold,$product);
                        mysqli_stmt_execute($statement);
                        if(mysqli_stmt_affected_rows($statement)>0){

                            // deduct the quantity of the product in product list...
                            $sqldeduct = "SELECT * FROM gasoline WHERE id='". $product ."'";
                            $queryResult = mysqli_query($dbCon, $sqldeduct);
                            $rowCount = mysqli_num_rows($queryResult);
                            if($rowCount > 0){
                                $rec = mysqli_fetch_assoc($queryResult);
                                $onhand = $rec['available'] - $stocksold;
                                $query = "UPDATE `gasoline` SET `available`=? WHERE `id`=?";
                                $statement = mysqli_stmt_init($dbCon);
                                if(!mysqli_stmt_prepare($statement, $query)){}
                                mysqli_stmt_bind_param($statement, "ss",$onhand,$product);
                                mysqli_stmt_execute($statement);
                            }

                            $notif = "SELECT * FROM gasoline WHERE id='" . $product . "'";
                            $queryResult = mysqli_query($dbCon, $notif);
                            $rowCount = mysqli_num_rows($queryResult);
                            if ($rowCount > 0) {
                                $rec = mysqli_fetch_assoc($queryResult);
                                $left = $rec["available"];
                                $gnames = $rec["name"];
                                if($left <= 5000){
                                    $_SESSION["titleText"] = $gnames;
                                    header("Location:../products-sold.php#dataTable1");
                                }
                            }

                            $_SESSION['text']= "Sold item successfully added.";
                            $_SESSION['status'] = "success";
                            header("Location:../products-sold.php#dataTable1");
                        }else{
                            $_SESSION['text']= "Sold item register failed.";
                            $_SESSION['status'] = "error";
                            header("Location:../products-sold.php#dataTable1");
                        }
                    } 
                    // updating the total price.....
                        $qryfind = "SELECT `gasolinesold`.`quantity` * `gasoline`.`price` AS `totalPrice`
                        FROM `gasolinesold`
                        JOIN `gasoline` ON `gasolinesold`.`gas_id`= `gasoline`.`id`
                        WHERE `gasolinesold`.`gas_id` = '". $product ."' AND `gasolinesold`.`title` = '".$title."' AND `gasolinesold`.`quantity`='". $stocksold ."'";
                        $queryResult = mysqli_query($dbCon, $qryfind);
                        $rowCount = mysqli_num_rows($queryResult);
                        if ($rowCount > 0) {
                            $record = mysqli_fetch_assoc($queryResult);
                            $total = $record['totalPrice'];
                            $query = "UPDATE `gasolinesold` SET `totalPrice`=? WHERE `title`=? AND `gas_id`=? AND `quantity`=?";
                            $statement = mysqli_stmt_init($dbCon);
                            if(!mysqli_stmt_prepare($statement, $query)){}
                            mysqli_stmt_bind_param($statement, "ssss",$total,$title,$product,$stocksold);
                            mysqli_stmt_execute($statement);
                        }
                    }
                     
                //...........  
    
            }
        
    // }
?>