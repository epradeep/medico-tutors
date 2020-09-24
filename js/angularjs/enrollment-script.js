var Enrollment = angular.module("EnrollmentModule", ['ui.bootstrap'])
Enrollment.controller("EnrollmentController", function ($scope, $timeout, $http, jsonFilter, $window)
{
	$scope.showWarningAlert = false;	
	$scope.showSuccessAlert = false;
	$scope.ListEmrolled = true;
	$scope.EditEmrolled = false;
	
	
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
	
	
	$scope.CoursesArray = [
       {
            "PkId" : "1",
            "CourseName" : "Basic Pain Management for Doctors"
        },{
            "PkId" : "2",
            "CourseName" : "Advanced Pain Management for Doctors"
        },{
            "PkId" : "3",
            "CourseName" : "Principles of Pain Management for Nurses"
        },{
            "PkId" : "4",
            "CourseName" : "Interventional Pain Management"
        }
    ]
	
	$scope.GetCountries = function()
	{
		$http.get("load_countries.php")
		.then(function successCallback(response)
		{
			var data = response.data;
			if(data=="NoData")
			{
				$scope.CountryArray = "";
			}
			else
			{
				$scope.CountryArray = data;	
			}
			
	   }, function errorCallback(response) {
		// called asynchronously if an error occurs
		// or server returns response with an error status.
	  });
	}
	
	$scope.GotoList = function()
	{		
		window.location.href = "list-enrollment.php";
	}
	
	$scope.EnrollmentData = function (Enrollment)
	{
        $scope.submitted = true;
		//console.log('enrolldate');
		$http.post('enrollment_process.php',{
			
			'coursename':$scope.coursename,
			'pname':$scope.pname,
			'emailid':$scope.emailid,
			'mobileno':$scope.mobileno,
			'countryname':$scope.countryname,
			'city':$scope.city,
			'enrolldate':$scope.enrolldate
			})
		.then(function successCallback(response)
		{
			var data = response.data;
			
			if(data=="Success")
			{
				$scope.submitted = false;
				$scope.SuccessAlert = "Enrollment added successfully";
				$scope.showSuccessAlert = true;
				$scope.showWarningAlert = false;
			
				$scope.Enrollment = {};
				$scope.EnrollmentForm.$setPristine();
				$scope.EnrollmentForm.$setUntouched();
							
				$timeout(function () { $scope.showSuccessAlert = false;window.location.href = "list-enrollment.php";}, 3000);
			}
			else
			{
				$scope.WarningAlert = data;
				$scope.showWarningAlert = true;
			
				//$scope.Enrollment = {};
				//$scope.EnrollmentForm.$setPristine();
				//$scope.EnrollmentForm.$setUntouched();
				
				$timeout(function () { $scope.showWarningAlert = false; $scope.submitted = false;}, 5000);
			}
			
		  
		}, function errorCallback(response) {
    		// called asynchronously if an error occurs
		    // or server returns response with an error status.
		  });
	};
	
	$scope.GetEnrolledList = function()
	{
		$http.get("load_enrollment.php")
		.then(function successCallback(response)
		{
			var data = response.data;
			if(data=="NoData")
			{
				$scope.EnrolledArray = "";
			}
			else
			{
				$scope.EnrolledArray = data;	
			}
			
	   }, function errorCallback(response) {
		// called asynchronously if an error occurs
		// or server returns response with an error status.
	  });
	}
	
	
	$scope.EditEnrolled = function(PkId,Name,EmailId,MobileNo,City,Countryid,CountryName,CourseName,DateofEnrolled)
	{
		
		$scope.ListEmrolled = false;
	    $scope.EditEmrolled = true;
		//alert(Countryid);
		$scope.editpkid = PkId;
		$scope.editname = Name;
		$scope.editemail = EmailId;
		$scope.editmobile = MobileNo;
		$scope.editcity = City;
		$scope.editcountryname = Countryid;
		$scope.editcoursename = CourseName;
		$scope.editdateofenroll = new Date(DateofEnrolled);

	}
	
	
	$scope.UpdateEnrollment = function (Update)
	{
        $scope.submitted = true;
		//console.log('editdateofenroll');
		$http.post('update_enrollment_process.php',{
			'pkid':$scope.editpkid,
			'editcoursename':$scope.editcoursename,
			'editname':$scope.editname,
			'editemail':$scope.editemail,
			'editmobile':$scope.editmobile,
			'editcountryname':$scope.editcountryname,
			'editcity':$scope.editcity,
			'editdateofenroll':$scope.editdateofenroll
		})
		.then(function successCallback(response)
		{
			var data = response.data;
			
			if(data=="Success")
			{
				$scope.submitted = false;
				$scope.SuccessAlert = "Enrollment updated successfully";
				$scope.showSuccessAlert = true;
				$scope.showWarningAlert = false;
			
				$scope.Update = {};
				$scope.EnrollmentForm.$setPristine();
				$scope.EnrollmentForm.$setUntouched();
							
				$timeout(function () { $scope.showSuccessAlert = false;}, 3000);
			}
			else
			{
				$scope.WarningAlert = data;
				$scope.showWarningAlert = true;
			
				//$scope.Update = {};
				//$scope.EnrollmentForm.$setPristine();
				//$scope.EnrollmentForm.$setUntouched();
				
				$timeout(function () { $scope.showWarningAlert = false; $scope.submitted = false;}, 5000);
			}
			
		}, function errorCallback(response) {
    		// called asynchronously if an error occurs
		    // or server returns response with an error status.
		  });
	};
	
	
	$scope.DeleteEnrolled = function(PkId)
	{
		var answer = confirm("Do you want to Delete?")
		if (!answer)
		{               
		}
		else
		{
			$scope.submitted = true;
			$http.post('delete_enrollment_process.php', {'PkId':PkId})
			.then(function successCallback(response)
			{
				var data = response.data;
				if(data=="Success")
				{
					$scope.SuccessAlert = "Student deleted successfully";
					$scope.showSuccessAlert = true;
					$scope.showWarningAlert = false;
   				
					$timeout(function () { window.location.href = "list-enrollment.php"; }, 3000);
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