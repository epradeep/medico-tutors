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
  <body data-ng-cloak data-ng-app="IPMVideoModule" data-ng-controller="IPMVideoController">
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
                <h2 class="no-margin-bottom">IPM Videos</h2>
            </div>
          </header>
          <!-- Breadcrumb-->
          <div class="breadcrumb-holder container-fluid">
            <ul class="breadcrumb">
              <li class="breadcrumb-item"><a href="welcome.php">Home</a></li>
              <li class="breadcrumb-item active">IPM Videos</li>
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
                      <h3 class="h4">Add IPM Video</h3>
                    </div>
                    <div class="card-body">
                      <p>&nbsp;</p>
                    <form class="IPMForm" id="IPMForm" autocomplete="off" enctype="multipart/form-data" name="IPMForm" novalidate="" data-ng-submit="VideoData(Video)">
                    	<div class="form-row">
                    		<div class="form-group col-md-4">
        							    <label class="form-control-label">Category Name <span class="require">*</span></label>
        							    <select name="categoryname" id="categoryname" class="form-control" data-ng-model="categoryname" required>
        								    <option value="">Select Category Name</option>
                            <option ng-repeat="category in CategoryArray" value="{{category.CategoryName}}">{{category.CategoryName}}</option>
        								  </select>
        								  <div class="error" data-ng-show="submitted || IPMForm.categoryname.$dirty && IPMForm.categoryname.$invalid">
        								    <small class="error" data-ng-show="IPMForm.categoryname.$error.required">Category Name is required.</small>
        							    </div>
        							</div>	
							        <div class="form-group col-md-4">
								        <label class="form-control-label">Video Name <span class="require">*</span></label>
                        <input type="text" class="form-control" id="videoname" name="videoname" data-ng-model="videoname" required>
          					    <div class="error" data-ng-show="submitted || IPMForm.videoname.$dirty && IPMForm.videoname.$invalid">
          							 <small class="error" data-ng-show="IPMForm.videoname.$error.required">Video Name is required.</small>
          					    </div>
                      </div>
                      <div class="form-group col-md-4">
          							<label class="form-control-label">Video Source <span class="require">*</span></label>
          							<textarea class="form-control" id="videosource" name="videosource" data-ng-model="videosource"></textarea>
          							<div class="error" data-ng-show="submitted || IPMForm.videosource.$dirty && IPMForm.videosource.$invalid">
          							 <small class="error" data-ng-show="IPMForm.videosource.$error.required">Video Source is required.</small>
          							</div>
          						</div>    
                    </div>

                    <div class="form-row">
                      <div class="form-group col-md-4">
        							   <label class="form-control-label">Duration(HH:mm:ss) <span class="require">*</span></label>
        								<input type="text" class="form-control" id="duration" name="duration" data-ng-model="duration" maxlength="8" data-ng-maxlength="8" required>
        								<div class="error" data-ng-show="submitted || IPMForm.duration.$dirty && IPMForm.duration.$invalid">
        								 <small class="error" data-ng-show="IPMForm.duration.$error.required">Duration is required.</small>
        							  </div>
        							</div>	
        							<div class="form-group col-md-4">
        							   <label class="form-control-label">Type <span class="require">*</span></label>
        								<input type="text" class="form-control" id="videotype" name="videotype" data-ng-model="videotype" required>
        								<div class="error" data-ng-show="submitted || IPMForm.videotype.$dirty && IPMForm.videotype.$invalid">
        								 <small class="error" data-ng-show="IPMForm.videotype.$error.required">Type is required.</small>
        							  </div>
        							</div>
        							<div class="form-group col-md-4">
        							   <label class="form-control-label">Batch <span class="require">*</span></label>
        								<input type="text" class="form-control" id="batch" name="batch" pattern="^[A-Za-z0-9]+$"  data-ng-model="batch" required>
        								<div class="error" data-ng-show="submitted || IPMForm.batch.$dirty && IPMForm.batch.$invalid">
        								 <small class="error" data-ng-show="IPMForm.batch.$error.required">Batch is required.</small>
        								<small class="error" data-ng-show="IPMForm.batch.$error.pattern">Batch is should be alphanumeric.</small>
        							  </div>
        							</div>												
                    </div>

                    <div class="form-row"> 
                        <div class="form-group col-md-12">						
          							  <button type="submit" class="btn btn-primary">Submit</button>
          							  <!--<button type="reset" class="btn btn-danger">Cancel</button>-->
          							  <button type="submit" class="btn btn-info" data-ng-click="GotoVideoList()">Back to List</button>
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