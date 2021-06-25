<?php
    session_start();
    include 'connect-database.php';
    $name = $_POST['user'];
    $pass = $_POST['pass'];
    $sql = "SELECT * FROM `accounts` WHERE `UserName`='$name' AND `PassWord`='$pass'";
    $result = $conn->query($sql) or die($conn->error);
    $row = $result->fetch_assoc();
    $message = 0;
    if ($row) {
        $message = 1;
        $_SESSION['user'] = $name;
        $_SESSION['pass'] = $pass;
    }
    echo $message;
?>