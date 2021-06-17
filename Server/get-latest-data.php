<?php
    session_start();
    $curr_user = $_SESSION['user'];
    $curr_user = "khoa.nguyen1408";

    include "../connect-database.php";
    $getData = "SELECT `Temperature`, `Humidity`, `Time_Receive` FROM `parameter` WHERE `UserName`='$curr_user' AND `Time_Receive` IN (SELECT MAX(`Time_Receive`) FROM `parameter` WHERE `UserName`='$curr_user')";
    $result = $conn->query($getData) or die($conn->error);

    $row = $result->fetch_assoc();
    
    echo $row["Temperature"]."-".$row["Humidity"];


?>