<?php
    $servername = "localhost:3306";
    $user = "root";
    $pass = "Anhkhoanguyen123";
    $dbname = "multidisciplinaryproject";

    // Create connection
    $conn = mysqli_connect($servername, $user, $pass, $dbname);
    
    // Check connection
    if (!$conn)
    {
        die("Connection failed: " . mysqli_connect_error());
    }
?>