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

  <title>Shell Oil Suppliers </title>

  <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon"/>

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
          <span> Supplier List </span>
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
          <a class="dropdown-item" href="products-sold.php">Sold products</a>
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
          <li class="breadcrumb-item active">Suppliers</li>
        </ol>

        <div class="card mb-3">
          <div class="card-header">
            <i style="color: #FFD500;" class="fas fa-exclamation-circle mr-2"></i>
            <a style="text-decoration: none ; color: #ED1C24; font-size: 20px;font-weight: bold;">SHELL SUPPLIERS </a>
            <div class="float-right">
              <button data-toggle="modal" data-target="#AddModal" style="padding: 4px 6px 5px 5px;margin-right: 5px;" class="btn btn-info">
              <i style="font-size: 15px;" class="fa fa-plus-circle"></i>
              Supplier</button>
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
                    <th>Address</th>
                    <th><small>Actions</small></th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $query = "select * from supplier;";
                  $queryResult = mysqli_query($dbCon, $query);
                  $rowCount = mysqli_num_rows($queryResult);

                  $count = 1;

                  if ($rowCount > 0) {
                    $record = mysqli_fetch_assoc($queryResult);
                    while ($record) {
                      echo "<tr>";
                      echo "<td>" . $count++ . "</th>";
                      echo "<td><i class='fas fa-desktop mr-2'></i>" . $record["id"] . "</th>";
                      echo "<td><i class='fas fa-user mx-1'></i> " . $record["supplier_name"] . "</th>";
                      echo "<td>" . $record["address"] . "</th>";
                      echo "<td style='width: 30px;'>";
                      echo '<a style="color: green ;" type="button" class="fas fa-edit mx-1" href="" id="btn_edit" data-whatever="' . $record["id"] . '" data-sname="' . $record["supplier_name"] . '"  data-saddress="' . $record["address"] . '" data-toggle="modal" data-target="#EditModal" title="Edit"></a>';
                      echo '<a style="color: red;" type="button" class="fas fa-trash mx-1" href="#" id="btn_delete" data-whatever="' . $record["id"] . '" data-toggle="modal" data-target="#DeleteModal" title="Delete"></a>';

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

  
      <!-- Add Supplier Modal-->
      <div class="modal fade" id="AddModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="exampleModalLabel">New supplier</h4>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
              <p class="modal-body-title" id="modal-body-title"></p>
              <form action="libraries/supplier-add.php" method="POST">
                <input type="hidden" name="id" class="form-control" id="sup-id" aria-hidden="true">
                <div class="form-group">
                  <div class="form-label-group">
                    <input type="text" name="suppliername" id="supname" class="form-control" placeholder="Supplier name" required="required" autofocus="autofocus">
                    <label for="supname">Supplier name</label>
                  </div>
                </div>
                <div class="form-group">
                  <div class="form-label-group">
                    <input type="text" name="address" id="supaddress" class="form-control" placeholder="Supplier address" required="required" autofocus="autofocus">
                    <label for="supaddress">Supplier address</label>
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


      <!-- Edit Supplier Modal-->
      <div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="exampleModalLabel">Edit supplier info</h4>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
              <p class="modal-body-title" id="modal-body-title"></p>
              <form action="libraries/supplier-edit.php" method="POST">
                <input type="hidden" name="id" class="form-control" id="sup-id" aria-hidden="true">
                <div class="form-group">
                  <div class="form-label-group">
                    <input type="text" name="suppliername" id="supname" class="form-control" placeholder="Supplier name" required="required" autofocus="autofocus">
                    <label for="supname">Supplier name</label>
                  </div>
                </div>
                <div class="form-group">
                  <div class="form-label-group">
                    <input type="text" name="address" id="supaddress" class="form-control" placeholder="Supplier address" required="required" autofocus="autofocus">
                    <label for="supaddress">Supplier address</label>
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
      <div class="modal fade" id="DeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="exampleModalLabel">Delete Supplier</h4>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
              <p class="modal-body-title" id="modal-body-title">Do you want to Delete the selected Supplier?</p>
              <form action="libraries/supplier-delete.php" method="POST">
                <input type="hidden" name="id" class="form-control" id="sup-id" aria-hidden="true">
            </div>
            <div class="modal-footer">
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
              <button type="submit" name="submit" value="yes" class="btn btn-primary">Delete</button>
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

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <!-- Page level plugin JavaScript-->
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
  <!-- Demo scripts for this page-->

  <!-- supplier modal script.... -->
  <script src="js/supplier-modal.js"></script>

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