var formdata = angular.module("FormDataModule", [])

formdata.directive('fileModel', ['$parse', function ($parse) {
    return {
        restrict: 'A',
        link: function(scope, element, attrs) {
            var model = $parse(attrs.fileModel);
            var modelSetter = model.assign;

            element.bind('change', function(){
                scope.$apply(function(){
                    modelSetter(scope, element[0].files);
                });
            });
        }
    };
}]);


formdata.service('fileUpload', ['$http', function ($http) {
    this.uploadFileToUrl = function(file, uploadUrl){
        var fd = new FormData();
        fd.append('file', file);
        $http.post(uploadUrl, fd, {
            transformRequest: angular.identity,
            headers: {'Content-Type': undefined}
        })
        .success(function(data){
      
        })
        .error(function(){
        });
    }
}]);

formdata.controller("FormDataController", ['$scope','$timeout', '$http','fileUpload', function ($scope, $timeout, $http, fileUpload)
{
	
	var logResult = function (data, status, headers, config)
	{
		return data;
	};
	
	$scope.showWarningAlert = false;	
	$scope.showSuccessAlert = false;
	
	$scope.showFileWarningAlert = false;	
	$scope.showFileSuccessAlert = false;
	
	$scope.EditStudent = false;
	$scope.StudentList = false;
		

	/* upload file add remove script*/
	//$scope.choices = [{ufile: 'ch1'}];
	//$scope.CoverLetter = [{name: 'cl1'}];
	/* upload file add remove script*/
	
    $scope.GetStates = function()
	{
		$http.get("load_states.php")
		.then(function successCallback(response)
			{
				var data = response.data;
				if(data=="NoData")
				{
					$scope.StateArray = "";
				}
				else
				{
					$scope.StateArray = data;	
				}
				
		   }, function errorCallback(response) {
			// called asynchronously if an error occurs
			// or server returns response with an error status.
		  });
	}
	
	
	
	$scope.sfiles = [];
    //alert($scope.sfiles);	
	
	$scope.RegisterData = function ()
	{
		$scope.submitted = true;
		   //var i = parseInt(1);
			var fd = new FormData();
		    
			angular.forEach($scope.sfiles,function(file){
				
				//var file = value.name;
				fd.append('file[]', file);
			    //i = i+1;
				
			});
			
			$http.post('upload-files.php', fd, {
				transformRequest: angular.identity,
				headers: {'Content-Type': undefined}
			})
			.then(function(response){
				$scope.response = response.data;
				//$scope.response = response.data;
				//alert($scope.response);
                //console.log(JSON.stringify(response));
				
				$http.post('register_process.php',{'name':$scope.name,'mobile':$scope.mobile,'email':$scope.email,'gender':$scope.gender,'department':$scope.department,'state':$scope.state,'address':$scope.address,'ufiles':$scope.response})
				.then(function (response)
				{
					var data = response.data;
					if(data=="Success")
					{
						$scope.submitted = false;
						$scope.SuccessAlert = "Thank for submitting, We will get back to you shortly";
						$scope.showSuccessAlert = true;
						$scope.showWarningAlert = false;
					
						$scope.Register = {};
						$scope.RegisterForm.$setPristine();
						$scope.RegisterForm.$setUntouched();
									
						$timeout(function () { $scope.showSuccessAlert = false; window.location.href="welcome.php";}, 3000);
					}
					else
					{
						$scope.WarningAlert = data;
						$scope.showWarningAlert = true;
					
						//$scope.Register = {};
						//$scope.RegisterForm.$setPristine();
						//$scope.RegisterForm.$setUntouched();
						
						$timeout(function () { $scope.showWarningAlert = false; $scope.submitted = false;}, 5000);
					}
				})
				.catch(function(response) {
					
					$scope.WarningAlert = logResult(response.data);
				});
		
		    })
	   
	}
	
	$scope.GotoList = function()
	{		
		window.location.href = "welcome.php";
	}
	
	
	$scope.GetStudentList = function()
	{	
		$http.get("load_studentlist.php", {})
		.then(function successCallback(response)
		{
			var data = response.data;
			//$scope.Uploadfiles = data[0]['data1'];
			//alert($scope.Uploadfiles);
			if(data=="NoRecords")
			{
				$scope.Students = "";
		        $scope.StudentList = false;
			}
			else
			{
				$scope.Students = data;
				$scope.StudentList = true;
			}
		}
		, function errorCallback(response) {
    		// called asynchronously if an error occurs
		    // or server returns response with an error status.
		  });
		
	}
	
	//$scope.editfile1=[];
	
    $scope.Editstud = function(PkId,Name,MobileNo,EmailId,Gender,Department,StateId,Statename,Address,data1)
	{
		
		$scope.EditStudent = true;
		$scope.StudentList = false;
	
		//alert($scope.editfile);
		$scope.editpkid = PkId;
		$scope.editname = Name;
		$scope.editmobile = MobileNo;
		$scope.editemail = EmailId;
		$scope.editgender = Gender;
		$scope.editdepartment = Department
		//alert(StateId);
		$scope.editstatename = StateId;
		$scope.editaddress = Address;
		$scope.editfile = data1;
		
		//console.log(data1);
		/*$scope.editfile.forEach(editfile, function (value, key) {
		  $scope.FileArray[key].EPkId = value.EPkId;
		});*/
		
		/*angular.forEach(data1, function (value, key) { 
			$scope.editfile1.push(value.key);
			$scope.FId = value.EPkId;
			$scope.UFile = value.Uploadfile;
            console.log($scope.FId);			
		});*/
		//var FId = $scope.FId;
		//console.log($scope.FId);
		

	}
	
	
	$scope.UpdateStud = function()
	{
		$scope.submitted = true;
		
		var fd = new FormData();   
		angular.forEach($scope.sfiles,function(file){
			
			fd.append('file[]', file);
			
		});
		  
		$http.post('upload-files.php', fd, {
				transformRequest: angular.identity,
				headers: {'Content-Type': undefined}
			})
			.then(function(response){
			//console.log(data);
			$scope.response = response.data;
			//$scope.response = response.data;
			//alert($scope.othersubdptname);
				
			$http.post('updatestudent_process.php',{
				'pkid':$scope.editpkid,
				'SPkId':$scope.EPkId,
				'name':$scope.editname,
				'mobile':$scope.editmobile,
				'email':$scope.editemail,
				'gender':$scope.editgender,
				'department':$scope.editdepartment,
				'editstatename':$scope.editstatename,
				'address':$scope.editaddress,
				'ufiles':$scope.response
				})
			.then(function (response)
			{
				var data = response.data;
				if(data=="Success")
				{   
			
				    $scope.SuccessAlert = "Updated successfully";
					$scope.showSuccessAlert = true;
					$scope.showWarningAlert = false;
					
					$scope.EditStudData = {};
					$scope.EditStudentForm.$setPristine();
					$scope.EditStudentForm.$setUntouched();
					
					$timeout(function () {$scope.showSuccessAlert = false; window.location = 'welcome.php';}, 3000);
				}
				else
				{
					$scope.WarningAlert = data;
					$scope.showWarningAlert = true;
						
				    $timeout(function () { $scope.showWarningAlert = false; $scope.submitted = false;}, 5000);
				}
			
			}).catch(function(response) {
				
				$scope.WarningAlert = logResult(response.data);
			});
		
		 })

	}
	
	$scope.DeleteStudent = function(PkId)
	{
		var answer = confirm("Do you want to Delete?")
		if (!answer)
		{               
		}
		else
		{
			$scope.submitted = true;
			$http.post('deletestudent_process.php', {'PkId':PkId})
			.then(function successCallback(response)
			{
				var data = response.data;
				if(data=="Success")
				{
					$scope.SuccessAlert = "Student deleted successfully";
					$scope.showSuccessAlert = true;
					$scope.showWarningAlert = false;
   				
					$timeout(function () { window.location.href = "welcome.php"; }, 3000);
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
	
	$scope.DeleteMfiles = function(editpkid,EPkId)
	{
		var answer = confirm("Do you want to Delete?")
		if (!answer)
		{               
		}
		else
		{
			$scope.submitted = true;
			
			$http.post('deletestudent_files_process.php', {'editpkid':editpkid,'SFid':EPkId})
			.then(function successCallback(response)
			{
				var data = response.data;
				//console.log(data);
				//JSON.stringify(data);
				if(data=="Success")
				{
					
					$scope.SuccessAlert = "Student file deleted successfully";
					$scope.showSuccessAlert = true;
					$scope.showWarningAlert = false;
   				
					$timeout(function () { window.location.href = "welcome.php"; }, 3000);
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
	
	
}]);