<?php
error_reporting(0);
session_start();
if($_SERVER["REQUEST_METHOD"]==="POST")
{
	$data = json_decode(file_get_contents("php://input"));
	
	$forgotemail = $data->forgotemail;
	
    if($forgotemail!="")
	{
		    include_once("CommonUtilities/Connections.php");
		    include_once("CommonUtilities/Functions.php");
		
		    $deletestatus = 0;
			//$data1 = array();
			$sql = $dbConnection->prepare("SELECT Pkid,Name,EmailId FROM superadmin WHERE EmailId=? AND DeleteStatus=?");
			$sql->execute(array($forgotemail,$deletestatus));
			$num = $sql->rowCount();
			if($num>0)
			{
				$row = $sql->fetch();
				$Id = $row['Pkid'];
				$Name = $row['Name'];
				$Email = $row['EmailId'];

				$newpwd = uniqid(rand(), true);	
			    echo $fnewpwd = substr($newpwd, 0, 8);			
			    $hash = hash('sha256', $fnewpwd);					
			    $md5 = md5(uniqid(rand(), TRUE));					
			    $salt = substr($md5, 0, 3);					
			    $enc_pwd = hash('sha256', $salt . $hash);
				
				$sql_one = $dbConnection->prepare("UPDATE password SET ParolString=?,TuzString=? WHERE Pkid_SAdmin=?");
				$sql_one->execute(array($enc_pwd,$salt,$Id));


				/*
				$From = "Medico Vibes";
				$FromId = "support@dotweb.in";
			    $BCC = "support@dotweb.in";
				$CC = "support@dotweb.in";
			
				$subject = "You are request to Forgot Password";

				$message = "Dear $Name,\n\nYou request to reset forgotten password.\n\nYour User-Name/Email-Id: $forgotemail\n\n\nBelow is the new password, Please change it after login:\n\nNew Password: $newpwd\n\nTo Login with your password.\n\n\nRegards,\nSupport Team,\nMedico Vibes";

				$headers = "Reply-To: $From <$FromId>\r\n";
				$headers .= "Return-Path: $From <$FromId>\r\n";
				$headers .= "From: $From <$FromId>\r\n";
				$headers .= "Organization: $From\r\n";
				$headers .= "Content-Type: text/plain\r\n";
				$headers .= "X-Sender: <$FromId>\n";
				$headers .= "X-Mailer: PHP\n"; // mailer
				$headers .= "X-Priority: 1\n"; //1 Urgent Message, 3 Normal
				$headers .= "Bcc:$BCC"."\n";
				$headers .= "Cc:$CC\n";
				
				mail($forgotemail,$subject,$message,$headers);
				*/
		

					
			    $result= "Success";
				echo $result;
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