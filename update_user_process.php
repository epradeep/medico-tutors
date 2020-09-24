<?php
error_reporting(0);
session_start();
if($_SESSION['UserId']!="")
{
	if($_SERVER["REQUEST_METHOD"]==="POST")
	{
		$data = json_decode(file_get_contents("php://input"));
		
		$updatepkid = $data->updatepkid;
		$editfname = $data->editfname;
		$edituname = $data->edituname;
		$editmobileno = $data->editmobileno;
		$editemailid = $data->editemailid;
		$editpassword = $data->editpassword;
		$editspecialization = $data->editspecialization;
		$editcity = $data->editcity;
		$editcountry = $data->editcountry;
		$editguname = $data->editguname;
		$editgdegreename = $data->editgdegreename;
		$editgraduationyear = $data->editgraduationyear;
		$editpguname = $data->editpguname;
		$editpgdname = $data->editpgdname;
		$editpgyear = $data->editpgyear;

		$updatefileone = $data->updatefileone;
		$updatefiletwo = $data->updatefiletwo;
		$updatefilethree = $data->updatefilethree;
		$updatefilefour = $data->updatefilefour;
		$updatefilefive = $data->updatefilefive;
		
		
		if($updatepkid!="" && $editfname!="" && $edituname!="" && $editmobileno!="" && $editemailid!="" && $editpassword!="" && $editspecialization!="" && $editcity!="" && $editcountry!="" && $editguname!="" && $editgdegreename!="" && $editgraduationyear!="" && $editpguname!="" && $editpgdname!="" && $editpgyear!="")
		{
				include_once("CommonUtilities/Connections.php");
				include_once "CommonUtilities/Functions.php";

				$datetime = GetDateTime();
				$logstatus = "Approved";
				$status = "Active";
				$batch = "All";
				//$deletestatus = 0;

		    if($updatefileone=="" && $updatefiletwo=="" && $updatefilethree=="" && $updatefilefour=="" && $updatefilefive=="")
		    {
				
                $query=$dbConnection->prepare("UPDATE user_log SET name=?,username=?,mobile=?,emailid=?,password=?,specialization=?,city=?,country=?,graduation_uname=?,graduation_degree=?,graduation_year=?,pg_uname=?,pg_degree=?,pg_year=? WHERE user_id=?");
				$query->execute(array($editfname,$edituname,$editmobileno,$editemailid,$editpassword,$editspecialization,$editcity,$editcountry,$editguname,$editgdegreename,$editgraduationyear,$editpguname,$editpgdname,$editpgyear,$updatepkid));
			}
			else
			{

				$query=$dbConnection->prepare("UPDATE user_log SET name=?,username=?,mobile=?,emailid=?,password=?,specialization=?,city=?,country=?,graduation_uname=?,graduation_degree=?,graduation_year=?,pg_uname=?,pg_degree=?,pg_year=?,doc_one=?,doc_two=?,doc_three=?,doc_four=?,doc_five=? WHERE user_id=?");
				$query->execute(array($editfname,$edituname,$editmobileno,$editemailid,$editpassword,$editspecialization,$editcity,$editcountry,$editguname,$editgdegreename,$editgraduationyear,$editpguname,$editpgdname,$editpgyear,$updatefileone,$updatefiletwo,$updatefilethree,$updatefilefour,$updatefilefive,$updatepkid));

			}
				
				
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
  echo "<script language=\"javascript\">window.location=\"logout.php\";</script>";
}
?>