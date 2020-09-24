var Enquiry = angular.module("EnquiryModule", ['ui.bootstrap'])
Enquiry.controller("EnquiryController", function ($scope, $timeout, $http, jsonFilter, $window)
{
	$scope.showWarningAlert = false;	
	$scope.showSuccessAlert = false;
	$scope.ListEnquiries = true;
	$scope.EditEnquiry = false;
	
	
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
	
	/*
	$scope.GetSpecialization = function()
	{
		$http.get("load_specialization.php")
		.then(function successCallback(response)
		{
			var data = response.data;
			if(data=="NoData")
			{
				$scope.SpecializationArray = "";
			}
			else
			{
				$scope.SpecializationArray = data;	
			}
			
	   }, function errorCallback(response) {

	  });
	}*/

	$scope.SpecializationArray = ["Dentist","Ayurveda","Homeopath","Gynecologist/obstetrician","Psychologist","Psychiatrist","Ophthalmologist","Physiotherapist","Spa","Acupuncturist","Addiction Psychiatrist","Adolescent And Child Psychiatrist","Adult Psychiatrist","Aesthetic Surgeon","Allergist","Allergist/immunologist","Allergy","Alternative Medicine","Andrologist","Anesthesia And Pain Medicine","Anesthesiologist","Asthma","Asthma Specialist","Audiologist","Autonomic Neurologist","Bariatric Surgeon","Bariatric Surgery","Beautician","Breast Lift/augumentation/reduction","Cardiac Electrophysiologist","Cardiac Surgeon","Cardiologist","Cardiothoracic Surgeon","Cardiovascular And Pulmonary Physiotherapist","Chiropractor","Clinical Physiotherapist","Clinical Psychologist","Colorectal Surgeon","Consultant Physician","Consultant Physiotherapist","Coronary Surgery","Cosmetic/aesthetic Dentist","Cosmetic/plastic Surgeon","Cosmetologist","Counselling Psychologist","Critical Care Medicine","Dental Surgeon","Dentofacial Orthopedist","Dermatologist","Dermatopathologist","Dermatosurgeon","Diabetologist","Dietitian/nutritionist","Ear-nose-throat (ent) Specialist","Emergency & Critical Care","Emergency Medicine","Endochrine Surgeon","Endocrinologist","Endodontist","Ent Surgeon,Ent/ Otolaryngologist","Gastroenterologist","Gastrointestinal Surgery","General Endocrinologist","General Neurologist","General Pathologist","General Physician","General Surgeon","Geneticist","Geriatric Psychiatrist","Geriatrician","Gynecologic Oncologist","Gynecologist","Hair Transplant Surgeon","Hand Surgeon","Head And Neck Surgeon","Head And Neck Surgery","Headache Specialist","Health Psychologist","Heart Failure/transplant Specialist","Hematologic Oncologist","Hematologist","Hepatology","Homecare Physiotherapist","Hospital Nutritionist/dietitian","Hypnotherapist","Immunodermatologist","Implantologist","Infertility","Infertility Specialist","Integrated Medicine","Internal Medicine","Intervention Cardiologist","Intervention Cardiologist (angioplasty)","Laparoscopic Surgery","Laparoscopy","Naturopathy","Neonatal Surgeoneonatal Surgeon","Nephrologist","Nephrologist/renal Specialist","Neuro Physiotherapist","Rehablitation","Neuroendocrinologist","Neurointerventional Surgery","Neurologist","Neurophysiologist","Neuropsychiatrist","Neuropsychologist","Neurosurgeon","Nuclear Medicine Physician","Obesity Specialist","Obstetrician","Occupational Therapist","Oncologist","Oncologist/cancer Specialist","Ophthalmologist/ Eye Surgeon,Optician","Opticians","Optometrist","Oral And Maxillofacial Surgeon","Oral Pathologist","Oral Surgeon","Orthodontist","Orthopedic Physiotherapist","Orthopedic Surgeon","Orthopedist","Otologist/Neurotologist","Paediatric Intensivist","Pathologist","Pediatric Cardiologist","Pediatric Dentist","Pediatric Dermatologist","Pediatric Endocrinologist","Pediatric Gastroenterologist","Pediatric Neurologist","Pediatric Oncologist","Pediatric Orthopedic Surgeon","Pediatric Otolaryngologist","Pediatric Physiotherapist","Pediatric Pulmonologist","Pediatric Surgeon","Pediatric Urologist","Pediatrician","Perinatologist","Periodontist","Podiatrist","Prosthodontist","Psychotherapist","Pulmonary Medicine","Pulmonologist","Radiation Oncologist","Radiologist","Rehab & Physical Medicine Specialist","Renal Dietician","Reproductive Endocrinologist (infertilty)","Rheumatologist","Rhinoplasty (nose Surgery)","Saloon","Sexologist","Siddha","Somnologist","Somnologist (sleep Specialist)","Sonologista Therapist","Speech Therapist","Spine And Pain Specialist","Spine Surgeon","Sports And Musculoskeletal Physiotherapist","Sports Medicine Nutritionist","Sports Medicine Physician","Sports Medicine Specialist","Sports Medicine Surgeon","Sports Nutritionist","Surgeon","Surgical Oncologist","Surgical Oncology","Thoracic (chest) Surgeon","Total Joint Surgeon","Toxicologist","Transplant Surgeon","Trichologist","Unani","Upper Gastro-intestinal Surgeon","Urological Surgeon","Urologist","Vascular Surgeon","Venereologist","Veterinarian","Veterinary Physician","Veterinary Surgeon","Wellness","Yoga","Yoga And Naturopathy","Other"];
	

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
	
	$scope.GotoEnquiryList = function()
	{		
	    $scope.submitted = false;
		window.location.href = "list-enquiry.php";
	}
	
	$scope.EnquiryData = function (Enquiry)
	{
        $scope.submitted = true;
		//console.log('enrolldate');
		$http.post('enquiry_process.php',{
			
			'pname':$scope.pname,
			'emailid':$scope.emailid,
			'mobileno':$scope.mobileno,
			'city':$scope.city,
			'specialization':$scope.specialization,
			'courseinterest':$scope.courseinterest,
			'specilizetype':$scope.specilizetype,
			'enquirytext':$scope.enquirytext
			})
		.then(function successCallback(response)
		{
			var data = response.data;
			
			if(data=="Success")
			{
				$scope.submitted = false;
				$scope.SuccessAlert = "Enquiry added successfully";
				$scope.showSuccessAlert = true;
				$scope.showWarningAlert = false;
			
				$scope.Enquiry = {};
				$scope.EnquiryForm.$setPristine();
				$scope.EnquiryForm.$setUntouched();
							
				$timeout(function () { $scope.showSuccessAlert = false;window.location.href = "list-enquiry.php";}, 3000);
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
	};
	
	$scope.GetEnquiryList = function()
	{
		$http.get("load_enquires.php")
		.then(function successCallback(response)
		{
			var data = response.data;
			if(data=="NoData")
			{
				$scope.EnquiryArray = "";
			}
			else
			{
				$scope.EnquiryArray = data;	
			}
			
	   }, function errorCallback(response) {
		// called asynchronously if an error occurs
		// or server returns response with an error status.
	  });
	}
	
	
	$scope.EditEnquiry = function(PkId,Name,EmailId,MobileNo,City,Specialization,Courseinterest,Type,Enquiry)
	{
		
		$scope.ListEnquiries = false;
	    $scope.EditEnquiries = true;
		
		//alert(Countryid);
		$scope.enquirypkid = PkId;
		$scope.enquiryname = Name;
		$scope.enquiryemail = EmailId;
		$scope.enquirymobile = MobileNo;
		$scope.enquirycity = City;
		$scope.enquiryspecialization = Specialization;
		$scope.enquirycourseinterest = Courseinterest;
		$scope.enquirytype = Type;
		$scope.editenquiry = Enquiry;
		//$scope.editdateofenroll = new Date(DateofEnrolled);

	}
	
	
	$scope.UpdateEnquiry = function (Update)
	{
        $scope.submitted = true;
		//console.log('editdateofenroll');
		$http.post('update_enquiry_process.php',{
			'updatepkid':$scope.enquirypkid,
			'updatename':$scope.enquiryname,
			'updateemail':$scope.enquiryemail,
			'updatemobile':$scope.enquirymobile,
			'updatecity':$scope.enquirycity,
			'updatespecialization':$scope.enquiryspecialization,
			'updatecourseinterest':$scope.enquirycourseinterest,
			'updatetype':$scope.enquirytype,
			'updateenquiry':$scope.editenquiry
		})
		.then(function successCallback(response)
		{
			var data = response.data;
			
			if(data=="Success")
			{
				$scope.submitted = false;
				$scope.SuccessAlert = "Enquiry updated successfully";
				$scope.showSuccessAlert = true;
				$scope.showWarningAlert = false;
			
				$scope.Update = {};
				$scope.EnquiryForm.$setPristine();
				$scope.EnquiryForm.$setUntouched();
							
				$timeout(function () { $scope.showSuccessAlert = false;window.location.href = "list-enquiry.php";}, 3000);
			}
			else
			{
				$scope.WarningAlert = data;
				$scope.showWarningAlert = true;
			
				//$scope.Update = {};
				//$scope.EnquiryForm.$setPristine();
				//$scope.EnquiryForm.$setUntouched();
				
				$timeout(function () { $scope.showWarningAlert = false; $scope.submitted = false;}, 5000);
			}
			
		}, function errorCallback(response) {
    		// called asynchronously if an error occurs
		    // or server returns response with an error status.
		  });
	};
	
	
	$scope.DeleteEnquiry = function(PkId)
	{
		var answer = confirm("Do you want to Delete?")
		if (!answer)
		{               
		}
		else
		{
			$scope.submitted = true;
			$http.post('delete_enquires_process.php', {'PkId':PkId})
			.then(function successCallback(response)
			{
				var data = response.data;
				if(data=="Success")
				{
					$scope.SuccessAlert = "Enquiry deleted successfully";
					$scope.showSuccessAlert = true;
					$scope.showWarningAlert = false;
   				
					$timeout(function () { window.location.href = "list-enquiry.php"; }, 3000);
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