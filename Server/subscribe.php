<?php
require('phpMQTT.php');
// header('Access-Control-Allow-Origin: *');

$server = 'io.adafruit.com';     // change if necessary
$port = 1883;                     // change if necessary
$username = 'anhkhoa1408';                   // set your username
$password = 'aio_nQtM66lwU64L7uKNDJs9tbMuKvfX';                   // set your password
$client_id = 'phpMQTT'; // make sure this is unique for connecting to sever - you could use uniqid()

$mqtt = new Bluerhinos\phpMQTT($server, $port, $client_id);
if (!$mqtt->connect(true, NULL, $username, $password)) {
	exit(1);
}

$mqtt->debug = true;

$topics['anhkhoa1408/feeds/bk-iot-relay'] = array('qos' => 0, 'function' => 'procMsg');
$mqtt->subscribe($topics, 0);

while ($mqtt->proc()) {
	
}

$mqtt->close();

function procMsg($topic, $msg)
{
	// echo 'Msg Recieved: ' . date('r') . "\n";
	// echo "Topic: {$topic}\n\n";
	echo "\t$msg\n\n";
}

