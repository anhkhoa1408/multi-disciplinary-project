<?php
    include "connect-database.php";
    $temp = $_POST['temperature'];
    $humidity = $_POST['humidity'];
    $time = date("Y-m-d H:i:s", time() + 7 * 60 * 60);
    $sql = "INSERT INTO `parameter` (`Temperature`, `Humidity`, `Time_Receive`) VALUES ('$temp', '$humidity', '$time')";
    $result = $conn->query($sql) or die($conn->error);
    $message = 0;
    if ($result) {
        $message = 1;
    }
    echo $message;
?>