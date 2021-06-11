<?php
    $servername = "localhost:3306";
    $user = "root";
    $pass = "";
    $dbname = "multidisciplinaryproject";

    // Create connection
    $conn = mysqli_connect($servername, $user, $pass, $dbname);
    
    // Check connection
    if (!$conn)
    {
        die("Connection failed: " . mysqli_connect_error());
    }
?>