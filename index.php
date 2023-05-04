<?php
require_once "libraries/dbaseconnect.php";

if (isset($_GET["error"])) {
  if ($_GET["error"] == "InvalidData") {
    displayAlert("Invalid Data Entered");
  } else if ($_GET["error"] == "DatabaseError") {
    displayAlert("Database connection Error/Failed.");
  } else if ($_GET["error"] == "AccessDenied") {
    displayAlert("ACCESS DENIED");
  } else if ($_GET["error"] == "resetPassword") {
    displayAlert("Reset Password Successful");
  } else if ($_GET["error"] == "adminApproval") {
    displayAlert("CANNOT LOGIN, ADMIN APPROVAL IS NEEDED.");
  } else if ($_GET["error"] == "wrongpassword") {
    displayAlert("Password is incorrect.");
  } else {
    displayAlert($_GET["error"]);
  }
}

include "pages/lgfHeader.php"

?>

<style>
  .mainDiv {
    padding: none;
    background-image: url('images/lgpage1.jpg');
    background-size: cover;
  }
  .box {
    
    position: relative;
    width: 350px;
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

<br><br><br>

<body class="mainDiv">
  <div class="logoplacer">
    <div class="holder">
      <img src="images/logowithname.png" alt="logo">
    </div>
  </div>
  <div class="centerdiv">
    <div class="box">
      <div class="card mx-auto mt-1">
        <div class="card-header">Login</div>
        <div class="card-body">
          <form action="libraries/verifyUser.php" method="POST">
            <div class="form-group">
              <div style="width: 302px;" class="form-label-group">
                <input type="text" name="username" id="inputEmail" class="form-control" placeholder="Username" required="required" autofocus="autofocus">
                <label for="inputEmail">Username</label>
              </div>
            </div>
            <div class="form-group">
              <div style="width: 302px;" class="form-label-group">
                <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required="required">
                <label for="inputPassword">Password</label>
              </div>
            </div>
            <div class="form-group">
              <div class="form-label-group">
                <div class="g-recaptcha" data-sitekey="6LfeuIEiAAAAAIvrRJWkDcwuP_lcurw52lG5J35q"></div>
              </div>
            </div>
            <!-- <div class="form-group">
              <div style="margin-left: 17px;" class="checkbox">
                <label>
                  <input type="checkbox" value="remember-me">
                  Remember Password
                </label>
              </div>
            </div> -->
            <button style="background-color: #DA291C;border: none; width: 302px;" type="submit" name="submit" class="btn btn-primary btn-block">Login</button>
          </form>
          <div class="text-center">
            <a style="text-decoration: none;" class="d-block small mt-3" href="registerUser.php?type=fromlogin">Register an Account</a>
            <a style="text-decoration: none;" class="d-block small" href="forgot-password.php">Forgot Password?</a>
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

  <!-- <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit"
    async defer>
</script> -->
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</body>

</html>