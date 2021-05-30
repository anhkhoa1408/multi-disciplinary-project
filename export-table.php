<?php
    session_start();
    include 'connect-database.php';
    $userName = $_SESSION['user'];
    $getParameter = "SELECT * FROM `parameter` WHERE `UserName` = '$userName'";
    $query = $conn->query($getParameter) or die($conn->error);
    $results = $query->fetch_all(MYSQLI_ASSOC);
    $rowCount = mysqli_num_rows($query);
    $data = array();
    foreach($results as $index => $result) {
        $sub = array();
        $sub[] = $result['Temperature'];
        $sub[] = $result['Humidity'];
        $sub[] = $result['Time_Receive'];
        $sub[] = $result['UserName'];
        $data[] = $sub;
    }

    $output = array(
    'draw'    => 1,
    'recordsTotal'  => intval($rowCount),
    'recordsFiltered' => intval($rowCount),
    'data'    => $data
    );
       
    echo json_encode($output);
?>
