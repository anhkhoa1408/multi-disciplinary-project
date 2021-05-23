<?php
    include "connect-database.php";
    $query = "SELECT * FROM `parameter` WHERE date(Time_Receive) = date(NOW())";
    $result = $conn->query($query) or die($conn->error);
    $data = array();
    foreach ($result as $row) {
        $data[] = $row;
    }
    echo json_encode($data);
?>