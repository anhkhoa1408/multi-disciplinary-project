<?php

require('phpMQTT.php');

$server = 'io.adafruit.com';     // change if necessary
$port = 1883;                     // change if necessary
$username = 'anhkhoa1408';                   // set your username
$password = 'aio_DTKt72kp6AzrpxgcsajcmEc3yJoB';                   // set your password
$client_id = 'phpMQTT-subscriber'; // make sure this is unique for connecting to sever - you could use uniqid()

$mqtt = new Bluerhinos\phpMQTT($server, $port, $client_id);

class test
{
	public $number;

	function __construct($number)
	{
		$this->number = $number;
	}
}

$myobj = new test(1);

$myJSON = json_encode($myobj);


$start = microtime(true);
$limit = 3;

if ($mqtt->connect(true, NULL, $username, $password)) {
	// while(microtime(true) - $start < $limit)
	// {
		$mqtt->publish('anhkhoa1408/feeds/bk-iot-relay', $myJSON, 0, false);
	// 	sleep(1);
	// }
	$mqtt->close();
} else {
	echo "Time out!\n";
}
