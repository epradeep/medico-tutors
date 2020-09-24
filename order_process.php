<?php
error_reporting(0);
session_start();
if($_SESSION['UserId']!="")
{
	if($_SERVER["REQUEST_METHOD"]==="POST")
	{
		
		$data = json_decode(file_get_contents("php://input"));
		
		$coursename = $data->coursename;
		$username = $data->username;
		$transactionid = $data->transactionid;
		$chequenumber = $data->chequenumber;
		$transactiondate = $data->transactiondate;
		$amountdeposited = $data->amountdeposited;
		$bankname = $data->bankname;
		$paymentthrough = $data->paymentthrough;

		if($coursename!="" && $username!="" && $transactionid!="" && $chequenumber!="" && $transactiondate!="" && $amountdeposited!="" && $bankname!="" && $paymentthrough!="")
		{
				include_once("CommonUtilities/Connections.php");
				include_once("CommonUtilities/Functions.php");

				$datetime = GetDateTime();
				$transactiondate1 = date("Y-m-d",strtotime($transactiondate));
				//$data1 = array();
				
				$query = $dbConnection->prepare("INSERT INTO courses_ordered(course_id,user_id,trans_id,cheque,	date_transaction,amount_deposited,bank_name,payment_through,date_ordered) VALUES (?,?,?,?,?,?,?,?,?)");
				$query->execute(array($coursename,$username,$transactionid,$chequenumber,$transactiondate1,$amountdeposited,$bankname,$paymentthrough,$datetime));
				
				
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