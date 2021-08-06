<?php

    include '../connect-database.php';
        
    // Get all user
    $get_all_user = "SELECT * FROM `accounts`";
    $user_query_result = $conn->query($get_all_user) or die($conn->error);
    $all_user = $user_query_result->fetch_all(MYSQLI_ASSOC);

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
        if ($user["UserName"] == 'CSE_BBC1')
            continue;

        echo $user["AIOKey"]."\n";
        
        echo $user["UserName"]."\n";
        if ($user["UserName"] == 'CSE_BBC') {
            $is_relay_on = get_relay_state($user["UserName"]."1", $user["AIOKey"]);
        }
        else {
            $is_relay_on = get_relay_state($user["UserName"], $user["AIOKey"]);
        }
        $relay_state = ($user["toggle_time"] && check_time($user["UserName"])) || ($user["toggle_para"] && check_para($user["UserName"]));
        echo "Relay state: ".($relay_state?"1":"0")."\n";
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
            if (count((array)$result) == 1)
                continue;

            $value = json_decode($result->value)->data;
            return $value;
        }
    }

    function check_time($username)
    {
        include '../connect-database.php';
        $get_latest_time = "SELECT `start_time`, `end_time` FROM `timesetting` WHERE `UserName`='$username' ORDER BY `ID` DESC LIMIT 0, 1";
        $time_query_result = $conn->query($get_latest_time) or die($conn->error);
        $latest_time = $time_query_result->fetch_assoc();
        date_default_timezone_set('UTC');
        if ($latest_time)
        {
            echo $username;
            echo date('H:i:s', time() + 7*60*60)."  ";
            echo $latest_time['start_time'];
            if (date('H:i:s', time() + 7*60*60) >= $latest_time['start_time'] and date('H:i:s', time() + 7*60*60) <= $latest_time['end_time'])
                return true;
        }
        return false;
    }

    function check_para($username)
    {
        include '../connect-database.php';
        $get_para = "SELECT `Temperature`, `Humidity` FROM `parameter` WHERE `UserName`='$username' ORDER BY `Time_Receive` DESC LIMIT 0, 1";
        $para_query_result = $conn->query($get_para) or die($conn->error);
        $para = $para_query_result->fetch_assoc();
        
        $get_min_para = "SELECT `Temperature`, `Humidity` FROM `minimumparam` WHERE `UserName`='$username' ORDER BY `Created` DESC LIMIT 0, 1";
        $min_para_query_result = $conn->query($get_min_para) or die($conn->error);
        $min_para = $min_para_query_result->fetch_assoc();
        if ($min_para)
        {
            if ($para['Temperature'] >= $min_para['Temperature'])
                return TRUE;
            if ($para['Humidity'] <= $min_para['Humidity'])
                return TRUE;
        }
        return FALSE;
    }

?>