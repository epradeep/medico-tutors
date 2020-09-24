<?php
error_reporting(E_ALL);
include_once("CommonUtilities/Connections.php");
include_once "CommonUtilities/Functions.php";

$sql = $dbConnection->prepare("SELECT user_id,uniqid FROM user_log ORDER BY user_id DESC") ;
$sql->execute();
$rowCount = $sql->rowCount();
if($rowCount>0)
{
	$row = $sql->fetch();	
	$value = $row['uniqid'];

	echo "lastdb-value: $value<br />";


	$edit = substr($value, 2);
	echo "lastdb-value-edited: $edit<br />";
	
	$one = 1;

	$variable = $edit + $one;
	echo "plus-value: $variable<br />";


	$mvuid = "MV"."$variable";
	//echo "final-value: $mvuid<br />";
	


/*
	Don't just copy paste try to google & study first 
	its basic learning process
*/

}
else
{
	$mvuid = "MV1";
}

echo "$mvuid<br />";
?>