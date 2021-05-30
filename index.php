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
    <link rel="stylesheet" href="/src/gauge.css">
    <link rel="stylesheet" href="/src/toggle.css">
    <link rel="stylesheet" href="/style.css">
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
            <div class="gauge-container">
                <div class="gauge gauge-temp">
                    <div class="gauge__body_temp">
                        <div class="gauge__fill_temp"></div>
                        <div class="gauge__cover_temp"></div>
                    </div>

                    <div class="temperature">
                        <p>Temperature</p>
                    </div>


                </div>

                <div class="gauge gauge-humid">
                    <div class="gauge__body_humid">
                        <div class="gauge__fill_humid"></div>
                        <div class="gauge__cover_humid"></div>
                    </div>

                    <div class="humidity">
                        <p>Humidity</p>
                    </div>

                </div>
            </div>



            <!-- button ON/OFF -->
            <div class="toggle">
                <p class="off-switch">OFF</p>
                <label class="switch">
                    <input id="switch-btn" type="checkbox">
                    <span class="slider round"></span>
                </label>
                <p class="on-switch">ON</p>
            </div>


        </div>

        <!-- Get Humidity JSON text from Server AdaFruit -->
        <script src="/src/gauge.js"></script>

        <script>
            setParam();

            async function setParam() {
                var message;
                await $.ajax({
                    url: "Server/get-latest-data.php",
                    type: 'GET',
                    success: function(data) {
                        var dataArray = data.split('-');
                        const humidElement = document.querySelector(".gauge.gauge-humid");
                        const tempElement = document.querySelector(".gauge.gauge-temp");
                        setTempValue(tempElement, dataArray[0]);
                        setHumidValue(humidElement, dataArray[1]);
                    },
                    error: function() {
                        console.log("Error");
                    }
                });
            }
            window.setInterval(setParam, 30000);
        </script>

        <!-- <script>
            async function setParam() {
                var message;
                await $.ajax({
                    url: "Server/subscribe.php",
                    type: 'GET',
                    success: function(data) {
                        console.log(data);
                        message = JSON.parse(data);
                        var dataArray = message.data.split('-');
                        const humidElement = document.querySelector(".gauge.gauge-humid");
                        const tempElement = document.querySelector(".gauge.gauge-temp");
                        setTempValue(tempElement, dataArray[0]);
                        setHumidValue(humidElement, dataArray[1]);

                        $.ajax({
                            url: 'insert-param.php',
                            type: 'POST',
                            data: {
                                temperature: dataArray[0],
                                humidity: dataArray[1]
                            },
                            success: function(msg) {
                                console.log(msg);
                            }
                        })
                    },
                    error: function() {
                        console.log("Error");
                    }
                });
            }
            setParam();
            window.setInterval(setParam,250000);
        </script> -->


        <!-- Send Relay JSON text to Server AdaFruit -->
        <script>
            var State, buttonState;
            $(document).ready(function() {
                $("#switch-btn").click(function() {
                    State = $('#switch-btn').prop('checked');

                    if (State === true)
                        buttonState = 1;
                    else
                        buttonState = 0;

                    $.ajax({
                        url: 'Server/publish-Relay.php',
                        type: 'POST',
                        data: {
                            state: buttonState
                        },
                        success: function() {
                            console.log("Success");
                        },
                        error: function() {
                            console.log("Error");
                        }
                    });
                })
            })
        </script>

        <!-- Load BUTTON ON/OFF state from user -->
        <script>
            $(document).ready(setInterval(function() {
                $.ajax({
                    url: 'Server/get-relay-state.php',
                    type: 'GET',
                    success: function(data) {
                        console.log(data);
                        if (data == 1) {
                            $('#switch-btn').prop('checked', true);
                        }
                    },
                    error: function() {
                        console.log('error');
                    }
                })
            },20000))
        </script>
    </div>
</body>

</html>