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
  <body data-ng-cloak data-ng-app="EnquiryModule" data-ng-controller="EnquiryController">
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
              <h2 class="no-margin-bottom">Enquires</h2>
            </div>
          </header>
          <!-- Breadcrumb-->
          <div class="breadcrumb-holder container-fluid">
            <ul class="breadcrumb">
              <li class="breadcrumb-item"><a href="welcome.php">Home</a></li>
              <li class="breadcrumb-item active">Enquires</li>
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
                      <div>&nbsp;</div>
                    </div>
                    <div class="card-header d-flex align-items-center">
                      <h3 class="h4">Add Enquiry</h3>
                    </div>
                    <div class="card-body">
                      <p>&nbsp;</p>
                      <form class="EnquiryForm" id="EnquiryForm" autocomplete="off" enctype="multipart/form-data" name="EnquiryForm" novalidate="" data-ng-submit="EnquiryData(Enquiry)">
					    <div class="form-row">
						    
                            <div class="form-group col-md-4">
							   <label class="form-control-label">Name <span class="require">*</span></label>
								<input type="text" class="form-control" id="pname" name="pname" pattern="^[a-zA-Z- .]+" maxlength="50" data-ng-model="pname" data-ng-minlength="3" data-ng-maxlength="50" required>
								<div class="error" data-ng-show="submitted || EnquiryForm.pname.$dirty && EnquiryForm.pname.$invalid">
								 <small class="error" data-ng-show="EnquiryForm.pname.$error.required">Name is required.</small>
								 <small class="error" data-ng-show="EnquiryForm.pname.$error.minlength">Name is should be at least 3 characters.</small>
								 <small class="error" data-ng-show="EnquiryForm.pname.$error.maxlength">Name is should not be greater then 50 characters.</small>
								<small class="error" data-ng-show="EnquiryForm.pname.$error.pattern">Name is should be alphabetic.</small>
							  </div>
							</div>
							<div class="form-group col-md-4">
							    <label class="form-control-label">Email-Id <span class="require">*</span></label>
								<input type="email" id="emailid" name="emailid" class="form-control" pattern="^[_a-zA-Z0-9]+(\.[_a-zA-Z0-9]+)*@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*(\.[a-zA-Z]{2,4})$" data-ng-model="emailid" required>
								<div class="error" data-ng-show="submitted || EnquiryForm.emailid.$dirty && EnquiryForm.emailid.$invalid">
									<small class="error" data-ng-show="EnquiryForm.emailid.$error.required">Email is required.</small>
									<small class="error" data-ng-show="EnquiryForm.emailid.$error.email || EnquiryForm.emailid.$error.pattern">Invalid Email.</small>
							    </div>
							</div>
							<div class="form-group col-md-4">
							    <label class="form-control-label">Mobile-No <span class="require">*</span></label>
								<input type="tel" class="form-control" id="mobileno" name="mobileno" maxlength="10" data-ng-model="mobileno" data-ng-minlength="10" data-ng-maxlength="10" data-ng-pattern="/^[0-9]*$/" required="">
							   <div class="error" data-ng-show="submitted || EnquiryForm.mobileno.$dirty && EnquiryForm.mobileno.$invalid">
									<small class="error" data-ng-show="EnquiryForm.mobileno.$error.required">Mobile No is required.</small>
									<small class="error" data-ng-show="EnquiryForm.mobileno.$error.minlength">Mobile No is required to be at least 10 digits</small>
									<small class="error" data-ng-show="EnquiryForm.mobileno.$error.maxlength">Mobile No cannot be longer than 10 digits</small>
									<small class="error" data-ng-show="EnquiryForm.mobileno.$error.pattern">Mobile No should be numeric</small>
								</div>
							</div>
							
                        </div>

                        <div class="form-row">
						    <div class="form-group col-md-4">
							   <label class="form-control-label">City <span class="require">*</span></label>
								<input type="text" class="form-control" id="city" name="city" pattern="^[a-zA-Z- .]+"  data-ng-model="city" required>
								<div class="error" data-ng-show="submitted || EnquiryForm.city.$dirty && EnquiryForm.city.$invalid">
								 <small class="error" data-ng-show="EnquiryForm.city.$error.required">City is required.</small>
								<small class="error" data-ng-show="EnquiryForm.city.$error.pattern">City is should be alphabetic.</small>
							  </div>
							</div>
                            
                            <div class="form-group col-md-4">
							    <label class="form-control-label">Specialization <span class="require">*</span></label>
							    <select name="specialization" id="specialization" class="form-control" data-ng-model="specialization" required>
								    <option value="">Select Specialization</option> 
								    <option ng-repeat="specialization in SpecializationArray" value="{{specialization}}">{{specialization}}</option>
								</select>
								<div class="error" data-ng-show="submitted || EnquiryForm.specialization.$dirty && EnquiryForm.specialization.$invalid">
								<small class="error" data-ng-show="EnquiryForm.specialization.$error.required">Specialization is required.</small>
							    </div>
							</div>

                             <div class="form-group col-md-4">
							    <label class="form-control-label">Course Interested <span class="require">*</span></label>
							    <select name="courseinterest" id="courseinterest" class="form-control" data-ng-model="courseinterest" required>
								  <option value="">Select Course Name</option> 
								  <option ng-repeat="course in CoursesArray" value="{{course.CourseName}}">{{course.CourseName}}</option>
								</select>
								<div class="error" data-ng-show="submitted || EnquiryForm.courseinterest.$dirty && EnquiryForm.courseinterest.$invalid">
								<small class="error" data-ng-show="EnquiryForm.courseinterest.$error.required">Course Interested is required.</small>
							    </div>
							</div>
							                   
                        </div>	
                        <div class="form-row">
                        	<div class="form-group col-md-4">
							    <label class="form-control-label">Type <span class="require">*</span></label>
							    <input type="text" class="form-control" id="specilizetype" name="specilizetype" pattern="^[a-zA-Z- .]+"  data-ng-model="specilizetype" required>
								<div class="error" data-ng-show="submitted || EnquiryForm.specilizetype.$dirty && EnquiryForm.specilizetype.$invalid">
									 <small class="error" data-ng-show="EnquiryForm.specilizetype.$error.required">Type is required.</small>
									<small class="error" data-ng-show="EnquiryForm.specilizetype.$error.pattern">Type is should be alphabetic.</small>
								</div> 
							</div>
						    <!--<div class="form-group col-md-4">
							    <label class="form-control-label">Date of Enquiry (MM/DD/YYYY) <span class="require">*</span></label>
								<input type="text" id="enquirydate" name="enquirydate" class="form-control" data-ng-model="enquirydate" uib-datepicker-popup="MM/dd/yyyy" is-open="opened.opened1" ng-click="open($event,'opened1')" datepicker-options="EDT" required>
								<div class="error" data-ng-show="submitted || EnquiryForm.enquirydate.$dirty && EnquiryForm.enquirydate.$invalid">
								<small class="error" data-ng-show="EnquiryForm.enquirydate.$error.required">Date of Enquiry is required.</small>
							    </div>
							</div>-->
							<div class="form-group col-md-4">
							    <label class="form-control-label">Enquiry</label>
							    <textarea name="enquirytext" id="enquirytext" class="form-control" data-ng-model="enquirytext">
								  
								</textarea>
								<div class="error" data-ng-show="submitted || EnquiryForm.enquirytext.$dirty && EnquiryForm.enquirytext.$invalid">
								<small class="error" data-ng-show="EnquiryForm.enquirytext.$error.required">Enquiry is required.</small>
							    </div>
							</div>
                        </div>					
						
                        <div class="form-row"> 
                            <div class="form-group col-md-12">						
							    <button type="submit" class="btn btn-primary">Submit</button>
							    <button type="reset" class="btn btn-danger">Cancel</button>
							    <button type="submit" class="btn btn-info" data-ng-click="GotoEnquiryList()">Back</button>
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