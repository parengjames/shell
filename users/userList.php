<?php
require_once "libraries/dbaseconnect.php";

if (isset($_GET["error"])) {
  if ($_GET["error"] == "updateSuccess") {
    displayAlert("Admin Approval change succcessfully");
  } else if ($_GET["error"] == "updateFailed") {
    displayAlert("Admin Approval change Failed");
  } else if ($_GET["error"] == "databaseError") {
    displayAlert("Databse Error..<br>Preparing Update statement Failed..");
  } else if ($_GET["error"] == "deleteSuccess") {
    displayAlert("Deleted Successfully.");
  } else if ($_GET["error"] == "deleteFailed") {
    displayAlert("Attempt Delete Failed");
  } else if ($_GET["error"] == "editFailed") {
    displayAlert("Attempt Update Failed");
  } else if ($_GET["error"] == "editSuccess") {
    displayAlert("Updated Successfully.");
  } else if ($_GET["error"] == "adminonly") {
    displayAlert("You don't have the authority to change,<br>Admin only.");
  } else {
    displayAlert($_GET["error"]);
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

  <title>User Account List</title>

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
          <span> User Accounts </span>
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
          <a class="dropdown-item" href="registerUser.php?type=fromList">Register user</a>
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
          <li class="breadcrumb-item active">User accounts</li>
        </ol>
        <div class="card mb-3">
          <div class="card-header">
            <i style="color: #FFD500;" class="fas fa-exclamation-circle mr-2"></i>
            <a style="text-decoration: none ; color: #ED1C24; font-size: 20px;font-weight: bold;"> USER ACCOUNTS </a>
            <div class="float-right">
              <a href="registerUser.php?type=fromList">
              <button type="button" style="padding: 4px 6px 5px 5px;margin-right: 5px;" class="btn btn-success">
                <i style="font-size: 15px;" class="fa fa-plus-circle"></i>
                Users</button>
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
                    <th>Username</th>
                    <th>UserType</th>
                    <th>Name</th>
                    <th>Admin approval</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $query = "SELECT * FROM users";
                  $resultSet = mysqli_query($dbCon, $query);
                  $rowCount = mysqli_num_rows($resultSet);

                  $count = 1;
                  if ($rowCount > 0) {
                    $record = mysqli_fetch_assoc($resultSet);
                    while ($record) {
                      echo "<tr>";
                      echo "<th>" . $count++ . "</th>";
                      echo "<th><i class='fas fa-calendar-check mr-2'></i>" . $record["id"] . "</th>";
                      echo "<th><i class='fas fa-user mx-1' href='#' title='Open Document'></i>" . $record["username"] . "</th>";
                      echo "<th><i class='fas fa-user mx-1' href='#' title='Open Document'></i>" . $record["userType"] . "</th>";
                      echo "<th><i class='fas fa-user mx-1' href='#' title='Open Document'></i>" . $record["firstname"] . " " . $record["lastname"] . "</th>";
                      echo "<th>" . $record["approval"] . "</th>";
                      echo "<td style='width: 100px;'>";
                      echo '<a style="color: #24a0ed;" type="button" class="fas fa-check-square mx-1" href="#" id="btn_approve" data-whatever="' . $record["id"] . '" data-toggle="modal" data-target="#ApproveModal" title="Approve"></a>';
                      echo '<a style="color: green ;" type="button" class="fas fa-edit mx-1" href="" id="btn_edit" data-whatever="' . $record["id"] . '" data-user="' . $record["username"] . '"  data-fname="' . $record["firstname"] . '"  data-lname="' . $record["lastname"] . '"  data-type="' . $record["userType"] . '" data-toggle="modal" data-target="#EditModal" title="Edit"></a>';
                      echo '<a style="color: red;" type="button" class="fas fa-trash mx-1" href="#" id="btn_delete" data-whatever="' . $record["id"] . '" data-toggle="modal" data-target="#DeleteModal" title="Delete"></a>';
                      echo "</tr>";
                      $record = mysqli_fetch_assoc($resultSet);
                    }
                  } else {
                    echo "<tr>";
                    echo "<th><i class='far fa-file-excel'></i>" . " No Record Found" . "</th>";
                    echo "</tr>";
                  }
                  ?>
                </tbody>
              </table>
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

  <!-- Approve Modal-->
  <div class="modal fade" id="ApproveModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="exampleModalLabel">Admin approval to user</h4>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <p class="modal-body-title" id="modal-body-title">Do you want to approve this user?</p>
          <form action="libraries/approveUser.php" method="POST">
            <input type="hidden" name="id" class="form-control" id="user-id" aria-hidden="true">
            <!-- <select class="form-control" type="text" name="answer" id="selected-answer">
              <option value="">Choose answer</option>
              <option value="yes">Yes</option>
              <option value="no">No</option>
            </select> -->
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <button type="submit" name="submit" value="no" class="btn btn-danger">Restrict</button>
          <button type="submit" name="submit" value="yes" class="btn btn-success">Approve</button>
        </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Edit user Modal-->
  <div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="exampleModalLabel">Update user</h4>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <p class="modal-body-title" id="modal-body-title"></p>
          <form action="libraries/editUser.php" method="POST">
            <input type="hidden" name="id" class="form-control" id="user-id" aria-hidden="true">
            <div class="form-group">
              <div class="form-row">
                <div class="col-md-6">
                  <div class="form-label-group">
                    <input type="text" name="firstname" id="firstName" class="form-control" placeholder="First name" required="required" autofocus="autofocus">
                    <label for="firstName">First name</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-label-group">
                    <input type="text" name="lastname" id="lastName" class="form-control" placeholder="Last name" required="required">
                    <label for="lastName">Last name</label>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="form-label-group">
                <input type="text" name="username" id="userName" class="form-control" placeholder="Username" required="required">
                <label for="userName">Username</label>
              </div>
            </div>
            <div class="form-group">
              <div class="form-label-group">
                <select style="height: 50px;" type="text" name="usertype" id="userType" class="form-control" placeholder="User type" required="required" autofocus>
                  <option value="">User type</option>
                  <option value="admin">admin</option>
                  <option value="user">user</option>
                </select>
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

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Are you sure you want to log-out?</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="index.php">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Delete user Modal-->
  <div class="modal fade" id="DeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="exampleModalLabel">Delete user</h4>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <p class="modal-body-title" id="modal-body-title">Do you want to Delete this user?</p>
          <form action="libraries/deleteUser.php" method="POST">
            <input type="hidden" name="id" class="form-control" id="user-id" aria-hidden="true">
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <button type="submit" name="submit" value="yes" class="btn btn-primary">Delete</button>
        </div>
        </form>
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
  <!-- For modal ajax -->
  <script src="js/function-js.js"></script>

  <!-- Sweet alert -->
  <script src="vendor/sweetalert/sweetalert.min.js"></script>
  <?php

    if(isset($_SESSION['text'])){
      if(isset($_SESSION['status'])){
        ?>
          <script>
          swal({
              title: "<?php echo $_SESSION['text']?>",
              // text: "You clicked the button!",
              icon: "<?php echo $_SESSION['status']?>",
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