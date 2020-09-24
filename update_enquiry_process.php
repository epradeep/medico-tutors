<?php
error_reporting(E_ALL);
session_start();
if($_SESSION['UserId']!="")
{
	if($_SERVER["REQUEST_METHOD"]==="POST")
	{
		$data = json_decode(file_get_contents("php://input"));
		
		$updatepkid = $data->updatepkid;
		$updatename = $data->updatename;
		$updateemail = $data->updateemail;
		$updatemobile = $data->updatemobile;
		$updatecity = $data->updatecity;
		$updatespecialization = $data->updatespecialization;
		$updatecourseinterest = $data->updatecourseinterest;
		$updatetype = $data->updatetype;
		$updateenquiry = $data->updateenquiry;
		
		if($updatepkid!="" && $updatename!="" && $updateemail!="" && $updatemobile!="" && $updatecity!="" && $updatespecialization!="" && $updatecourseinterest!="" && $updatetype!="")
		{
				include_once("CommonUtilities/Connections.php");
				include_once "CommonUtilities/Functions.php";

				$datetime = GetDateTime();
				$status = "Active";
				//$deletestatus = 0;
				
				//$editdateofenroll = date("Y-m-d",strtotime($editdateofenroll));
				
                $query=$dbConnection->prepare("UPDATE course_enquires SET name=?,emailid=?,specialization=?,mobile=?,city=?,	course_interest=?,enquiry=?,type=?,date_submited=? WHERE quiry_id=? AND status=?");
				$query->execute(array($updatename,$updateemail,$updatespecialization,$updatemobile,$updatecity,$updatecourseinterest,$updateenquiry,$updatetype,$datetime,$updatepkid,$status));
				
				
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