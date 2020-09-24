var Order = angular.module("OrderModule", ['ui.bootstrap'])
Order.controller("OrderController", function ($scope, $timeout, $http, jsonFilter, $window)
{

	$scope.showWarningAlert = false;	
	$scope.showSuccessAlert = false;
	$scope.ListOrders = true;
	$scope.EditOrders = false;


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
        },
        {
            "PkId" : "2",
            "CourseName" : "Advanced Pain Management for Doctors"
        },
        {
            "PkId" : "3",
            "CourseName" : "Principles of Pain Management for Nurses"
        },
        {
            "PkId" : "4",
            "CourseName" : "Interventional Pain Management"
        }
    ]

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


	
	$scope.GotoOrderList = function()
	{		
	    $scope.submitted = false;
		window.location.href = "list-order.php";
	}

	
	$scope.OrderData = function (Order)
	{
        $scope.submitted = true;
		//console.log('enrolldate');
		$http.post('order_process.php',{
			
			'coursename':$scope.coursename,
			'username':$scope.username,
			'transactionid':$scope.transactionid,
			'chequenumber':$scope.chequenumber,
			'transactiondate':$scope.transactiondate,
			'amountdeposited':$scope.amountdeposited,
			'bankname':$scope.bankname,
			'paymentthrough':$scope.paymentthrough
			})
		.then(function successCallback(response)
		{
			var data = response.data;
			
			if(data=="Success")
			{
				$scope.submitted = false;
				$scope.SuccessAlert = "Order added successfully";
				$scope.showSuccessAlert = true;
				$scope.showWarningAlert = false;
			
				$scope.Order = {};
				$scope.OrderForm.$setPristine();
				$scope.OrderForm.$setUntouched();
							
				$timeout(function () { $scope.showSuccessAlert = false;window.location.href = "list-order.php";}, 3000);
			}
			else
			{
				$scope.WarningAlert = data;
				$scope.showWarningAlert = true;
			
				//$scope.Order = {};
				//$scope.OrderForm.$setPristine();
				//$scope.OrderForm.$setUntouched();
				
				$timeout(function () { $scope.showWarningAlert = false; $scope.submitted = false;}, 5000);
			}
			
		  
		}, function errorCallback(response) {
    		// called asynchronously if an error occurs
		    // or server returns response with an error status.
		  });
	};
	
	$scope.GetOrdersList = function()
	{
		$http.get("load_orders.php")
		.then(function successCallback(response)
		{
			var data = response.data;
			if(data=="NoData")
			{
				$scope.OrderArray = "";
			}
			else
			{
				$scope.OrderArray = data;	
			}
			
	   }, function errorCallback(response) {
		// called asynchronously if an error occurs
		// or server returns response with an error status.
	  });
	}
	
	
	$scope.EditOrder = function(PkId,CourseId,CourseName,Userid,Username,TransId,Cheque,AmountDeposited,BankName,Paymentthrough,DateTransaction)
	{
		
		$scope.ListOrders = false;
	    $scope.EditOrders = true;
		
		//alert(CourseId);
		
		$scope.editpkid = PkId;
		//$scope.editcourseid = CourseId;
		$scope.editcoursename = CourseId;
		$scope.edituname = Userid;
		$scope.edittransid = TransId;
		$scope.editcheque = Cheque;
		$scope.editamountdeposited = AmountDeposited;
		$scope.editbankname = BankName;
		$scope.editpaymentthrough = Paymentthrough;
		$scope.editdatetransaction = new Date(DateTransaction);

	}
	
	
	$scope.UpdateOrder = function (Update)
	{
        $scope.submitted = true;
		//console.log('editdateofenroll');
		$http.post('update_order_process.php',{
			'updatepkid':$scope.editpkid,
			'updatecoursename':$scope.editcoursename,
			'updateusername':$scope.edituname,
			'updatetransid':$scope.edittransid,
			'updatecheque':$scope.editcheque,
			'updateamountdeposited':$scope.editamountdeposited,
			'updatebankname':$scope.editbankname,
			'updatepaymentthrough':$scope.editpaymentthrough,
			'updatedatetransaction':$scope.editdatetransaction
		})
		.then(function successCallback(response)
		{
			var data = response.data;
			
			if(data=="Success")
			{
				$scope.submitted = false;
				$scope.SuccessAlert = "Order updated successfully";
				$scope.showSuccessAlert = true;
				$scope.showWarningAlert = false;
			
				$scope.Update = {};
				$scope.OrderForm.$setPristine();
				$scope.OrderForm.$setUntouched();
							
				$timeout(function () { $scope.showSuccessAlert = false;window.location.href = "list-order.php";}, 3000);
			}
			else
			{
				$scope.WarningAlert = data;
				$scope.showWarningAlert = true;
			
				//$scope.Update = {};
				//$scope.OrderForm.$setPristine();
				//$scope.OrderForm.$setUntouched();
				
				$timeout(function () { $scope.showWarningAlert = false; $scope.submitted = false;}, 5000);
			}
			
		}, function errorCallback(response) {
    		// called asynchronously if an error occurs
		    // or server returns response with an error status.
		  });
	};
	
	
	
	$scope.DeleteOrder = function(PkId)
	{
		var answer = confirm("Do you want to Delete?")
		if (!answer)
		{               
		}
		else
		{
			$scope.submitted = true;
			$http.post('delete_order_process.php', {'PkId':PkId})
			.then(function successCallback(response)
			{
				var data = response.data;
				if(data=="Success")
				{
					$scope.SuccessAlert = "Order deleted successfully";
					$scope.showSuccessAlert = true;
					$scope.showWarningAlert = false;
   				
					$timeout(function () { window.location.href = "list-order.php"; }, 3000);
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


    Order.directive('convertToNumber', function() {
	 return {
	   require: 'ngModel',
	   link: function(scope, element, attrs, ngModel) {
	     ngModel.$parsers.push(function(val) {
	       return val != null ? parseInt(val, 10) : null;
	     });
	     ngModel.$formatters.push(function(val) {
	       return val != null ? '' + val : null;
	     });
	   }
	 };
	});
