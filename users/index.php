<?php
require_once "libraries/dbaseconnect.php";

if (isset($_GET["error"])) {
    if ($_GET["error"] == "InvalidData") {
        displayAlert("Invalid Data Entered");
    } else if ($_GET["error"] == "DatabaseError") {
        displayAlert("Database connection Error/Failed.");
    } else if ($_GET["error"] == "AccessDenied") {
        displayAlert("ACCESS DENIED");
    } else if($_GET["error"] == "resetPassword") {
      displayAlert("Reset Password Successful");
    } else if($_GET["error"] == "adminApproval"){
      displayAlert("CANNOT LOGIN, ADMIN APPROVAL IS NEEDED.");
    } else if($_GET["error"] == "wrongpassword"){
      displayAlert("Password is incorrect.");
    } 
    else {
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
      margin-left: 500px;
      width: 380px;
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


<body class="body">
  <div class="headertext">
    <img src="images/shelllogo.png" alt="logo">
    <h4>Shell</h4>
  </div>
  <div class="subtext">
    <h3>Inventory System</h3>
  </div>
    <div class="box">
      <div class="card card-login mx-auto mt-5">
        <div class="card-header">Login</div>
        <div class="card-body">
          <form action="libraries/verifyUser.php" method="POST">
            <div class="form-group">
              <div class="form-label-group">
                <input type="text" name="username" id="inputEmail" class="form-control" placeholder="Username" required="required" autofocus="autofocus">
                <label for="inputEmail">Username</label>
              </div>
            </div>
            <div class="form-group">
              <div class="form-label-group">
                <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required="required">
                <label for="inputPassword">Password</label>
              </div>
            </div>
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox" value="remember-me">
                  Remember Password
                </label>
              </div>
            </div>
            <button type="submit" name="submit" class="btn btn-primary btn-block">Login</button>
          </form>
          <div class="text-center">
            <a class="d-block small mt-3" href="registerUser.php?type=fromlogin">Register an Account</a>
            <a class="d-block small" href="forgot-password.php">Forgot Password?</a>
          </div>
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