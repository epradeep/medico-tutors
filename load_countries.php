<?php
error_reporting(0);
session_start();
if($_SESSION['UserId']!="")
{
		include_once("CommonUtilities/Connections.php");
				
		$UserId = $_SESSION['UserId'];		

		$data = json_decode(file_get_contents("php://input"));

		$deletestatus = 0;
		$data1 = array();  
			
		$query = $dbConnection->prepare("SELECT * FROM countries WHERE DeleteStatus=?");
		$query->execute(array($deletestatus));
		$num = $query->rowCount();
		if($num>0)
		{	$a=0;
			while($rows = $query->fetch())
			{
				$PkId = $rows['PkId'];
				$CountryName = $rows['CountryName'];			

				$data1[] = array("PkId"=>$PkId,"CountryName"=>$CountryName);
				$a++;
			}
			echo (json_encode($data1));
		}	
		else
		{
			echo "Invalid Data";
			echo $result;
		}
}
else
{	
	
	echo "<script language=\'javascript\'>window.location=\'index.php\';</script>";
}
?>