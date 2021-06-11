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
    <!-- <link rel="stylesheet" href="/assets/fontawesome-free-5.15.3-web/fontawesome-free-5.15.3-web/css/all.css"> -->
    <script src="/src/icon.js"></script>
    <link rel="stylesheet" href="/src/gauge.css">
    <link rel="stylesheet" href="/src/toggle.css">
    <link rel="stylesheet" href="/style.css">
    <script src="/src/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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

            <!-- Content section -->
            <div id="home-section">

                <!-- button ON/OFF -->
                <div class="toggle">
                    <!-- <p class="off-switch">OFF</p> -->
                    <div class="toggle_content">
                        <p class="toggle_header">Realtime control</p>
                        <label class="switch">
                            <input id="switch-btn" type="checkbox">
                            <span class="slider round"></span>
                        </label>
                    </div>

                    <i class="sprinkler_icon fas fa-sprinkler"></i>
                </div>

                <div class="gauge-chart-container">
                    <div class="gauge-container">
                        <div class="gauge gauge-temp">
                            <div class="gauge_header">
                                <p>Temperature</p>
                            </div>
                            <div class="gauge__body_temp">
                                <div class="gauge__fill_temp"></div>
                                <div class="gauge__cover_temp"></div>
                            </div>
                        </div>

                        <div class="gauge gauge-humid">
                            <div class="gauge_header">
                                <p>Humidity</p>
                            </div>
                            <div class="gauge__body_humid">
                                <div class="gauge__fill_humid"></div>
                                <div class="gauge__cover_humid"></div>
                            </div>
                        </div>
                    </div>

                    <div class="avg-bar-chart-container">
                        <canvas id="bar-chart">

                        </canvas>
                    </div>
                </div>



            </div>


        </div>
    </div>

    <!-- Function to load Humidity and Temperature to gauge -->
    <script src="/src/gauge.js"></script>


    <!-- Function to load average bar chart -->
    <script src="/src/avg-chart.js"></script>


    <!-- Function to get JSON text from Server AdaFruit -->
    <script>
        setParam();

        async function setParam() {
            var message;
            await $.ajax({
                url: "Server/get-latest-data.php",
                type: 'GET',
                success: function(data) {
                    var dataArray = data.split('-');
                    console.log(dataArray);
                    const tempElement = document.querySelector(".gauge.gauge-temp");
                    const humidElement = document.querySelector(".gauge.gauge-humid");
                    setTempValue(tempElement, dataArray[0]);
                    setHumidValue(humidElement, dataArray[1]);
                    loadChart();
                },
                error: function() {
                    console.log("Error");
                }
            });
        }
        window.setInterval(setParam, 1000000);
    </script>


    <!-- Send Relay JSON text to Server AdaFruit -->
    <script>
        var State, buttonState;
        $(document).ready(function() {
            $("#switch-btn").click(function() {
                State = $('#switch-btn').prop('checked');

                if (State === true) {
                    buttonState = 1;
                    $('.sprinkler_icon').css('color', '#4e73df');
                    $('.sprinkler_icon').css('transition', '0.5s');
                    $('.slider').css('--col', 'rgb(76, 228, 76)')
                } else {
                    buttonState = 0;
                    $('.sprinkler_icon').css('color', '#ccc');
                    $('.slider').css('--col', 'red')
                }

                $.ajax({
                    url: 'Server/publish-Relay.php',
                    type: 'POST',
                    data: {
                        state: buttonState
                    },
                    success: function() {
                        console.log("Success send data to relay");
                    },
                    error: function() {
                        console.log("Error occur when sending data");
                    }
                });
            })
        })
    </script>

    <!-- Load BUTTON ON/OFF state from user -->
    <script>
        function getBtnState() {
            $.ajax({
                url: 'Server/get-relay-state.php',
                type: 'GET',
                success: function(data) {
                    console.log("Get state successfully");
                    if (data == 1) {
                        $('#switch-btn').prop('checked', true);
                        $('.sprinkler_icon').css('color', '#4e73df');
                        $('.slider').css('--col', 'rgb(76, 228, 76)')
                    }
                },
                error: function() {
                    console.log('error');
                }
            })
        }
        getBtnState();
        window.setInterval(getBtnState, 20000);
    </script>

    

</body>

</html>