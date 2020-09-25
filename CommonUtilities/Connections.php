<?php
	date_default_timezone_set('Asia/Calcutta');

		
	/*$host ="localhost";
	$db_name = "medicovi_app";
	$db_username = "root";
	$db_password = "";*/

	$host ="remotemysql.com";
	$db_name = "QTbGOdLRBF";
	$db_username = "QTbGOdLRBF";
	$db_password = "GQNZOHLOfV";


	
	$dbConnection = new PDO("mysql:dbname=$db_name;host=$host;charset=utf8", "$db_username", "$db_password");	
	$dbConnection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);	
	$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

/*require 'vendor/autoload.php';
use \Mailjet\Resources;

$mailjetApiKey = "65abbf8807dd3aa21bd1127ef1c16665";
$mailjetSecret = "8c52745d075a1774a3ea38e3111aada4";
$mailjet = new Mailjet\Client($mailjetApiKey, $mailjetSecret);*/
?>
