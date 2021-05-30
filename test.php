<?php 
    include 'connect-database.php';
    // $get_all_time = "SELECT `start_time`, `end_time` FROM `timesetting` WHERE `UserName`='anhkhoa1408' ORDER BY `ID` DESC LIMIT 0, 1";
    // $time_query_result = $conn->query($get_all_time) or die($conn->error);
    // $all_time = $time_query_result->fetch_assoc();
    // echo $all_time['end_time'];
    // if (date('H:i', time() + 7*60*60) < $all_time['end_time'])
    //     echo 1;
    // else 
    //     echo 0;
    $get_para = "SELECT `Temperature`, `Humidity` FROM `parameter` WHERE `UserName`='anhkhoa1408' ORDER BY `Time_Receive` DESC LIMIT 0, 1";
    $para_query_result = $conn->query($get_para) or die($conn->error);
    $para = $para_query_result->fetch_assoc();

    $get_min_para = "SELECT `Temperature`, `Humidity` FROM `minimumparam` WHERE `UserName`='anhkhoa1408' ORDER BY `Created` DESC LIMIT 0, 1";
        $min_para_query_result = $conn->query($get_min_para) or die($conn->error);
        $min_para = $min_para_query_result->fetch_assoc();
    
    if ($para['Temperature'] >= $min_para['Temperature'])
        echo 1;
    if ($para['Humidity'] <= $min_para['Humidity'])
        echo 1;
    // $dom = new DOMDocument();
    // $dom->loadHTMLFile('index.php');
    // $dom->validateOnParse = true;
    // $dom->getElementById('switch-btn')->setAttribute('checked', true);
    // echo $dom->getElementById('switch-btn')->getAttribute('checked');
?>