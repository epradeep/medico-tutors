<?php
error_reporting(E_ALL);
session_start();
if($_SESSION['UserId']!="")
{
	if($_SERVER["REQUEST_METHOD"]==="POST")
	{
		$data = json_decode(file_get_contents("php://input"));
		
		$pkid = $data->pkid;
		$editcoursename = $data->editcoursename;
		$editname = $data->editname;
		$editemail = $data->editemail;
		$editmobile = $data->editmobile;
		$editcountryname = $data->editcountryname;
		$editcity = $data->editcity;
		$editdateofenroll = $data->editdateofenroll;
		
		if($pkid!="" && $editcoursename!="" && $editname!="" && $editemail!="" && $editmobile!="" && $editcountryname!="" && $editcity!="" && $editdateofenroll!="")
		{
				include_once("CommonUtilities/Connections.php");
				include_once "CommonUtilities/Functions.php";

				$datetime = GetDateTime();
				$deletestatus = 0;
				
				$editdateofenroll = date("Y-m-d",strtotime($editdateofenroll));
				
     $query = $dbConnection->prepare("UPDATE course_enrollment SET name=?,emailid=?,mobile=?,city=?,country=?,course=?,date_submited=? WHERE ceid=? AND DeleteStatus=?");
				$query->execute(array($editname,$editemail,$editmobile,$editcity,$editcountryname,$editcoursename,$editdateofenroll,$pkid,$deletestatus));
				
				
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