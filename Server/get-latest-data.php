<?php
    session_start();
    $curr_user = $_SESSION['user'];

    include "../connect-database.php";
    $findUser = "SELECT * FROM `accounts` WHERE `UserName`='$curr_user'";
    $result = $conn->query($findUser) or die($conn->error);
    $row = $result->fetch_assoc();
    
    
    // Init curl object
    $ch = curl_init();

    // Init url
    $url = "https://io.adafruit.com/api/v2/{username}/feeds/bk-iot-temp-humid/data?limit=1";
    $url = str_replace("{username}", $row["UserName"], $url);

    $http_header =
        [
            "X-AIO-Key: " . $row["AIOKey"],
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
    $result = json_decode($response)[0];

    $value = json_decode($result->value)->data;
    echo $value;

?>