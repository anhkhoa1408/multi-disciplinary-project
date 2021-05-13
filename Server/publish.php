<?php
header('Access-Control-Allow-Origin: *');
require('phpMQTT.php');

$server = 'io.adafruit.com';     // change if necessary
$port = 1883;                     // change if necessary
$username = 'anhkhoa1408';                   // set your username
$password = 'aio_HeeM82TNmt1J2clREj2efo8LPnP9';                   // set your password
$client_id = 'phpMQTT-subscriber'; // make sure this is unique for connecting to sever - you could use uniqid()

$mqtt = new Bluerhinos\phpMQTT($server, $port, $client_id);

class test {
	public $number;
	// public $age;

	function __construct($number)
	{
		$this->number = $number;
	}
}

$myobj = new test(20);


$myJSON = json_encode($myobj);

if ($mqtt->connect(true, NULL, $username, $password)) {
	$mqtt->publish('anhkhoa1408/feeds/bk-iot-relay', $myJSON, 0, false);
	$mqtt->close();
} else {
    echo "Time out!\n";
}
