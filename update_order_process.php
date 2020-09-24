<?php
error_reporting(E_ALL);
session_start();
if($_SESSION['UserId']!="")
{
	if($_SERVER["REQUEST_METHOD"]==="POST")
	{
		$data = json_decode(file_get_contents("php://input"));
		
		$orderpkid = $data->updatepkid;
		//$updatecourseid = $data->updatecourseid;
		$updatecoursename = $data->updatecoursename;


		$updateusername = $data->updateusername;
		$updatetransid = $data->updatetransid;
		$updatecheque = $data->updatecheque;
		$updateamountdeposited = $data->updateamountdeposited;
		$updatebankname = $data->updatebankname;
		$updatepaymentthrough = $data->updatepaymentthrough;
		$updatedatetransaction = $data->updatedatetransaction;
		
		if($orderpkid!="" && $updatecoursename!="" && $updateusername!="" && $updatetransid!="" && $updatecheque!="" && $updateamountdeposited!="" && $updatebankname!="" && $updatepaymentthrough!="" && $updatedatetransaction!="")
		{
				include_once("CommonUtilities/Connections.php");
				include_once "CommonUtilities/Functions.php";

				$datetime = GetDateTime();
				$status = "Active";
				//$deletestatus = 0;
				
				$dateoftransaction = date("Y-m-d",strtotime($updatedatetransaction));
				
                $query=$dbConnection->prepare("UPDATE courses_ordered SET course_id=?,user_id=?,trans_id=?,cheque=?,date_transaction=?,amount_deposited=?,bank_name=?,payment_through=?,date_ordered=? WHERE order_id=? AND status=?");
				$query->execute(array($updatecoursename,$updateusername,$updatetransid,$updatecheque,$dateoftransaction,$updateamountdeposited,$updatebankname,$updatepaymentthrough,$datetime,$orderpkid,$status));
				
				
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