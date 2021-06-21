<?php
session_start();
include "connect-database.php";
$username = $_SESSION["user"];
$get_latest_time = "SELECT * FROM `timesetting` WHERE `UserName` = '$username' ORDER BY `ID` DESC LIMIT 0, 1";
$query = $conn->query($get_latest_time) or die($conn->error);
$result = $query->fetch_assoc();
if ($result == null) {
    $startTime = date("H:i", strtotime("00:00"));
    $endTime = date("H:i", strtotime("00:00"));
    $start_value = 0;
    $end_value = 0;
} else {
    $startTime = date("H:i", strtotime($result['start_time']));
    $endTime = date("H:i", strtotime($result['end_time']));
    $start_value = intval(date("H", strtotime($startTime))) * 60 + intval(date("i", strtotime($startTime)));
    $end_value = intval(date("H", strtotime($endTime))) * 60 + intval(date("i", strtotime($endTime)));
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SprinklerIOT</title>
    <link rel="stylesheet" href="/src/settime.css">
    <link rel="stylesheet" href="/src/toast-message.css">
    <link rel="stylesheet" href="/style.css">
    <script src="/src/jquery-3.6.0.min.js"></script>
    <script src="/src/icon.js"></script>
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

        <!-- Content section -->
        <!-------------------------------------------------------------------------------------------------->
        <!--Author:Pham Nguyen Thai Khuong ------------------------------------------------------------------------->
        <!--Id: Range-slider ----------------------------------------------------------------------------->
        <!--Note: Set Time---------------------------------------------------------------------------------->
        <!-- Navigation section -->
        <div id="content">
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


            <div id="set-time-section">
                <div id="set-time-container">
                    <div class="set-time-header">
                        <i class="fal fa-clock"></i>
                        <p>Automatic Timer</p>
                    </div>

                    <div class="container">
                        <div class="range__slider start-slider">
                            <div class="length__title field-title" data-length=<?php echo $startTime ?>>Start Time : </div>
                            <input class="slider" type="range" min="0" max="1439" value=<?php echo $start_value ?> />
                        </div>
                    </div>

                    <div class="container">
                        <div class="range__slider end-slider">
                            <div class="length__title field-title" data-length=<?php echo $endTime ?>>End Time : </div>
                            <input class="slider" type="range" min="0" max="1439" value=<?php echo $end_value ?> />
                        </div>
                    </div>

                    <div>
                        <button type="button" class="button set-time-btn" onclick="submitTime()">Submit</button>
                    </div>
                </div>
            </div>



        </div>

        <div id="toast"></div>

    </div>


    <!-- Function to show toast message -->
    <script src="/src/toast-message.js"></script>

    <!-- Function to handle time -->
    <script src="/src/settime.js"></script>

    <!-- Function to save time to database -->
    <script>
        async function submitTime() {
            var start_time = document.querySelectorAll(".length__title.field-title")[0].getAttribute('data-length');
            var end_time = document.querySelectorAll(".length__title.field-title")[1].getAttribute('data-length');
            console.log(start_time);

            if (start_time >= end_time) {
                showErrorToast("Bad timing!");
            } else {
                await $.ajax({
                    url: 'settime-server.php',
                    type: 'POST',
                    data: {
                        stime: start_time,
                        etime: end_time
                    },
                    cache: false,
                    success: function(message) {
                        console.log(message)
                        if (message == 1)
                            showSuccessToast()
                    },
                    error: function() {
                        showErrorToast();
                    }
                });
            }
        }
    </script>

    <!-- Function to fill slider color from user input -->
    <script>
        $('.start-slider .slider').on('input', function() {
            $(this).css('background', 'linear-gradient(to right, rgb(90, 223, 183) 0%, rgb(90, 223, 183) ' + (this.value / 1440) * 100 + '%, #d3d3d3 ' + (this.value / 1440) * 100 + '%, #d3d3d3 100%)');
        });

        $('.end-slider .slider').on('input', function() {
            $(this).css('background', 'linear-gradient(to right, rgb(90, 223, 183) 0%, rgb(90, 223, 183) ' + (this.value / 1440) * 100 + '%, #d3d3d3 ' + (this.value / 1440) * 100 + '%, #d3d3d3 100%)');
        });
    </script>

    <!-- Function to fill slider from slider value -->
    <script>
        $(document).ready(function() {
            var start_value = $('.start-slider .slider').val();
            $('.start-slider .slider').css('background', 'linear-gradient(to right, rgb(90, 223, 183) 0%, rgb(90, 223, 183) ' + (start_value / 1440) * 100 + '%, #d3d3d3 ' + (start_value / 1440) * 100 + '%, #d3d3d3 100%)');
            var end_value = $('.end-slider .slider').val();
            $('.end-slider .slider').css('background', 'linear-gradient(to right, rgb(90, 223, 183) 0%, rgb(90, 223, 183) ' + (end_value / 1440) * 100 + '%, #d3d3d3 ' + (end_value / 1440) * 100 + '%, #d3d3d3 100%)');
        });
    </script>
</body>

</html>