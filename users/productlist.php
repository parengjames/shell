<?php
require_once "libraries/dbaseconnect.php";

if (isset($_GET["error"])) {
  if ($_GET["error"] == "InvalidData") {
    displayAlert("Invalid Data Entered");
  } else if ($_GET["error"] == "DatabaseError") {
    displayAlert("Database Initialization Error");
  } else if ($_GET["error"] == "productExisted") {
    displayAlert("That product is already saved");
  } else if ($_GET["error"] == "statementError") {
    displayAlert("Insert prepare statement error");
  } else if ($_GET["error"] == "registerFailed") {
    displayAlert("Product register Failed");
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Shell Products List</title>

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
          <span> Shell Products </span>
        </a>
      </li>
      <div class="dropdown-divider mx-3"></div>
      <li class="nav-item">
        <a class="nav-link" href="user-dashboard.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Home</span>
        </a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Pages</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
          <h6 class="dropdown-header">Available pages:</h6>
          <a class="dropdown-item" href="supplierList.php">Supplier</a>
          <a class="dropdown-item" href="products-sold.php">Sold Product</a>
        </div>
      </li>
      <li style="margin-bottom: -15px;" class="nav-item">
          <a class="nav-link" href="transaction.php">
            <i class="fas fa-folder-open"></i>
            <span>Supply transactions</span>
          </a>
        </li>
    </ul>
    <div id="content-wrapper">
      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a style="text-decoration: none ; color: #696969;" href="user-dashboard.php">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Shell products</li>
        </ol>

        <div class="card mb-3">
          <div class="card-header">
            <div class="float-left">
              <i style="color: #FFD500;" class="fas fa-exclamation-circle mr-2"></i>
              <a style="text-decoration: none ; color: #ED1C24; font-size: 20px;font-weight: bold;">SHELL OIL PRODUCTS</a>

              <!-- // echo "Database Status: ";
              // if ($GLOBALS["dbaseStatusValue"] == 1) {
              //   echo "<b style='color:green'>online</b>";
              // } else {
              //   echo "<b style='color:red'>offline</b>";
              // } -->
            </div>
            <div class="float-right">
              <button type="button" data-toggle="modal" data-target="#AddModal" style="padding: 4px 6px 5px 5px;margin-right: 5px;" class="btn btn-info">
                <i style="font-size: 15px;" class="fa fa-plus-circle"></i>
                Oil product</button>
              <a style="text-decoration: none ;" href="products-sold.php">
                <button style="padding: 4px 6px 5px 5px;" class="btn btn-success">
                  <i style="font-size: 15px;" class="fa fa-check-circle"></i>
                  Sold Items</button>
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
                    <th>Name</th>
                    <th>Liters (L)</th>
                    <th>Price</th>
                    <th>Stock on hand</th>
                    <th>Stock Stored</th>
                    <th><small>Actions</small></th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $query = "select * from product;";
                  $queryResult = mysqli_query($dbCon, $query);
                  $rowCount = mysqli_num_rows($queryResult);

                  $count = 1;
                  $Transtype = "oil";

                  if ($rowCount > 0) {
                    $record = mysqli_fetch_assoc($queryResult);
                    while ($record) {
                      echo "<tr>";
                      echo "<td>" . $count++ . "</th>";
                      echo "<td><i class='fas fa-desktop mr-2'></i>" . $record["id"] . "</th>";
                      echo "<td>" . $record["name"] . "</th>";
                      echo "<td>" . $record["liters"] . "</th>";
                      echo "<td> ₱ " . number_format($record["price"])  . "</th>";
                      if($record["stockonhand"] <= 10){
                        echo "<td style='color: red;font-weight: bold;' >" . $record["stockonhand"] . "</th>";
                      }else if($record["stockonhand"] > 10 && $record["stockonhand"] <= 60){
                        echo "<td style='color: orange;font-weight: bold;' >" . $record["stockonhand"] . "</th>";
                      }else{
                        echo "<td style='color: green;font-weight: bold;' >" . $record["stockonhand"] . "</th>";
                      }
                      echo "<td>" . $record["stockstored"] . "</th>";
                      echo "<td style='width: 70px;'>";
                      echo '<a style="text-decoration: none;font-size: 14px;color:#24a0ed;" type="button" href="#"  id="btn_transac" class="fa fa-plus-circle mx-1"  data-whatever="'. $record['id'] .'" data-oilname="'. $record["name"] .'" data-transaction="'. $Transtype .'" data-toggle="modal" data-target="#supplyOil" title="Add supply"></a>';
                      echo '<a style="color: green ;" type="button" class="fas fa-edit mx-1" href="" id="btn_edit" data-whatever="' . $record["id"] . '" data-pname="' . $record["name"] . '"  data-pliters="' . $record["liters"] . '"  data-pprice="' . $record["price"] . '"  data-onhand="' . $record["stockonhand"] . '" data-stored="' . $record["stockstored"] . '" data-toggle="modal" data-target="#oilmodal" title="Edit"></a>';
                      echo '<a style="color: red;" type="button" class="fas fa-trash mx-1" href="#" id="btn_delete" data-whatever="' . $record["id"] . '" data-toggle="modal" data-target="#oilDelete" title="Delete"></a>';

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
          <div class="card-footer small text-muted"><?php echo "Total Records Found: <b>" . $rowCount . "</b>" ?></div>
        </div>

        <!-- first table modals................. -->

        <!-- Add Product Modal-->
        <div class="modal fade" id="AddModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">New product item</h4>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
              <div class="modal-body">
                <p class="modal-body-title" id="modal-body-title"></p>
                <form action="libraries/product-add.php" method="POST">
                  <input type="hidden" name="id" class="form-control" id="user-id" aria-hidden="true">
                  <div class="form-group">
                    <div class="form-label-group">
                      <input type="text" name="productname" id="prodname" class="form-control" placeholder="Product name" required="required" autofocus="autofocus">
                      <label for="prodname">Product name</label>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="form-row">
                      <div class="col-md-6">
                        <div class="form-label-group">
                          <input type="number" name="liters" id="size" class="form-control" placeholder="Liters (L)" required="required" autofocus="autofocus">
                          <label for="size">Liters (L)</label>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-label-group">
                          <input type="number" name="price" id="prodprice" class="form-control" placeholder="Price (₱)" required="required">
                          <label for="prodprice">Price (₱)</label>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="form-row">
                      <div class="col-md-6">
                        <div class="form-label-group">
                          <input type="number" name="stockonhand" id="onhand" class="form-control" placeholder="Stock on hand" required="required" autofocus="autofocus">
                          <label for="onhand">Stock on hand</label>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-label-group">
                          <input type="number" name="stockstored" id="stored" class="form-control" placeholder="Stock Stored" required="required">
                          <label for="stored">Stock Stored</label>
                        </div>
                      </div>
                    </div>
                  </div>
              </div>
              <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
              </div>
              </form>
            </div>
          </div>
        </div>

        <!-- Edit Product Modal-->
        <div class="modal fade" id="oilmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Update product item</h4>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
              <div class="modal-body">
                <p class="modal-body-title" id="modal-body-title"></p>
                <form action="libraries/product-edit.php" method="POST">
                  <input type="hidden" name="id" class="form-control" id="prod-id" aria-hidden="true">
                  <div class="form-group">
                    <div class="form-label-group">
                      <input type="text" name="productname" id="prodname" class="form-control" placeholder="Product name" required="required" autofocus="autofocus">
                      <label for="prodname">Product name</label>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="form-row">
                      <div class="col-md-6">
                        <div class="form-label-group">
                          <input type="number" name="liters" id="size" class="form-control" placeholder="Liters (L)" required="required" autofocus="autofocus">
                          <label for="size">Liters (L)</label>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-label-group">
                          <input type="number" name="price" id="prodprice" class="form-control" placeholder="Price (₱)" required="required">
                          <label for="prodprice">Price (₱)</label>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="form-row">
                      <div class="col-md-6">
                        <div class="form-label-group">
                          <input type="number" name="stockonhand" id="onhand" class="form-control" placeholder="Stock on hand" required="required" autofocus="autofocus">
                          <label for="onhand">Stock on hand</label>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-label-group">
                          <input type="number" name="stockstored" id="stored" class="form-control" placeholder="Stock Stored" required="required">
                          <label for="stored">Stock Stored</label>
                        </div>
                      </div>
                    </div>
                  </div>
              </div>
              <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
              </div>
              </form>
            </div>
          </div>
        </div>

        <!-- Delete product Modal-->
        <div class="modal fade" id="oilDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Delete Product</h4>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
              <div class="modal-body">
                <p class="modal-body-title" id="modal-body-title">Do you want to Delete the selected Product?</p>
                <form action="libraries/product-delete.php" method="POST">
                  <input type="hidden" name="id" class="form-control" id="product-id" aria-hidden="true">
              </div>
              <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <button type="submit" name="submit" value="yes" class="btn btn-primary">Delete</button>
              </div>
              </form>
            </div>
          </div>
        </div>

        <!-- ADD SUPPLY TO OIL ........ -->
        <div class="modal fade" id="supplyOil" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Add supply for</h4>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
              <div class="modal-body">
                <p class="modal-body-title" id="modal-body-title"></p>
                <form action="libraries/transaction-add.php" method="POST">
                  <input type="hidden" name="id" class="form-control" id="oilsupply-id" aria-hidden="true">
                  <input type="hidden" name="transactType" class="form-control" id="transType" aria-hidden="true">
                  <div class="form-group">
                    <div class="form-label-group">
                      <input style="font-weight: bold ;" type="text" name="oilname" id="oilName" class="form-control" placeholder="Product name" required="required" autofocus="autofocus" readonly>
                      <label for="oilName">Product name</label>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="form-label-group">
                      <?php
                      $sql = "SELECT * FROM `supplier`";
                      $resultset = mysqli_query($dbCon, $sql);
                      ?>
                      <select style="height: 50px;" type="text" name="suppName" id="supname" class="form-control" placeholder="Supplier name" required="required" autofocus="autofocus">
                        <option value="">Supplier name</option>
                        <?php while ($rows = mysqli_fetch_array($resultset)) :; ?>
                          <option value="<?php echo $rows[0] ?>"><?php echo $rows[1]; ?></option>
                        <?php endwhile; ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="form-row">
                      <div class="col-md-6">
                        <div class="form-label-group">
                          <input style="height: 50px;" type="date" name="purchaseDate" id="orderDate" class="form-control" placeholder="Date" required="required" autofocus="autofocus">
                          <label for="orderDate">Date</label>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-label-group">
                          <input type="number" name="quantityNeed" id="quantity" value=0 class="form-control" placeholder="Quantity" required="required">
                          <label for="quantity">Quantity (L)</label>
                        </div>
                      </div>
                    </div>
                  </div>
              </div>
              <div class="modal-footer">
                <button class="btn btn-secondary  " type="button" data-dismiss="modal">Cancel</button>
                <button type="submit" name="submit" class="btn btn-success">Submit</button>
              </div>
              </form>
            </div>
          </div>
        </div>
        <!-- ADD SUPPLY TO OIL END ..... ........ -->
        
        <!-- End of the first table modal ........ -->

        <!-- Shell gas products -->
        <div class="card mb-3">
          <div class="card-header">
            <div class="float-left">
              <i style="color: #FFD500;" class="fas fa-exclamation-circle mr-2"></i>
              <a style="text-decoration: none ; color: #ED1C24; font-size: 20px;font-weight: bold;">SHELL GASOLINE PRODUCTS</a>
            </div>
            <div class="float-right">
              <button type="button" data-toggle="modal" data-target="#AddModal1" style="padding: 4px 6px 5px 5px;margin-right: 5px;" class="btn btn-info">
                <i style="font-size: 15px;" class="fa fa-plus-circle"></i>
                Gasoline</button>
              <a style="text-decoration: none ;" href="products-sold.php#dataTable1">
                <button style="padding: 4px 6px 5px 5px;" class="btn btn-success">
                  <i style="font-size: 15px;" class="fa fa-check-circle"></i>
                  Sold Items</button>
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
                    <th>Name</th>
                    <th>Type</th>
                    <th>Price (L)</th>
                    <th>Available (L)</th>
                    <th>Stock Stored (L)</th>
                    <th><small>Actions</small></th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $query = "select * from gasoline;";
                  $queryResult = mysqli_query($dbCon, $query);
                  $rowCount = mysqli_num_rows($queryResult);

                  $count = 1;

                  if ($rowCount > 0) {
                    $record = mysqli_fetch_assoc($queryResult);
                    while ($record) {
                      echo "<tr>";
                      echo "<td>" . $count++ . "</th>";
                      echo "<td><i class='fas fa-desktop mr-2'></i>" . $record["id"] . "</th>";
                      echo "<td>" . $record["name"] . "</th>";
                      echo "<td>" . $record["type"] . "</th>";
                      echo "<td> ₱ " . number_format((float)$record["price"], 2, '.', '')  . "</th>";
                      if($record["available"] <= 5000){
                        echo "<td style='color: red;font-weight: bold;'> " . number_format((float)$record["available"], 1, '.', '') . "</th>";
                      }else if($record["available"] > 5000 && $record["available"] <= 13000){
                        echo "<td style='color: orange;font-weight: bold;'> " . number_format((float)$record["available"], 1, '.', '') . "</th>";
                      }else{
                        echo "<td  style='color: green;font-weight: bold;'>" . number_format((float)$record["available"], 1, '.', '') . "</th>";
                      }
                      echo "<td>" . number_format((float)$record["stored"], 2, '.', '') . "</th>";
                      echo "<td style='width: 90px;'>";
                      echo '<a style="text-decoration: none;font-size: 14px;color:#24a0ed;" type="button" href="#"  id="btn_transac" class="fa fa-plus-circle mx-1"  data-whatever="'. $record['id'] .'" data-gasname="'. $record["name"] .'" data-toggle="modal" data-target="#supplyGas" title="Add supply"></a>';
                      echo '<a style="color: green ;" type="button" class="fas fa-edit mx-1" href="" id="btn_edit" data-whatever="' . $record["id"] . '" data-pname="' . $record["name"] . '"  data-types="' . $record["type"] . '"  data-pprice="' . $record["price"] . '"  data-onhand="' . $record["available"] . '" data-gasstored="' . $record["stored"] . '" data-toggle="modal" data-target="#gasEdit" title="Edit"></a>';
                      echo '<a style="color: red;" type="button" class="fas fa-trash mx-1" href="#" id="btn_delete" data-whatever="' . $record["id"] . '" data-toggle="modal" data-target="#gasDelete" title="Delete"></a>';

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
          <div class="card-footer small text-muted"><?php echo "Total Records Found: <b>" . $rowCount . "</b>" ?></div>
        </div>

        <!-- table 2 modal code......... -->

        <!-- Add Product Modal-->
        <div class="modal fade" id="AddModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">New Gasoline item</h4>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
              <div class="modal-body">
                <p class="modal-body-title" id="modal-body-title"></p>
                <form action="libraries/gas-add.php" method="POST">
                  <input type="hidden" name="id" class="form-control" id="gas-id" aria-hidden="true">
                  <div class="form-group">
                    <div class="form-label-group">
                      <input type="text" name="gasname" id="gname" class="form-control" placeholder="Product name" required="required" autofocus="autofocus">
                      <label for="gname">Product name</label>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="form-row">
                      <div class="col-md-6">
                        <div class="form-label-group">
                        <select style="height: 50px;" type="text" name="type" id="gasType" class="form-control" placeholder="Types" required="required" autofocus>
                          <option value="">Types</option>
                          <option value="Cars/Motorcycles">Cars/Motorcycles</option>
                          <option value="Cars/Trucks">Cars/Trucks</option>
                        </select>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-label-group">
                          <input type="text" name="price" id="gasprice" class="form-control" placeholder="Price (₱)" required="required">
                          <label for="gasprice">Price (₱)</label>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="form-row">
                      <div class="col-md-6">
                        <div class="form-label-group">
                          <input type="number" name="onhand" id="avail" class="form-control" placeholder="Stock available" required="required" autofocus="autofocus">
                          <label for="avail">Stock available (L)</label>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-label-group">
                          <input type="number" name="gasstored" id="allGas" class="form-control" placeholder="Stock Stored" required="required">
                          <label for="allGas">Stock Stored (L)</label>
                        </div>
                      </div>
                    </div>
                  </div>
              </div>
              <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
              </div>
              </form>
            </div>
          </div>
        </div>

        <!-- Edit Product Modal-->
        <div class="modal fade" id="gasEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Update product item</h4>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
              <div class="modal-body">
                <p class="modal-body-title" id="modal-body-title"></p>
                <form action="libraries/gas-edit.php" method="POST">
                  <input type="hidden" name="id" class="form-control" id="gas-id" aria-hidden="true">
                  <div class="form-group">
                    <div class="form-label-group">
                      <input type="text" name="gasname" id="gname" class="form-control" placeholder="Product name" required="required" autofocus="autofocus">
                      <label for="gname">Product name</label>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="form-row">
                      <div class="col-md-6">
                        <div class="form-label-group">
                        <select style="height: 50px;" type="text" name="type" id="gasType" class="form-control" placeholder="Types" required="required" autofocus>
                          <option value="">Types</option>
                          <option value="Cars/Motorcycles">Cars/Motorcycles</option>
                          <option value="Cars/Trucks">Cars/Trucks</option>
                        </select>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-label-group">
                          <input type="text" name="price" id="gasprice" class="form-control" placeholder="Price (₱)" required="required">
                          <label for="gasprice">Price (₱)</label>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="form-row">
                      <div class="col-md-6">
                        <div class="form-label-group">
                          <input type="number" name="onhand" id="avail" class="form-control" placeholder="Stock available" required="required" autofocus="autofocus">
                          <label for="avail">Stock available (L)</label>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-label-group">
                          <input type="number" name="gasstored" id="allGas" class="form-control" placeholder="Stock Stored" required="required">
                          <label for="allGas">Stock Stored (L)</label>
                        </div>
                      </div>
                    </div>
                  </div>
              </div>
              <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
              </div>
              </form>
            </div>
          </div>
        </div>

        <!-- Delete product Modal-->
        <div class="modal fade" id="gasDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Delete Product</h4>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
              <div class="modal-body">
                <p class="modal-body-title" id="modal-body-title">Do you want to Delete the selected Product?</p>
                <form action="libraries/gas-delete.php" method="POST">
                  <input type="hidden" name="id" class="form-control" id="gasoline-id" aria-hidden="true">
              </div>
              <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <button type="submit" name="submit" value="yes" class="btn btn-primary">Delete</button>
              </div>
              </form>
            </div>
          </div>
        </div>
        <!-- End of the second table modal ........ -->

        <!-- MODAL TRANSACTION GASOLINE -->
        <div class="modal fade" id="supplyGas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Add supply for</h4>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
              <div class="modal-body">
                <p class="modal-body-title" id="modal-body-title"></p>
                <form action="libraries/transaction-add.php" method="POST">
                  <input type="hidden" name="id" class="form-control" id="gassupply-id" aria-hidden="true">
                  <input type="hidden" name="transactType" class="form-control" id="transType" aria-hidden="true">
                  <div class="form-group">
                    <div class="form-label-group">
                      <input style="font-weight: bold ;" type="text" name="gasname" id="gasName" class="form-control" placeholder="Product name" required="required" autofocus="autofocus" readonly>
                      <label for="oilName">Product name</label>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="form-label-group">
                      <?php
                      $sql = "SELECT * FROM `supplier`";
                      $resultset = mysqli_query($dbCon, $sql);
                      ?>
                      <select style="height: 50px;" type="text" name="suppName1" id="supname" class="form-control" placeholder="Supplier name" required="required" autofocus="autofocus">
                        <option value="">Supplier name</option>
                        <?php while ($rows = mysqli_fetch_array($resultset)) :; ?>
                          <option value="<?php echo $rows[0] ?>"><?php echo $rows[1]; ?></option>
                        <?php endwhile; ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="form-row">
                      <div class="col-md-6">
                        <div class="form-label-group">
                          <input style="height: 50px;" type="date" name="purchaseDate1" id="orderDate" class="form-control" placeholder="Date" required="required" autofocus="autofocus">
                          <label for="orderDate">Date</label>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-label-group">
                          <input type="number" name="quantityNeed1" id="quantity" value=0 class="form-control" placeholder="Quantity" required="required">
                          <label for="quantity">Quantity (L)</label>
                        </div>
                      </div>
                    </div>
                  </div>
              </div>
              <div class="modal-footer">
                <button class="btn btn-secondary  " type="button" data-dismiss="modal">Cancel</button>
                <button type="submit" name="submit" class="btn btn-success">Submit</button>
              </div>
              </form>
            </div>
          </div>
        </div>

        <!-- END MODAL TRANSACTION GASOLINE -->

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

  <!-- For modal, data transfer... -->
  <script src="js/productsModal.js"></script>
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
</body>

</html>