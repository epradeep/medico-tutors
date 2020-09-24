var Login = angular.module("LoginModule", [])
Login.controller("LoginController", function ($scope, $timeout, $http, jsonFilter, $window)
{
	$scope.showWarningAlert = false;	
	$scope.showSuccessAlert = false;
	//$scope.LoginPage = true;
	//$scope.ForgotPage = false;
		
	var logResult = function (data, status, headers, config)
	{
		return data;
	};
	
	
	$scope.LoginData = function (ALogin)
	{
     
        $scope.submitted = true;
		
		$http.post('login_process.php',{'loginUname':$scope.ALogin.loginUname,'loginPassword':$scope.ALogin.loginPassword})
		.then(function successCallback(response)
		{
			var data = response.data;
			
			if(data=="Success")
			{
			    $scope.submitted = false;
				//$scope.SuccessAlert = "Thank for login";
				$window.location.href = "welcome.php";
				$scope.showSuccessAlert = true;
				$scope.showWarningAlert = false;
			
				$scope.ALogin = {};
				$scope.LoginForm.$setPristine();
				$scope.LoginForm.$setUntouched();
							
				$timeout(function () { $scope.showSuccessAlert = false; }, 3000);
			}
			else
			{
				$scope.WarningAlert = data;
				$scope.showWarningAlert = true;
			
				//$scope.ALogin = {};
				//$scope.LoginForm.$setPristine();
				//$scope.LoginForm.$setUntouched();
				
				$timeout(function () { $scope.showWarningAlert = false; $scope.submitted = false;}, 5000);
			}
			
		  
		}, function errorCallback(response) {
    		// called asynchronously if an error occurs
		    // or server returns response with an error status.
		  });

	};

    $scope.GotoLogin = function()
	{		
	    $scope.submitted = false;
		window.location.href = "index.php";
	}


	$scope.ForgotEmailCheck = function(forgotemail)
	{
		$http.post('check_email.php', {'emailid': $scope.forgotemail })
		.then(function successCallback(response)
		{
			var data = response.data;
			if(data=="OK")
			{
				$scope.ForgotEmailExists = "Email Id not found";
				$scope.ForgotFormValid = true;
				$scope.ForgotForm.forgotemail.$setValidity("forgotemail",true);
			}
			else
			{
				$scope.ForgotEmailExists = "";
				$scope.ForgotFormValid = false;
				$scope.ForgotForm.forgotemail.$setValidity("forgotemail",false);
			}
		}, function errorCallback(response) {
    		// called asynchronously if an error occurs
		    // or server returns response with an error status.
		  });
			
	}

	$scope.ForgotData = function(AForgot)
	{
		$scope.submitted = true;
		
		$http.post('forgotpwd_process.php',{'forgotemail':$scope.forgotemail})
		.then(function successCallback(response)
		{
			var data = response.data;
			if(data=="Success")
			{
				$scope.ForgotFormValid = true;

				$scope.SuccessAlert = "New password has been sent to your EmailId";
				$scope.showSuccessAlert = true;				

				$timeout(function () { $scope.showSuccessAlert = false;$window.location.href = "index.php";}, 5000);
			}
			else
			{
				$scope.WarningAlert = data;
				$scope.showWarningAlert = true;
				$timeout(function () { $scope.showWarningAlert = false; $scope.submitted = false;}, 5000);
			}
		}, function errorCallback(response) {
    		// called asynchronously if an error occurs
		    // or server returns response with an error status.
		  });
	}

		
});

