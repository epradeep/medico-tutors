<?php
error_reporting(0);
session_start();
if($_SESSION['UserId']!="")
{
   $uname = $_SESSION['Name'];
   include_once("CommonUtilities/Connections.php");

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
          <section class="tables">   
            <div class="container-fluid">
              <div class="row">
                <div class="col-lg-12">
				    <div ng-show="ListEmrolled">
						<div class="card">
							<div class="card-close">
							  <div class="align-items-center">
								<a href="add-enrollment.php" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> Add Enrollment</a>
								<!--<button type="button" id="closeCard1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-ellipsis-v"></i></button>
								<div aria-labelledby="closeCard1" class="dropdown-menu dropdown-menu-right has-shadow"><a href="#" class="dropdown-item remove"> <i class="fa fa-times"></i>Close</a><a href="#" class="dropdown-item edit"> <i class="fa fa-gear"></i>Edit</a></div>-->
							  </div>
							</div>
							<div class="card-header d-flex align-items-center">
							  <h3 class="h4">List Enrollment</h3>
							</div>
							<div class="card-body"> 
								<div class="table-responsive">
									<table class="table table-bordered" data-ng-init="GetEnrolledList()">
									  <thead>
										<tr>
										  <th>S.No</th>
										  <th>Name</th>
										  <th>Email-Id </th>
										  <th>Mobile-No</th>
										  <th>Course Name</th>
										  <th>Date of Enrolled</th>
										  <th>Action</th>
										</tr>
									  </thead>
									  <tbody>
										<tr ng-repeat="Enrolled in EnrolledArray">
										  <td data-title="Sl.No">{{$index+1}}</td>
										  <td data-title="Name">{{Enrolled.Name}}</td>
										  <td data-title="Email-Id">{{Enrolled.EmailId}}</td>
										  <td data-title="Mobile-No">{{Enrolled.MobileNo}}</td>
										  <td data-title="Course Name">{{Enrolled.CourseName}}</td>
										  <td data-title="Date of Enrolled">{{Enrolled.DateofEnrolled}}</td>
										  <td data-title="Action">
											<button type="button" class="btn btn-primary btn-xs" data-ng-click="EditEnrolled(Enrolled.PkId,Enrolled.Name,Enrolled.EmailId,Enrolled.MobileNo,Enrolled.City,Enrolled.Countryid,Enrolled.CountryName,Enrolled.CourseName,Enrolled.DateofEnrolled)">
												<i class="fa fa-edit" aria-hidden="true"></i>
											</button>&nbsp;&nbsp;
											<button type="button" class="btn btn-danger btn-xs" data-ng-click="DeleteEnrolled(Enrolled.PkId)">
												<i class="fa fa-trash" aria-hidden="true"></i>
											</button>
										  </td>
										</tr>
										
									  </tbody>
									</table>
								</div>
							</div>
					    </div>
					</div>
					<!--Edit  Emrolled-->
					<div ng-show="EditEmrolled">
						<div class="card">
							<div class="card-close">
							  <div>&nbsp;</div>
							</div>
							<div class="card-header d-flex align-items-center">
							  <h3 class="h4">Edit Enrollment</h3>
							</div>
							<div class="card-body">
								<form class="EnrollmentForm" id="EnrollmentForm" autocomplete="off" enctype="multipart/form-data" name="EnrollmentForm" novalidate="" data-ng-submit="UpdateEnrollment(Update)">
									<input type="hidden" ng-model="editpkid" >
									<div class="form-row">
										<div class="form-group col-md-4">
											<label class="form-control-label">Course Name <span class="require">*</span></label>
											<select name="editcoursename" id="editcoursename" class="form-control" data-ng-model="editcoursename" required>
											  <option value="">Select Course Name</option>
											  <option ng-repeat="course in CoursesArray" value="{{course.CourseName}}">{{course.CourseName}}</option>
											</select>
											<div class="error" data-ng-show="submitted || EnrollmentForm.editcoursename.$dirty && EnrollmentForm.editcoursename.$invalid">
											<small class="error" data-ng-show="EnrollmentForm.editcoursename.$error.required">Course is required.</small>
											</div>
										</div>
										<div class="form-group col-md-4">
										   <label class="form-control-label">Name <span class="require">*</span></label>
											<input type="text" class="form-control" id="editname" name="editname" pattern="^[a-zA-Z- .]+" maxlength="50" data-ng-model="editname" data-ng-minlength="3" data-ng-maxlength="50" required>
											<div class="error" data-ng-show="submitted || EnrollmentForm.editname.$dirty && EnrollmentForm.editname.$invalid">
											 <small class="error" data-ng-show="EnrollmentForm.editname.$error.required">Name is required.</small>
											 <small class="error" data-ng-show="EnrollmentForm.editname.$error.minlength">Name is should be at least 3 characters.</small>
											 <small class="error" data-ng-show="EnrollmentForm.editname.$error.maxlength">Name is should not be greater then 50 characters.</small>
											<small class="error" data-ng-show="EnrollmentForm.editname.$error.pattern">Name is should be alphabetic.</small>
										  </div>
										</div>
										<div class="form-group col-md-4">
											<label class="form-control-label">Email-Id <span class="require">*</span></label>
											<input type="email" id="editemail" name="editemail" class="form-control" pattern="^[_a-zA-Z0-9]+(\.[_a-zA-Z0-9]+)*@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*(\.[a-zA-Z]{2,4})$" data-ng-model="editemail" required>
											<div class="error" data-ng-show="submitted || EnrollmentForm.editemail.$dirty && EnrollmentForm.editemail.$invalid">
											<small class="error" data-ng-show="EnrollmentForm.editemail.$error.required">Email is required.</small>
											<small class="error" data-ng-show="EnrollmentForm.editemail.$error.editemail || EnrollmentForm.editemail.$error.pattern">Invalid Email.</small>
										</div>
										</div>
										
									</div>

									<div class="form-row">
										<div class="form-group col-md-4">
											<label class="form-control-label">Mobile-No <span class="require">*</span></label>
											<input type="tel" class="form-control" id="editmobile" name="editmobile" maxlength="10" data-ng-model="editmobile" data-ng-minlength="10" data-ng-maxlength="10" data-ng-pattern="/^[0-9]*$/" required="">
										<div class="error" data-ng-show="submitted || EnrollmentForm.editmobile.$dirty && EnrollmentForm.editmobile.$invalid">
											<small class="error" data-ng-show="EnrollmentForm.editmobile.$error.required">Mobile No is required.</small>
											<small class="error" data-ng-show="EnrollmentForm.editmobile.$error.minlength">Mobile No is required to be at least 10 digits</small>
											<small class="error" data-ng-show="EnrollmentForm.editmobile.$error.maxlength">Mobile No cannot be longer than 10 digits</small>
											<small class="error" data-ng-show="EnrollmentForm.editmobile.$error.pattern">Mobile No should be numeric</small>
										</div>
										</div>
										<div class="form-group col-md-4">
											<label class="form-control-label">Country <span class="require">*</span></label>
											<select name="editcountryname" id="editcountryname" class="form-control" data-ng-model="editcountryname" required>
											  <option value="">Select Country</option> 
											  <option ng-repeat="country in CountryArray" value="{{country.CountryName}}">{{country.CountryName}}</option>
											</select>
											<div class="error" data-ng-show="submitted || EnrollmentForm.editcountryname.$dirty && EnrollmentForm.editcountryname.$invalid">
											<small class="error" data-ng-show="EnrollmentForm.editcountryname.$error.required">Course is required.</small>
											</div>
										</div>
										<div class="form-group col-md-4">
										   <label class="form-control-label">City <span class="require">*</span></label>
											<input type="text" class="form-control" id="editcity" name="editcity" pattern="^[a-zA-Z- .]+"  data-ng-model="editcity" required>
											<div class="error" data-ng-show="submitted || EnrollmentForm.editcity.$dirty && EnrollmentForm.city.$invalid">
											 <small class="error" data-ng-show="EnrollmentForm.editcity.$error.required">City is required.</small>
											<small class="error" data-ng-show="EnrollmentForm.editcity.$error.pattern">City is should be alphabetic.</small>
										  </div>
											
										</div>
									</div>	
									<div class="form-row">
										<div class="form-group col-md-4">
											<label class="form-control-label">Date (MM/DD/YYYY) <span class="require">*</span></label>
											<input type="text" id="editdateofenroll" name="editdateofenroll" class="form-control" data-ng-model="editdateofenroll" uib-datepicker-popup="MM/dd/yyyy" is-open="opened.opened1" ng-click="open($event,'opened1')" datepicker-options="EDT" required>
											<div class="error" data-ng-show="submitted || EnrollmentForm.editdateofenroll.$dirty && EnrollmentForm.coursename.$invalid">
											<small class="error" data-ng-show="EnrollmentForm.editdateofenroll.$error.required">Date is required.</small>
											</div>
										</div>
									</div>						
									
									<div class="form-row"> 
										<div class="form-group col-md-12">						
										    <button type="submit" class="btn btn-primary">Update</button>
										    <button type="submit" class="btn btn-info" data-ng-click="GotoList()">Back to List</button>
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
					
					
					
				</div>
				
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
  echo "<script language=\"javascript\">window.location=\"index.php\";</script>";
}
?>