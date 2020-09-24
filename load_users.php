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
		$logstatus = "Approved";
		$status = "Active";
		$batch = "All";
		$data1 = array();  
			
	    $query=$dbConnection->prepare("SELECT * FROM user_log WHERE log_status=? AND status=? AND batch=? ORDER BY user_id DESC");
		$query->execute(array($logstatus,$status,$batch));
		$num=$query->rowCount();
		if($num>0)
		{	
	        $a=0;
			while($rows = $query->fetch())
			{
				$PkId = $rows['user_id'];
				$uniqid = $rows['uniqid'];
				
				$name = $rows['name'];
				$username = $rows['username'];
				$mobile = $rows['mobile'];
                $emailid = $rows['emailid'];
                $password = $rows['password'];
                $specialization = $rows['specialization'];
                $city = $rows['city'];
                $country = $rows['country'];
                $graduationuname = $rows['graduation_uname'];
                $graduationdegree = $rows['graduation_degree'];
                $graduationyear = $rows['graduation_year'];

                $pguname = $rows['pg_uname'];
                $pgdegree = $rows['pg_degree'];
                $pgyear = $rows['pg_year'];
                $docone = $rows['doc_one'];
                $doctwo = $rows['doc_two'];
                $docthree = $rows['doc_three'];
                $docfour = $rows['doc_four'];
                $docfive = $rows['doc_five'];

                
                $dateregistered = date("d-m-Y", strtotime($rows['date_registered']));
				
				/*$query1 = $dbConnection->prepare("SELECT CountryName FROM countries WHERE CountryName=? AND DeleteStatus=?");
		        $query1->execute(array($country,$deletestatus));
				
				$row1 = $query1->fetch();
				
				$CountryName = $row1['CountryName'];
				*/
				

				$data1[] = array(
				 "PkId"=>$PkId,
				 "Name"=>$name,
				 "UserName"=>$username,
				 "MobileNo"=>$mobile,
				 "EmailId"=>$emailid,
				 "Password"=>$password,
				 "Specialization"=>$specialization,
				 "City"=>$city,
				 "Country"=>$country,
				 "GraduationUname"=>$graduationuname,
				 "GraduationDegree"=>$graduationdegree,
				 "GraduationYear"=>$graduationyear,
				 "PgUname"=>$pguname,
				 "PgDegree"=>$pgdegree,
				 "Pgyear"=>$pgyear,
                 "DocOne"=>$docone,
                 "DocTwo"=>$doctwo,
                 "DocThree"=>$docthree,
                 "DocFour"=>$docfour,
                 "DocFive"=>$docfive,

				 "DateofRegistered"=>$dateregistered
				
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