var Video = angular.module("IPMVideoModule", ['ui.bootstrap'])
Video.controller("IPMVideoController", function ($scope, $timeout, $http, jsonFilter, $window)
{
	$scope.showWarningAlert = false;	
	$scope.showSuccessAlert = false;
	$scope.ListVideos = true;
	$scope.EditVideos = false;


	$(document).ready(function() {
		
		$("#enrolldate").keypress(function (event) { event.preventDefault(); });
		$("#enrolldate").keydown(function (event) { event.preventDefault(); });
    
    });
	
		
	var logResult = function (data, status, headers, config)
	{
		return data;
	};


	$scope.opened = {};
    $scope.opened.opened1 = false;
    //$scope.opened.opened2 = false;
    //$scope.opened.opened3 = false;
    //$scope.opened.sal = false; 

    $scope.open = function($event,datepicker) {
      //alert();
      $event.preventDefault();
      $event.stopPropagation();
      $scope.opened[datepicker] = true;
    };
	
	var date = new Date();

	$scope.EDT = {
      // dateDisabled: myDisabledDates,
        formatYear: 'y',
        maxDate: new Date(),
        minDate: new Date(1950, 5, 22),
        startingDay: 1,
        showWeeks: false
    };
	
	
	$scope.repeatopened = {};
    $scope.repeatopened.sal = false;
    $scope.repeatopen = function($event, sal) {
		$event.preventDefault();
		$event.stopPropagation();
		sal.repeatopened = true;
	};


	$scope.CategoryArray = [
       {
           "CategoryName" : "Live Interactions"
        },
		{
           "CategoryName" : "Advanced Pain Management"
        },
		{
           "CategoryName" : "Interventional Pain Management"
        },
		{
           "CategoryName" : "Acute Pain"
        }
		,
		{
           "CategoryName" : "Chronic Pain Syndromes"
        },
		{
           "CategoryName" : "General Considerations"
        },
		{
           "CategoryName" : "Lower Limb"
        },
		{
           "CategoryName" : "Upper Limb"
        },
		{
           "CategoryName" : "Back"
        },
		{
           "CategoryName" : "Pelvis"
        },
		{
           "CategoryName" : "Abdomen"
        },
		{
           "CategoryName" : "Thorax"
        },
		{
           "CategoryName" : "Head & Neck"
        }
    ]

	
	/*
	$scope.GetCategoryList = function()
	{
		$http.get("load_categories.php")
		.then(function successCallback(response)
		{
			var data = response.data;
			if(data=="NoData")
			{
				$scope.CategoryArray = "";
			}
			else
			{
				$scope.CategoryArray = data;	
			}
			
	   }, function errorCallback(response) {
		
	  });
	}
	*/


	
	$scope.GotoVideoList = function()
	{		
	    $scope.submitted = false;
		window.location.href = "list-ipmvideos.php";
	}

	
	$scope.VideoData = function (Video)
	{
        $scope.submitted = true;
		//console.log('enrolldate');
		$http.post('ipmvideo_process.php',{
			
			'categoryname':$scope.categoryname,
			'videoname':$scope.videoname,
			'videosource':$scope.videosource,
			'duration':$scope.duration,
			'videotype':$scope.videotype,
			'batch':$scope.batch
			})
		.then(function successCallback(response)
		{
			var data = response.data;
			
			if(data=="Success")
			{
				$scope.submitted = false;
				$scope.SuccessAlert = "Video added successfully";
				$scope.showSuccessAlert = true;
				$scope.showWarningAlert = false;
			
				$scope.Video = {};
				$scope.IPMForm.$setPristine();
				$scope.IPMForm.$setUntouched();
							
				$timeout(function () { $scope.showSuccessAlert = false;window.location.href = "list-ipmvideos.php";}, 3000);
			}
			else
			{
				$scope.WarningAlert = data;
				$scope.showWarningAlert = true;
			
				//$scope.Video = {};
				//$scope.IPMForm.$setPristine();
				//$scope.IPMForm.$setUntouched();
				
				$timeout(function () { $scope.showWarningAlert = false; $scope.submitted = false;}, 5000);
			}
			
		  
		}, function errorCallback(response) {
    		// called asynchronously if an error occurs
		    // or server returns response with an error status.
		  });
	};
	
	$scope.GetVideosList = function()
	{
		$http.get("load_ipmvideos.php")
		.then(function successCallback(response)
		{
			var data = response.data;
			if(data=="NoData")
			{
				$scope.VideosArray = "";
			}
			else
			{
				$scope.VideosArray = data;	
			}
			
	   }, function errorCallback(response) {
		// called asynchronously if an error occurs
		// or server returns response with an error status.
	  });
	}
	
	
	$scope.EditVideo = function(PkId,CategoryName,VideoName,VideoSource,Duration,Type,Batch)
	{
		
		$scope.ListVideos = false;
	    $scope.EditVideos = true;
		
		//console.log(Userid);
		
		$scope.ipmpkid = PkId;
		$scope.editcategoryname = CategoryName;
		$scope.editvideoname = VideoName;
		$scope.editvideosource = VideoSource;
		$scope.editduration = Duration;
		$scope.edittype = Type;
		$scope.editbatch = Batch
	}
	
	
	$scope.VideoData = function (Update)
	{
        $scope.submitted = true;
		//console.log('editdateofenroll');
		$http.post('update_video_process.php',{

			'updatepkid':$scope.ipmpkid,
			'updatecategoryname':$scope.editcategoryname,
			'updatevideoname':$scope.editvideoname,
			'updatevideosource':$scope.editvideosource,
			'updateduration':$scope.editduration,
			'updatetype':$scope.edittype,
			'updatebatch':$scope.editbatch
		})
		.then(function successCallback(response)
		{
			var data = response.data;
			
			if(data=="Success")
			{
				$scope.submitted = false;
				$scope.SuccessAlert = "Video updated successfully";
				$scope.showSuccessAlert = true;
				$scope.showWarningAlert = false;
			
				$scope.Update = {};
				$scope.IPMForm.$setPristine();
				$scope.IPMForm.$setUntouched();
							
				$timeout(function () { $scope.showSuccessAlert = false;window.location.href = "list-ipmvideos.php";}, 3000);
			}
			else
			{
				$scope.WarningAlert = data;
				$scope.showWarningAlert = true;
			
				//$scope.Update = {};
				//$scope.IPMForm.$setPristine();
				//$scope.IPMForm.$setUntouched();
				
				$timeout(function () { $scope.showWarningAlert = false; $scope.submitted = false;}, 5000);
			}
			
		}, function errorCallback(response) {
    		// called asynchronously if an error occurs
		    // or server returns response with an error status.
		  });
	};
	
	
	
	$scope.DeleteVideo = function(PkId)
	{
		var answer = confirm("Do you want to Delete?")
		if (!answer)
		{               
		}
		else
		{
			$scope.submitted = true;
			$http.post('delete_ipmvideo_process.php', {'PkId':PkId})
			.then(function successCallback(response)
			{
				var data = response.data;
				if(data=="Success")
				{
					$scope.SuccessAlert = "Order deleted successfully";
					$scope.showSuccessAlert = true;
					$scope.showWarningAlert = false;
   				
					$timeout(function () { window.location.href = "list-ipmvideos.php"; }, 3000);
				}
				else
				{
					$scope.WarningAlert = data;
					$scope.showWarningAlert = true;
					$scope.showSuccessAlert = false;
				}
			}, function errorCallback(response) {
    		// called asynchronously if an error occurs
		    // or server returns response with an error status.
		  });
		}
	}
	
    
	$scope.switchBool = function (value) {
		$scope[value] = !$scope[value];
	};
			
});


