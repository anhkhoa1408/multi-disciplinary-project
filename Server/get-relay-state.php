<?php
    session_start();
    include '../connect-database.php';
    $username = $_SESSION['user'];
    $get_AIO = "SELECT `AIOKey` FROM `accounts` WHERE `UserName` = '$username'";
    $query = $conn->query($get_AIO) or die($conn->error);
    $res = $query->fetch_assoc();
    $aiokey = $res['AIOKey'];

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
        echo $value;
        break;
    }
?>