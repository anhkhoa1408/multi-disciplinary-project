<?php
    session_start();
    include "connect-database.php";

    $user = $_SESSION['user'];

    $getParaData = "SELECT * FROM `parameter` WHERE date(Time_Receive) = date(NOW()) AND `userName` = '$user'";
    $paraResults = $conn->query($getParaData) or die($conn->error);
    $paraRecord = mysqli_num_rows($paraResults);

    $checkNullAvgData = "SELECT * FROM `avgparam` WHERE date(`Time`) = date(NOW()) AND `userName` = '$user'";
    $avgResults = $conn->query($checkNullAvgData) or die($conn->error);
    $avgRecord = mysqli_num_rows($avgResults);

    echo $avgRecord;
    
    $flag = 0;

    if ($avgRecord == 0) {
        if ($paraRecord == 0) {
            $avgTemp = 0;
            $avgHumid = 0;
            $time = date("Y-m-d H:i:s", time() + 7 * 60 * 60);
            $insertAvgData = "INSERT INTO `avgparam` (`Time`, `Average_Temperature`, `Average_Humidity`, `UserName`) VALUES ('$time', '$avgTemp', '$avgHumid', '$user')";
            $insertAvg = $conn->query($insertAvgData) or die($conn->error);

            $flag = 1;
        }
        else
        {
            $avgTemp = 0;
            $avgHumid = 0;
            foreach ($paraResults as $index => $result) {
                $avgTemp += $result['Temperature'];
                $avgHumid += $result['Humidity'];
            }
            $avgTemp = round($avgTemp / $paraRecord, 2);
            $avgHumid = round($avgHumid / $paraRecord, 2);

            $time = date("Y-m-d H:i:s", time() + 7 * 60 * 60);
            $insertAvgData = "INSERT INTO `avgparam` (`Time`, `Average_Temperature`, `Average_Humidity`, `UserName`) VALUES ('$time', '$avgTemp', '$avgHumid', '$user')";
            $insertAvg = $conn->query($insertAvgData) or die($conn->error);

            $flag = 1;
        }
    }
    else
    {
        $avgTemp = 0;
        $avgHumid = 0;
        foreach ($paraResults as $index => $result) {
            $avgTemp += $result['Temperature'];
            $avgHumid += $result['Humidity'];
        }
        $avgTemp = round($avgTemp / $paraRecord, 2);
        $avgHumid = round($avgHumid / $paraRecord, 2);

        $time = date("Y-m-d H:i:s", time() + 7 * 60 * 60);
        $updateAvgData = "UPDATE `avgparam` SET `Time` = '$time', `Average_Temperature` = '$avgTemp', `Average_Humidity` = '$avgHumid' WHERE date(`Time`) = date(NOW()) AND `UserName` = '$user' ";
        $updateAvg = $conn->query($updateAvgData) or die($conn->error);

        $flag = 1;
    }
    

    echo $flag;
?>