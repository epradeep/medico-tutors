var Welcome = angular.module("WelcomeModule", ['ui.bootstrap'])
Welcome.controller("WelcomeController", function ($scope, $timeout, $http, jsonFilter, $window)
{

	$scope.showWarningAlert = false;	
	$scope.showSuccessAlert = false;


	var logResult = function (data, status, headers, config)
	{
		return data;
	};

	
	$scope.GetDashboardData = function()
	{

		$http.get("load_dashboard_data.php")
		.then(function successCallback(response)
		{

			var data = response.data;

			//alert($scope.EnrollmentsCount);
			
			$scope.EnrollmentsCount = data[0]['EnrollmentsCount'];
			$scope.EnquiresCount = data[0]['EnquiresCount'];
			$scope.OrderesCount = data[0]['OrderesCount'];
			$scope.VideosCount = data[0]['VideosCount'];
			$scope.UsersCount = data[0]['UsersCount'];
			
	   }, function errorCallback(response) {
		// called asynchronously if an error occurs
		// or server returns response with an error status.
	  });
	}
	


	$scope.switchBool = function (value) {
		$scope[value] = !$scope[value];
	};
			
});


