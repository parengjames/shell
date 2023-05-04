<?php
require_once "libraries/dbaseconnect.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Shell Oil Products Sold</title>

    <link rel="shortcut icon" href="../images/favicon.ico" type="image/x-icon" />

    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <!-- Page level plugin CSS-->
    <link rel="stylesheet" href="vendor/datatables1/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="vendor/datatables1/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="vendor/datatables1/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">
    <link href="pages/dashboard.css" rel="stylesheet">
</head>

<body id="page-top">

    <?php
    include "pages/user-dashHeader.php"
    ?>
    <div id="wrapper">

        <!-- Sidebar -->
        <style>
            #pagename {
                font-size: 20px;
                text-transform: uppercase;
                padding: none;
                margin-bottom: -20px;
            }
        </style>
        <ul class="sidebar navbar-nav">
            <li id="pagename" class="nav-item">
                <a class="nav-link" href="#" id="sidebarToggle">
                    <span>Supply Transaction</span>
                </a>
            </li>
            <div class="dropdown-divider mx-3"></div>
            <li class="nav-item">
                <a class="nav-link" href="user-dashboard.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Home</span>
                </a>
            </li>
            <!-- <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Pages</span>
                </a>
                <div class="dropdown-menu" aria-labelledby="pagesDropdown">
                    <h6 class="dropdown-header">Available pages:</h6>
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#">Add transaction</a>
                </div>
            </li> -->
        </ul>
        <div id="content-wrapper">
            <div class="container-fluid">

                <!-- Breadcrumbs-->
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a style="text-decoration: none ; color: #696969;" href="user-dashboard.php">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">Supply Transaction</li>
                </ol>

                <div class="card mb-3">
                    <div class="card-header">
                        <div class="float-left">
                            <i style="color: #FFD500;" class="fas fa-info-circle mr-2"></i>
                            <a style="text-decoration: none ; color: #ED1C24; font-size: 20px;font-weight: bold;" >OIL SUPPLY TRANSACTION LOGS</a>
                        </div>
                        <div class="float-right">
                            <!-- <button data-toggle="modal" data-target="#AddModal" style="padding: 4px 6px 5px 5px;" class="btn btn-info">
                                <i style="font-size: 15px;" class="fa fa-plus-circle"></i>
                                transaction</button> -->
                            <a style="text-decoration: none ;" href="productlist.php">
                                <button style="padding: 4px 6px 5px 5px;" class="btn btn-success">
                                    <i style="font-size: 15px;" class="fa fa-arrow-circle-left"></i>
                                    Products</button>
                            </a>
                        </div>

                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered small" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Id</th>
                                        <th>Product name</th>
                                        <th>Supplier name</th>
                                        <th>Quantity</th>
                                        <th>Date purchase</th>
                                        <th><small>Actions</small></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = "select purchase.id, product.name, supplier.supplier_name, purchase.stock_order, purchase.purchase_date
                                            from purchase
                                            JOIN product ON purchase.product_id = product.id
                                            JOIN supplier ON purchase.supplier_id = supplier.id";
                                    $queryResult = mysqli_query($dbCon, $query);
                                    $rowCount = mysqli_num_rows($queryResult);
                                    $count = 1;

                                    if ($rowCount > 0) {
                                        $record = mysqli_fetch_assoc($queryResult);
                                        while ($record) {
                                            $datedb = $record['purchase_date'];
                                            $datesold = date("M jS, Y", strtotime($datedb));
                                            $onedit = date("d/m/Y", strtotime($datedb));
                                            echo "<tr>";
                                            echo "<td>" . $count++ . "</th>";
                                            echo "<td><i class='fas fa-desktop mr-2'></i>" . $record["id"] . "</th>";
                                            echo "<td>" . $record["name"] . "</th>";
                                            echo "<td>" . $record["supplier_name"] . "</th>";
                                            echo "<td >" . $record["stock_order"] . "</th>";
                                            echo "<td>" . $datesold . "</th>";
                                            echo "<td style='width: 70px;'>";
                                            // echo '<a style="color: green ;" type="button" class="fas fa-edit mx-1" href="" id="btn_edit" data-whatever="' . $record["id"] . '" data-title="' . $record["title"] . '"  data-productsname="' . $record["name"] . '"  data-sdate="' . $record["date_sold"] . '"  data-sold="' . $record["stock_sold"] . '" data-toggle="modal" data-target="#EditModal" title="Edit"></a>';
                                            echo '<button style="font-size: 12px; font-weight:bold;" type="button" class="btn btn-danger" href="#" id="btn_delete" data-whatever="' . $record["id"] . '" data-toggle="modal" data-target="#deleteOil" title="Delete">Delete</button>';

                                            echo '</th>';
                                            echo "</tr>";
                                            $record = mysqli_fetch_assoc($queryResult);
                                        }
                                        echo "</table>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer small text-muted">
                        <?php echo "Total Records Found: <b>" . $rowCount . "</b>" ?></div>
                </div>

                <!-- OIL LOGS DELETION-->
                <div class="modal fade" id="deleteOil" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="exampleModalLabel">Delete transaction logs</h4>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p class="modal-body-title" id="modal-body-title">Do you want to Delete the selected
                                    Item?</p>
                                <form action="libraries/transaction-oil-delete.php" method="POST">
                                    <input type="hidden" name="id" class="form-control" id="product-soldID" aria-hidden="true">
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                <button type="submit" name="submit" value="yes" class="btn btn-primary">Delete</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- GAS PRODUCTS SOLD..................... -->

                <div class="card mb-3">
                    <div class="card-header">
                        <div class="float-left">
                            <i style="color: #FFD500;" class="fas fa-info-circle mr-2"></i>
                            <a style="text-decoration: none ; color: #ED1C24; font-size: 20px;font-weight: bold;">GASOLINE SUPPLY TRANSACTION LOGS</a>
                        </div>
                        <div class="float-right">
                            <!-- <button data-toggle="modal" data-target="#AddModal" style="padding: 4px 6px 5px 5px;" class="btn btn-info">
                                <i style="font-size: 15px;" class="fa fa-plus-circle"></i>
                                transaction</button> -->
                            <a style="text-decoration: none ;" href="productlist.php#dataTable1">
                                <button style="padding: 4px 6px 5px 5px;" class="btn btn-success">
                                    <i style="font-size: 15px;" class="fa fa-arrow-circle-left"></i>
                                    Products</button>
                            </a>
                        </div>

                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered small" id="dataTable1" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Id</th>
                                        <th>Product name</th>
                                        <th>Supplier name</th>
                                        <th>Quantity (L)</th>
                                        <th>Date Purchased</th>
                                        <th><small>Actions</small></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = "select gas_purchase.id, gasoline.name, supplier.supplier_name, gas_purchase.quantity, gas_purchase.date_purchase
                                    from gas_purchase
                                    JOIN gasoline ON gas_purchase.gasoline_id = gasoline.id
                                    JOIN supplier ON gas_purchase.supplier_id = supplier.id";
                                    $queryResult = mysqli_query($dbCon, $query);
                                    $rowCount = mysqli_num_rows($queryResult);

                                    $count = 1;

                                    if ($rowCount > 0) {
                                        $record = mysqli_fetch_assoc($queryResult);
                                        while ($record) {
                                            $datedb = $record['date_purchase'];
                                            $datesold = date("M jS, Y", strtotime($datedb));
                                            $onedit = date("d/m/Y", strtotime($datedb));
                                            echo "<tr>";
                                            echo "<td>" . $count++ . "</th>";
                                            echo "<td><i class='fas fa-desktop mr-2'></i>" . $record["id"] . "</th>";
                                            echo "<td>" . $record["name"] . "</th>";
                                            echo "<td>" . $record["supplier_name"] . "</th>";
                                            echo "<td >" . $record["quantity"] . " liters</th>";
                                            echo "<td>" . $datesold . "</th>";
                                            echo "<td style='width: 70px;'>";
                                            // echo '<a style="color: green ;" type="button" class="fas fa-edit mx-1" href="" id="btn_edit" data-whatever="' . $record["id"] . '" data-title="' . $record["title"] . '"  data-productsname="' . $record["name"] . '"  data-sdate="' . $record["date_sold"] . '"  data-sold="' . $record["stock_sold"] . '" data-toggle="modal" data-target="#EditModal" title="Edit"></a>';
                                            echo '<button style="font-size: 12px; font-weight:bold;" type="button" class="btn btn-danger" href="#" id="btn_delete" data-whatever="' . $record["id"] . '" data-toggle="modal" data-target="#gasdelete" title="Delete">Delete</button>';

                                            echo '</th>';
                                            echo "</tr>";
                                            $record = mysqli_fetch_assoc($queryResult);
                                        }
                                        echo "</table>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer small text-muted">
                        <?php echo "Total Records Found: <b>" . $rowCount . "</b>" ?></div>
                </div>

                <!-- MODAL 2 FOR GASOLINE -->

                <!-- Delete product Modal-->
                <div class="modal fade" id="gasdelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="exampleModalLabel">Delete Transaction logs</h4>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p class="modal-body-title" id="modal-body-title">Do you want to Delete the selected
                                    Item?</p>
                                <form action="libraries/transaction-gas-delete.php" method="POST">
                                    <input type="hidden" name="id" class="form-control" id="gas-soldID" aria-hidden="true">
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                <button type="submit" name="submit" value="yes" class="btn btn-primary">Delete</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>


            </div>

            <!-- Sticky Footer -->
            <?php include "pages/footer.php" ?>

        </div>
        <!-- /.content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Confirm Log out</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Are you sure you wanted to Log out?</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="../index.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- CDN example (jsDelivr) -->
    <script src="vendor/dayjs/dayjs.min.js"></script>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Page level datatables & plugin JavaScript-->
    <script src="vendor/datatables1/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables1/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="vendor/datatables1/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="vendor/datatables1/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="vendor/datatables1/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="vendor/datatables1/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="vendor/datatables1/jszip/jszip.min.js"></script>
    <script src="vendor/datatables1/pdfmake/pdfmake.min.js"></script>
    <script src="vendor/datatables1/pdfmake/vfs_fonts.js"></script>
    <script src="vendor/datatables1/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="vendor/datatables1/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="vendor/datatables1/datatables-buttons/js/buttons.colVis.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>
    <script src="js/oil-sold.js"></script>

    <!-- Sweet alert -->
    <script src="vendor/sweetalert/sweetalert.min.js"></script>

    <?php

    if (isset($_SESSION['text'])) {
        if (isset($_SESSION['status'])) {
    ?>
            <script>
                swal({
                    title: "<?php echo $_SESSION['text'] ?>",
                    // text: "You clicked the button!",
                    icon: "<?php echo $_SESSION['status'] ?>",
                    button: "OK",
                });
            </script>
    <?php
            unset($_SESSION['status']);
        }
    }
    ?>

    <script>
        $(function() {
            $("#dataTable").DataTable({
                "responsive": true,
                "lengthChange": true,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#dataTable_wrapper .col-md-6:eq(0)');
        });
    </script>

    <script>
        $(function() {
            $("#dataTable1").DataTable({
                "responsive": true,
                "lengthChange": true,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#dataTable1_wrapper .col-md-6:eq(0)');
        });
    </script>

</body>

</html>