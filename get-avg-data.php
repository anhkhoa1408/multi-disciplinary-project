<?php
    session_start();
    include "connect-database.php";

    $day = $_POST['date'];

    $userName = $_SESSION['user'];

    $getAVGData = "SELECT *
    FROM (SELECT AVG(`Temperature`) AS `Average_Temperature`, AVG(`Humidity`) AS `Average_Humidity`, DATE(`Time_Receive`) AS `Time`  
        FROM `parameter` 
        WHERE `UserName` = '$userName' AND DATE(`Time_Receive`) = DATE(NOW() - INTERVAL '$day' DAY) 
        GROUP BY `Time`) 
    AS TEMPORARY";

    $result = $conn->query($getAVGData) or die($conn->error);
    $data = array();
    foreach ($result as $row) {
        $data[] = $row;
    }

    echo json_encode($data);
?>