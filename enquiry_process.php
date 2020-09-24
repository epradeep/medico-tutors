<?php
error_reporting(0);
session_start();
if($_SESSION['UserId']!="")
{
	if($_SERVER["REQUEST_METHOD"]==="POST")
	{
		
		$data = json_decode(file_get_contents("php://input"));
		
		$pname = $data->pname;
		$emailid = $data->emailid;
		$mobileno = $data->mobileno;
		$city = $data->city;
		$specialization = $data->specialization;
		$courseinterest = $data->courseinterest;
		$specilizetype = $data->specilizetype;
		$enquirytext = $data->enquirytext;
		
		if($pname!="" && $emailid!="" && $mobileno!="" && $city!="" && $specialization!="" && $courseinterest!="" && $specilizetype!="")
		{
				include_once("CommonUtilities/Connections.php");
				include_once("CommonUtilities/Functions.php");

				$datetime = GetDateTime();
				//$enrolldate = date("Y-m-d",strtotime($enrolldate));
				//$data1 = array();
				
				$query = $dbConnection->prepare("INSERT INTO course_enquires(name,emailid,specialization,mobile,city,course_interest,enquiry,type,date_submited) VALUES (?,?,?,?,?,?,?,?,?)");
				$query->execute(array($pname,$emailid,$specialization,$mobileno,$city,$courseinterest,$enquirytext,$specilizetype,$datetime));
				
				
			    $result = "Success";
			    echo $result;
		}
		else
		{
			$result = "Enter Mandatory fields";
			echo $result;
		}

    }
    else
	{
		$result = "Invalid";
		echo $result;
	}	
}
else
{
    echo "<script language=\'javascript\'>window.location=\'logout.php\';</script>";
}
?>