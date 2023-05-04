<?php
  require "libraries/dbaseconnect.php";

  if (isset($_GET["error"])) {
    if ($_GET["error"] == "InvalidData") {
        displayAlert("Invalid Data Entered");
    } else if ($_GET["error"] == "DatabaseError") {
        displayAlert("Database connection Error/Failed.");
    } else if ($_GET["error"] == "AccessDenied") {
        displayAlert("ACCESS DENIED");
    } else if($_GET["error"] == "Usernotfound") {
      displayAlert("Username does not Exist!");
    } else if($_GET["error"] == "PasswordError") {
      displayAlert("PASSWORD IS NOT MATCH");
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
      margin-left: 470px;
      width: 420px;
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
        <div class="card-header">Reset Password</div>
        <div class="card-body">
          <div class="text-center mb-4">
            <h4>Forgot your password?</h4>
            <p>Enter your username and we will send you instructions on how to reset your password.</p>
          </div>
          <form action="libraries/resetpass.php" method="post">
            <div class="form-group">
              <div class="form-label-group">
                <input type="text" name="username" id="inputEmail" class="form-control" placeholder="Enter Username" required="required" autofocus="autofocus">
                <label for="inputEmail">Enter Username</label>
              </div>
              <div class="form-label-group">
                <input type="password" name="password" id="inputEmail" class="form-control" placeholder="Enter Password" required="required" autofocus="autofocus">
                <label for="inputEmail">Enter Password</label>
              </div>
              <div class="form-label-group">
                <input type="password" name="confirmpass" id="inputEmail" class="form-control" placeholder="Re-type Password" required="required" autofocus="autofocus">
                <label for="inputEmail">Re-type Password</label>
              </div>
            </div>
            <button type="submit" name="submit" class="btn btn-primary btn-block">Reset Password</button>
          </form>
          <div class="text-center">
            <br>
            <a class="d-block small" href="index.php">Login Page</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  </body>

</html>
