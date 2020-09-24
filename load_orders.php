<?php
error_reporting(E_ALL);
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
			
		$query = $dbConnection->prepare("SELECT * FROM courses_ordered WHERE status=? ORDER BY order_id DESC");
		$query->execute(array($status));
		$num = $query->rowCount();
		if($num>0)
		{	
	        $a=0;
			while($rows = $query->fetch())
			{
				$PkId = $rows['order_id'];
				$courseid = $rows['course_id'];
                $user_id = $rows['user_id'];
                $transid = $rows['trans_id'];
                $cheque = $rows['cheque'];
                $amountdeposited = $rows['amount_deposited'];
                $bankname = $rows['bank_name'];
                $paymentthrough = $rows['payment_through'];
                $status = $rows['status'];
                
                $datetransaction = date("m-d-Y", strtotime($rows['date_transaction']));

                $coursename="'";
                if($courseid=="1")
                {
                    $coursename="Basic Pain Management for Doctors";
                }
                elseif ($courseid=="2") {

                	$coursename="Advanced Pain Management for Doctors";
                }
                elseif ($courseid=="3") {

                	$coursename="Principles of Pain Management for Nurses";
                }
                elseif ($courseid=="4") {

                	$coursename="Interventional Pain Management";
                }

				

				$query1 = $dbConnection->prepare("SELECT name FROM user_log WHERE user_id=?");
		        $query1->execute(array($user_id));
				
				$row1 = $query1->fetch();
				
				$fullname = $row1['name'];
				

				$data1[] = array(
				 "PkId"=>$PkId,
				 "CourseId"=>$courseid,
				 "CourseName"=>$coursename,
				 "Userid"=>$user_id,
				 "Username"=>$fullname,
				 "TransId"=>$transid,
				 "Cheque"=>$cheque,
				 "AmountDeposited"=>$amountdeposited,
                 "BankName"=>$bankname,

				 "Paymentthrough"=>$paymentthrough,
				 "DateTransaction"=>$datetransaction,
				 "Status"=>$status
				
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