<?php
    session_start();
    include 'connect-database.php';
    $userName = $_SESSION['user'];
    $getParameter = "SELECT AVG(`Temperature`) AS `Average_Temperature`, AVG(`Humidity`) AS `Average_Humidity`, DATE(`Time_Receive`) AS `Time` FROM `parameter` WHERE `userName` = '$userName' GROUP BY `Time`";
    $query = $conn->query($getParameter) or die($conn->error);
    $results = $query->fetch_all(MYSQLI_ASSOC);
    $rowCount = mysqli_num_rows($query);
    $data = [];
    foreach($results as $index => $result) {
        $sub = array();
        $sub[] = $result['Average_Temperature'];
        $sub[] = $result['Average_Humidity'];
        $sub[] = $result['Time'];
        $data[] = $sub;
    }

    $output = [
    'draw'    => 1,
    'recordsTotal'  => intval($rowCount),
    'recordsFiltered' => intval($rowCount),
    'data'    => $data
    ];
       
    echo json_encode($output);
?>
