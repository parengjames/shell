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

  <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />

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
  include "pages/dashboardheader.php"
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
          <span>Sold Item</span>
        </a>
      </li>
      <div class="dropdown-divider mx-3"></div>
      <li class="nav-item">
        <a class="nav-link" href="admin-dashboard.php">
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
          <a class="dropdown-item" href="productlist.php">Products</a>
          <a class="dropdown-item" href="supplierList.php">Suppliers</a>
        </div>
      </li>
    </ul>
    <div id="content-wrapper">
      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a style="text-decoration: none ; color: #696969;" href="admin-dashboard.php">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Product sold</li>
        </ol>

        <div class="card mb-3">
          <div class="card-header">
            <div class="float-left">
              <i style="color: #FFD500;" class="fas fa-info-circle mr-2"></i>
              <a style="text-decoration: none ; color: #ED1C24; font-size: 20px;font-weight: bold;">OIL
                PRODUCTS SOLD</a>
            </div>
            <div class="float-right">
              <div class="dropdown">
                <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i style="font-size: 15px;" class="fa fa-plus-circle"></i>
                  Sold items
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  <a class="dropdown-item" href="#" data-toggle="modal" data-target="#AddModal">Oil
                    products</a>
                  <a class="dropdown-item" href="#" data-toggle="modal" data-target="#AddModal1">Gasoline products</a>
                </div>
                <a style="text-decoration: none ;" href="productlist.php">
                  <button style="padding: 4px 6px 5px 5px;" class="btn btn-success">
                    <i style="font-size: 15px;" class="fa fa-check-circle"></i>
                    Products</button>
                </a>
              </div>
              <!-- <button data-toggle="modal" data-target="#AddModal" style="padding: 4px 6px 5px 5px;" class="btn btn-info">
                <i style="font-size: 15px;" class="fa fa-plus-circle"></i>
                Sold Item</button> -->

            </div>

          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-hover table-bordered small" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Id</th>
                    <th>Title</th>
                    <th>Product name</th>
                    <th>Date</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                    <th><small>Actions</small></th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $query = "SELECT `sold`.`id`, `sold`.`title`, `product`.`name`, `sold`.`date_sold`, `sold`.`stock_sold`,`sold`.`stock_sold` * `product`.`price` AS `totalPrice`
                            FROM `sold`
                            JOIN `product` ON `sold`.`product_id`= `product`.`id` order by id";
                  $queryResult = mysqli_query($dbCon, $query);
                  $rowCount = mysqli_num_rows($queryResult);

                  $count = 1;

                  if ($rowCount > 0) {
                    $record = mysqli_fetch_assoc($queryResult);
                    while ($record) {
                      $datedb = $record['date_sold'];
                      $datesold = date("M jS, Y", strtotime($datedb));
                      $onedit = date("d/m/Y", strtotime($datedb));
                      echo "<tr>";
                      echo "<td>" . $count++ . "</th>";
                      echo "<td><i class='fas fa-desktop mr-2'></i>" . $record["id"] . "</th>";
                      echo "<td>" . $record["title"] . "</th>";
                      echo "<td>" . $record["name"] . "</th>";
                      echo "<td>" . $datesold . "</th>";
                      echo "<td >" . $record["stock_sold"] . "</th>";
                      echo "<td style='font-size: 15px;'><b>₱ " . number_format($record["totalPrice"])  . "</b></th>";
                      echo "<td style='width: 70px;'>";
                      // echo '<a style="color: green ;" type="button" class="fas fa-edit mx-1" href="" id="btn_edit" data-whatever="' . $record["id"] . '" data-title="' . $record["title"] . '"  data-productsname="' . $record["name"] . '"  data-sdate="' . $record["date_sold"] . '"  data-sold="' . $record["stock_sold"] . '" data-toggle="modal" data-target="#EditModal" title="Edit"></a>';
                      echo '<button style="font-size: 12px; font-weight:bold;" type="button" class="btn btn-danger" href="#" id="btn_delete1" data-whatever="' . $record["id"] . '" data-toggle="modal" data-target="#deleteOil" title="Delete">Delete</button>';

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



        <!-- Add Product Modal1-->
        <div class="modal fade" id="AddModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Insert sold oil products</h4>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
              <div class="modal-body">
                <p class="modal-body-title" id="modal-body-title"></p>
                <form action="libraries/sold-add.php" method="POST">
                  <input type="hidden" name="id" class="form-control" id="sold-id" aria-hidden="true">
                  <div class="form-group">
                    <div class="form-label-group">
                      <input type="text" name="soldtitle" id="title" class="form-control" placeholder="Title" required="required" autofocus="autofocus">
                      <label for="title">Title</label>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="form-label-group">
                      <?php
                      $sql = "SELECT * FROM `product`";
                      $resultset = mysqli_query($dbCon, $sql);
                      ?>
                      <select style="height: 50px;" type="text" name="prodname" id="pname" class="form-control" placeholder="Product name" required="required" autofocus="autofocus">
                        <option value="">Product name</option>
                        <?php while ($rows = mysqli_fetch_array($resultset)) :; ?>
                          <option value="<?php echo $rows[0] ?>"><?php echo $rows[1]; ?></option>
                        <?php endwhile; ?>
                      </select>
                      <!-- <input type="text" name="prodname" id="pname" class="form-control" placeholder="Product name" required="required" autofocus="autofocus">
                <label for="pname">Product name</label> -->
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="form-row">
                      <div class="col-md-6">
                        <div class="form-label-group">
                          <input style="height: 50px;" type="date" name="date" id="ondatesold" class="form-control" placeholder="Date sold" required="required" autofocus="autofocus">
                          <label for="ondatesold">Date sold</label>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-label-group">
                          <input type="number" name="stocksold" id="ssold" value=0 class="form-control" placeholder="Quantity" required="required">
                          <label for="ssold">Quantity</label>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- <div class="form-group">
              <div class="form-label-group">
                <input type="number" name="totalprice" id="price" value="" class="form-control" placeholder="Total Price (₱)" required="required" autofocus="autofocus">
                <label for="price">Total Price (₱)</label>
              </div>
            </div> -->
              </div>
              <div class="modal-footer">
                <button class="btn btn-secondary  " type="button" data-dismiss="modal">Cancel</button>
                <button type="submit" name="submit" class="btn btn-success">Submit</button>
              </div>
              </form>
            </div>
          </div>
        </div>

        <!-- Delete product Modal-->
        <div class="modal fade" id="deleteOil" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Delete Sold Item</h4>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
              <div class="modal-body">
                <p class="modal-body-title" id="modal-body-title">Do you want to Delete the selected
                  Item?</p>
                <form action="libraries/sold-delete.php" method="POST">
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
              <a style="text-decoration: none ; color: #ED1C24; font-size: 20px;font-weight: bold;">GASOLINE
                PRODUCTS SOLD</a>
            </div>
            <div class="float-right">
              <div class="dropdown">
                <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i style="font-size: 15px;" class="fa fa-plus-circle"></i>
                  Sold items
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  <a class="dropdown-item" href="#" data-toggle="modal" data-target="#AddModal">Oil
                    products</a>
                  <a class="dropdown-item" href="#" data-toggle="modal" data-target="#AddModal1">Gasoline products</a>
                </div>
                <a style="text-decoration: none ;" href="productlist.php#dataTable1">
                  <button style="padding: 4px 6px 5px 5px;" class="btn btn-success">
                    <i style="font-size: 15px;" class="fa fa-check-circle"></i>
                    Products</button>
                </a>
              </div>
              <!-- <button data-toggle="modal" data-target="#AddModal" style="padding: 4px 6px 5px 5px;" class="btn btn-info">
                <i style="font-size: 15px;" class="fa fa-plus-circle"></i>
                Sold Item</button> -->

            </div>

          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-hover table-bordered small" id="dataTable1" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Id</th>
                    <th>Title</th>
                    <th>Product name</th>
                    <th>Date</th>
                    <th>Quantity (L)</th>
                    <th>Total Price</th>
                    <th><small>Actions</small></th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $query = "SELECT `gasolinesold`.`id`, `gasolinesold`.`title`, `gasoline`.`name`, `gasolinesold`.`date_sold`, `gasolinesold`.`quantity`,`gasolinesold`.`quantity` * `gasoline`.`price` AS `totalPrice`
                            FROM `gasolinesold`
                            JOIN `gasoline` ON `gasolinesold`.`gas_id`= `gasoline`.`id`
                            ORDER BY `gasolinesold`.`id`";
                  $queryResult = mysqli_query($dbCon, $query);
                  $rowCount = mysqli_num_rows($queryResult);

                  $count = 1;

                  if ($rowCount > 0) {
                    $record = mysqli_fetch_assoc($queryResult);
                    while ($record) {
                      $datedb = $record['date_sold'];
                      $datesold = date("M jS, Y", strtotime($datedb));
                      $onedit = date("d/m/Y", strtotime($datedb));
                      echo "<tr>";
                      echo "<td>" . $count++ . "</th>";
                      echo "<td><i class='fas fa-desktop mr-2'></i>" . $record["id"] . "</th>";
                      echo "<td>" . $record["title"] . "</th>";
                      echo "<td>" . $record["name"] . "</th>";
                      echo "<td>" . $datesold . "</th>";
                      echo "<td >" . $record["quantity"] . " liters</th>";
                      echo "<td style='font-size: 15px;'><b>₱ " . number_format((float)$record["totalPrice"], 2, '.', '')  . "</b></th>";
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
        <!-- Add Product Modal2-->
        <div class="modal fade" id="AddModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Insert sold Gas products</h4>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
              <div class="modal-body">
                <p class="modal-body-title" id="modal-body-title"></p>
                <form action="libraries/gasSold-add.php" method="POST">
                  <input type="hidden" name="id" class="form-control" id="sold-id" aria-hidden="true">
                  <div class="form-group">
                    <div class="form-label-group">
                      <input type="text" name="soldtitle" id="gastitle" class="form-control" placeholder="Title" required="required" autofocus="autofocus">
                      <label for="gastitle">Title</label>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="form-label-group">
                      <?php
                      $sql = "SELECT * FROM `gasoline`";
                      $resultset = mysqli_query($dbCon, $sql);
                      ?>
                      <select style="height: 50px;" type="text" name="gasID" id="gname" class="form-control" placeholder="Product name" required="required" autofocus="autofocus">
                        <option value="">Product name</option>
                        <?php while ($rows = mysqli_fetch_array($resultset)) :; ?>
                          <option value="<?php echo $rows[0] ?>"><?php echo $rows[1]; ?></option>
                        <?php endwhile; ?>
                      </select>
                      <!-- <input type="text" name="prodname" id="pname" class="form-control" placeholder="Product name" required="required" autofocus="autofocus">
                <label for="pname">Product name</label> -->
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="form-row">
                      <div class="col-md-6">
                        <div class="form-label-group">
                          <input style="height: 50px;" type="date" name="date" id="ondatesold" class="form-control" placeholder="Date sold" required="required" autofocus="autofocus">
                          <label for="ondatesold">Date sold</label>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-label-group">
                          <input type="number" name="stocksold" id="ssold" value=0 class="form-control" placeholder="Quantity" required="required">
                          <label for="ssold">Quantity (L)</label>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- <div class="form-group">
              <div class="form-label-group">
                <input type="number" name="totalprice" id="price" value="" class="form-control" placeholder="Total Price (₱)" required="required" autofocus="autofocus">
                <label for="price">Total Price (₱)</label>
              </div>
            </div> -->
              </div>
              <div class="modal-footer">
                <button class="btn btn-secondary  " type="button" data-dismiss="modal">Cancel</button>
                <button type="submit" name="submit" class="btn btn-success">Submit</button>
              </div>
              </form>
            </div>
          </div>
        </div>

        <!-- Delete product Modal-->
        <div class="modal fade" id="gasdelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Delete Item</h4>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
              <div class="modal-body">
                <p class="modal-body-title" id="modal-body-title">Do you want to Delete the selected
                  Item?</p>
                <form action="libraries/gasSold-delete.php" method="POST">
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

  <!-- Edit Product Modal-->
  <div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="exampleModalLabel">Update sold item</h4>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <p class="modal-body-title" id="modal-body-title"></p>
          <form action="libraries/sold-update.php" method="POST">
            <input type="hidden" name="id" class="form-control" id="sold-id" aria-hidden="true">
            <div class="form-group">
              <div class="form-label-group">
                <input type="text" name="soldtitle" id="title" class="form-control" placeholder="Title" required="required" autofocus="autofocus">
                <label for="title">Title</label>
              </div>
            </div>
            <div class="form-group">
              <div class="form-label-group">
                <?php
                $sql = "SELECT * FROM `product`";
                $resultset = mysqli_query($dbCon, $sql);
                ?>
                <select style="height: 50px;" type="text" name="prodname" id="selectedproduct" class="form-control" placeholder="Product name" required="required" autofocus="autofocus">
                  <option value="">Product name</option>
                  <?php while ($rows = mysqli_fetch_array($resultset)) :; ?>
                    <option value="<?php echo $rows[1] ?>"><?php echo $rows[1]; ?></option>
                  <?php endwhile; ?>
                </select>
                <!-- <input type="text" name="prodname" id="pname" class="form-control" placeholder="Product name" required="required" autofocus="autofocus">
                <label for="pname">Product name</label> -->
              </div>
            </div>
            <div class="form-group">
              <div class="form-label-group">
                <p style="padding: none; font-weight: bold;">Current date saved: <input style="border: none;margin-top: -15px;" type="text" id="saveDate" readonly aria-selected="false"></p>
                <input style="height: 50px;margin-top: -13px;" type="date" name="date" id="datesold" class="form-control" required="required" autofocus="autofocus">
              </div>
            </div>
            <div class="form-group">
              <div class="form-label-group">
                <input type="number" name="stocksold" id="ssold" value=0 class="form-control" placeholder="Quantity" required="required">
                <label for="ssold">Quantity</label>
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
          <a class="btn btn-primary" href="index.php">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Notification modal -->
  <div class="modal fade" id="notif" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 style="color:#ED1C24 ;" class="modal-title" id="exampleModalLabel">The product <?php echo "<b>".$_SESSION["titleText"]."</b>" ?></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <p class="modal-body-title" id="modal-body-title">Product stock is low, restock now.</p>
          <form action="productlist.php" method="POST">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Later</button>
          <button type="submit" name="submit" class="btn btn-primary">Go to products</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Notification modal -->


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
    <!-- SHOW NOTIFICATION MODAL.... -->
    <?php
    if(isset($_SESSION["titleText"])){
    ?>
    <script>
        setTimeout(function(){
          $("#notif").modal('show');
        },1200);        
    </script>
    <?php 
    unset($_SESSION["titleText"]);
    }
    ?>

</body>

</html>