<?php
error_reporting(0);
session_start();
if($_SESSION['UserId']!="")
{
	if($_SERVER["REQUEST_METHOD"]==="POST")
	{
		$data = json_decode(file_get_contents("php://input"));
		
		$coursename = $data->coursename;
		$pname = $data->pname;
		$emailid = $data->emailid;
		$mobileno = $data->mobileno;
		$countryname = $data->countryname;
		$city = $data->city;
		$enrolldate = $data->enrolldate;
		
		if($pname!="" && $emailid!="" && $mobileno!="" && $countryname!="" && $city!="" && $enrolldate!="")
		{
				include_once("CommonUtilities/Connections.php");
				include_once "CommonUtilities/Functions.php";

				$datetime = GetDateTime();
				$enrolldate = date("Y-m-d",strtotime($enrolldate));
				//$data1 = array();
				
				$query = $dbConnection->prepare("INSERT INTO  course_enrollment(name,emailid,mobile,city,country,course,date_submited,CreatedTime) VALUES (?,?,?,?,?,?,?,?)");
				$query->execute(array($pname,$emailid,$mobileno,$city,$countryname,$coursename,$enrolldate,$datetime));
				
				
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
  echo "<script language=\"javascript\">window.location=\"logout.php\";</script>";
}
?>