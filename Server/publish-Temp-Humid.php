<?php

require('phpMQTT.php');

$server = 'io.adafruit.com';
$port = 1883;

// ---------------------------------
session_start();
$curr_user = 'anhkhoa1408';
if ($curr_user == 'CSE_BBC')
	$curr_user .= '1';
include "../connect-database.php";
$findUser = "SELECT * FROM `accounts` WHERE `UserName`='$curr_user'";
$result = $conn->query($findUser) or die($conn->error);
$row = $result->fetch_assoc();
// ---------------------------------

$username = $row["UserName"];
$password = $row["AIOKey"];
$client_id = 'publisher';

$mqtt = new Bluerhinos\phpMQTT($server, $port, $client_id);

class Humidity
{
	public $id;
	public $name;
	public $data;
	public $unit;

	function __construct($id, $name, $data, $unit)
	{
		$this->id = $id;
		$this->name = $name;
		$this->data = $data;
		$this->unit = $unit;
	}
}
$myobj = new Humidity(7, "TEMP-HUMID", rand(0, 50). "-" .rand(20, 90), "C-%");
$myJSON = json_encode($myobj);

if ($mqtt->connect(true, NULL, $username, $password)) {
	$mqtt->publish('anhkhoa1408/feeds/bk-iot-temp-humid', $myJSON, 0, false);
	$mqtt->close();
} else {
	echo "Time out!\n";
}
