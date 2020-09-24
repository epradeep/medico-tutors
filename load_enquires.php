<?php
error_reporting(E_ALL);
session_start();
if($_SESSION['UserId']!="")
{
		include_once("CommonUtilities/Connections.php");
		include_once "CommonUtilities/Functions.php";
				
		$UserId = $_SESSION['UserId'];		

		$data = json_decode(file_get_contents("php://input"));

		//$deletestatus = 0;
		$status = "Active";
		$data1 = array();  
			
		$query = $dbConnection->prepare("SELECT * FROM course_enquires WHERE status=? ORDER BY quiry_id DESC");
		$query->execute(array($status));
		$num = $query->rowCount();
		if($num>0)
		{	
	        $a=0;
			while($rows = $query->fetch())
			{
				$PkId = $rows['quiry_id'];
				$name = $rows['name'];
                $emailid = $rows['emailid'];
                $specialization = $rows['specialization'];
                $mobile = $rows['mobile'];
                $city = $rows['city'];
                $course_interest = $rows['course_interest'];
                $enquiry = $rows['enquiry'];
                $type = $rows['type'];
                $status = $rows['status'];
                
                $date_submited = date("d-m-Y", strtotime($rows['date_submited']));
				

				/*$query1 = $dbConnection->prepare("SELECT CountryName FROM countries WHERE PkId=? AND DeleteStatus=?");
		        $query1->execute(array($countryid,$deletestatus));
				
				$row1 = $query1->fetch();
				
				$CountryName = $row1['CountryName'];*/
				

				$data1[] = array(
				 "PkId"=>$PkId,
				 "Name"=>$name,
				 "EmailId"=>$emailid,
				 "Specialization"=>$specialization,
				 "MobileNo"=>$mobile,
				 "City"=>$city,
                 "Courseinterest"=>$course_interest,

				 "Enquiry"=>$enquiry,
				 "Type"=>$type,
				 "Status"=>$status,
				 "DateofEnquiry"=>$date_submited
				
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