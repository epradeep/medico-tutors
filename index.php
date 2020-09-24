<?php
  session_start();
?>
<!DOCTYPE html>
<html>
  <head>
    <?php include_once("title.php"); ?>
  </head>
  <body data-ng-cloak data-ng-app="LoginModule" data-ng-controller="LoginController">
    <div class="page login-page">
      <div class="container d-flex align-items-center">
        <div class="form-holder has-shadow">
          <div class="row">
            <!-- Logo & Information Panel-->
            <div class="col-lg-6">
              <div class="info d-flex align-items-center">
                <div class="content">
                  <div class="logo">
                    <h1>Medico Vibes</h1>
                  </div>
                  <p>&nbsp;</p>
                </div>
              </div>
            </div>
            <!-- Form Panel -->
              <div class="col-lg-6 bg-white">
                <div class="form d-flex align-items-center">
                  <div class="content">
                    <form class="form-validate" id="LoginForm" autocomplete="off" enctype="multipart/form-data" name="LoginForm" novalidate="" data-ng-submit="LoginData(ALogin)">
                      <div class="form-group">
                        <input type="email" class="input-material" id="login-username" name="loginUname" pattern="^[a-zA-Z0-9-\_.]+@[a-zA-Z0-9-\_.]+\.[a-zA-Z0-9.]{2,5}$" data-ng-model="ALogin.loginUname" required>
              					  <div class="error" data-ng-show="submitted || LoginForm.loginUname.$dirty && LoginForm.loginUname.$invalid">
              							<small class="error" data-ng-show="LoginForm.loginUname.$error.required">Email-Id is required.</small>
              						    <small class="error" data-ng-show="LoginForm.loginUname.$error.email">Invalid Email-Id.</small>
              						</div>
                        <label for="login-username" class="label-material">User Name <span class="require">*</span></label>
                      </div>
                      <div class="form-group">
                        <input  class="input-material" id="login-password" type="password" name="loginPassword" maxlength="20" data-ng-model="ALogin.loginPassword" data-ng-minlength="8" data-ng-maxlength="20" required>
            					  <div class="error" data-ng-show="submitted || LoginForm.loginPassword.$dirty && LoginForm.loginPassword.$invalid">
            							<small class="error" data-ng-show="LoginForm.loginPassword.$error.required">Password is required.</small>
            							<small class="error" data-ng-show="LoginForm.loginPassword.$error.minlength">Password is required to be at least 8 characters</small>
            							<small class="error" data-ng-show="LoginForm.loginPassword.$error.maxlength">Password cannot be longer than 20 characters</small>
            					  </div>
                        <label for="login-password" class="label-material">Password <span class="require">*</span></label>
                      </div>
  					
            					<button type="submit" id="login" class="btn btn-primary">Login</button>
            					<p>&nbsp;</p>
            					<div class="alert alert-danger alert-dismissable" data-ng-show="showWarningAlert">
            						  <button type="button" class="close" data-ng-click="switchBool('showWarningAlert')">×</button>
            						  <strong>&nbsp;{{WarningAlert}}</strong>
            					</div>
            					<div class="alert alert-success alert-dismissable" data-ng-show="showSuccessAlert">
            						  <button type="button" class="close" data-ng-click="switchBool('showSuccessAlert')">×</button>
            						  <strong>&nbsp;{{SuccessAlert}}</strong>
            					</div>
                      <!-- This should be submit button but I replaced it with <a> for demo purposes-->
                    </form>
  				          <a href="forgot-password.php" class="forgot-pass">Forgot Password?</a>
  				          <br>
  				          <!--<small>Do not have an account? </small><a href="#" class="signup">Signup</a>-->
                  </div>
                </div>
              </div>

          </div>
        </div>
      </div>
      <div class="copyrights text-center">
        <p>Powered by <a href="#" class="external">Dotweb.in</a>
      </div>
    </div>
    <!-- JavaScript files-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/popper.js/umd/popper.min.js"> </script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="vendor/jquery.cookie/jquery.cookie.js"> </script>
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="vendor/jquery-validation/jquery.validate.min.js"></script>
    <!-- Main File-->
    <script src="js/front.js"></script>
  </body>
</html>
