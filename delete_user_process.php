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
			//$deletestatus= 1;
			$status = "Inactive";	
			include_once("CommonUtilities/Connections.php");
			include_once "CommonUtilities/Functions.php";
			
			$query = $dbConnection->prepare("UPDATE user_log SET status=? WHERE user_id=?");
			$query->execute(array($status,$PkId));
			
		
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