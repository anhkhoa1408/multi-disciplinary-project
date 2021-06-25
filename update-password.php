<?php
    include 'connect-database.php';
    session_start();
    $userName = $_SESSION['user'];
    $password = $_POST["password"];
    
    $query = "UPDATE `accounts`
    SET `PassWord`='$password'
    WHERE `UserName`='$userName'";
    $_SESSION['pass'] = $password;
    $result = $conn->query($query) or die($conn->error);
    $message = $result ? 1 : 0;
    echo $result;
?>