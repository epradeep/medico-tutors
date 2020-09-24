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
                  <form class="form-validate" id="ForgotForm" autocomplete="off" enctype="multipart/form-data" name="ForgotForm" novalidate="" data-ng-submit="ForgotData(AForgot)">
                    <div class="form-group">
                      <input type="email" class="input-material" id="forgotemail" name="forgotemail" pattern="^[a-zA-Z0-9-\_.]+@[a-zA-Z0-9-\_.]+\.[a-zA-Z0-9.]{2,5}$" data-ng-model="forgotemail" ng-change="ForgotEmailCheck(forgotemail)" compare-to required>
                        <div class="error" data-ng-show="submitted || ForgotForm.forgotemail.$dirty && ForgotForm.forgotemail.$invalid">
                          <small class="error" data-ng-show="ForgotForm.forgotemail.$error.required">Email-Id is required.</small>
                          <small class="error" data-ng-show="ForgotForm.forgotemail.$error.email">Invalid Email-Id.</small>
                          <small class="error">{{ForgotEmailExists}}</small>
                        </div>
                      <label for="login-username" class="label-material">Email-Id <span class="require">*</span></label>
                    </div>
          
                    <button type="submit" id="login" class="btn btn-primary" ng-disabled="ForgotFormValid">Get New Password</button>
                    <!--<button type="submit" id="back" class="btn btn-info d-inline" data-ng-click="GotoLogin()">Back</button>-->
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