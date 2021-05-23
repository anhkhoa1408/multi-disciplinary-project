<?php
    session_start();
    include "connect-database.php";
    $temp = $_POST['temperature'];
    $humidity = $_POST['humidity'];
    
    $user = $_SESSION['user'];
    $findUserID = "SELECT `ID` FROM `accounts` WHERE `UserName` = '$user'";
    $result = $conn->query($findUserID) or die($conn->error);
    $row = $result->fetch_assoc();
    $userID = $row['ID'];

    $time = date("Y-m-d H:i:s", time() + 7 * 60 * 60);
    $sql = "INSERT INTO `parameter` (`Temperature`, `Humidity`, `Time_Receive`, `userID`) VALUES ('$temp', '$humidity', '$time', '$userID')";
    $result = $conn->query($sql) or die($conn->error);
    $message = 0;
    if ($result) {
        $message = 1;
    }
    echo $message;
?>