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
          <section class="tables">   
            <div class="container-fluid">
              <div class="row">
                <div class="col-lg-12">
      				    <div ng-show="ListVideos">
      						<div class="card">
      							<div class="card-close">
      							  <div class="align-items-center">
      								<a href="add-ipm-video.php" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> Add IPM Video</a>
      								<!--<button type="button" id="closeCard1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-ellipsis-v"></i></button>
      								<div aria-labelledby="closeCard1" class="dropdown-menu dropdown-menu-right has-shadow"><a href="#" class="dropdown-item remove"> <i class="fa fa-times"></i>Close</a><a href="#" class="dropdown-item edit"> <i class="fa fa-gear"></i>Edit</a></div>-->
      							  </div>
      							</div>
      							<div class="card-header d-flex align-items-center">
      							  <h3 class="h4">List IPM Videos</h3>
      							</div>
      							<div class="card-body"> 
      								<div class="table-responsive">
      									<table class="table table-bordered" data-ng-init="GetVideosList()">
      									  <thead>
      										<tr>
      										  <th>S.No</th>
      										  <th>Category Name</th>
      										  <th>Video Name</th>
      										  <th>Type</th>
      										  <th>Batch</th>
      										  <th>Action</th>
      										</tr>
      									  </thead>
      									  <tbody>
      										<tr ng-repeat="Video in VideosArray">
      										  <td data-title="Sl.No">{{$index+1}}</td>
      										  <td data-title="Category Name">{{Video.CategoryName}}</td>
      										  <td data-title="Video Name">{{Video.VideoName}}</td>
      										  <td data-title="Type">{{Video.Type}}</td>
      										  <td data-title="Batch">{{Video.Batch}}</td>
      										  <td data-title="Action">
      											<button type="button" class="btn btn-primary btn-xs" data-ng-click="EditVideo(Video.PkId,Video.CategoryName,Video.VideoName,Video.VideoSource,Video.Duration,Video.Type,Video.Batch)">
      												<i class="fa fa-edit" aria-hidden="true"></i>
      											</button>&nbsp;&nbsp;
      											<button type="button" class="btn btn-danger btn-xs" data-ng-click="DeleteVideo(Video.PkId)">
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
      					<!--Edit Video-->
      					<div ng-show="EditVideos">
      						<div class="card">
      							<div class="card-close">
      							  <div>&nbsp;</div>
      							</div>
      							<div class="card-header d-flex align-items-center">
      							  <h3 class="h4">Edit Video</h3>
      							</div>
      							<div class="card-body">
      							  <form class="IPMForm" id="IPMForm" autocomplete="off" enctype="multipart/form-data" name="IPMForm" novalidate="" data-ng-submit="UpdateData(Update)">
                        <input type="hidden" ng-model="ipmpkid">
      		              <div class="form-row">
      		                  <div class="form-group col-md-4">
              							    <label class="form-control-label">Category Name <span class="require">*</span></label>
              							    <select name="editcategoryname" id="editcategoryname" class="form-control" data-ng-model="editcategoryname" required>
              								  <option value="">Select Category Name</option>
                                <option ng-repeat="category in CategoryArray" value="{{category.CategoryName}}">{{category.CategoryName}}</option>
              								</select>
              								<div class="error" data-ng-show="submitted || IPMForm.categoryname.$dirty && IPMForm.categoryname.$invalid">
              								  <small class="error" data-ng-show="IPMForm.categoryname.$error.required">Category Name is required.</small>
              							 </div>
              							</div>
      		                        	
          									<div class="form-group col-md-4">
          										  <label class="form-control-label">Video Name <span class="require">*</span></label>
          		                  <input type="text" class="form-control" id="editvideoname" name="editvideoname" data-ng-model="editvideoname" required>
                  					    <div class="error" data-ng-show="submitted || IPMForm.editvideoname.$dirty && IPMForm.editvideoname.$invalid">
                  							   <small class="error" data-ng-show="IPMForm.editvideoname.$error.required">Video Name is required.</small>
                  					    </div>
          		              </div>

      		                  <div class="form-group col-md-4">
                							<label class="form-control-label">Video Source <span class="require">*</span></label>
                							<textarea class="form-control" id="editvideosource" name="editvideosource" data-ng-model="editvideosource"></textarea>
                							<div class="error" data-ng-show="submitted || IPMForm.editvideosource.$dirty && IPMForm.editvideosource.$invalid">
                								<small class="error" data-ng-show="IPMForm.editvideosource.$error.required">Video Source is required.</small>
                							    </div>
                						  </div>    
      		                  </div>

      		                  <div class="form-row">
      		                    <div class="form-group col-md-4">
                							  <label class="form-control-label">Duration(HH:mm:ss) <span class="require">*</span></label>
                								<input type="text" class="form-control" id="editduration" name="editduration" data-ng-model="editduration" maxlength="8" data-ng-maxlength="8" required>
                								<div class="error" data-ng-show="submitted || IPMForm.editduration.$dirty && IPMForm.editduration.$invalid">
                								 <small class="error" data-ng-show="IPMForm.editduration.$error.required">Duration is required.</small>
                							  </div>
                							</div>	
                							<div class="form-group col-md-4">
                							   <label class="form-control-label">Type <span class="require">*</span></label>
                								<input type="text" class="form-control" id="edittype" name="edittype" data-ng-model="edittype" required>
                								<div class="error" data-ng-show="submitted || IPMForm.edittype.$dirty && IPMForm.edittype.$invalid">
                								 <small class="error" data-ng-show="IPMForm.edittype.$error.required">Type is required.</small>
                							  </div>
                							</div>
                							<div class="form-group col-md-4">
                							   <label class="form-control-label">Batch <span class="require">*</span></label>
                								<input type="text" class="form-control" id="editbatch" name="editbatch" pattern="^[A-Za-z0-9]+$"  data-ng-model="editbatch" required>
                								<div class="error" data-ng-show="submitted || IPMForm.editbatch.$dirty && IPMForm.editbatch.$invalid">
                								 <small class="error" data-ng-show="IPMForm.editbatch.$error.required">Batch is required.</small>
                								<small class="error" data-ng-show="IPMForm.editbatch.$error.pattern">Batch is should be alphanumeric.</small>
                							  </div>
                							</div>												
      		                  </div>
                            
      		                  <div class="form-row"> 
      		                    <div class="form-group col-md-12">						
                							  <button type="submit" class="btn btn-primary">Update</button>
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