<?php
    session_start();
    include 'connect-database.php';
    $stime = $_GET['stime'];
    $etime = $_GET['etime'];
    $sql = "SELECT * FROM `accounts` WHERE `UserName`='$name' AND `PassWord`='$pass'";
    $sql = "INSERT INTO timesetting (start_time, end_time) VALUES (stime, etime)";
    $result = $conn->query($sql) or die($conn->error);
?>