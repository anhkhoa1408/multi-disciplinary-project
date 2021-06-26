<?php
    include '../connect-database.php';
    
    // Get all user
    $get_all_user = "SELECT `UserName`, `AIOKey` FROM `accounts`";
    $user_query_result = $conn->query($get_all_user) or die($conn->error);
    $all_user = $user_query_result->fetch_all(MYSQLI_ASSOC);


    // For each user, get humid-temp feed data and store in db
    foreach($all_user as $index => $user) {
        echo $user['UserName'];
        get_temp_humid($user["UserName"], $user["AIOKey"]);
    }

    // Function to get feed data
    function get_temp_humid($name, $aiokey)
    {
        if ($name == 'CSE_BBC1')
            return;
        
        // Init curl object
        $ch = curl_init();
    
        // Init url
        $url = "https://io.adafruit.com/api/v2/{username}/feeds/bk-iot-temp-humid/data?limit=1";
        $url = str_replace("{username}", $name, $url);
        // $TIME_INTERVAL = 3; // hours
        // $start_time = date(DATE_ISO8601, time() - $TIME_INTERVAL * 60 * 60);
        // $url .= "?start_time=" . $start_time;

    
        $http_header =
            [
                "X-AIO-Key: " . $aiokey,
            ];
    
        // Define options
        $optArray = array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => $http_header,
            // CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_CAINFO => dirname(__FILE__)."/cacert-2021-04-13.pem",
        );
    
        // Apply those options
        curl_setopt_array($ch, $optArray);
    
        // Execute request and get response
        $response = curl_exec($ch);
    
        // Close curl object
        curl_close($ch);
    
        // Parse result
        $results = json_decode($response);

        // For each result, check duplicate then add to db
        require('../connect-database.php');
        echo "<pre>";
        var_dump($results);
        echo "</pre>";
        foreach($results as $result)
        {
            if (count((array)$result) == 1)
                continue;
            // Result structure
            // Key: id -               Value: string
            // Key: value -            Value: string
            // Key: feed_id -          Value: int
            // Key: feed_key -         Value: string
            // Key: created_at -       Value: string ISO 8601
            // Key: created_epoch -    Value: int
            // Key: expiration -       Value: string ISO 8601
    
            // Example
            // Key: id -               Value: 0EQZRVWTW6SSXC434ZDN0P1J5S
            // Key: value -            Value: 2
            // Key: feed_id -          Value: 1629470
            // Key: feed_key -         Value: bk-iot-temp-humid
            // Key: created_at -       Value: 2021-05-23T07:42:13Z
            // Key: created_epoch -    Value: 1621755733
            // Key: expiration -       Value: 2021-06-22T07:42:13Z
            
            // Find id
            $id = $result->id;
            // $id_query = "SELECT `ID` FROM `parameter` WHERE `ID`='$id'";
            // $result = $conn->query($id_query) or die($conn->error);
            // if ($result) continue;
            
            // Add to db
            $value = json_decode($result->value)->data;
            $temp = strtok($value, "-");
            $humidity = strtok("-");
            $time = date("Y-m-d H:i:s", strtotime($result->created_at) + 7*60*60);
            // echo $user;
            $sql = "INSERT INTO `parameter` (`Temperature`, `Humidity`, `Time_Receive`, `UserName`) VALUES ('$temp', '$humidity', '$time', '$name')";
            $result = $conn->query($sql);
            if ($result) {
                echo "ID: " . $id . " is added.\n";
            }
            else {
                echo "Duplicated data.  ";
            }
        }
    }

?>