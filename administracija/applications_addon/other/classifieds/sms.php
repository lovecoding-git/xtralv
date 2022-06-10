<?php
require_once('sms_fns.php');

if (!in_array($_SERVER['REMOTE_ADDR'],array("91.247.72.34", "91.247.72.46", "217.199.115.18", "80.255.224.34", "80.255.238.34"))) exit("Don't cheat");

$conn = db_payments_connect();

if(isset($_GET['charged']))
{
	 $query = "UPDATE `sms_log`  
		 SET 
		  `charged` = '1'
		 WHERE
		  `sms_id` = '".$_GET["sms-id"]."'";
	 
	 $conn->query($query);
	 
	 exit();
}
else
{
	 $query = "INSERT INTO `sms_log` 
		 SET
		  `time` = NOW(),
		  `from_nr` = '".$_GET["from"]."',
		  `to_nr` = '".$_GET["to"]."',
		  `service_id` = '".$_GET["service_id"]."',
		  `operator_id` = '".$_GET["operator-id"]."',
		  `text` = '".$_GET["text"]."',
		  `sms_id` = '".$_GET["sms-id"]."'";

	$conn->query($query);
	
	header("x-esteria-price: 0.71EUR");

	$code = generate_code();
	 
	insert_code($code, strtolower($_GET["text"]), $_GET["from"]);
	 
	echo "Paldies, maksajums veiksmigi sanemts. XTRA.lv pakalpojuma kods: ".$code." Spasibo, platyozh uspeshno poluchen.";
	exit(); 
}

?> 