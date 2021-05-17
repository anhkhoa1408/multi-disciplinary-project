<?php
    session_start();
    include 'connect-database.php';
    $name = $_POST['user'];
    $pass = $_POST['pass'];
    $findUserName = "SELECT * FROM `accounts` WHERE `UserName` = '$name'";
    $res = $conn->query($findUserName) or die($conn->error);
    $row = $res->fetch_assoc();
    $message = 0;
    if ($row) {
        $message = 2;
    } else {
        $sql = "INSERT INTO `accounts` (`UserName`, `PassWord`) VALUES ('$name', '$pass')";
        $result = $conn->query($sql) or die($conn->error);
        if ($result) {
            $message = 1;
        }
    }
    echo $message;
?>