<?php
    session_start();
    include "connect-database.php";

    $user = $_SESSION['user'];
    $findUserID = "SELECT `ID` FROM `accounts` WHERE `UserName` = '$user'";
    $result = $conn->query($findUserID) or die($conn->error);
    $row = $result->fetch_assoc();
    $userID = $row['ID'];

    $query = "SELECT * FROM `parameter` WHERE date(Time_Receive) = date(NOW()) AND `userID` = '$userID'";
    $result = $conn->query($query) or die($conn->error);
    $data = array();
    foreach ($result as $row) {
        $data[] = $row;
    }
    echo json_encode($data);
?>