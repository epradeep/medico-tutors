<?php
error_reporting(E_ALL);
if($_SERVER["REQUEST_METHOD"]==="POST")
{
	$data = json_decode(file_get_contents("php://input"));
	$emailid = $data->emailid;

	if(isset($emailid))
	{
		include_once("CommonUtilities/Connections.php");
		include_once("CommonUtilities/Functions.php");
					
		
		$deletestatus = 0;
			
		$query = $dbConnection->prepare("SELECT EmailId FROM superadmin WHERE EmailId=? AND DeleteStatus=?");
		$query->execute(array($emailid,$deletestatus));
		if($query->rowCount()>0)
		{			
			$result= "OK";
			echo $result;	
		}
		else
		{
			$result= "Email-Id already exists";
			echo $result;			
		}
	}
	else
	{
		echo "Invalid Data";
		echo $result;
	}
}
else
{
	echo "<script language=\'javascript\'>window.location=\'welcome.php\';</script>";
}		
?>