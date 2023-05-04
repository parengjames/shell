<?php
require "libraries/dbaseconnect.php";

if (isset($_GET["error"])) {
  if ($_GET["error"] == "InvalidData") {
    displayAlert("Invalid Data Entered");
  } else if ($_GET["error"] == "DatabaseError") {
    displayAlert("Database connection Error/Failed.");
  } else if ($_GET["error"] == "AccessDenied") {
    displayAlert("ACCESS DENIED");
  } else if ($_GET["error"] == "Usernotfound") {
    displayAlert("Username does not Exist!");
  } else if ($_GET["error"] == "PasswordError") {
    displayAlert("PASSWORD IS NOT MATCH");
  } else {
    displayAlert($_GET["error"]);
  }
}

include "pages/lgfHeader.php"
?>

<style>
  .body {
    padding: none;
    background-image: url('images/lgpage1.jpg');
    background-size: cover;
  } 
  .box {
    position: relative;
    width: 390px;
    margin: none;
    padding: none;
  }
  .centerdiv{
    display: flex;
    align-items: center;
    justify-content: center;
  }
  .logoplacer{
    display: flex;
    margin-left: -40px;
    align-items: center;
    justify-content: center;
  }
  .holder img{
    height: 90px;
  }

  .btn {
    height: 45px;
    text-transform: uppercase;
    font-weight: bold;
    font-family: Verdana, Geneva, Tahoma, sans-serif;
  }

</style>

<body class="body">
<div class="logoplacer">
    <div class="holder">
      <img src="images/logowithname.png" alt="logo">
    </div>
  </div>
  <div class="centerdiv">
  <div class="box">
    <div class="card card-login mx-auto mt-1">
      <div class="card-header">Reset Password</div>
      <div class="card-body">
        <div class="text-center mb-4">
          <h4>Forgot your password?</h4>
          <p>Enter your username to identify your account on the system and input your new password.</p>
        </div>
        <form action="libraries/resetpass.php" method="post">
          <div class="form-group">
            <div style="margin-bottom: 10px;" class="form-label-group">
              <input type="text" name="username" id="inputEmail" class="form-control" placeholder="Enter Username" required="required" autofocus="autofocus">
              <label for="inputEmail">Enter Username</label>
            </div>
            <div style="margin-bottom: 10px;" class="form-label-group">
              <input type="password" name="password" id="newPassword" class="form-control" placeholder="Enter Password" required="required" autofocus="autofocus">
              <label for="newPassword">Enter new Password</label>
            </div>
            <div class="form-label-group">
              <input type="password" name="confirmpass" id="confirmnewpass" class="form-control" placeholder="Re-type Password" required="required" autofocus="autofocus">
              <label for="confirmnewpass">Re-type new Password</label>
            </div>
          </div>
          <button style="margin-bottom: 10px;background-color: #DA291C;border: none;" type="submit" name="submit" class="btn btn-primary btn-block">Reset Password</button>
        </form>
        <div class="text-center">
          <a style="text-decoration: none;" class="d-block small" href="index.php">Login Page</a>
        </div>
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