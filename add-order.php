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
  <body data-ng-cloak data-ng-app="OrderModule" data-ng-controller="OrderController" ng-init="GetUserList()">
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
                <h2 class="no-margin-bottom">Orders</h2>
            </div>
          </header>
          <!-- Breadcrumb-->
          <div class="breadcrumb-holder container-fluid">
            <ul class="breadcrumb">
              <li class="breadcrumb-item"><a href="welcome.php">Home</a></li>
              <li class="breadcrumb-item active">Orders</li>
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
                      <h3 class="h4">Add Order</h3>
                    </div>
                    <div class="card-body">
                      <p>&nbsp;</p>
                    <form class="OrderForm" id="OrderForm" autocomplete="off" enctype="multipart/form-data" name="OrderForm" novalidate="" data-ng-submit="OrderData(Order)">

                    	<div class="form-row">
                    		<div class="form-group col-md-4">
							    <label class="form-control-label">Course Name <span class="require">*</span></label>
							    <select name="coursename" id="coursename" class="form-control" data-ng-model="coursename" required>
								  <option value="">Select Course Name</option> 
								  <option ng-repeat="course in CoursesArray" value="{{course.PkId}}">{{course.CourseName}}</option>
								  <!--<option value="Basic Pain Management for Doctors">Basic Pain Management for Doctors</option>
								  <option value="Advanced Pain Management for Doctors">Advanced Pain Management for Doctors</option>
								  <option value="Principles of Pain Management for Nurses">Principles of Pain Management for Nurses</option>
                                  <option value="Interventional Pain Management">Interventional Pain Management</option>-->
								</select>
								<div class="error" data-ng-show="submitted || OrderForm.coursename.$dirty && OrderForm.coursename.$invalid">
								<small class="error" data-ng-show="OrderForm.coursename.$error.required">Course Name is required.</small>
							    </div>
							</div>
							<div class="form-group col-md-4">
							    <label class="form-control-label">User Name <span class="require">*</span></label>
							    <select name="username" id="username" class="form-control" data-ng-model="username" required>
								  <option value="">Select User Name</option>
								  <option ng-repeat="user in UserArray" value="{{user.PkId}}">{{user.Name}}</option>
								</select>
								<div class="error" data-ng-show="submitted || OrderForm.username.$dirty && OrderForm.username.$invalid">
								<small class="error" data-ng-show="OrderForm.username.$error.required">User Name is required.</small>
							    </div>
							</div>
                        	
							<div class="form-group col-md-4">
								<label class="form-control-label">Transaction ID <span class="require">*</span></label>
                                <input type="text" class="form-control" id="transactionid" name="transactionid" mainlength="10" maxlength="30" data-ng-model="transactionid" data-ng-minlength="10" data-ng-maxlength="30" pattern="^[A-Za-z0-9]+$" required>
          					    <div class="error" data-ng-show="submitted || OrderForm.transactionid.$dirty && OrderForm.transactionid.$invalid">
          							<small class="error" data-ng-show="OrderForm.transactionid.$error.required">Transaction ID is required.</small>
          							<small class="error" data-ng-show="OrderForm.transactionid.$error.minlength">Transaction ID required to be at least 10 characters</small>
          							<small class="error" data-ng-show="OrderForm.transactionid.$error.maxlength">Transaction ID cannot be longer than 30 characters</small>
          							<small class="error" data-ng-show="OrderForm.transactionid.$error.pattern">Transaction ID is should be alphanumeric.</small>
          					    </div>
                            </div>                
                        </div>
					    <div class="form-row">
                            <div class="form-group col-md-4">
							   <label class="form-control-label">Cheque Number <span class="require">*</span></label>
								<input type="text" class="form-control" id="chequenumber" name="chequenumber" pattern="^[A-Za-z0-9]+$" data-ng-model="chequenumber" maxlength="6" data-ng-maxlength="6" required>
								<div class="error" data-ng-show="submitted || OrderForm.chequenumber.$dirty && OrderForm.chequenumber.$invalid">
								 <small class="error" data-ng-show="OrderForm.chequenumber.$error.required">Cheque Number is required.</small>
								 <small class="error" data-ng-show="OrderForm.chequenumber.$error.maxlength">Cheque Number is should not be greater then 6 digits.</small>
								<small class="error" data-ng-show="OrderForm.chequenumber.$error.pattern">Cheque Number is should be alphanumeric.</small>
							  </div>
							</div>

						    <div class="form-group col-md-4">
							    <label class="form-control-label">Date of Transaction (MM/DD/YYYY)<span class="require">*</span></label>
								<input type="text" id="transactiondate" name="transactiondate" class="form-control" data-ng-model="transactiondate" uib-datepicker-popup="MM/dd/yyyy" is-open="opened.opened1" ng-click="open($event,'opened1')" datepicker-options="EDT" required>
								<div class="error" data-ng-show="submitted || OrderForm.transactiondate.$dirty && OrderForm.transactiondate.$invalid">
								<small class="error" data-ng-show="OrderForm.transactiondate.$error.required">Date of Transaction is required.</small>
							    </div>
							</div>
                       
							<div class="form-group col-md-4">
							    <label class="form-control-label">Amount Deposited <span class="require">*</span></label>
							<input type="text" class="form-control" id="amountdeposited" name="amountdeposited" data-ng-model="amountdeposited" pattern="^[0-9]+" required="">
							   <div class="error" data-ng-show="submitted || OrderForm.amountdeposited.$dirty && OrderForm.amountdeposited.$invalid">
									<small class="error" data-ng-show="OrderForm.amountdeposited.$error.required">Amount Deposited is required.</small>
									<small class="error" data-ng-show="OrderForm.amountdeposited.$error.pattern">Amount Deposited should be numeric</small>
								</div>
							</div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-4">
							   <label class="form-control-label">Bank Name <span class="require">*</span></label>
								<input type="text" class="form-control" id="bankname" name="bankname" pattern="^[a-zA-Z- .]+"  data-ng-model="bankname" required>
								<div class="error" data-ng-show="submitted || OrderForm.bankname.$dirty && OrderForm.bankname.$invalid">
								 <small class="error" data-ng-show="OrderForm.bankname.$error.required">Bank Name is required.</small>
								<small class="error" data-ng-show="OrderForm.bankname.$error.pattern">Bank Name is should be alphabetic.</small>
							  </div>
							</div>	
							<div class="form-group col-md-4">
							   <label class="form-control-label">Payment Through <span class="require">*</span></label>
								<input type="text" class="form-control" id="paymentthrough" name="paymentthrough" pattern="^[a-zA-Z- .]+"  data-ng-model="paymentthrough" required>
								<div class="error" data-ng-show="submitted || OrderForm.paymentthrough.$dirty && OrderForm.paymentthrough.$invalid">
								 <small class="error" data-ng-show="OrderForm.paymentthrough.$error.required">Payment Through is required.</small>
								<small class="error" data-ng-show="OrderForm.paymentthrough.$error.pattern">Payment Through is should be alphabetic.</small>
							  </div>
							</div>						
                        </div>

                        <div class="form-row"> 
                            <div class="form-group col-md-12">						
							    <button type="submit" class="btn btn-primary">Submit</button>
							    <button type="reset" class="btn btn-danger">Cancel</button>
							    <button type="submit" class="btn btn-info" data-ng-click="GotoOrderList()">Back</button>
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