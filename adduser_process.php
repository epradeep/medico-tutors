<?php
error_reporting(E_ALL);
session_start();
if($_SESSION['UserId']!="")
{
	if($_SERVER["REQUEST_METHOD"]==="POST")
	{
		$data = json_decode(file_get_contents("php://input"));
		
		$fullname = $data->fullname;
		$username = $data->username;
		$mobileno = $data->mobileno;
		$emailid = $data->emailid;
		$password = $data->password;
		$specialization = $data->specialization;
		$city = $data->city;
		$country = $data->country;
		$guname = $data->guname;
		$gdegreename = $data->gdegreename;
		$graduationyear = $data->graduationyear;
		$pguname = $data->pguname;
		$pgdname = $data->pgdname;
		$pgyear = $data->pgyear;
		$cfileone = $data->cfileone;
		$cfiletwo = $data->cfiletwo;
		$cfilethree = $data->cfilethree;
		$cfilefour = $data->cfilefour;
		$cfilefive = $data->cfilefive;
		
		if($fullname!="" && $username!="" && $mobileno!="" && $emailid!="" && $password!="" && $specialization!="" && $city!="" && $country!="" && $guname!="" && $gdegreename!="" && $graduationyear!="" && $pguname!="" && $pgdname!="" && $pgyear!="")
		{
				include_once("CommonUtilities/Connections.php");
				include_once "CommonUtilities/Functions.php";

				$datetime = GetDateTime();
				//$enrolldate = date("Y-m-d",strtotime($enrolldate));

				$sql=$dbConnection->prepare("SELECT user_id,uniqid FROM user_log ORDER BY user_id DESC") ;
				$sql->execute();
				$rowCount=$sql->rowCount();
				if($rowCount>0)
				{
					$row=$sql->fetch();	
					$value=substr($row['uniqid'],2);
					$one=1;
					$variable=$value+$one;
					$mvuid="MV"."$variable";
				}
				else
				{
					$mvuid="MV1";
				}
				
				$query=$dbConnection->prepare("INSERT INTO user_log(uniqid,name,username,mobile,emailid,password,specialization,city,country,graduation_uname,graduation_degree,graduation_year,pg_uname,pg_degree,pg_year,doc_one,doc_two,doc_three,doc_four,doc_five,date_registered) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
				$query->execute(array($mvuid,$fullname,$username,$mobileno,$emailid,$password,$specialization,$city,$country,$guname,$gdegreename,$graduationyear,$pguname,$pgdname,$pgyear,$cfileone,$cfiletwo,$cfilethree,$cfilefour,$cfilefive,$datetime));
				
				
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