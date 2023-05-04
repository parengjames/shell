<?php
require_once "libraries/dbaseconnect.php";

if (isset($_GET["error"])) {
  if ($_GET["error"] == "InvalidData") {
    displayAlert("Invalid Data Entered");
  } else if ($_GET["error"] == "DatabaseError") {
    displayAlert("Database connection Error/Failed.");
  } else if ($_GET["error"] == "AccessDenied") {
    displayAlert("ACCESS DENIED");
  } else if ($_GET["error"] == "InvalidUsername") {
    displayAlert("USERNAME IS INVALID");
  } else if ($_GET["error"] == "PasswordError") {
    displayAlert("PASSWORD IS NOT MATCH");
  } else if ($_GET["error"] == "userAlreadyExist") {
    displayAlert("USER ALREADY EXIST");
  } else if ($_GET["error"] == "userAdded") {
    displayAlert("User successfully Added");
  } else {
    displayAlert($_GET["error"]);
  }
}

include "pages/lgfHeader.php"
?>
<style>

    .body{
      padding: none;
    }

    .box{
      position: absolute;
      margin-top: 100px;
      margin-left: 31%;
      width: 500px;
    }

    .card{
      padding: none;
      box-shadow: 0 3px 10px rgb(0 0 0 / 0.2);
    }
    .btn{
      height: 45px;
      text-transform: uppercase;
      font-weight: bold;
      font-family: Verdana, Geneva, Tahoma, sans-serif;
    }

    .headertext{
      padding: none;
    }
    .headertext img{
      position: absolute;
      height: 100px;
      width: 100px;
      margin-top: 30px;
      margin-left: 510px;
    }
    .headertext h4{
      position: absolute;
      font-size: 80px;
      color: #DA291C;
      font-weight: bold;
      margin-top: 18px;
      margin-left: 615px;
    }
    .subtext h3{
      position: absolute;
      font-size: 24px;
      text-transform: uppercase;
      font-weight: bold;
      margin-top: 100px;
      margin-left: 615px;
    }
  </style>

<body class="bg">
  

<div class="headertext">
    <img src="images/shelllogo.png" alt="logo">
    <h4>Shell</h4>
  </div>
  <div class="subtext">
    <h3>Inventory System</h3>
  </div>

  <div class="box">
    <div class="card card-register mx-auto mt-5">
      <div class="card-header">Register an Account</div>
      <div class="card-body">
        <form action="libraries/addUser.php" method="post">
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
              <input type="text" name="username" id="inputEmail" class="form-control" placeholder="Username" required="required">
              <label for="inputEmail">Username</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required="required">
                  <label for="inputPassword">Password</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="password" name="confirmpass" id="confirmPassword" class="form-control" placeholder="Confirm password" required="required">
                  <label for="confirmPassword">Confirm password</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <select style="height: 50px;" type="text" name="usertype" id="inputEmail" class="form-control" placeholder="User type" required="required" autofocus>
                <option value="">User type</option>
                <option value="admin">admin</option>
                <option value="user">user</option>
              </select>
            </div>
          </div>
          <?php
            $from = $_GET['type'];
            $fromtype = "";
            if($from=="fromList"){
              $fromtype = $from;
            }else{
              $fromtype = $from;
            }
          ?>
          <input type="hidden" name="type" value="<?php echo $fromtype;?>">
          <button type="submit" name="submit" class="btn btn-primary btn-block">Register</button>
          <?php
            $from = $_GET['type']; //list
            if ($from == "fromList") {
              echo '<a class="btn btn-primary btn-block" href="userList.php">
                    Cancel
                  </a>';
            }
          ?>
        </form>
        <?php
          $from = $_GET['type'];
          if ($from == "fromList") {
            echo '';
          } else {
            echo '<div class="text-center">
                  <a class="d-block small mt-3" href="index.php" >Login Page</a>
                  <a class="d-block small" href="forgot-password.php">Forgot Password?</a>
                </div>';
          }
        ?>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  
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