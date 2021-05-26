<?php

require('phpMQTT.php');

$server = 'io.adafruit.com';
$port = 1883;
$username = 'anhkhoa1408';
$password = 'aio_bUAd97nQQdaIVzNRmAQx4MIOszNr';
$client_id = 'subscriber';

$mqtt = new Bluerhinos\phpMQTT($server, $port, $client_id);

class Relay
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
$myobj = new Relay(11, "RELAY", $_POST['state'], "");
$myJSON = json_encode($myobj);

if ($mqtt->connect(true, NULL, $username, $password)) {
    $mqtt->publish('anhkhoa1408/feeds/bk-iot-relay', $myJSON, 0, false);   
    $mqtt->close();
} else {
    echo "Time out!\n";
}
