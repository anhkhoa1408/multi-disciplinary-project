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
    <link rel="stylesheet" href="/style.css">
    <script src="/src/icon.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="/src/jquery-3.6.0.min.js"></script>
</head>

<body>
    <div id="main">
        <!-- Header section -->
        <div id="header-section">
            <!-- <img src="" alt="" class="logo"> -->

            <div class="nav-toggle">
                <i class="fal fa-bars"></i>
            </div>

            <div class="user">
                <i class="user-icon fal fa-user-circle"></i>
                <li class="drop-icon"><i class="drop-icon fas fa-caret-down"></i></li>
                <ul class="user-setting">
                    <?php 
                        if (isset($_SESSION['user']))
                            echo "<h5>Signed in as </br>".strval($_SESSION['user'])."</h5>";
                    ?>
                    <li><i class="fas fa-user-alt"></i><a href="/edit-profile.php" class="setting">Your Profile</a></li>
                    <li><i class="fas fa-sign-out-alt"></i><a href="/login.php">Sign out</a></li>
                </ul>
            </div>
        </div>


        <div id="content">
            <!-- Navigation section -->
            <div id="nav-section">
                <i class="nav-icon far fa-raindrops"></i>
                <ul class="nav">
                    <li><a href="/index.php" class="home-page"><i class="btn fas fa-home"></i>Home</a></li>
                    <li><a href="/setinfo.php" class="set-info-page"><i class="btn fas fa-sliders-h"></i>Parameter</a></li>
                    <li><a href="/settime.php" class="set-time-page"><i class="btn far fa-clock"></i>Time</a></li>
                    <li><a href="/view-table.php" class="view-table-page"><i class="btn fas fa-table"></i>Tables</a></li>
                    <li><a href="/view-chart.php" class="view-chart-page"><i class="btn far fa-chart-bar"></i>Charts</a></li>
                </ul>
            </div>

            <!-- Content section -->
            <div id="chart-section">
                <div class="temp chart-container">
                    <div class="header-container">
                        <p class="header">Temperature Overview</p>
                        <button class="export-btn">Export</button>
                    </div>

                    <div class="chart-body">
                        <canvas id="temp-chart" class="chart"></canvas>
                    </div>
                    
                </div>

                <div class="humid chart-container">
                    <div class="header-container">
                        <p class="header">Humidity Overview</p>
                        <button class="export-btn">Export</button>
                    </div>

                    <div class="chart-body">
                        <canvas id="humid-chart" class="chart"></canvas>
                    </div>
                    
                </div>
            </div>
        </div>

    </div>

    <script src="/src/line-chart.js"> </script>

    <script src="/src/control.js"></script>

</body>

</html>