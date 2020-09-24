var User = angular.module("UserModule", ['ui.bootstrap'])


User.directive('fileModel', ['$parse', function ($parse) {
    return {
        restrict: 'A',
        link: function(scope, element, attrs) {
            var model = $parse(attrs.fileModel);
            var modelSetter = model.assign;

            element.bind('change', function(){
                scope.$apply(function(){
                    modelSetter(scope, element[0].files[0]);
                });
            });
        }
    };
}]);


User.service('fileUpload', ['$http', function ($http) {
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



User.controller("UserController", function ($scope, $timeout, $http, fileUpload)
{
	$scope.showWarningAlert = false;	
	$scope.showSuccessAlert = false;
	$scope.ListUser = true;
	$scope.EditUsers = false;
		
	var logResult = function (data, status, headers, config)
	{
		return data;
	};


    $scope.SpecializationArray = ["Dentist","Ayurveda","Homeopath","Gynecologist/obstetrician","Psychologist","Psychiatrist","Ophthalmologist","Physiotherapist","Spa","Acupuncturist","Addiction Psychiatrist","Adolescent And Child Psychiatrist","Adult Psychiatrist","Aesthetic Surgeon","Allergist","Allergist/immunologist","Allergy","Alternative Medicine","Andrologist","Anesthesia And Pain Medicine","Anesthesiologist","Asthma","Asthma Specialist","Audiologist","Autonomic Neurologist","Bariatric Surgeon","Bariatric Surgery","Beautician","Breast Lift/augumentation/reduction","Cardiac Electrophysiologist","Cardiac Surgeon","Cardiologist","Cardiothoracic Surgeon","Cardiovascular And Pulmonary Physiotherapist","Chiropractor","Clinical Physiotherapist","Clinical Psychologist","Colorectal Surgeon","Consultant Physician","Consultant Physiotherapist","Coronary Surgery","Cosmetic/aesthetic Dentist","Cosmetic/plastic Surgeon","Cosmetologist","Counselling Psychologist","Critical Care Medicine","Dental Surgeon","Dentofacial Orthopedist","Dermatologist","Dermatopathologist","Dermatosurgeon","Diabetologist","Dietitian/nutritionist","Ear-nose-throat (ent) Specialist","Emergency & Critical Care","Emergency Medicine","Endochrine Surgeon","Endocrinologist","Endodontist","Ent Surgeon,Ent/ Otolaryngologist","Gastroenterologist","Gastrointestinal Surgery","General Endocrinologist","General Neurologist","General Pathologist","General Physician","General Surgeon","Geneticist","Geriatric Psychiatrist","Geriatrician","Gynecologic Oncologist","Gynecologist","Hair Transplant Surgeon","Hand Surgeon","Head And Neck Surgeon","Head And Neck Surgery","Headache Specialist","Health Psychologist","Heart Failure/transplant Specialist","Hematologic Oncologist","Hematologist","Hepatology","Homecare Physiotherapist","Hospital Nutritionist/dietitian","Hypnotherapist","Immunodermatologist","Implantologist","Infertility","Infertility Specialist","Integrated Medicine","Internal Medicine","Intervention Cardiologist","Intervention Cardiologist (angioplasty)","Laparoscopic Surgery","Laparoscopy","Naturopathy","Neonatal Surgeoneonatal Surgeon","Nephrologist","Nephrologist/renal Specialist","Neuro Physiotherapist","Rehablitation","Neuroendocrinologist","Neurointerventional Surgery","Neurologist","Neurophysiologist","Neuropsychiatrist","Neuropsychologist","Neurosurgeon","Nuclear Medicine Physician","Obesity Specialist","Obstetrician","Occupational Therapist","Oncologist","Oncologist/cancer Specialist","Ophthalmologist/ Eye Surgeon,Optician","Opticians","Optometrist","Oral And Maxillofacial Surgeon","Oral Pathologist","Oral Surgeon","Orthodontist","Orthopedic Physiotherapist","Orthopedic Surgeon","Orthopedist","Otologist/Neurotologist","Paediatric Intensivist","Pathologist","Pediatric Cardiologist","Pediatric Dentist","Pediatric Dermatologist","Pediatric Endocrinologist","Pediatric Gastroenterologist","Pediatric Neurologist","Pediatric Oncologist","Pediatric Orthopedic Surgeon","Pediatric Otolaryngologist","Pediatric Physiotherapist","Pediatric Pulmonologist","Pediatric Surgeon","Pediatric Urologist","Pediatrician","Perinatologist","Periodontist","Podiatrist","Prosthodontist","Psychotherapist","Pulmonary Medicine","Pulmonologist","Radiation Oncologist","Radiologist","Rehab & Physical Medicine Specialist","Renal Dietician","Reproductive Endocrinologist (infertilty)","Rheumatologist","Rhinoplasty (nose Surgery)","Saloon","Sexologist","Siddha","Somnologist","Somnologist (sleep Specialist)","Sonologista Therapist","Speech Therapist","Spine And Pain Specialist","Spine Surgeon","Sports And Musculoskeletal Physiotherapist","Sports Medicine Nutritionist","Sports Medicine Physician","Sports Medicine Specialist","Sports Medicine Surgeon","Sports Nutritionist","Surgeon","Surgical Oncologist","Surgical Oncology","Thoracic (chest) Surgeon","Total Joint Surgeon","Toxicologist","Transplant Surgeon","Trichologist","Unani","Upper Gastro-intestinal Surgeon","Urological Surgeon","Urologist","Vascular Surgeon","Venereologist","Veterinarian","Veterinary Physician","Veterinary Surgeon","Wellness","Yoga","Yoga And Naturopathy","Other"];


     $scope.CountryArray = ["India","USA","Australia","Canada","Denmark","NewZealand","Norway","Singapore","UK","Germany","Saudi Arabia","Srilanka","Others"];


	$scope.GotoUserList = function()
	{		
	    $scope.submitted = false;
		window.location.href = "list-user.php";
	}


	/*var year = new Date().getFullYear();
    var range = [];
    range.push(year);
    for (var i = 1; i < 7; i++) {
        range.push(year + i);
    }
    $scope.years = range;*/


    $scope.years = function(min, max, step) {
    step = step || 1;
    var input = [];
    for (var i = min; i <= max; i += step) {
        input.push(i);
    }
    return input;

   };
	


	$scope.UserData = function (User)
	{
        $scope.submitted = true;
		//console.log('enrolldate');
		    var fd = new FormData();
			var file = $scope.certificateone;
			var file2 = $scope.certificatetwo;
			var file3 = $scope.certificatethree;
			var file4 = $scope.certificatefour;
			var file5 = $scope.certificatefive;
			/*angular.forEach($scope.certificateone, function(file){
				
				fd.append('file', file);
				
			});*/
			fd.append('file', file);
			fd.append('file2', file2);
			fd.append('file3', file3);
			fd.append('file4', file4);
			fd.append('file5', file5);
           $http.post('upload-files.php', fd, {

				transformRequest: angular.identity,
				headers: {'Content-Type': undefined}

			}).then(function(response){ 

                
              var data = response.data;
               $scope.fileonepath = data['File1'];
               $scope.filetwopath = data['File2'];
               $scope.filethreepath = data['File3'];
               $scope.filefourpath = data['File4'];
               $scope.filefivepath = data['File5'];
             
               // console.log($scope.File1);
               // console.log($scope.File2);
               // console.log($scope.File3);


                $http.post('adduser_process.php',{
			
					'fullname':$scope.fullname,
					'username':$scope.username,
					'mobileno':$scope.mobileno,
					'emailid':$scope.emailid,
					'password':$scope.password,
					'specialization':$scope.specialization,
					'city':$scope.city,
					'country':$scope.country,
					'guname':$scope.guname,
					'gdegreename':$scope.gdegreename,
					'graduationyear':$scope.graduationyear,
					'pguname':$scope.pguname,
					'pgdname':$scope.pgdname,
					'pgyear':$scope.pgyear,

					'cfileone':$scope.fileonepath,
					'cfiletwo':$scope.filetwopath,
					'cfilethree':$scope.filethreepath,
					'cfilefour': $scope.filefourpath,
					'cfilefive':$scope.filefivepath
					}).then(function successCallback(response){

					    var data = response.data;
					
						if(data=="Success")
						{
							$scope.submitted = false;
							$scope.SuccessAlert = "User added successfully";
							$scope.showSuccessAlert = true;
							$scope.showWarningAlert = false;
						
							$scope.User = {};
							$scope.UserForm.$setPristine();
							$scope.UserForm.$setUntouched();
										
							$timeout(function () { $scope.showSuccessAlert = false;window.location.href = "list-user.php";}, 3000);
						}
						else
						{
							$scope.WarningAlert = data;
							$scope.showWarningAlert = true;
						
							//$scope.Enquiry = {};
							//$scope.EnquiryForm.$setPristine();
							//$scope.EnquiryForm.$setUntouched();
							
							$timeout(function () { $scope.showWarningAlert = false; $scope.submitted = false;}, 5000);
						}
					
				  
					}, function errorCallback(response) {
			    		// called asynchronously if an error occurs
					    // or server returns response with an error status.
					  });

           });

		
	};
	
	$scope.GetUserList = function()
	{
		$http.get("load_users.php")
		.then(function successCallback(response)
		{
			var data = response.data;
			if(data=="NoData")
			{
				$scope.UserArray = "";
			}
			else
			{
				$scope.UserArray = data;	
			}
			
	   }, function errorCallback(response) {
		// called asynchronously if an error occurs
		// or server returns response with an error status.
	  });
	}
	
	
	$scope.EditUser = function(PkId,Name,UserName,MobileNo,EmailId,Password,Specialization,City,Country,GraduationUname,GraduationDegree,GraduationYear,PgUname,PgDegree,Pgyear,DocOne,DocTwo,DocThree,DocFour,DocFive,DateofRegistered)
	{
		
		$scope.ListUser = false;
	    $scope.EditUsers = true;
		
		//alert(Country);
		$scope.edituserpkid = PkId;
		$scope.editfname = Name;
		$scope.edituname = UserName;
		$scope.editmobileno = MobileNo;
		$scope.editemailid = EmailId;
		$scope.editpassword = Password;
		$scope.editspecialization = Specialization;
		$scope.editcity = City;
		$scope.editcountry = Country;
		$scope.editguname = GraduationUname;
		$scope.editgdegreename = GraduationDegree;
		$scope.editgraduationyear = GraduationYear;
		$scope.editpguname = PgUname;
		$scope.editpgdname = PgDegree;
		$scope.editpgyear = Pgyear;
		$scope.editdocone = DocOne;
		$scope.editdoctwo = DocTwo;
		$scope.editdocthree = DocThree;
		$scope.editdocfour = DocFour;
		$scope.editdocfive = DocFive;
		//$scope.editdateofenroll = new Date(DateofEnrolled);

	}
	
	$scope.UpdateUser = function (Update)
	{
       
           $scope.submitted = true;

            var fd = new FormData();
			var file = $scope.editdocone;
			var file2 = $scope.editdoctwo;
			var file3 = $scope.editdocthree;
			var file4 = $scope.editdocfour;
			var file5 = $scope.editdocfive;
			/*angular.forEach($scope.certificateone, function(file){
				
				fd.append('file', file);
				
			});*/
			fd.append('file', file);
			fd.append('file2', file2);
			fd.append('file3', file3);
			fd.append('file4', file4);
			fd.append('file5', file5);
           $http.post('upload-files.php', fd, {

				transformRequest: angular.identity,
				headers: {'Content-Type': undefined}

			}).then(function(response){ 

                
              var data = response.data;
               $scope.updatefileone = data['File1'];
               $scope.updatefiletwo = data['File2'];
               $scope.updatefilethree = data['File3'];
               $scope.updatefilefour = data['File4'];
               $scope.updatefilefive = data['File5'];

				$http.post('update_user_process.php',{
					'updatepkid':$scope.edituserpkid,
					'editfname':$scope.editfname,
					'edituname':$scope.edituname,
					'editmobileno':$scope.editmobileno,
					'editemailid':$scope.editemailid,
					'editpassword':$scope.editpassword,
					'editspecialization':$scope.editspecialization,
					'editcity':$scope.editcity,
					'editcountry':$scope.editcountry,
					'editguname':$scope.editguname,
					'editgdegreename':$scope.editgdegreename,
					'editgraduationyear':$scope.editgraduationyear,
					'editpguname':$scope.editpguname,
					'editpgdname':$scope.editpgdname,
					'editpgyear':$scope.editpgyear,


					'updatefileone':$scope.updatefileone,
					'updatefiletwo':$scope.updatefiletwo,
					'updatefilethree':$scope.updatefilethree,
					'updatefilefour':$scope.updatefilefour,
					'updatefilefive':$scope.updatefilefive
					
				})
				.then(function successCallback(response)
				{
					var data = response.data;
					
					if(data=="Success")
					{
						$scope.submitted = false;
						$scope.SuccessAlert = "User updated successfully";
						$scope.showSuccessAlert = true;
						$scope.showWarningAlert = false;
					
						$scope.Update = {};
						$scope.UserForm.$setPristine();
						$scope.UserForm.$setUntouched();
									
						$timeout(function () { $scope.showSuccessAlert = false;window.location.href = "list-user.php";}, 3000);
					}
					else
					{
						$scope.WarningAlert = data;
						$scope.showWarningAlert = true;
					
						//$scope.Update = {};
						//$scope.UserForm.$setPristine();
						//$scope.UserForm.$setUntouched();
						
						$timeout(function () { $scope.showWarningAlert = false; $scope.submitted = false;}, 5000);
					}
					
				}, function errorCallback(response) {
		    		// called asynchronously if an error occurs
				    // or server returns response with an error status.
				  });

     });



	};
	
	

	$scope.DeleteUser = function(PkId)
	{
		var answer = confirm("Do you want to Delete?")
		if (!answer)
		{               
		}
		else
		{
			$scope.submitted = true;
			$http.post('delete_user_process.php', {'PkId':PkId})
			.then(function successCallback(response)
			{
				var data = response.data;
				if(data=="Success")
				{
					$scope.SuccessAlert = "User deleted successfully";
					$scope.showSuccessAlert = true;
					$scope.showWarningAlert = false;
   				
					$timeout(function () { window.location.href = "list-user.php"; }, 3000);
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