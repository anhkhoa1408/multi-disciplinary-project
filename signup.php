<?php
    session_start();
    include 'connect-database.php';
    $name = $_POST['user'];
    $pass = $_POST['pass'];
    $key = $_POST['key'];

    $findUserName = "SELECT * FROM `accounts` WHERE `UserName` = '$name'";
    $res = $conn->query($findUserName) or die($conn->error);
    $row = $res->fetch_assoc();

    $message = 0;
    if ($row) {
        $message = 2;
    } else {
        $sql = "INSERT INTO `accounts` (`UserName`, `PassWord`, `AIOKey`) VALUES ('$name', '$pass', '$key')";
        $result = $conn->query($sql) or die($conn->error);
        if ($result) {
            $message = 1;
        }
    }
    echo $message;
?>