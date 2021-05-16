<?php
require('phpMQTT.php');

$server = 'io.adafruit.com';
$port = 1883;
$username = 'anhkhoa1408';
$password = 'aio_FrMj27gOUb6JqB1eXtBb8MlOv8DU';
$client_id = 'publisher';

$mqtt = new Bluerhinos\phpMQTT($server, $port, $client_id);
if (!$mqtt->connect(true, NULL, $username, $password)) {
	exit(1);
}

$mqtt->debug = true;

$topics['anhkhoa1408/feeds/bk-iot-soil'] = array('qos' => 0, 'function' => '__direct_return_message__');
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
