<?php
error_reporting(0);
session_start();
if($_SERVER["REQUEST_METHOD"]==="POST")
{
	$data = json_decode(file_get_contents("php://input"));
	
	$loginUname = $data->loginUname;
	$loginPassword = $data->loginPassword;
	
    if($loginUname!="" && $loginPassword!="")
	{
		    include_once("CommonUtilities/Connections.php");
		    include_once("CommonUtilities/Functions.php");
		
		    $deletestatus = 0;
			//$data1 = array();
			$sql = $dbConnection->prepare("SELECT Pkid,Name,EmailId FROM superadmin WHERE EmailId=? AND DeleteStatus=?");
			$sql->execute(array($loginUname,$deletestatus));
			$num = $sql->rowCount();
			if($num>0)
			{
				$row = $sql->fetch();
				$Id = $row['Pkid'];
				$Name = $row['Name'];
				$Email = $row['EmailId'];
				
				$sql_one = $dbConnection->prepare("SELECT Pkid_SAdmin,ParolString,TuzString FROM password WHERE Pkid_SAdmin=?");
				$sql_one->execute(array($Id));
				$num_one = $sql_one->rowCount();
				if($num_one>0)
				{
					$row1 = $sql_one->fetch();
					$password_string = $row1['ParolString'];
					$salt_string = $row1['TuzString'];
						
					$hashkey = hash('sha256',$loginPassword);
					$password_hashkey = hash('sha256',$salt_string.$hashkey);
					
					if($password_string==$password_hashkey)
					{
						$_SESSION['UserId'] = $Id;
						$_SESSION['Name'] = $Name;

						
						$result = "Success";
						echo $result;
					}
					else
					{
						$result = "Invalid Possword";
						echo $result;
					}
				}
				else
				{
					$result = "Invalid Username";
					echo $result;					
				}
			}
			else
			{
				$result = "Invalid data";
					echo $result;
			}
				
	}
	else
	{
		$result = "Please fill the required fields";
		echo $result;
	}
	
}
else
{

	$result = "Please fill the form,First";
	echo $result;
}
?>