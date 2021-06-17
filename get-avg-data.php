<?php
    session_start();
    include "connect-database.php";

    $userName = $_SESSION['user'];

    $query = "SELECT AVG(`Temperature`) AS `Average_Temperature`, AVG(`Humidity`) AS `Average_Humidity`, DATE(`Time_Receive`) `Time` FROM `parameter` WHERE `Time_Receive` = (SELECT MAX(`Time_Receive`) FROM `parameter` WHERE `userName` = '$userName') AND `userName` = '$userName' GROUP BY `Time_Receive`";
    $result = $conn->query($query) or die($conn->error);
    $data = array();
    foreach ($result as $row) {
        $data[] = $row;
    }

    echo json_encode($data);
?>