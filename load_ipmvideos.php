<?php
error_reporting(0);
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
			
		$query = $dbConnection->prepare("SELECT * FROM ipm_videos WHERE status=? ORDER BY ipm_id DESC");
		$query->execute(array($status));
		$num = $query->rowCount();
		if($num>0)
		{	
	        $a=0;
			while($rows = $query->fetch())
			{
				$PkId = $rows['ipm_id'];
				$category_name = $rows['category_name'];
				$video_name = $rows['video_name'];
				$video_source = $rows['video_source'];
				$duration = $rows['duration'];
				$type = $rows['type'];
				$batch = $rows['batch'];


				$data1[] = array(
				 "PkId"=>$PkId,
				 "CategoryName"=>$category_name,
				 "VideoName"=>$video_name,
				 "VideoSource"=>$video_source,
				 "Duration"=>$duration,
				 "Type"=>$type,
				 "Batch"=>$batch
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