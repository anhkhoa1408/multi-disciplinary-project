<?php
require('phpMQTT.php');

$server = 'io.adafruit.com';
$port = 1883;

// ---------------------------------
session_start();
$curr_user = $_SESSION['user'];
include "../connect-database.php";
$findUser = "SELECT * FROM `accounts` WHERE `UserName`='$curr_user'";
$result = $conn->query($findUser) or die($conn->error);
$row = $result->fetch_assoc();
// ---------------------------------

$username = $row["UserName"];
$password = $row["AIOKey"];
$client_id = 'subscriber';

$mqtt = new Bluerhinos\phpMQTT($server, $port, $client_id);
if (!$mqtt->connect(true, NULL, $username, $password)) {
	exit(1);
}

$mqtt->debug = true;

$topics[$username.'/feeds/bk-iot-temp-humid'] = array('qos' => 0, 'function' => '__direct_return_message__');
$mqtt->subscribe($topics, 0);
$msg_return = $mqtt->proc();
while (is_bool($msg_return)) {
	$msg_return = $mqtt->proc();
}

$mqtt->close();

showMessage($msg_return);

function showMessage($msg)
{
	echo "$msg\n";
}
