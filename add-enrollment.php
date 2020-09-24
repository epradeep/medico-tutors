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
  <body data-ng-cloak data-ng-app="EnrollmentModule" data-ng-controller="EnrollmentController" ng-init="GetCountries()">
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
              <h2 class="no-margin-bottom">Enrollment</h2>
            </div>
          </header>
          <!-- Breadcrumb-->
          <div class="breadcrumb-holder container-fluid">
            <ul class="breadcrumb">
              <li class="breadcrumb-item"><a href="welcome.php">Home</a></li>
              <li class="breadcrumb-item active">Enrollment</li>
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
                      <h3 class="h4">Add Enrollment</h3>
                    </div>
                    <div class="card-body">
                      <p>&nbsp;</p>
                      <form class="EnrollmentForm" id="EnrollmentForm" autocomplete="off" enctype="multipart/form-data" name="EnrollmentForm" novalidate="" data-ng-submit="EnrollmentData(Enrollment)">
					    <div class="form-row">
						    <div class="form-group col-md-4">
							    <label class="form-control-label">Course Name <span class="require">*</span></label>
							    <select name="coursename" id="coursename" class="form-control" data-ng-model="coursename" required>
								  <option value="">Select Course Name</option> 
								  <option ng-repeat="course in CoursesArray" value="{{course.CourseName}}">{{course.CourseName}}</option>
								</select>
								<div class="error" data-ng-show="submitted || EnrollmentForm.coursename.$dirty && EnrollmentForm.coursename.$invalid">
								<small class="error" data-ng-show="EnrollmentForm.coursename.$error.required">Course is required.</small>
							    </div>
							</div>
                            <div class="form-group col-md-4">
							   <label class="form-control-label">Name <span class="require">*</span></label>
								<input type="text" class="form-control" id="pname" name="pname" pattern="^[a-zA-Z- .]+" maxlength="50" data-ng-model="pname" data-ng-minlength="3" data-ng-maxlength="50" required>
								<div class="error" data-ng-show="submitted || EnrollmentForm.pname.$dirty && EnrollmentForm.pname.$invalid">
								 <small class="error" data-ng-show="EnrollmentForm.pname.$error.required">Name is required.</small>
								 <small class="error" data-ng-show="EnrollmentForm.pname.$error.minlength">Name is should be at least 3 characters.</small>
								 <small class="error" data-ng-show="EnrollmentForm.pname.$error.maxlength">Name is should not be greater then 50 characters.</small>
								<small class="error" data-ng-show="EnrollmentForm.pname.$error.pattern">Name is should be alphabetic.</small>
							  </div>
							</div>
							<div class="form-group col-md-4">
							    <label class="form-control-label">Email-Id <span class="require">*</span></label>
								<input type="email" id="emailid" name="emailid" class="form-control" pattern="^[_a-zA-Z0-9]+(\.[_a-zA-Z0-9]+)*@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*(\.[a-zA-Z]{2,4})$" data-ng-model="emailid" required>
								<div class="error" data-ng-show="submitted || EnrollmentForm.emailid.$dirty && EnrollmentForm.emailid.$invalid">
								<small class="error" data-ng-show="EnrollmentForm.emailid.$error.required">Email is required.</small>
								<small class="error" data-ng-show="EnrollmentForm.emailid.$error.email || EnrollmentForm.emailid.$error.pattern">Invalid Email.</small>
							</div>
							</div>
							
                        </div>

                        <div class="form-row">
						    <div class="form-group col-md-4">
							    <label class="form-control-label">Mobile-No <span class="require">*</span></label>
								<input type="tel" class="form-control" id="mobileno" name="mobileno" maxlength="10" data-ng-model="mobileno" data-ng-minlength="10" data-ng-maxlength="10" data-ng-pattern="/^[0-9]*$/" required="">
							<div class="error" data-ng-show="submitted || EnrollmentForm.mobileno.$dirty && EnrollmentForm.mobileno.$invalid">
								<small class="error" data-ng-show="EnrollmentForm.mobileno.$error.required">Mobile No is required.</small>
								<small class="error" data-ng-show="EnrollmentForm.mobileno.$error.minlength">Mobile No is required to be at least 10 digits</small>
								<small class="error" data-ng-show="EnrollmentForm.mobileno.$error.maxlength">Mobile No cannot be longer than 10 digits</small>
								<small class="error" data-ng-show="EnrollmentForm.mobileno.$error.pattern">Mobile No should be numeric</small>
							</div>
							</div>
							<div class="form-group col-md-4">
							    <label class="form-control-label">Country <span class="require">*</span></label>
								<select name="countryname" id="countryname" class="form-control" data-ng-model="countryname" required>
								  <option value="">Select Country</option> 
								  <option ng-repeat="country in CountryArray" value="{{country.CountryName}}">{{country.CountryName}}</option>
								</select>
								<div class="error" data-ng-show="submitted || EnrollmentForm.countryname.$dirty && EnrollmentForm.countryname.$invalid">
								<small class="error" data-ng-show="EnrollmentForm.countryname.$error.required">Course is required.</small>
							    </div>
							</div>
                            <div class="form-group col-md-4">
							   <label class="form-control-label">City <span class="require">*</span></label>
								<input type="text" class="form-control" id="city" name="city" pattern="^[a-zA-Z- .]+"  data-ng-model="city" required>
								<div class="error" data-ng-show="submitted || EnrollmentForm.city.$dirty && EnrollmentForm.city.$invalid">
								 <small class="error" data-ng-show="EnrollmentForm.city.$error.required">City is required.</small>
								<small class="error" data-ng-show="EnrollmentForm.city.$error.pattern">City is should be alphabetic.</small>
							  </div>
								
							</div>
                        </div>	
                        <div class="form-row">
						    <div class="form-group col-md-4">
							    <label class="form-control-label">Date (MM/DD/YYYY) <span class="require">*</span></label>
								<input type="text" id="enrolldate" name="enrolldate" class="form-control" data-ng-model="enrolldate" uib-datepicker-popup="MM/dd/yyyy" is-open="opened.opened1" ng-click="open($event,'opened1')" datepicker-options="EDT" required>
								<div class="error" data-ng-show="submitted || EnrollmentForm.enrolldate.$dirty && EnrollmentForm.enrolldate.$invalid">
								<small class="error" data-ng-show="EnrollmentForm.enrolldate.$error.required">Date is required.</small>
							    </div>
							</div>
                        </div>						
						
                        <div class="form-row"> 
                            <div class="form-group col-md-12">						
							    <button type="submit" class="btn btn-primary">Submit</button>
							    <button type="reset" class="btn btn-danger">Cancel</button>
							    <button type="submit" class="btn btn-info" data-ng-click="GotoList()">Back</button>
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