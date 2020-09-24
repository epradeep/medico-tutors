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
          <section class="tables">   
            <div class="container-fluid">
              <div class="row">
                <div class="col-lg-12">
				    <div ng-show="ListEnquiries">
						<div class="card">
							<div class="card-close">
							  <div class="align-items-center">
								<a href="add-enquiry.php" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> Add Enquiry</a>
								<!--<button type="button" id="closeCard1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-ellipsis-v"></i></button>
								<div aria-labelledby="closeCard1" class="dropdown-menu dropdown-menu-right has-shadow"><a href="#" class="dropdown-item remove"> <i class="fa fa-times"></i>Close</a><a href="#" class="dropdown-item edit"> <i class="fa fa-gear"></i>Edit</a></div>-->
							  </div>
							</div>
							<div class="card-header d-flex align-items-center">
							  <h3 class="h4">List Enquires</h3>
							</div>
							<div class="card-body"> 
								<div class="table-responsive">
									<table class="table table-bordered" data-ng-init="GetEnquiryList()">
									  <thead>
										<tr>
										  <th>S.No</th>
										  <th>Name</th>
										  <th>Email-Id </th>
										  <th>Mobile-No</th>
										  <th>City</th>
										  <!--<th>Specialization</th>
										  <th>Course Interested</th>-->
										  <th>Date of Enquiry</th>
										  <th>Action</th>
										</tr>
									  </thead>
									  <tbody>
										<tr ng-repeat="enquiry in EnquiryArray">
										  <td data-title="Sl.No">{{$index+1}}</td>
										  <td data-title="Name">{{enquiry.Name}}</td>
										  <td data-title="Email-Id">{{enquiry.EmailId}}</td>
										  <td data-title="Mobile-No">{{enquiry.MobileNo}}</td>
										  <td data-title="City">{{enquiry.City}}</td>
										  <!--<td data-title="Specialization">{{enquiry.Specialization}}</td>
										  <td data-title="Course Interested">{{enquiry.Courseinterest}}</td>-->
										  <td data-title="Date of Enquiry">{{enquiry.DateofEnquiry}}</td>
										  <td data-title="Action">
											<button type="button" class="btn btn-primary btn-xs" data-ng-click="EditEnquiry(enquiry.PkId,enquiry.Name,enquiry.EmailId,enquiry.MobileNo,enquiry.City,enquiry.Specialization,enquiry.Courseinterest,enquiry.Type,enquiry.Enquiry)">
												<i class="fa fa-edit" aria-hidden="true"></i>
											</button>&nbsp;&nbsp;
											<button type="button" class="btn btn-danger btn-xs" data-ng-click="DeleteEnquiry(enquiry.PkId)">
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
					<div ng-show="EditEnquiries">
						<div class="card">
							<div class="card-close">
							  <div>&nbsp;</div>
							</div>
							<div class="card-header d-flex align-items-center">
							  <h3 class="h4">Edit Enquiry</h3>
							</div>
							<div class="card-body">
								<form class="EnquiryForm" id="EnquiryForm" autocomplete="off" enctype="multipart/form-data" name="EnquiryForm" novalidate="" data-ng-submit="UpdateEnquiry(Update)">
								<input type="hidden" ng-model="enquirypkid" >
							    <div class="form-row">
		                            <div class="form-group col-md-4">
									   <label class="form-control-label">Name <span class="require">*</span></label>
										<input type="text" class="form-control" id="enquiryname" name="enquiryname" pattern="^[a-zA-Z- .]+" maxlength="50" data-ng-model="enquiryname" data-ng-minlength="3" data-ng-maxlength="50" required>
										<div class="error" data-ng-show="submitted || EnquiryForm.enquiryname.$dirty && EnquiryForm.enquiryname.$invalid">
										 <small class="error" data-ng-show="EnquiryForm.enquiryname.$error.required">Name is required.</small>
										 <small class="error" data-ng-show="EnquiryForm.enquiryname.$error.minlength">Name is should be at least 3 characters.</small>
										 <small class="error" data-ng-show="EnquiryForm.enquiryname.$error.maxlength">Name is should not be greater then 50 characters.</small>
										<small class="error" data-ng-show="EnquiryForm.enquiryname.$error.pattern">Name is should be alphabetic.</small>
									  </div>
									</div>
									<div class="form-group col-md-4">
									    <label class="form-control-label">Email-Id <span class="require">*</span></label>
										<input type="email" id="enquiryemail" name="enquiryemail" class="form-control" pattern="^[_a-zA-Z0-9]+(\.[_a-zA-Z0-9]+)*@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*(\.[a-zA-Z]{2,4})$" data-ng-model="enquiryemail" required>
										<div class="error" data-ng-show="submitted || EnquiryForm.enquiryemail.$dirty && EnquiryForm.enquiryemail.$invalid">
											<small class="error" data-ng-show="EnquiryForm.enquiryemail.$error.required">Email is required.</small>
											<small class="error" data-ng-show="EnquiryForm.enquiryemail.$error.enquiryemail || EnquiryForm.enquiryemail.$error.pattern">Invalid Email.</small>
									    </div>
									</div>
									<div class="form-group col-md-4">
									    <label class="form-control-label">Mobile-No <span class="require">*</span></label>
										<input type="tel" class="form-control" id="enquirymobile" name="enquirymobile" maxlength="10" data-ng-model="enquirymobile" data-ng-minlength="10" data-ng-maxlength="10" data-ng-pattern="/^[0-9]*$/" required="">
									   <div class="error" data-ng-show="submitted || EnquiryForm.enquirymobile.$dirty && EnquiryForm.enquirymobile.$invalid">
											<small class="error" data-ng-show="EnquiryForm.enquirymobile.$error.required">Mobile No is required.</small>
											<small class="error" data-ng-show="EnquiryForm.enquirymobile.$error.minlength">Mobile No is required to be at least 10 digits</small>
											<small class="error" data-ng-show="EnquiryForm.enquirymobile.$error.maxlength">Mobile No cannot be longer than 10 digits</small>
											<small class="error" data-ng-show="EnquiryForm.enquirymobile.$error.pattern">Mobile No should be numeric</small>
										</div>
									</div>
		                        </div>

		                        <div class="form-row">
								    <div class="form-group col-md-4">
									   <label class="form-control-label">City <span class="require">*</span></label>
										<input type="text" class="form-control" id="enquirycity" name="enquirycity" pattern="^[a-zA-Z- .]+"  data-ng-model="enquirycity" required>
										<div class="error" data-ng-show="submitted || EnquiryForm.enquirycity.$dirty && EnquiryForm.enquirycity.$invalid">
										 <small class="error" data-ng-show="EnquiryForm.enquirycity.$error.required">City is required.</small>
										<small class="error" data-ng-show="EnquiryForm.enquirycity.$error.pattern">City is should be alphabetic.</small>
									  </div>
									</div>
		                            
		                            <div class="form-group col-md-4">
									    <label class="form-control-label">Specialization <span class="require">*</span></label>
									    <select name="enquiryspecialization" id="enquiryspecialization" class="form-control" data-ng-model="enquiryspecialization" required>
										    <option value="">Select Specialization</option> 
										    <option ng-repeat="specialization in SpecializationArray" value="{{specialization}}">{{specialization}}</option>
										</select>
										<div class="error" data-ng-show="submitted || EnquiryForm.enquiryspecialization.$dirty && EnquiryForm.enquiryspecialization.$invalid">
										<small class="error" data-ng-show="EnquiryForm.enquiryspecialization.$error.required">Specialization is required.</small>
									    </div>
									</div>

		                             <div class="form-group col-md-4">
									    <label class="form-control-label">Course Interested <span class="require">*</span></label>
									    <select name="enquirycourseinterest" id="enquirycourseinterest" class="form-control" data-ng-model="enquirycourseinterest" required>
										  <option value="">Select Course Interested</option> 
										  <option ng-repeat="course in CoursesArray" value="{{course.CourseName}}">{{course.CourseName}}</option>
										</select>
										<div class="error" data-ng-show="submitted || EnquiryForm.enquirycourseinterest.$dirty && EnquiryForm.enquirycourseinterest.$invalid">
										<small class="error" data-ng-show="EnquiryForm.enquirycourseinterest.$error.required">Course Interested is required.</small>
									    </div>
									</div>                 
		                        </div>	
		                        <div class="form-row">
		                        	<div class="form-group col-md-4">
									    <label class="form-control-label">Type <span class="require">*</span></label>
									    <input type="text" class="form-control" id="enquirytype" name="enquirytype" pattern="^[a-zA-Z- .]+"  data-ng-model="enquirytype" required>
										<div class="error" data-ng-show="submitted || EnquiryForm.enquirytype.$dirty && EnquiryForm.enquirytype.$invalid">
											 <small class="error" data-ng-show="EnquiryForm.enquirytype.$error.required">Type is required.</small>
											<small class="error" data-ng-show="EnquiryForm.enquirytype.$error.pattern">Type is should be alphabetic.</small>
										</div> 
									</div>
									<div class="form-group col-md-4">
									    <label class="form-control-label">Enquiry</label>
									    <textarea name="editenquiry" id="editenquiry" class="form-control" data-ng-model="editenquiry">
										  
										</textarea>
										<div class="error" data-ng-show="submitted || EnquiryForm.editenquiry.$dirty && EnquiryForm.editenquiry.$invalid">
										<small class="error" data-ng-show="EnquiryForm.editenquiry.$error.required">Enquiry is required.</small>
									    </div>
									</div>
		                        </div>					
								
		                        <div class="form-row"> 
		                            <div class="form-group col-md-12">						
									   <button type="submit" class="btn btn-primary">Update</button>
									   <!--<button type="reset" class="btn btn-danger">Cancel</button>-->
									   <button type="submit" class="btn btn-info" data-ng-click="GotoEnquiryList()">Back to List</button>
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
    echo "<script language=\'javascript\'>window.location=\'index.php\';</script>";
}
?>