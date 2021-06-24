<?php
    session_start();
    include '../connect-database.php';
    $username = $_SESSION['user'];
    $get_user = "SELECT * FROM `accounts` WHERE `UserName` = '$username'";
    $query = $conn->query($get_user) or die($conn->error);
    $res = $query->fetch_assoc();

    echo $res["toggle_time"];
    echo $res["toggle_para"];
?>