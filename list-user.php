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
  <body data-ng-cloak data-ng-app="UserModule" data-ng-controller="UserController">
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
              <h2 class="no-margin-bottom">Users</h2>
            </div>
          </header>
          <!-- Breadcrumb-->
          <div class="breadcrumb-holder container-fluid">
            <ul class="breadcrumb">
              <li class="breadcrumb-item"><a href="welcome.php">Home</a></li>
              <li class="breadcrumb-item active">Users</li>
            </ul>
          </div>
          <section class="tables">   
            <div class="container-fluid">
              <div class="row">
                <div class="col-lg-12">
				    <div ng-show="ListUser">
						<div class="card">
							<div class="card-close">
							  <div class="align-items-center">
								<a href="add-user.php" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> Add User</a>
								<!--<button type="button" id="closeCard1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-ellipsis-v"></i></button>
								<div aria-labelledby="closeCard1" class="dropdown-menu dropdown-menu-right has-shadow"><a href="#" class="dropdown-item remove"> <i class="fa fa-times"></i>Close</a><a href="#" class="dropdown-item edit"> <i class="fa fa-gear"></i>Edit</a></div>-->
							  </div>
							</div>
							<div class="card-header d-flex align-items-center">
							  <h3 class="h4">List Users</h3>
							</div>
							<div class="card-body"> 
								<div class="table-responsive">
									<table class="table table-bordered" data-ng-init="GetUserList()">
									  <thead>
										<tr>
										  <th>S.No</th>
										  <th>Full Name</th>
										  <th>Email-Id </th>
										  <th>Mobile-No</th>
										  <th>City</th>
										  <!--<th>Specialization</th>
										  <th>Course Interested</th>-->
										  <th>Date of Registered</th>
										  <th>Action</th>
										</tr>
									  </thead>
									  <tbody>
										<tr ng-repeat="user in UserArray">
										  <td data-title="Sl.No">{{$index+1}}</td>
										  <td data-title="Name">{{user.Name}}</td>
										  <td data-title="Email-Id">{{user.EmailId}}</td>
										  <td data-title="Mobile-No">{{user.MobileNo}}</td>
										  <td data-title="City">{{user.City}}</td>
										  <!--<td data-title="Specialization">{{user.Specialization}}</td>
										  <td data-title="Course Interested">{{user.Courseinterest}}</td>-->
										  <td data-title="Date of user">{{user.DateofRegistered}}</td>
										  <td data-title="Action">
											<button type="button" class="btn btn-primary btn-xs" data-ng-click="EditUser(user.PkId,user.Name,user.UserName,user.MobileNo,user.EmailId,user.Password,user.Specialization,user.City,user.Country,user.GraduationUname,user.GraduationDegree,user.GraduationYear,user.PgUname,user.PgDegree,user.Pgyear,user.DocOne,user.DocTwo,user.DocThree,user.DocFour,user.DocFive,user.DateofRegistered)">
												<i class="fa fa-edit" aria-hidden="true"></i>
											</button>&nbsp;&nbsp;
											<button type="button" class="btn btn-danger btn-xs" data-ng-click="DeleteUser(user.PkId)">
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
					<div ng-show="EditUsers">
						<div class="card">
							<div class="card-close">
							  <div>&nbsp;</div>
							</div>
							<div class="card-header d-flex align-items-center">
							  <h3 class="h4">Edit User</h3>
							</div>
							<div class="card-body">
								<form class="UserForm" id="UserForm" autocomplete="off" enctype="multipart/form-data" name="UserForm" novalidate="" data-ng-submit="UpdateUser(Update)">
									<input type="hidden" ng-model="edituserpkid" >
								    <div class="form-row">
			                            <div class="form-group col-md-4">
										   <label class="form-control-label">Full Name <span class="require">*</span></label>
											<input type="text" class="form-control" id="editfname" name="editfname" pattern="^[a-zA-Z- .]+" maxlength="50" data-ng-model="editfname" data-ng-minlength="3" data-ng-maxlength="50" required>
											<div class="error" data-ng-show="submitted || UserForm.editfname.$dirty && UserForm.editfname.$invalid">
											 <small class="error" data-ng-show="UserForm.editfname.$error.required">Full Name is required.</small>
											 <small class="error" data-ng-show="UserForm.editfname.$error.minlength">Full Name is should be at least 3 characters.</small>
											 <small class="error" data-ng-show="UserForm.editfname.$error.maxlength">Full Name is should not be greater then 50 characters.</small>
											<small class="error" data-ng-show="UserForm.editfname.$error.pattern">Full Name is should be alphabetic.</small>
										  </div>
										</div>
										<div class="form-group col-md-4">
										   <label class="form-control-label">User Name <span class="require">*</span></label>
											<input type="text" class="form-control" id="edituname" name="edituname" pattern="^[a-zA-Z- .]+" maxlength="50" data-ng-model="edituname" data-ng-minlength="3" data-ng-maxlength="50" required>
											<div class="error" data-ng-show="submitted || UserForm.edituname.$dirty && UserForm.edituname.$invalid">
											 <small class="error" data-ng-show="UserForm.edituname.$error.required">User Name is required.</small>
											 <small class="error" data-ng-show="UserForm.edituname.$error.minlength">User Name is should be at least 3 characters.</small>
											 <small class="error" data-ng-show="UserForm.edituname.$error.maxlength">User Name is should not be greater then 50 characters.</small>
											<small class="error" data-ng-show="UserForm.edituname.$error.pattern">User Name is should be alphabetic.</small>
										  </div>
										</div>

										<div class="form-group col-md-4">
										    <label class="form-control-label">Mobile-No <span class="require">*</span></label>
											<input type="tel" class="form-control" id="editmobileno" name="editmobileno" maxlength="10" data-ng-model="editmobileno" data-ng-minlength="10" data-ng-maxlength="10" data-ng-pattern="/^[0-9]*$/" required="">
										   <div class="error" data-ng-show="submitted || UserForm.editmobileno.$dirty && UserForm.editmobileno.$invalid">
												<small class="error" data-ng-show="UserForm.editmobileno.$error.required">Mobile No is required.</small>
												<small class="error" data-ng-show="UserForm.editmobileno.$error.minlength">Mobile No is required to be at least 10 digits</small>
												<small class="error" data-ng-show="UserForm.editmobileno.$error.maxlength">Mobile No cannot be longer than 10 digits</small>
												<small class="error" data-ng-show="UserForm.editmobileno.$error.pattern">Mobile No should be numeric</small>
											</div>
										</div>
			                        </div>

			                        <div class="form-row">
			                        	<div class="form-group col-md-4">
										    <label class="form-control-label">Email-Id <span class="require">*</span></label>
											<input type="email" id="editemailid" name="editemailid" class="form-control" pattern="^[_a-zA-Z0-9]+(\.[_a-zA-Z0-9]+)*@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*(\.[a-zA-Z]{2,4})$" data-ng-model="editemailid" required>
											<div class="error" data-ng-show="submitted || UserForm.editemailid.$dirty && UserForm.editemailid.$invalid">
												<small class="error" data-ng-show="UserForm.editemailid.$error.required">Email is required.</small>
												<small class="error" data-ng-show="UserForm.editemailid.$error.editemailid || UserForm.editemailid.$error.pattern">Invalid Email.</small>
										    </div>
										</div>
										<div class="form-group col-md-4">
											<label class="form-control-label">Password <span class="require">*</span></label>
			                                <input type="text" class="form-control" id="editpassword" name="editpassword" maxlength="20" data-ng-model="editpassword" data-ng-minlength="8" data-ng-maxlength="20" required>
			          					    <div class="error" data-ng-show="submitted || UserForm.editpassword.$dirty && UserForm.editpassword.$invalid">
			          							<small class="error" data-ng-show="UserForm.editpassword.$error.required">Password is required.</small>
			          							<small class="error" data-ng-show="UserForm.editpassword.$error.minlength">Password is required to be at least 8 characters</small>
			          							<small class="error" data-ng-show="UserForm.editpassword.$error.maxlength">Password cannot be longer than 20 characters</small>
			          					    </div>
			                            </div>
									    
			                            <div class="form-group col-md-4">
										    <label class="form-control-label">Specialization <span class="require">*</span></label>
										    <select name="editspecialization" id="editspecialization" class="form-control" data-ng-model="editspecialization" required>
											    <option value="">Select Specialization</option> 
											    <option ng-repeat="specialize in SpecializationArray" value="{{specialize}}">{{specialize}}</option>
											</select>
											<div class="error" data-ng-show="submitted || UserForm.editspecialization.$dirty && UserForm.editspecialization.$invalid">
											<small class="error" data-ng-show="UserForm.editspecialization.$error.required">Specialization is required.</small>
										    </div>
										</div>                  
			                        </div>	
			                        
			                        <div class="form-row">
			                            <div class="form-group col-md-4">
										   <label class="form-control-label">City <span class="require">*</span></label>
											<input type="text" class="form-control" id="editcity" name="editcity" pattern="^[a-zA-Z- .]+"  data-ng-model="editcity" required>
											<div class="error" data-ng-show="submitted || UserForm.editcity.$dirty && UserForm.editcity.$invalid">
											 <small class="error" data-ng-show="UserForm.editcity.$error.required">City is required.</small>
											<small class="error" data-ng-show="UserForm.editcity.$error.pattern">City is should be alphabetic.</small>
										  </div>
										</div>

										<div class="form-group col-md-4">
										    <label class="form-control-label">Country <span class="require">*</span></label>
										    <select name="editcountry" id="editcountry" class="form-control" data-ng-model="editcountry" required>
											    <option value="">Select Country</option> 
											    <option ng-repeat="country in CountryArray" value="{{country}}">{{country}}</option>
											</select>
											<div class="error" data-ng-show="submitted || UserForm.editcountry.$dirty && UserForm.editcountry.$invalid">
											    <small class="error" data-ng-show="UserForm.editcountry.$error.required">Country is required.</small>
										    </div>
										</div>
			                        </div>

			                        <h4>Graduation Details</h4>
			                        <div class="form-row">
			                        	<div class="form-group col-md-4">
										    <label class="form-control-label">University Name <span class="require">*</span></label>
										    <input type="text" class="form-control" id="editguname" name="editguname" pattern="^[a-zA-Z- .]+"  data-ng-model="editguname" required>
											<div class="error" data-ng-show="submitted || UserForm.editguname.$dirty && UserForm.editguname.$invalid">
												<small class="error" data-ng-show="UserForm.editguname.$error.required">University Name is required.</small>
												<small class="error" data-ng-show="UserForm.editguname.$error.pattern">University Name is should be alphabetic.</small>
											</div> 
										</div>
										<div class="form-group col-md-4">
										    <label class="form-control-label">Degree Name <span class="require">*</span></label>
										    <input type="text" class="form-control" id="editgdegreename" name="editgdegreename" pattern="^[a-zA-Z- .]+"  data-ng-model="editgdegreename" required>
											<div class="error" data-ng-show="submitted || UserForm.editgdegreename.$dirty && UserForm.editgdegreename.$invalid">
												 <small class="error" data-ng-show="UserForm.editgdegreename.$error.required">Degree Name is required.</small>
												<small class="error" data-ng-show="UserForm.editgdegreename.$error.pattern">Degree Name is should be alphabetic.</small>
											</div> 
										</div>
			                            
			                            <div class="form-group col-md-4">
			                                <label class="form-control-label">Graduation Year <span class="require">*</span></label>
										    <select id="editgraduationyear" class="form-control" name="editgraduationyear" data-ng-model="editgraduationyear" required>
										    	<option ng-repeat="year in years(1970,2020)" value="{{year}}">{{year}}</option>
											</select>
											<div class="error" data-ng-show="submitted || UserForm.editgraduationyear.$dirty && UserForm.editgraduationyear.$invalid">
											    <small class="error" data-ng-show="UserForm.editgraduationyear.$error.required">Graduation Year is required.</small>
										    </div>
			                            </div>
			                           </div>
			                            <h4>Post Graduation Details</h4>
				                        <div class="form-row">
				                        	<div class="form-group col-md-4">
											    <label class="form-control-label">University Name <span class="require">*</span></label>
											    <input type="text" class="form-control" id="editpguname" name="editpguname" pattern="^[a-zA-Z- .]+"  data-ng-model="editpguname" required>
												<div class="error" data-ng-show="submitted || UserForm.editpguname.$dirty && UserForm.editpguname.$invalid">
													<small class="error" data-ng-show="UserForm.editpguname.$error.required">University Name is required.</small>
													<small class="error" data-ng-show="UserForm.editpguname.$error.pattern">University Name is should be alphabetic.</small>
												</div> 
											</div>
											<div class="form-group col-md-4">
											    <label class="form-control-label">Degree Name <span class="require">*</span></label>
											    <input type="text" class="form-control" id="editpgdname" name="editpgdname" pattern="^[a-zA-Z- .]+"  data-ng-model="editpgdname" required>
												<div class="error" data-ng-show="submitted || UserForm.editpgdname.$dirty && UserForm.editpgdname.$invalid">
													<small class="error" data-ng-show="UserForm.editpgdname.$error.required">Degree Name is required.</small>
													<small class="error" data-ng-show="UserForm.editpgdname.$error.pattern">Degree Name is should be alphabetic.</small>
												</div> 
											</div>
				                            
				                            <div class="form-group col-md-4">
				                                <label class="form-control-label">Graduation Year <span class="require">*</span></label>
											    <select id="editpgyear" class="form-control" name="editpgyear" data-ng-model="editpgyear" required>
											    	<option value="">Select Year</option> 
												    <option ng-repeat="year in years(1970,2020)" value="{{year}}">{{year}}</option>
												</select>
												<div class="error" data-ng-show="submitted || UserForm.editpgyear.$dirty && UserForm.editpgyear.$invalid">
												    <small class="error" data-ng-show="UserForm.editpgyear.$error.required">PG Year is required.</small>
											    </div>
				                            </div>
				                        </div>
			                            <div class="form-row"> 
			                                <div class="form-group col-md-4">
			                                   <label class="form-control-label">Certificate One</label>
										        <input type="file" class="form-control-file" id="editdocone" accept="application/msword, text/plain, application/pdf, image/*" name="editdocone" file-model="editdocone">
			                                </div>
			                                <div class="form-group col-md-4">
			                                   <label class="form-control-label">Certificate Two</label>
										        <input type="file" class="form-control-file" id="editdoctwo" accept="application/msword,text/plain, application/pdf, image/*" name="editdoctwo" file-model="editdoctwo">
			                                </div>
			                                <div class="form-group col-md-4">
			                                   <label class="form-control-label">Certificate Three</label>
										        <input type="file" class="form-control-file" id="editdocthree" accept="application/msword, text/plain, application/pdf, image/*" name="editdocthree" file-model="editdocthree">
			                                </div>
			                            </div>
			                            <div class="form-row"> 
			                                <div class="form-group col-md-4">
			                                   <label class="form-control-label">Certificate Four</label>
										        <input type="file" class="form-control-file" id="editdocfour" accept="application/msword, text/plain, application/pdf, image/*" name="editdocfour" file-model="editdocfour">
			                                </div>
			                                <div class="form-group col-md-4">
			                                   <label class="form-control-label">Certificate Five</label>
										        <input type="file" class="form-control-file" id="editdocfive" accept="application/msword, text/plain, application/pdf, image/*" name="editdocfive" file-model="editdocfive">
			                                </div>
			                            </div>

			                            <div class="form-row">
			                               <div class="form-group col-md-4" ng-if="editdocone!=''">
			                               	    <label class="form-control-label">Download Certificate One</label>
                                                <p><a href="Files/{{editdocone}}" target="_blank">{{editdocone}}</a></p>
			                               </div> 
			                               <div class="form-group col-md-4" ng-if="editdocone!=''">
			                               	    <label class="form-control-label">Download Certificate Two</label>
                                                <p><a href="Files/{{editdoctwo}}">{{editdoctwo}}</a></p>
			                               </div> 
			                               <div class="form-group col-md-4" ng-if="editdocone!=''">
			                               	    <label class="form-control-label">Download Certificate Three</label>
                                                <p><a href="Files/{{editdocthree}}" target="_blank">{{editdocthree}}</a></p>
			                               </div> 
			                            </div>
			                            <div class="form-row">
			                               <div class="form-group col-md-4" ng-if="editdocone!=''">
			                               	    <label class="form-control-label">Download Certificate Four</label>
                                                <p><a href="Files/{{editdocfour}}" target="_blank">{{editdocfour}}</a></p>
			                               </div> 
			                               <div class="form-group col-md-4" ng-if="editdocone!=''">
			                               	    <label class="form-control-label">Download Certificate Five</label>
                                                <p><a href="Files/{{editdocfive}}" target="_blank">{{editdocfive}}</a></p>
			                               </div> 
			                            </div>


				                        <div class="form-row"> 
				                            <div class="form-group col-md-12">						
											   <button type="submit" class="btn btn-primary">Update</button>
											   <!--<button type="reset" class="btn btn-danger">Cancel</button>-->
											    <button type="submit" class="btn btn-info" data-ng-click="GotoUserList()">Back to List</button>
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