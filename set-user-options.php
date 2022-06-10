<?php
// konfigurēt XTRA.LV lietotaju nesaņemt paziņojumus epastā, jo tas ir neaktīvs vai neesošs

/* Pārbaudīt piekļuvi */
$secret = 'Jk5eTCN79XsA'; // insert your secret between ''
if(!isset($_GET['secret']) || empty($secret) || ($_GET['secret'] != $secret)) {
	header("HTTP/1.0 404 Not Found");
	die("Error: Invalid signature");
}

/* Vai ir uzstādīts jautājums */
if(!isset($_GET['xcute'])) exit();

/* MySQL CONFIGURĀCIJA */
$db_host = 'localhost';
$db_name = 'reklamb_xtra';
$db_user = 'reklamb_userxtra';
$db_passw = '&*V?FD7lJ[84';

/* use UTF-8 db encoding */
if (isset($_GET['utf8'])) { $utf8 = $_GET['utf8']; } else { $utf8 = false; }


/* FUNKCIJU DEFINĪCIJAS */

function query_db_e($query) {

	global $db_name, $db_host, $db_user, $db_passw, $utf8;

	/* Savienojums, datubaze */
	$link = mysqli_connect($db_host, $db_user, $db_passw, $db_name);
	/* pārbaudīt savienojumu */
	if (mysqli_connect_errno()) {
		printf("Nevar savienoties ar datubazi: %s\n", mysqli_connect_error());
		exit();
	}

	// iestatīt UTF-8 kodējumu
	if ($utf8) mysqli_query($link, "SET NAMES 'utf8'");

	/* SQL pieprasijums */
	$InsertID = FALSE;
	$result = mysqli_query($link, $query) or die("Pieprasijums nesanaca : " . mysqli_error() . "<br><br>" . $query);
	if ($result === TRUE) {
		$InsertID = mysqli_insert_id($link);
	}

	/* rezultātus neatgriež */
	mysqli_close($link);

	/* atgriež INSERTA ID numuru, vai 0, vai FALSE, ja savienojums nebija izveidots */
	return $InsertID;
	
}; // function query_db_e

function query_db_0($query) {

	global $db_name, $db_host, $db_user, $db_passw, $utf8;

	/* Savienojums, datubaze */
	$link = mysqli_connect($db_host, $db_user, $db_passw, $db_name);
	/* pārbaudīt savienojumu */
	if (mysqli_connect_errno()) {
		printf("Nevar savienoties ar datubazi: %s\n", mysqli_connect_error());
		exit();
	}

	// iestatīt UTF-8 kodējumu
	if ($utf8) mysqli_query($link, "SET NAMES 'utf8'");

	/* SQL pieprasijums */
	$result = mysqli_query($link, $query) or die("Pieprasijums nesanaca : " . mysqli_error() . "<br><br>" . $query);

	/* rezultatus rinda */
	$dati = '';
	if ($result) {
		while ($line = mysqli_fetch_row($result)) {
			foreach ($line as $col_value) {
				$dati .= $col_value;
			}
		}
		mysqli_free_result($result);
	}
	mysqli_close($link);

	return $dati;
}; // function query_db_0

function query_db_1($query,$dbx_name="",$utf8=true) {

	global $db_name, $db_host, $db_user, $db_passw, $utf8;

	/* Savienojums, datubaze */
	$link = mysqli_connect($db_host, $db_user, $db_passw, $db_name);
	/* pārbaudīt savienojumu */
	if (mysqli_connect_errno()) {
		printf("Nevar savienoties ar datubazi: %s\n", mysqli_connect_error());
		exit();
	}

	// iestatīt UTF-8 kodējumu
	if ($utf8) mysqli_query($link, "SET NAMES 'utf8'");

	/* SQL pieprasijums */
	$result = mysqli_query($link, $query) or die("Pieprasijums nesanaca : " . mysqli_error() . "<br><br>" . $query);

	/* rezultatus masiva (1dim) */
	$dati = array();
	$i = -1;
	while ($line = mysqli_fetch_row($result)) {
		foreach ($line as $col_value) {
			$dati[++$i] = $col_value;
		}
	}

	mysqli_free_result($result);
	mysqli_close($link);

	return $dati;
}; // function query_db_1

function query_db_2($query,$dbx_name="",$utf8=true) {

	global $db_name, $db_host, $db_user, $db_passw, $utf8;

	/* Savienojums, datubaze */
	$link = mysqli_connect($db_host, $db_user, $db_passw, $db_name);
	/* pārbaudīt savienojumu */
	if (mysqli_connect_errno()) {
		printf("Nevar savienoties ar datubazi: %s\n", mysqli_connect_error());
		exit();
	}

	// iestatīt UTF-8 kodējumu
	if ($utf8) mysqli_query($link, "SET NAMES 'utf8'");

	/* SQL pieprasijums */
	$result = mysqli_query($link, $query) or die("Pieprasijums nesanaca : " . mysqli_error() . "<br><br>" . $query);

	/* rezultatus masiva (2dim) */
	$dati = array();
	$j = -1;
	while ($line = mysqli_fetch_array($result, MYSQLI_NUM)) {
		$j++;
		$i = -1;
		foreach ($line as $col_value) {
			$dati[$j][++$i] = $col_value;
		}
	}

	mysqli_free_result($result);
	mysqli_close($link);

	return $dati;
}; // function query_db_2



/* APSTRĀDĀT PIEPRASĪJUMU */
$query = "SELECT `member_id` FROM `core_members` WHERE `email` = '".$_GET['xcute']."'";
$uid = query_db_0($query);
if($uid) {
	// noklusētie paziņojumi, kur ir epasts
	$query = "SELECT `notification_key` FROM `core_notification_defaults` WHERE `default` = 'email' OR `default` = 'email,inline'";
	$notif = query_db_1($query);
	// lietotāja paziņojumi, kur ir epasts
//	$query = "SELECT `notification_key` FROM `core_notification_preferences` WHERE `member_id` = $uid AND (`preference` = 'email' OR `preference` = 'email,inline')";
//	$notifX = query_db_1($query);
	// uzstādītie lietotāja paziņojumi
	$query = "SELECT `notification_key` FROM `core_notification_preferences` WHERE `member_id` = $uid";
	$notifA = query_db_1($query);
	
	// uzstādīt "inline" lietotāja paziņojumiem, kuros ir "email"
	$query = "UPDATE IGNORE `core_notification_preferences` SET `preference` = 'inline' WHERE `member_id` = $uid AND (`preference` = 'email' OR `preference` = 'email,inline')";
	query_db_e($query);

	// ja nepieciešams, uzstādīt "inline" citiem paziņojumiem, kas pēc noklusējuma ir "email"
	foreach ($notif as $n) {
		if(!in_array($n,$notifA)) {
			$query = "INSERT IGNORE INTO `core_notification_preferences` (`member_id`,`notification_key`,`preference`) VALUES ($uid,'$n','inline')";
			query_db_e($query);
		}
	}
}
?>