<?php
    session_start();
    include "connect-database.php";
    $username = $_SESSION["user"];
    $get_latest_para = "SELECT * FROM `minimumparam` WHERE `UserName` = '$username' ORDER BY `Created` DESC LIMIT 0, 1";
    $query = $conn->query($get_latest_para) or die($conn->error);
    $result = $query->fetch_assoc();
    if ($result == null) {
        $temperature = 0;
        $humidity = 0;
    } else {
        $temperature = $result['Temperature'];
        $humidity = $result['Humidity'];
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SprinklerIOT</title>
    <link rel="stylesheet" href="/src/gauge.css">
    <link rel="stylesheet" href="/src/slider.css">
    <link rel="stylesheet" href="/style.css">
    <script src="/src/icon.js"></script>
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

        <!-------------------------------------------------------------------------------------------------->
        <!--Author:Nguyen Van Khoa ------------------------------------------------------------------------->
        <!--Id: Content-slider ----------------------------------------------------------------------------->
        <!--Note: Set Info---------------------------------------------------------------------------------->
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

            <div id="set-info-section">
                <!--Temperature-->
                <div class="set-info-container">
                    <div class="slidecontainer temp">
                        <div class="gauge gauge-temp">
                            <i class="fas fa-temperature-high" style="color: #4e73df"></i>
                            <div class="temperature">
                                <p>Temperature</p>
                            </div>
                        </div>

                        <input type="range" value=<?php echo $temperature ?> class="slider-temperature" id="Temperature">

                        <div class="gauge gauge-temp-number">
                            <div class="temperature-number">
                                <p><span id="tmp">0</span>°C</p>
                            </div>
                        </div>
                    </div>

                    <!--Humidity-->
                    <div class="slidecontainer humid">
                        <div class="gauge gauge-humid">
                            <i class=" fal fa-humidity" style="color: #4e73df"></i>
                            <div class="humidity">
                                <p>Humidity</p>
                            </div>
                        </div>

                        <input type="range" value=<?php echo $humidity ?> class="slider-humidity" id="Humidity">


                        <div class="gauge gauge-humid-number">
                            <div class="humidity-number">
                                <p><span id="hmd">20</span>%</p>
                            </div>
                        </div>
                    </div>

                    <div>
                        <button type="button" class="set-info-btn" onclick="submitInfo()">Submit</button>
                    </div>
                </div>


            </div>

        </div>
    </div>

    <script src="/src/slider.js"></script>

    <script>
        async function submitInfo() {
            var temperature = $('#tmp').prop('innerHTML');
            console.log(temperature);
            var humidity = $('#hmd').prop('innerHTML');

            await $.ajax({
                url: 'setinfo-server.php',
                type: 'POST',
                data: {
                    temp: temperature,
                    humid: humidity
                },
                cache: false,
                success: function(message) {
                    console.log(message)
                    if (message == 1)
                        alert('Success');
                },
                error: function() {
                    console.log('Error');
                }
            });
        }
    </script>

    <script>
        $('.slider-temperature').on('input', function() {
            $(this).css('background', 'linear-gradient(to right, rgb(63, 63, 255) 0%, rgb(63, 63, 255) ' + this.value + '%, #d3d3d3 ' + this.value + '%, #d3d3d3 100%)');
        });

        $('.slider-humidity').on('input', function() {
            $(this).css('background', 'linear-gradient(to right, rgb(63, 63, 255) 0%, rgb(63, 63, 255) ' + this.value + '%, #d3d3d3 ' + this.value + '%, #d3d3d3 100%)');
        });
    </script>

    <script>
        $(document).ready(function() {
            var temp_value = $('#Temperature').val();
            // console.log(temp_value)
            var humid_value = $('#Humidity').val();
            $('#Temperature').css('background', 'linear-gradient(to right, rgb(63, 63, 255) 0%, rgb(63, 63, 255) ' + temp_value + '%, #d3d3d3 ' + temp_value + '%, #d3d3d3 100%)');
            $('#Humidity').css('background', 'linear-gradient(to right, rgb(63, 63, 255) 0%, rgb(63, 63, 255) ' + humid_value + '%, #d3d3d3 ' + humid_value + '%, #d3d3d3 100%)');
        });
    </script>
</body>