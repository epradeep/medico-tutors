<?php
error_reporting(0);
session_start();
if($_SESSION['UserId']!="")
{
	if($_SERVER["REQUEST_METHOD"]==="POST")
	{

		$data = json_decode(file_get_contents("php://input"));
		
		$categoryname = $data->categoryname;
		$videoname = $data->videoname;
		$videosource = $data->videosource;
		$duration = $data->duration;
		$videotype = $data->videotype;
		$batch = $data->batch;

		
		if($categoryname!="" && $videoname!="" && $videosource!="" && $duration!="" && $videotype!="" && $batch!="")
		{
			include_once("CommonUtilities/Connections.php");
			include_once("CommonUtilities/Functions.php");

			$datetime = GetDateTime();
			//$transactiondate1 = date("Y-m-d",strtotime($transactiondate));
			
			$query = $dbConnection->prepare("INSERT INTO ipm_videos(category_name,video_name,video_source,duration,	type,batch,datemodified) VALUES (?,?,?,?,?,?,?)");
			$query->execute(array($categoryname,$videoname,$videosource,$duration,$videotype,$batch,$datetime));
			
			
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