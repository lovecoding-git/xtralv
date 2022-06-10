<?php
	function db_payments_connect(){
	
	$result = new mysqli('localhost', 'reklamb_userxtra', '&*V?FD7lJ[84', 'reklamb_xtra');
	if(!$result)
		return false;
	
	$result->query("SET names 'utf8'");
	return $result;
	}
	
	function db_result_to_array($result){
	$res_array = array();
	
	for($count = 0; $row = $result->fetch_assoc(); $count++){
		$res_array[$count] = $row;
		}
	
	return $res_array;
	}
	
	//////////////////////
	
	function generate_code(){
		$length = 6;
		$characters = '23456789ABCDEFGHJKLMNPRSTUVWXYZ';
		$string = '';    
	
		for ($p = 0; $p < $length; $p++) {
			$string .= $characters[mt_rand(0, strlen($characters)-1)];
		}
	
		return $string;
	}
	
	/////////////////////////
	
	function insert_code($code, $service_text, $phone_nr){
	$conn = db_payments_connect();
	
	$query = "INSERT INTO `codes` 
			 SET
			  `time` = NOW(),
			  `service_text` = '$service_text',
			  `code` = '$code',
			  `from_nr` = '$phone_nr'";
	
	$result = $conn->query($query);
	if($conn->error) exit($conn->error);
	
	if (!$result)
		 return false;
	else
		 return true;
	}
	
	/////////////////////////
	
	function valid_code($service_text, $code){
	$conn = db_payments_connect();
	
	$query = "select * from codes where service_text = '$service_text' and code = '$code' and used = 0";
	$result = $conn->query($query);
	if($conn->error) exit($conn->error);
	
	if ($result->num_rows == 1)
		 return true;
	else
		 return false;
	}
	
	////////////////////////
	
	function use_code($service_text, $code){
	$conn = db_payments_connect();
	
	$query = "UPDATE `codes`  
			 SET 
			  `used` = '1'
			 WHERE
			  `code` = '$code' and `service_text` = '$service_text'";
	
	$result = $conn->query($query);
	
	if($conn->error) 
		exit($conn->error);
	}
	
	////////////////////////
?>