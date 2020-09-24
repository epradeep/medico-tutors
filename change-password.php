<?php
error_reporting(0);
session_start();
if($_SESSION['UserId']!="")
{
   $uname = $_SESSION['Name'];
   include_once("CommonUtilities/Connections.php");
   include_once("CommonUtilities/Functions.php");

?>
<!DOCTYPE html>
<html>
  <head>
    <?php include_once("title.php"); ?>
  </head>
  <body data-ng-cloak data-ng-app="ChangePwdModule" data-ng-controller="ChangePwdController">
    <div class="page">
      <!-- Main Navbar-->
      <?php include_once("header.php"); ?>
      <div class="page-content d-flex align-items-stretch"> 
        <!-- Side Navbar -->
        <?php include_once("sidebar.php"); ?>
        <div class="content-inner">
          <!-- Page Header-->
          <header class="page-header">
            <div class="container-fluid">
              <h2 class="no-margin-bottom">Change Password</h2>
            </div>
          </header>
          <!-- Breadcrumb-->
          <div class="breadcrumb-holder container-fluid">
            <ul class="breadcrumb">
              <li class="breadcrumb-item"><a href="welcome.php">Home</a></li>
              <li class="breadcrumb-item active">Change Password</li>
            </ul>
          </div>
          <!-- Forms Section-->
          <section class="forms"> 
            <div class="container-fluid">
              <div class="row">
                <!-- Basic Form-->
                <div class="col-lg-12">
                  <div class="card">
                    <div class="card-close">
                      <!--<div class="dropdown">
                        <button type="button" id="closeCard1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-ellipsis-v"></i></button>
                        <div aria-labelledby="closeCard1" class="dropdown-menu dropdown-menu-right has-shadow"><a href="#" class="dropdown-item remove"> <i class="fa fa-times"></i>Close</a><a href="#" class="dropdown-item edit"> <i class="fa fa-gear"></i>Edit</a></div>
                      </div>-->
                    </div>
                    <div class="card-header d-flex align-items-center">
                      <!--<h3 class="h4">Add Enrollment</h3>-->
                    </div>
                    <div class="card-body">
                      <p>&nbsp;</p>
                      <form class="ChangePwdForm" id="ChangePwdForm" autocomplete="off" enctype="multipart/form-data" name="ChangePwdForm" novalidate="" data-ng-submit="ChangePwdData(UserPwd)">
					    <div class="form-row">
						    <div class="form-group col-md-4">
							    <label class="form-control-label">Current Password <span class="require">*</span></label>
							    <input  class="form-control" id="currentpassword" type="password" name="currentpassword" maxlength="20" data-ng-model="UserPwd.currentpassword" data-ng-minlength="8" data-ng-maxlength="20" required>
          					  <div class="error" data-ng-show="submitted || ChangePwdForm.currentpassword.$dirty && ChangePwdForm.currentpassword.$invalid">
          							<small class="error" data-ng-show="ChangePwdForm.currentpassword.$error.required">Current Password is required.</small>
          							<small class="error" data-ng-show="ChangePwdForm.currentpassword.$error.minlength">Current Password is required to be at least 8 characters</small>
          							<small class="error" data-ng-show="ChangePwdForm.currentpassword.$error.maxlength">Current Password cannot be longer than 20 characters</small>
          					  </div>
							</div>
							<div class="form-group col-md-4">
							    <label class="form-control-label">New Password <span class="require">*</span></label>
							    <input  class="form-control" id="password" type="password" name="password" maxlength="20" data-ng-model="UserPwd.password" data-ng-minlength="8" data-ng-maxlength="20" required>
          					  <div class="error" data-ng-show="submitted || ChangePwdForm.password.$dirty && ChangePwdForm.password.$invalid">
          							<small class="error" data-ng-show="ChangePwdForm.password.$error.required">Password is required.</small>
          							<small class="error" data-ng-show="ChangePwdForm.password.$error.minlength">Password is required to be at least 8 characters</small>
          							<small class="error" data-ng-show="ChangePwdForm.password.$error.maxlength">Password cannot be longer than 20 characters</small>
          					  </div>
							</div>
							<div class="form-group col-md-4">
							    <label class="form-control-label">Retype New Password <span class="require">*</span></label>
							    <input  class="form-control" id="confirmpassword" type="password" name="confirmpassword" maxlength="20" data-ng-model="UserPwd.confirmpassword" compare-to="UserPwd.password" data-ng-minlength="8" data-ng-maxlength="20" required>
          					  <div class="error" data-ng-show="submitted || ChangePwdForm.confirmpassword.$dirty && ChangePwdForm.confirmpassword.$invalid">
          							<small class="error" data-ng-show="ChangePwdForm.confirmpassword.$error.required">Password is required.</small>
          							<small class="error" data-ng-show="ChangePwdForm.confirmpassword.$error.minlength">Password is required to be at least 8 characters</small>
          							<small class="error" data-ng-show="ChangePwdForm.confirmpassword.$error.maxlength">Password cannot be longer than 20 characters</small>
                                    <small class="error" data-ng-show="ChangePwdForm.confirmpassword.$error.compareTo">Passwords don't match.</small>
          					  </div>
							</div>
                            
                        </div>

                        <div class="form-row"> 
                            <div class="form-group col-md-12">						
							    <button type="submit" class="btn btn-primary" data-ng-disabled="FormValid">Submit</button>
							    <button type="reset" class="btn btn-danger">Cancel</button>
							    <!--<button type="submit" class="btn btn-info" data-ng-click="GotoList()">Back</button>-->
							    <div class="pt-4">
								    <div class="alert alert-danger alert-dismissable" data-ng-show="showWarningAlert">
										<button type="button" class="close" data-ng-click="switchBool('showWarningAlert')">×</button>
										<strong>&nbsp;{{WarningAlert}}</strong>
									</div>
									<div class="alert alert-success alert-dismissable" data-ng-show="showSuccessAlert">
										<button type="button" class="close" data-ng-click="switchBool('showSuccessAlert')">×</button>
										<strong>&nbsp;{{SuccessAlert}}</strong>
									</div>
							    </div>
							</div>
                        </div>
                      </form>
					  
                    </div>
                  </div>
                </div>
                <!-- Horizontal Form-->
				
              </div>
            </div>
          </section>
          <!-- Page Footer-->
          <?php include_once("footer.php"); ?>
		</div>
		
      </div>
    </div>
  </body>
</html>
<?php
}
else
{ 
   echo "<script language=\'javascript\'>window.location=\'index.php\';</script>";
}
?>