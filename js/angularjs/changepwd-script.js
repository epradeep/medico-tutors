var ChangePwd = angular.module("ChangePwdModule", [])

/*ChangePwd.directive("compareTo", function() {
      return {
        require: "ngModel",
        scope: {
          confirmPassword: "=compareTo"
        },
        link: function(scope, element, attributes, modelVal) {

          modelVal.$validators.compareTo = function(val) {
            return val == scope.confirmPassword;
          };

          scope.$watch("confirmPassword", function() {
            modelVal.$validate();
          });
        }
      };
    });*/

   
ChangePwd.controller("ChangePwdController", function ($scope, $timeout, $http, jsonFilter, $window)
{
	$scope.showWarningAlert = false;	
	$scope.showSuccessAlert = false;

		
	var logResult = function (data, status, headers, config)
	{
		return data;
	};

    $scope.user = {  
        password: "",  
        confirmPassword: ""  
    };
	
	$scope.ChangePwdData = function (UserPwd)
	{
     
        $scope.submitted = true;
		
		$http.post('changepwd_process.php',{'currentpassword':$scope.UserPwd.currentpassword,'password':$scope.UserPwd.password,'confirmpassword':$scope.UserPwd.confirmpassword})
		.then(function successCallback(response)
		{
			var data = response.data;
			
			if(data=="Success")
			{
			    $scope.submitted = false;
				$scope.SuccessAlert = "Password changed successfully";
				$scope.showSuccessAlert = true;
				$scope.showWarningAlert = false;
			
				/*$scope.ALogin = {};
				$scope.ChangePwdForm.$setPristine();
				$scope.ChangePwdForm.$setUntouched();*/
							
				$timeout(function () { $scope.showSuccessAlert = false;window.location.href="welcome.php"}, 3000);
			}
			else
			{
				$scope.WarningAlert = data;
				$scope.showWarningAlert = true;
			
				//$scope.ALogin = {};
				//$scope.ChangePwdForm.$setPristine();
				//$scope.ChangePwdForm.$setUntouched();
				
				$timeout(function () { $scope.showWarningAlert = false; $scope.submitted = false;}, 3000);
			}
			
		  
		}, function errorCallback(response) {
    		// called asynchronously if an error occurs
		    // or server returns response with an error status.
		  });
   
	   
	};
	
		
});


ChangePwd.directive("compareTo", function ()  
  {  
      return {  

          require: "ngModel",  
          scope:  
          {  
              confirmPassword: "=compareTo"  
          },  
          link: function (scope, element, attributes, paramval)  
          {  
              paramval.$validators.compareTo = function (val)  
              {  
                  return val == scope.confirmPassword;  
              };  

              scope.$watch("confirmPassword", function ()  
              {  
                  paramval.$validate();  
              });  
          }  
      };  

  });