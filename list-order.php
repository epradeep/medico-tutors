<?php
error_reporting(0);
session_start();
if($_SESSION['UserId']!="")
{
   $uname = $_SESSION['Name'];
   include_once("CommonUtilities/Connections.php");
   include_once ("CommonUtilities/Functions.php");

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
          <section class="tables">   
            <div class="container-fluid">
              <div class="row">
                <div class="col-lg-12">
				    <div ng-show="ListOrders">
						<div class="card">
							<div class="card-close">
							  <div class="align-items-center">
								<a href="add-order.php" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> Add Order</a>
								<!--<button type="button" id="closeCard1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-ellipsis-v"></i></button>
								<div aria-labelledby="closeCard1" class="dropdown-menu dropdown-menu-right has-shadow"><a href="#" class="dropdown-item remove"> <i class="fa fa-times"></i>Close</a><a href="#" class="dropdown-item edit"> <i class="fa fa-gear"></i>Edit</a></div>-->
							  </div>
							</div>
							<div class="card-header d-flex align-items-center">
							  <h3 class="h4">List Orders</h3>
							</div>
							<div class="card-body"> 
								<div class="table-responsive">
									<table class="table table-bordered" data-ng-init="GetOrdersList()">
									  <thead>
										<tr>
										  <th>S.No</th>
										  <th>User Name</th>
										  <th>Course Name</th>
										  <th>Bank Name</th>
										  <th>Date of Transaction</th>
										  <th>Action</th>
										</tr>
									  </thead>
									  <tbody>
										<tr ng-repeat="order in OrderArray">
										  <td data-title="Sl.No">{{$index+1}}</td>
										  <td data-title="User Name">{{order.Username}}</td>
										  <td data-title="Course Name">{{order.CourseName}}</td>
										  <td data-title="Bank Name">{{order.BankName}}</td>
										  <td data-title="Date of Transaction">{{order.DateTransaction}}</td>
										  <td data-title="Action">
											<button type="button" class="btn btn-primary btn-xs" data-ng-click="EditOrder(order.PkId,order.CourseId,order.CourseName,order.Userid,order.Username,order.TransId,order.Cheque,order.AmountDeposited,order.BankName,order.Paymentthrough,order.DateTransaction)">
												<i class="fa fa-edit" aria-hidden="true"></i>
											</button>&nbsp;&nbsp;
											<button type="button" class="btn btn-danger btn-xs" data-ng-click="DeleteOrder(order.PkId)">
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
					<div ng-show="EditOrders">
						<div class="card">
							<div class="card-close">
							  <div>&nbsp;</div>
							</div>
							<div class="card-header d-flex align-items-center">
							  <h3 class="h4">Edit Order</h3>
							</div>
							<div class="card-body">
							   <form class="OrderForm" id="OrderForm" autocomplete="off" enctype="multipart/form-data" name="OrderForm" novalidate="" data-ng-submit="UpdateOrder(Update)">
							   	   <input type="hidden" ng-model="editpkid">
			                    	<div class="form-row">
			                    		<div class="form-group col-md-4">
										    <label class="form-control-label">Course Name <span class="require">*</span></label>
										    <select name="editcoursename" id="editcoursename" class="form-control" data-ng-model="editcoursename" convert-to-number required>
											  <option value="">Select Course Name</option> 
											  <option ng-repeat="course in CoursesArray" value="{{course.PkId}}">{{course.CourseName}}</option>
											</select>
											<div class="error" data-ng-show="submitted || OrderForm.editcoursename.$dirty && OrderForm.editcoursename.$invalid">
											<small class="error" data-ng-show="OrderForm.editcoursename.$error.required">Course Name is required.</small>
										    </div>
										</div>
										<div class="form-group col-md-4">
										    <label class="form-control-label">User Name <span class="require">*</span></label>
										    <select name="edituname" id="edituname" class="form-control" data-ng-model="edituname" convert-to-number required >
											  <option value="">Select User Name</option>
											  <option ng-repeat="user in UserArray" value="{{user.PkId}}">{{user.Name}}</option>
											</select>
											<div class="error" data-ng-show="submitted || OrderForm.edituname.$dirty && OrderForm.edituname.$invalid">
											<small class="error" data-ng-show="OrderForm.edituname.$error.required">User Name is required.</small>
										    </div>
										</div>
			                        	
										<div class="form-group col-md-4">
											<label class="form-control-label">Transaction ID <span class="require">*</span></label>
			                                <input type="text" class="form-control" id="edittransid" name="edittransid" mainlength="10" maxlength="30" data-ng-model="edittransid" data-ng-minlength="10" data-ng-maxlength="30" pattern="^[A-Za-z0-9]+$" required>
			          					    <div class="error" data-ng-show="submitted || OrderForm.edittransid.$dirty && OrderForm.edittransid.$invalid">
			          							<small class="error" data-ng-show="OrderForm.edittransid.$error.required">Transaction ID is required.</small>
			          							<small class="error" data-ng-show="OrderForm.edittransid.$error.minlength">Transaction ID required to be at least 10 characters</small>
			          							<small class="error" data-ng-show="OrderForm.edittransid.$error.maxlength">Transaction ID cannot be longer than 30 characters</small>
			          							<small class="error" data-ng-show="OrderForm.edittransid.$error.pattern">Transaction ID is should be alphanumeric.</small>
			          					    </div>
			                            </div>
                                    </div>
								    <div class="form-row">
			                            <div class="form-group col-md-4">
										   <label class="form-control-label">Cheque Number <span class="require">*</span></label>
											<input type="text" class="form-control" id="editcheque" name="editcheque" pattern="^[A-Za-z0-9]+$" data-ng-model="editcheque" maxlength="6" data-ng-maxlength="6" required>
											<div class="error" data-ng-show="submitted || OrderForm.editcheque.$dirty && OrderForm.editcheque.$invalid">
											 <small class="error" data-ng-show="OrderForm.editcheque.$error.required">Cheque Number is required.</small>
											 <small class="error" data-ng-show="OrderForm.editcheque.$error.maxlength">Cheque Number is should not be greater then 6 digits.</small>
											<small class="error" data-ng-show="OrderForm.editcheque.$error.pattern">Cheque Number is should be alphanumeric.</small>
										  </div>
										</div>

									    <div class="form-group col-md-4">
										    <label class="form-control-label">Date of Transaction (MM/DD/YYYY)<span class="require">*</span></label>
											<input type="text" id="editdatetransaction" name="editdatetransaction" class="form-control" data-ng-model="editdatetransaction" uib-datepicker-popup="MM/dd/yyyy" is-open="opened.opened1" ng-click="open($event,'opened1')" datepicker-options="EDT" required>
											<div class="error" data-ng-show="submitted || OrderForm.editdatetransaction.$dirty && OrderForm.editdatetransaction.$invalid">
											<small class="error" data-ng-show="OrderForm.editdatetransaction.$error.required">Date of Transaction is required.</small>
										    </div>
										</div>
			                       
										<div class="form-group col-md-4">
										    <label class="form-control-label">Amount Deposited <span class="require">*</span></label>
											<input type="text" class="form-control" id="editamountdeposited" name="editamountdeposited" data-ng-model="editamountdeposited" pattern="^[0-9]+" required="">
										   <div class="error" data-ng-show="submitted || OrderForm.editamountdeposited.$dirty && OrderForm.editamountdeposited.$invalid">
												<small class="error" data-ng-show="OrderForm.editamountdeposited.$error.required">Amount Deposited is required.</small>
												<small class="error" data-ng-show="OrderForm.editamountdeposited.$error.pattern">Amount Deposited should be numeric</small>
											</div>
										</div>
			                        </div>

			                        <div class="form-row">
			                            <div class="form-group col-md-4">
										   <label class="form-control-label">Bank Name <span class="require">*</span></label>
											<input type="text" class="form-control" id="editbankname" name="editbankname" pattern="^[a-zA-Z- .]+"  data-ng-model="editbankname" required>
											<div class="error" data-ng-show="submitted || OrderForm.editbankname.$dirty && OrderForm.editbankname.$invalid">
											 <small class="error" data-ng-show="OrderForm.editbankname.$error.required">Bank Name is required.</small>
											<small class="error" data-ng-show="OrderForm.editbankname.$error.pattern">Bank Name is should be alphabetic.</small>
										  </div>
										</div>	
										<div class="form-group col-md-4">
										   <label class="form-control-label">Payment Through <span class="require">*</span></label>
											<input type="text" class="form-control" id="editpaymentthrough" name="editpaymentthrough" pattern="^[a-zA-Z- .]+"  data-ng-model="editpaymentthrough" required>
											<div class="error" data-ng-show="submitted || OrderForm.editpaymentthrough.$dirty && OrderForm.editpaymentthrough.$invalid">
											 <small class="error" data-ng-show="OrderForm.editpaymentthrough.$error.required">Payment Through is required.</small>
											<small class="error" data-ng-show="OrderForm.editpaymentthrough.$error.pattern">Payment Through is should be alphabetic.</small>
										  </div>
										</div>						
			                        </div>

			                        <div class="form-row"> 
			                            <div class="form-group col-md-12">						
										   <button type="submit" class="btn btn-primary">Update</button>
										   <!--<button type="reset" class="btn btn-danger">Cancel</button>-->
										   <button type="submit" class="btn btn-info" data-ng-click="GotoOrderList()">Back to List</button>
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