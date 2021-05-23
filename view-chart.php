<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sprinkler IOT</title>
    <link rel="stylesheet" href="/assets/fontawesome-free-5.15.3-web/fontawesome-free-5.15.3-web/css/all.css">
    <link rel="stylesheet" href="/style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.2.1/chart.min.js"></script>
    <script src="/src/jquery-3.6.0.min.js"></script>
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
            <div class="temp chart-container">
                <div class="header-container">
                    <p class="header">Temperature Overview</p>
                    <button class="export-btn">Export</button>
                </div>
                <canvas id="temp-chart" class="chart">

                </canvas>


            </div>

            <div class="humid chart-container">
                <div class="header-container">
                    <p class="header">Humidity Overview</p>
                    <button class="export-btn">Export</button>
                </div>
                <canvas id="humid-chart" class="chart">

                </canvas>
            </div>

        </div>

        <script src="/line-chart.js"> </script>

    </div>
</body>

</html>