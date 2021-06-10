<?php
    session_start();
    include 'connect-database.php';
    $stime = $_POST['stime'];
    $etime = $_POST['etime'];

    $user = $_SESSION['user'];
    $sql = "INSERT INTO `timesetting` (`start_time`, `end_time`, `UserName`) VALUES ('$stime', '$etime', '$user')";
    $result = $conn->query($sql) or die($conn->error);
    $message = 0;
    if($result) {
        $message = 1;
    }
    echo $message;
?>