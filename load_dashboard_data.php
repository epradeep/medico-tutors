<?php
error_reporting(0);
session_start();
if($_SESSION['UserId']!="")
{

		include_once("CommonUtilities/Connections.php");
		include_once "CommonUtilities/Functions.php";
				
		$UserId = $_SESSION['UserId'];		

		$data = json_decode(file_get_contents("php://input"));

		$deletestatus = 0;
		$status = "Active";
        $logstatus = "Approved";
		$data1 = array();  
			
		$query = $dbConnection->prepare("SELECT * FROM course_enrollment WHERE DeleteStatus=?");
		$query->execute(array($deletestatus));
		$EnrollmentsCount = $query->rowCount();


		$query1 = $dbConnection->prepare("SELECT * FROM course_enquires WHERE status=?");
		$query1->execute(array($status));
		$EnquiresCount = $query1->rowCount();

		$query2 = $dbConnection->prepare("SELECT * FROM courses_ordered WHERE status=?");
		$query2->execute(array($status));
		$OrderesCount = $query2->rowCount();

		$query3 = $dbConnection->prepare("SELECT * FROM ipm_videos WHERE status=?");
		$query3->execute(array($status));
		$VideosCount = $query3->rowCount();

		$query4 = $dbConnection->prepare("SELECT * FROM user_log WHERE log_status=? AND status=?");
		$query4->execute(array($logstatus,$status));
		$UsersCount = $query4->rowCount();


		
		$data1[] = array("EnrollmentsCount"=>$EnrollmentsCount,"EnquiresCount"=>$EnquiresCount,"OrderesCount"=>$OrderesCount,"VideosCount"=>$VideosCount,"UsersCount"=>$UsersCount);
		echo (json_encode($data1));

}
else
{	
	
	echo "<script language=\"javascript\">window.location=\"index.php\";</script>";
}
?>