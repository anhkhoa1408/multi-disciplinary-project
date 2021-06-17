<?php
    session_start();
    include "connect-database.php";

    $user = $_SESSION['user'];
    // $query = "SELECT * FROM `parameter` WHERE date(Time_Receive) = date(NOW()) AND `userName` = '$user'";

    $query = "SELECT AVG(`Temperature`) AS `Average_Temperature`, AVG(`Humidity`) AS `Average_Humidity`, DATE(`Time_Receive`) `Time` FROM `parameter` WHERE `userName` = '$user' GROUP BY `Time`";
    $result = $conn->query($query) or die($conn->error);
    $data = array();
    foreach ($result as $row) {
        $data[] = $row;
    }
    echo json_encode($data);
?>