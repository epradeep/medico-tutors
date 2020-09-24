<?php
error_reporting(E_ALL);
session_start();
if($_SESSION['UserId']!="")
{
		include_once("CommonUtilities/Connections.php");
		include_once "CommonUtilities/Functions.php";
				
		$UserId = $_SESSION['UserId'];		

		$data = json_decode(file_get_contents("php://input"));

		$deletestatus = 0;
		$data1 = array();  
			
		$query = $dbConnection->prepare("SELECT * FROM specialization WHERE DeleteStatus=?");
		$query->execute(array($deletestatus));
		$num = $query->rowCount();
		if($num>0)
		{	$a=0;
			while($rows = $query->fetch())
			{
				$PkId = $rows['PkId'];
				$Specialization = $rows['Specialization'];			

				$data1[] = array("PkId"=>$PkId,"SpecializeName"=>$Specialization);
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
	
	echo "<script language=\"javascript\">window.location=\"index.php\";</script>";
}
?>