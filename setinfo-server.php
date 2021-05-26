<?php
    session_start();
    include 'connect-database.php';
    $temp = $_POST['temp'];
    $humid = $_POST['humid'];
    $user = $_SESSION['user'];
    $time = date("Y-m-d H:i:s", time() + 7 * 60 * 60);

    $sql = "INSERT INTO `minimumparam` (`Temperature`, `Humidity`, `Created`, `UserName`) VALUES ('$temp', '$humid', '$time', '$user')";
    $result = $conn->query($sql) or die($conn->error);
    $message = 0;
    if($result) {
        $message = 1;
    }
    echo $message;
?>
