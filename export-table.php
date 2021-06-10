<?php
    session_start();
    include 'connect-database.php';
    $userName = $_SESSION['user'];
    $getParameter = "SELECT * FROM `avgparam` WHERE `UserName` = '$userName'";
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
