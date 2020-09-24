<?php
error_reporting(E_ALL);
session_start();
if($_SESSION['UserId']!="")
{ 

    $uname = $_SESSION['Name'];
    include_once("CommonUtilities/Connections.php");
    include_once "CommonUtilities/Functions.php";

?>
<!DOCTYPE html>
<html>
  <head>
    <?php include_once("title.php"); ?>
  </head>
  <body data-ng-cloak data-ng-app="WelcomeModule" data-ng-controller="WelcomeController" ng-init="GetDashboardData()">
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
              <h2 class="no-margin-bottom">Dashboard</h2>
            </div>
          </header>
          <!-- Dashboard Counts Section-->
          <section class="dashboard-counts no-padding-bottom">
            <div class="container-fluid">
              <div class="row bg-white has-shadow">
                <div class="col-xl-3 col-sm-6">
                  <div class="item d-flex align-items-center">
                    <div class="icon bg-violet"><i class="icon-interface-windows"></i></div>
                    <div class="title"><span>Total<br>Enrollments</span>
                      <!--<div class="progress">
                        <div role="progressbar" style="width: 25%; height: 4px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-violet"></div>
                      </div>-->
                    </div>
                    <div class="number"><strong>{{EnrollmentsCount}}</strong></div>
                  </div>
                </div>

                <div class="col-xl-3 col-sm-6">
                  <div class="item d-flex align-items-center">
                    <div class="icon bg-red"><i class="fa fa-question-circle"></i></div>
                    <div class="title"><span>Total<br>Enquires</span>
                      <!--<div class="progress">
                        <div role="progressbar" style="width: 70%; height: 4px;" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-red"></div>
                      </div>-->
                    </div>
                    <div class="number"><strong>{{EnquiresCount}}</strong></div>
                  </div>
                </div>
                
                <div class="col-xl-3 col-sm-6">
                  <div class="item d-flex align-items-center">
                    <div class="icon bg-green"><i class="fa fa-shopping-cart"></i></div>
                    <div class="title"><span>Total<br>Orders</span>
                      <!--<div class="progress">
                        <div role="progressbar" style="width: 40%; height: 4px;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-green"></div>
                      </div>-->
                    </div>
                    <div class="number"><strong>{{OrderesCount}}</strong></div>
                  </div>
                </div>
                
                <div class="col-xl-3 col-sm-6">
                  <div class="item d-flex align-items-center">
                    <div class="icon bg-orange"><i class="fa fa-file-video-o"></i></div>
                    <div class="title"><span>Total<br>IPM Videos</span>
                      <!--<div class="progress">
                        <div role="progressbar" style="width: 50%; height: 4px;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-orange"></div>
                      </div>-->
                    </div>
                    <div class="number"><strong>{{VideosCount}}</strong></div>
                  </div>
                </div>
              </div>
              <div class="clear">&nbsp;</div>
              <div class="row bg-white has-shadow">
                <div class="col-xl-3 col-sm-6">
                  <div class="item d-flex align-items-center">
                    <div class="icon bg-violet"><i class="fa fa-user"></i></div>
                    <div class="title"><span>Total<br>Users</span>
                      <!--<div class="progress">
                        <div role="progressbar" style="width: 25%; height: 4px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-violet"></div>
                      </div>-->
                    </div>
                    <div class="number"><strong>{{UsersCount}}</strong></div>
                  </div>
                </div>
              </div>



            </div>
          </section>
          <!-- Page Footer-->
          <?php include_once("footer.php"); ?>
  </body>
</html>
<?php
}
else
{ 
  echo "<script language=\"javascript\">window.location=\"index.php\";</script>";
}
?>