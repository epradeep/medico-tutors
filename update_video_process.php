<?php
error_reporting(0);
session_start();
if($_SESSION['UserId']!="")
{
	if($_SERVER["REQUEST_METHOD"]==="POST")
	{
		$data = json_decode(file_get_contents("php://input"));
		
		$updateipmpkid = $data->updatepkid;
		$updatecategoryname = $data->updatecategoryname;
		$updatevideoname = $data->updatevideoname;
		$updatevideosource = $data->updatevideosource;
		$updateduration = $data->updateduration;
		$updatetype = $data->updatetype;
		$updatebatch = $data->updatebatch;
		
		if($updateipmpkid!="" && $updatecategoryname!="" && $updatevideoname!="" && $updatevideosource!="" && $updateduration!="" && $updatetype!="" && $updatebatch!="")
		{
				include_once("CommonUtilities/Connections.php");
				include_once "CommonUtilities/Functions.php";

				$datetime = GetDateTime();
				$status = "Active";
				//$deletestatus = 0;
				
                $query=$dbConnection->prepare("UPDATE ipm_videos SET category_name=?,video_name=?,video_source=?,duration=?,type=?,batch=?,datemodified=? WHERE ipm_id=? AND status=?");
				$query->execute(array($updatecategoryname,$updatevideoname,$updatevideosource,$updateduration,$updatetype,$updatebatch,$datetime,$updateipmpkid,$status));
				
				
			    $result = "Success";
			    echo $result;
		}
		else
		{
			$result = "Enter Mandatory fields";
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
   echo "<script language=\'javascript\'>window.location=\'logout.php\';</script>";
}
?>