<?php

require('phpMQTT.php');

$server = 'io.adafruit.com';
$port = 1883;
$username = 'anhkhoa1408';
$password = 'aio_QRun81Ps49G1Dwsj3n7NuqrVQb0J';
$client_id = 'subscriber';

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

$countMessage = 0;
if ($mqtt->connect(true, NULL, $username, $password)) {
	while ($countMessage < 1) {
		$mqtt->publish('anhkhoa1408/feeds/bk-iot-temp-humid', $myJSON, 0, false);
		sleep(3);
		$countMessage++;
	}
	$mqtt->close();
} else {
	echo "Time out!\n";
}
