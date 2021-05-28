<?php

    include 'connect-database.php';
        
    // Get all user
    $get_all_user = "SELECT `UserName`, `AIOKey` FROM `accounts`";
    $user_query_result = $conn->query($get_all_user) or die($conn->error);
    $all_user = $user_query_result->fetch_all(MYSQLI_NUM);

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

    // For each user, get humid-temp feed data and store in db
    foreach($all_user as $index => $user)
    {
        if ($user["UserName"] == 'CSE_BBC')
            continue;
        $is_relay_on = get_relay_state($user["UserName"], $user["AIOKey"]);
        $relay_state = check_time($user["UserName"]) or check_para($user["UserName"]);
        if (($is_relay_on == 1 and $relay_state == FALSE) or ($is_relay_on == 0 and $relay_state == TRUE))
        {
            require('phpMQTT.php');
            $server = 'io.adafruit.com';
            $port = 1883;
            $username = $user["UserName"];
            $password = $user["AIOKey"];
            $client_id = 'publisher';
            $myobj = new Relay(11, "RELAY", $relay_state?1:0, "");
            $myJSON = json_encode($myobj);
            $mqtt = new Bluerhinos\phpMQTT($server, $port, $client_id);
            if ($mqtt->connect(true, NULL, $username, $password)) {
                $mqtt->publish($username.'/feeds/bk-iot-relay', $myJSON, 0, false);   
                $mqtt->close();
            } else {
                echo "Time out!\n";
            }
        }

    }

    function get_relay_state($username, $aiokey)
    {
        $ch = curl_init();
    
        $url = "https://io.adafruit.com/api/v2/{username}/feeds/bk-iot-relay/data?limit=1";
        $url = str_replace("{username}", $username, $url);
        $http_header =
        [
            "X-AIO-Key: " . $aiokey,
        ];
        $optArray = array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => $http_header,
            // CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_CAINFO => dirname(__FILE__)."/cacert-2021-04-13.pem",
        );
        curl_setopt_array($ch, $optArray);
        $response = curl_exec($ch);
        curl_close($ch);

        $results = json_decode($response);
        foreach($results as $result)
        {
            if (count($result) == 1)
                continue;

            $value = json_decode($result->value)->data;
            return $value;
        }
    }

    function check_time($username)
    {
        $get_all_time = "SELECT `start_time`, `end_time` FROM `timesetting` WHERE `UserName`='$username'";
        $time_query_result = $conn->query($get_all_time) or die($conn->error);
        $all_time = $time_query_result->fetch_all(MYSQLI_NUM);
        foreach ($all_time as $index => $time)
        {
            if (time() >= $time['start_time'] and time() <= $time['end_time'])
                return TRUE;
        }
        return FALSE;
    }

    function check_para($username)
    {
        $get_para = "SELECT `Temperature`, `Humidity` MAX(`Time_Receive`) AS `CURR_TIME` FROM `parameter` WHERE `UserName`='$username'";
        $para_query_result = $conn->query($get_para) or die($conn->error);
        $para = $para_query_result->fetch_assoc();
        
        $get_min_para = "SELECT `Temperature`, `Humidity` MAX(`Created`) AS `CURR_TIME` FROM `minimumparam` WHERE `UserName`='$username'";
        $min_para_query_result = $conn->query($get_min_para) or die($conn->error);
        $min_para = $min_para_query_result->fetch_assoc();
        if ($para['Temperature'] >= $min_para['Temperature'])
            return TRUE;
        if ($para['Humidity'] <= $min_para['Humidity'])
            return TRUE;
        return FALSE;
    }

?>