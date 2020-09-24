<?php
error_reporting(E_ALL);
session_start();
if($_SESSION['UserId']!="")
{
		include_once("CommonUtilities/Connections.php");
				
		$UserId = $_SESSION['UserId'];		

		$data = json_decode(file_get_contents("php://input"));

		$deletestatus = 0;
		$data1 = array();  
			
		$query = $dbConnection->prepare("SELECT * FROM course_enrollment WHERE DeleteStatus=? ORDER BY ceid DESC");
		$query->execute(array($deletestatus));
		$num = $query->rowCount();
		if($num>0)
		{	
	        $a=0;
			while($rows = $query->fetch())
			{
				$PkId = $rows['ceid'];
				$name = $rows['name'];
                $emailid = $rows['emailid'];
                $mobile = $rows['mobile'];
                $city = $rows['city'];
                $countryid = $rows['country'];
                $course = $rows['course'];
                $date_submited = date("m-d-Y", strtotime($rows['date_submited']));
				
                
				$query1 = $dbConnection->prepare("SELECT CountryName FROM countries WHERE PkId=? AND DeleteStatus=?");
		        $query1->execute(array($countryid,$deletestatus));
				
				$row1 = $query1->fetch();
				
				$CountryName = $row1['CountryName'];
				

				$data1[] = array(
				 "PkId"=>$PkId,
				 "Name"=>$name,
				 "EmailId"=>$emailid,
				 "MobileNo"=>$mobile,
				 "City"=>$city,
				 "Countryid"=>$countryid,
				 "CountryName"=>$CountryName,
				 "CourseName"=>$course,
				 "DateofEnrolled"=>$date_submited
				
				);
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