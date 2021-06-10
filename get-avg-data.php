<?php
    session_start();
    include "connect-database.php";

    $user = $_SESSION['user'];
    // $query = "SELECT * FROM `parameter` WHERE date(Time_Receive) = date(NOW()) AND `userName` = '$user'";

    $query = "SELECT * FROM `avgparam` WHERE DATE(`Time`) = DATE(NOW()) AND `UserName` = '$user'";
    $result = $conn->query($query) or die($conn->error);
    $data = array();
    foreach ($result as $row) {
        $data[] = $row;
    }
    echo json_encode($data);
?>