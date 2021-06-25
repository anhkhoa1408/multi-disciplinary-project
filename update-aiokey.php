<?php
    include 'connect-database.php';
    session_start();
    $userName = $_SESSION['user'];
    $key = $_POST["key"];
    
    $query = "UPDATE `accounts`
    SET `AIOKey`='$key'
    WHERE `UserName`='$userName'";
    $result = $conn->query($query) or die($conn->error);
    $message = $result ? 1 : 0;
    echo $message;
?>