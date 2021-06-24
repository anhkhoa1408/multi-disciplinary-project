<?php
    include '../connect-database.php';
    session_start();
    $userName = $_SESSION['user'];
    $type = $_POST["type"];
    $state = $_POST["state"];
    
    $query = "UPDATE `accounts`
    SET `$type`='$state'
    WHERE `UserName`='$userName'";
    $conn->query($query) or die($conn->error);
    echo $query;
?>