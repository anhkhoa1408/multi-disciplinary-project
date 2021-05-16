<?php

require('phpMQTT.php');

$server = 'io.adafruit.com';
$port = 1883;
$username = 'anhkhoa1408';
$password = 'aio_FrMj27gOUb6JqB1eXtBb8MlOv8DU';
$client_id = 'subscriber';

$mqtt = new Bluerhinos\phpMQTT($server, $port, $client_id);

class Humidity
{
	public $id = 9;
	public $name = "SOIL";
	public $humid;
	public $temp;
	public $unit = "%";

	function __construct($id, $name, $humid, $temp, $unit)
	{
		$this->id = $id;
		$this->name = $name;
		$this->humid = $humid;
		$this->temp = $temp;
		$this->unit = $unit;
	}
}
$myobj = new Humidity(9, "SOIL", rand(0, 1023), rand(0, 100), "%");
$myJSON = json_encode($myobj);

$countMessage = 0;
if ($mqtt->connect(true, NULL, $username, $password)) {
	while ($countMessage < 2) {
		$mqtt->publish('anhkhoa1408/feeds/bk-iot-soil', $myJSON, 0, false);
		sleep(3);
		$countMessage++;
	}
	$mqtt->close();
} else {
	echo "Time out!\n";
}
