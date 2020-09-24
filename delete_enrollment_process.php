<?php
error_reporting(E_ALL);
session_start();
if($_SESSION['UserId']!="")
{
	if($_SERVER["REQUEST_METHOD"]==="POST")
	{
		$data = json_decode(file_get_contents("php://input"));	
		$PkId = $data->PkId;
		
		if(isset($PkId))
		{
			$deletestatus= 1;	
			include_once("CommonUtilities/Connections.php");
			
			$query = $dbConnection->prepare("UPDATE course_enrollment SET DeleteStatus=? WHERE ceid=?");
			$query->execute(array($deletestatus,$PkId));
			
		
			if($query)
			{				
				$result= "Success";
				echo $result;
			}
			else
			{
				$result= "Unable to delete";
				echo $result;
			}
		}
		else
		{
			$result= "Invalid Data";
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