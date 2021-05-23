<?php
include "connect-database.php";
$query = "SELECT * FROM `parameter`";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SprinklerIOT</title>
    <link rel="stylesheet" href="/assets/fontawesome-free-5.15.3-web/fontawesome-free-5.15.3-web/css/all.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="/style.css">
    <script src="/src/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
</head>

<body>
    <div id="main">
        <!-- Header section -->
        <div id="header-section">
            <img src="" alt="" class="logo">

            <div class="sign-out">
                <a href="/login.php"><i class="fas fa-sign-out-alt"></i></a>
            </div>
        </div>

        <!-- Navigation section -->
        <div id="nav-section">
            <ul class="nav">
                <li><a href="/index.php" class="home-page"><i class="btn fas fa-home"></i></a>Home</li>
                <li><a href="/setinfo.php" class="set-info-page"><i class="btn fas fa-sliders-h"></i></a>Parameter</li>
                <li><a href="/settime.php" class="set-time-page"><i class="btn far fa-clock"></i></a>Time</li>
                <li><a href="/view-table.php" class="view-table-page"><i class="btn fas fa-table"></i></a>Tables</li>
                <li><a href="/view-chart.php" class="view-chart-page"><i class="btn far fa-chart-bar"></i></a>Charts</li>
            </ul>
        </div>

        <!-- Content section -->
        <div id="content-section">
            <!-- Tables section -->
            <div class="tables-container">
                <table id="temp_humid_data" class="uk-table uk-table-hover uk-table-striped">
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>Temperature</td>
                            <td>Humidity</td>
                            <td>Time</td>
                        </tr>
                    </thead>
                    <?php
                        while ($row = mysqli_fetch_array($result)) {
                            echo '  
                                <tr>  
                                        <td>' . $row["ID"] . '</td>  
                                        <td>' . $row["Temperature"] . '</td>  
                                        <td>' . $row["Humidity"] . '</td>  
                                        <td>' . $row["Time_Receive"] . '</td>  
                                </tr>  
                                ';
                        }
                    ?>
                </table>
            </div>
        </div>

        <!-- Js for table view -->
        <script>
            $(document).ready(function() {
                $('#temp_humid_data').DataTable();
            });
        </script>

    </div>
</body>

</html>