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
                      <h3 class="h4">Add User</h3>
                    </div>
                    <div class="card-body">
                      <p>&nbsp;</p>
                    <form class="UserForm" id="UserForm" autocomplete="off" enctype="multipart/form-data" name="UserForm" novalidate="" data-ng-submit="UserData(User)">
					    <div class="form-row">
                            <div class="form-group col-md-4">
							    <label class="form-control-label">Full Name <span class="require">*</span></label>
  								<input type="text" class="form-control" id="fullname" name="fullname" pattern="^[a-zA-Z- .]+" maxlength="50" data-ng-model="fullname" data-ng-minlength="3" data-ng-maxlength="50" required>
  								<div class="error" data-ng-show="submitted || UserForm.fullname.$dirty && UserForm.fullname.$invalid">
  								 <small class="error" data-ng-show="UserForm.fullname.$error.required">Full Name is required.</small>
  								 <small class="error" data-ng-show="UserForm.fullname.$error.minlength">Full Name is should be at least 3 characters.</small>
  								 <small class="error" data-ng-show="UserForm.fullname.$error.maxlength">Full Name is should not be greater then 50 characters.</small>
  								<small class="error" data-ng-show="UserForm.fullname.$error.pattern">Full Name is should be alphabetic.</small>
  							  </div>
							</div>
  							<div class="form-group col-md-4">
  							    <label class="form-control-label">User Name <span class="require">*</span></label>
    								<input type="text" class="form-control" id="username" name="username" pattern="^[a-zA-Z- .]+" maxlength="50" data-ng-model="username" data-ng-minlength="3" data-ng-maxlength="50" required>
    								<div class="error" data-ng-show="submitted || UserForm.username.$dirty && UserForm.username.$invalid">
    								 <small class="error" data-ng-show="UserForm.username.$error.required">User Name is required.</small>
    								 <small class="error" data-ng-show="UserForm.username.$error.minlength">User Name is should be at least 3 characters.</small>
    								 <small class="error" data-ng-show="UserForm.username.$error.maxlength">User Name is should not be greater then 50 characters.</small>
    								<small class="error" data-ng-show="UserForm.username.$error.pattern">User Name is should be alphabetic.</small>
    							  </div>
  							</div>

  							<div class="form-group col-md-4">
  							    <label class="form-control-label">Mobile-No <span class="require">*</span></label>
  								<input type="tel" class="form-control" id="mobileno" name="mobileno" maxlength="10" data-ng-model="mobileno" data-ng-minlength="10" data-ng-maxlength="10" data-ng-pattern="/^[0-9]*$/" required="">
  							   <div class="error" data-ng-show="submitted || UserForm.mobileno.$dirty && UserForm.mobileno.$invalid">
  									<small class="error" data-ng-show="UserForm.mobileno.$error.required">Mobile No is required.</small>
  									<small class="error" data-ng-show="UserForm.mobileno.$error.minlength">Mobile No is required to be at least 10 digits</small>
  									<small class="error" data-ng-show="UserForm.mobileno.$error.maxlength">Mobile No cannot be longer than 10 digits</small>
  									<small class="error" data-ng-show="UserForm.mobileno.$error.pattern">Mobile No should be numeric</small>
  								</div>
  							</div>
              </div>

		          <div class="form-row">
		              <div class="form-group col-md-4">
						        <label class="form-control-label">Email-Id <span class="require">*</span></label>
								    <input type="email" id="emailid" name="emailid" class="form-control" pattern="^[_a-zA-Z0-9]+(\.[_a-zA-Z0-9]+)*@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*(\.[a-zA-Z]{2,4})$" data-ng-model="emailid" required>
    								<div class="error" data-ng-show="submitted || UserForm.emailid.$dirty && UserForm.emailid.$invalid">
    									<small class="error" data-ng-show="UserForm.emailid.$error.required">Email is required.</small>
    									<small class="error" data-ng-show="UserForm.emailid.$error.email || UserForm.emailid.$error.pattern">Invalid Email.</small>
    							  </div>
						    </div>
							<div class="form-group col-md-4">
								<label class="form-control-label">Password <span class="require">*</span></label>
		                        <input type="password" class="form-control" id="password" name="password" maxlength="20" data-ng-model="password" data-ng-minlength="8" data-ng-maxlength="20" required>
          					    <div class="error" data-ng-show="submitted || UserForm.password.$dirty && UserForm.password.$invalid">
          							<small class="error" data-ng-show="UserForm.password.$error.required">Password is required.</small>
          							<small class="error" data-ng-show="UserForm.password.$error.minlength">Password is required to be at least 8 characters</small>
          							<small class="error" data-ng-show="UserForm.password.$error.maxlength">Password cannot be longer than 20 characters</small>
          					    </div>
		                    </div>
								    
		                    <div class="form-group col-md-4">
  							    <label class="form-control-label">Specialization <span class="require">*</span></label>
  							    <select name="specialization" id="specialization" class="form-control" data-ng-model="specialization" required>
  								    <option value="">Select Specialization</option> 
  								    <option ng-repeat="specialize in SpecializationArray" value="{{specialize}}">{{specialize}}</option>
  								</select>
  								<div class="error" data-ng-show="submitted || UserForm.specialization.$dirty && UserForm.specialization.$invalid">
  								  <small class="error" data-ng-show="UserForm.specialization.$error.required">Specialization is required.</small>
  							    </div>
						    </div>                  
		                </div>	

                        <div class="form-row">
                            <div class="form-group col-md-4">
							    <label class="form-control-label">City <span class="require">*</span></label>
								<input type="text" class="form-control" id="city" name="city" pattern="^[a-zA-Z- .]+"  data-ng-model="city" required>
								<div class="error" data-ng-show="submitted || UserForm.city.$dirty && UserForm.city.$invalid">
								    <small class="error" data-ng-show="UserForm.city.$error.required">City is required.</small>
								    <small class="error" data-ng-show="UserForm.city.$error.pattern">City is should be alphabetic.</small>
						        </div>
						    </div>
  							<div class="form-group col-md-4">
  							    <label class="form-control-label">Country <span class="require">*</span></label>
  							    <select name="country" id="country" class="form-control" data-ng-model="country" required>
  								    <option value="">Select Country</option> 
  								    <option ng-repeat="country in CountryArray" value="{{country}}">{{country}}</option>
  								</select>
  								<div class="error" data-ng-show="submitted || UserForm.country.$dirty && UserForm.country.$invalid">
  								    <small class="error" data-ng-show="UserForm.country.$error.required">Country is required.</small>
  							    </div>
  							</div>
                        </div>

                       <h4>Graduation Details</h4>
                        <div class="form-row">
                            <div class="form-group col-md-4">
							    <label class="form-control-label">University Name <span class="require">*</span></label>
							    <input type="text" class="form-control" id="guname" name="guname" pattern="^[a-zA-Z- .]+"  data-ng-model="guname" required>
								  <div class="error" data-ng-show="submitted || UserForm.guname.$dirty && UserForm.guname.$invalid">
									<small class="error" data-ng-show="UserForm.guname.$error.required">University Name is required.</small>
									<small class="error" data-ng-show="UserForm.guname.$error.pattern">University Name is should be alphabetic.</small>
								  </div> 
						    </div>
							<div class="form-group col-md-4">
							    <label class="form-control-label">Degree Name <span class="require">*</span></label>
							    <input type="text" class="form-control" id="gdegreename" name="gdegreename" pattern="^[a-zA-Z- .]+"  data-ng-model="gdegreename" required>
								<div class="error" data-ng-show="submitted || UserForm.gdegreename.$dirty && UserForm.gdegreename.$invalid">
									 <small class="error" data-ng-show="UserForm.gdegreename.$error.required">Degree Name is required.</small>
									<small class="error" data-ng-show="UserForm.gdegreename.$error.pattern">Degree Name is should be alphabetic.</small>
								</div> 
							</div>
                            <div class="form-group col-md-4">
                                <label class="form-control-label">Graduation Year <span class="require">*</span></label>
  							    <select id="graduationyear" class="form-control" name="graduationyear" data-ng-model="graduationyear" required>
  							    	<option value="">Select Year</option>
  								    <option ng-repeat="year in years(1970,2020)" value="{{year}}">{{year}}</option>
  								  </select>
  								<div class="error" data-ng-show="submitted || UserForm.graduationyear.$dirty && UserForm.graduationyear.$invalid">
  								    <small class="error" data-ng-show="UserForm.graduationyear.$error.required">Graduation Year is required.</small>
  							  </div>
                            </div>
                        </div>
                        <h4>Post Graduation Details</h4>
	                    <div class="form-row">
  	                    <div class="form-group col-md-4">
						    <label class="form-control-label">University Name <span class="require">*</span></label>
						    <input type="text" class="form-control" id="pguname" name="pguname" pattern="^[a-zA-Z- .]+"  data-ng-model="pguname" required>
							<div class="error" data-ng-show="submitted || UserForm.pguname.$dirty && UserForm.pguname.$invalid">
								<small class="error" data-ng-show="UserForm.pguname.$error.required">University Name is required.</small>
								<small class="error" data-ng-show="UserForm.pguname.$error.pattern">University Name is should be alphabetic.</small>
							</div> 
						</div>
						<div class="form-group col-md-4">
						    <label class="form-control-label">Degree Name <span class="require">*</span></label>
						    <input type="text" class="form-control" id="pgdname" name="pgdname" pattern="^[a-zA-Z- .]+"  data-ng-model="pgdname" required>
							<div class="error" data-ng-show="submitted || UserForm.pgdname.$dirty && UserForm.pgdname.$invalid">
								<small class="error" data-ng-show="UserForm.pgdname.$error.required">Degree Name is required.</small>
								<small class="error" data-ng-show="UserForm.pgdname.$error.pattern">Degree Name is should be alphabetic.</small>
							</div> 
						</div>    
	                    <div class="form-group col-md-4">
	                        <label class="form-control-label">Graduation Year <span class="require">*</span></label>
        					<select id="pgyear" class="form-control" name="pgyear" data-ng-model="pgyear" required>
                                <option ng-repeat="year in years(1970,2020)" value="{{year}}">{{year}}</option>
							</select>
							<div class="error" data-ng-show="submitted || UserForm.pgyear.$dirty && UserForm.pgyear.$invalid">
								<small class="error" data-ng-show="UserForm.pgyear.$error.required">PG Year is required.</small>
							</div>
	                    </div>
	                </div>

                    <div class="form-row"> 
                        <div class="form-group col-md-4">
                             <label class="form-control-label">Certificate One</label>
				            <input type="file" class="form-control-file" id="certificateone" accept="application/msword,text/plain, application/pdf, image/*" name="certificateone" file-model="certificateone" required="">
                        </div>
                        <div class="form-group col-md-4">
                            <label class="form-control-label">Certificate Two</label>
				            <input type="file" class="form-control-file" id="certificatetwo" accept="application/msword, text/plain, application/pdf, image/*" name="certificatetwo" file-model="certificatetwo" required="">
                        </div>
                        <div class="form-group col-md-4">
                            <label class="form-control-label">Certificate Three</label>
				            <input type="file" class="form-control-file" id="certificatethree" accept="application/msword, text/plain, application/pdf, image/*" name="certificatethree" file-model="certificatethree" required="">
                        </div>
                    </div>
                    <div class="form-row"> 
                        <div class="form-group col-md-4">
                            <label class="form-control-label">Certificate Four</label>
				            <input type="file" class="form-control-file" id="certificatefour" accept="application/msword, text/plain, application/pdf, image/*" name="certificatefour" file-model="certificatefour" required="">
                        </div>
                        <div class="form-group col-md-4">
                            <label class="form-control-label">Certificate Five</label>
				            <input type="file" class="form-control-file" id="certificatefive" accept="application/msword, text/plain, application/pdf, image/*" name="certificatefive" file-model="certificatefive" required="">
                        </div>
                    </div>

	                <div class="form-row"> 
	                    <div class="form-group col-md-12">						
							<button type="submit" class="btn btn-primary">Submit</button>
							<button type="reset" class="btn btn-danger">Cancel</button>
							<button type="submit" class="btn btn-info" data-ng-click="GotoUserList()">Back</button>
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