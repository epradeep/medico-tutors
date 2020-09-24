<?php
error_reporting(E_ALL);
session_start();
if($_SESSION['UserId']!="")
{

	if($_SERVER["REQUEST_METHOD"]==="POST")
	{
		$adminid = $_SESSION['UserId'];

		$data = json_decode(file_get_contents("php://input"));
		
		$currentpwd = $data->currentpassword;
		$newpwd = $data->password;
		$retypwd = $data->confirmpassword;
		
		
	    if($currentpwd!="" && $newpwd!="" && $retypwd!="")
		{
			    include_once("CommonUtilities/Connections.php");
			    include_once("CommonUtilities/Functions.php");
			
			    $deletestatus = 0;
				$datetime = GetDateTime();
				
				$query = $dbConnection->prepare("SELECT ParolString,TuzString FROM password WHERE Pkid_SAdmin=?");
				$query->execute(array($adminid));
				$row = $query->fetch();
				$Password = $row['ParolString'];		
				$pwdsalt = $row['TuzString'];
				$currentpwd_hash = hash('sha256', $currentpwd);	
				$encrypted_password = hash('sha256', $pwdsalt . $currentpwd_hash);

				if($Password==$encrypted_password)
				{
					if($newpwd==$retypwd)
					{
						$hash = hash('sha256', $newpwd);					
						$md5 = md5(uniqid(rand(), TRUE));					
						$salt = substr($md5, 0, 3);					
						$enc_pwd = hash('sha256', $salt . $hash);
						
								
						$query1 = $dbConnection->prepare("UPDATE password SET ParolString=?,TuzString=? WHERE Pkid_SAdmin=?");
						$query1->execute(array($enc_pwd,$salt,$adminid));		
						
							
						$result= "Success";
						echo $result;
					}
					else
					{
						$result = "Please re-type correct password.";
						echo $result;
					}
				}	
				else
				{
					$result = "Invalid password.";
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

}
else
{ 
   echo "<script language=\'javascript\'>window.location=\'index.php\';</script>";
}

?>