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
    <link rel="stylesheet" href="/src/watch.css">
    <link rel="stylesheet" href="/src/toast-message.css">
    <link rel="stylesheet" href="/style.css">
    <script src="/src/jquery-3.6.0.min.js"></script>
    <script src="/src/icon.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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

        <!-- Navigation section -->
        <div id="content">
            <div id="nav-section">
                <i class="nav-icon fas fa-raindrops"></i>
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
                <div class="control">
                    <div class="control-container">
                        <div class="sprinkler_toggle">
                            <p class="toggle_header">Realtime Control</p>
                            <label class="switch switch-sprinkler">
                                <input id="switch-btn" type="checkbox">
                                <span class="slider round"></span>
                            </label>
                        </div>

                        <div class="clock-container">
                            <div class="hours">
                                <span>Hours</span>
                                <p id='hour'> 00 </p>
                            </div>
                            <div class="colon"></div>
                            <div class="minutes">
                                <span>Minutes</span>
                                <p id='minute'> 00 </p>
                            </div>
                            <div class="colon"></div>
                            <div class="seconds">
                                <span>Seconds</span>
                                <p id='second'> 00 </p>
                            </div>

                            <div class="bottom">
                                <div class="progress-bar" id="progress"></div>
                            </div>
                        </div>



                        <i class="fas fa-sprinkler sprinkler_icon"></i>

                    </div>

                    <div class="setting">
                        <div class="setting-header">
                            <p>Automatic</p>
                            <li class="menu-toggle-icon"><i class="menu-toggle-icon fal fa-ellipsis-h"></i></li>
                            <ul class="toggle-all">
                                <li id="toggle-on-all">All on</li>
                                <li id="toggle-off-all">All off</li>
                            </ul>
                        </div>
                        <ul class="setting-content">
                            <li>
                                <p>Check Time</p>
                                <label class="switch switch-para">
                                    <input id="switch-time-btn" type="checkbox">
                                    <span class="slider round"></span>
                                </label>
                            </li>
                            <li>
                                <p>Check Parameter</p>
                                <label class="switch switch-para">
                                    <input id="switch-para-btn" type="checkbox">
                                    <span class="slider round"></span>
                                </label>
                            </li>
                        </ul>
                    </div>
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
                        <div class="avg-bar-chart-header">
                            <p>Average Chart</p>
                            <li class="drop-down-icon"><i class="fas fa-bars"></i></li>
                            <ul class="avg-chart-content-date">
                                <li>Today</li>
                                <li>Yesterday</li>
                                <li>Last Week</li>
                            </ul>
                        </div>
                        <canvas id="bar-chart">

                        </canvas>
                    </div>
                </div>
            </div>
        </div>

        <div id="toast"></div>
    </div>

    <!-- Function to show toast message -->
    <script src="/src/toast-message.js"></script>


    <script src="/src/watch.js"></script>

    <!-- Function to load Humidity and Temperature to gauge -->
    <script src="/src/gauge.js"></script>


    <!-- Function to load average bar chart -->
    <script src="/src/avg-chart.js"></script>


    <!-- Function to get JSON text from database -->
    <script>
        setParam();

        async function setParam() {
            var message;
            await $.ajax({
                url: "Server/get-latest-data.php",
                type: 'GET',
                success: function(data) {
                    var dataArray = data.split('-');
                    // console.log(dataArray);
                    const tempElement = document.querySelector(".gauge.gauge-temp");
                    const humidElement = document.querySelector(".gauge.gauge-humid");
                    setTempValue(tempElement, dataArray[0]);
                    setHumidValue(humidElement, dataArray[1]);
                    loadChart(0);
                    showSuccessToast("Get data successfully!")
                },
                error: function() {
                    showErrorToast("Error occur, please contact to the administrator!");
                }
            });
        }
        window.setInterval(setParam, 30000);
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
                    $('.sprinkler_icon').css('transition', '0.8s');
                    $('.switch-sprinkler .slider').css('--col', 'rgb(76, 228, 76)')
                    showSuccessToast("Sprinkler is on")
                } else {
                    buttonState = 0;
                    $('.sprinkler_icon').css('color', '#ccc');
                    $('.switch-sprinkler .slider').css('--col', 'red')
                    showSuccessToast("Sprinkler is off")
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

        // var temp = localStorage.getItem('timeState') === "true" ? true : false;
        // console.log(typeof temp)
        if (localStorage.getItem('timeState') === "true")
        {
            $('#switch-time-btn').prop('checked', true);
            $('#switch-time-btn + .slider').css('--col', 'rgb(76, 228, 76)');
        }

        if (localStorage.getItem('paraState') === "true")
        {
            $('#switch-para-btn').prop('checked', true);
            $('#switch-para-btn + .slider').css('--col', 'rgb(76, 228, 76)');
        }
    </script>

    <!-- Load BUTTON ON/OFF state from user -->
    <script>
        function getBtnState() {
            $.ajax({
                url: 'Server/get-relay-state.php',
                type: 'GET',
                success: function(data) {
                    // console.log("Get state successfully", data);
                    if (data == 1) {
                        $('#switch-btn').prop('checked', true);
                        $('.sprinkler_icon').css('color', '#4e73df');
                        $('.switch-sprinkler .slider').css('--col', 'rgb(76, 228, 76)')
                    } else {
                        $('#switch-btn').prop('checked', false);
                        $('.switch-sprinkler .slider').css('--col', 'red')
                        // $('.switch-sprinkler .slider').css('--col', 'rgb(76, 228, 76)')
                    }
                },
                error: function() {
                    console.log('error');
                }
            })
        }
        getBtnState();
        window.setInterval(getBtnState, 5000);
    </script>

    <!-- Load Check BUTTON ON/OFF state from user -->
    <script>
        function getCheckBtnState() {
            $.ajax({
                url: 'Server/get_user_toggle.php',
                type: 'GET',
                success: function(data) {
                    // console.log("Get toggle state successfully", data);
                    if (data[0] == "1")
                    {
                        $('#switch-time-btn').prop('checked', true);
                        $('#switch-time-btn + .slider').css('--col', 'rgb(76, 228, 76)');
                        localStorage.setItem('timeState', "true");
                    }
                    else
                    {
                        $('#switch-time-btn + .slider').css('--col', 'red')
                        localStorage.setItem('timeState', "false");
                    }
                    if (data[1] == "1")
                    {
                        $('#switch-para-btn').prop('checked', true);
                        $('#switch-para-btn + .slider').css('--col', 'rgb(76, 228, 76)');
                        localStorage.setItem('paraState', "true");
                    }
                    else
                    {
                        $('#switch-para-btn + .slider').css('--col', 'red');
                        localStorage.setItem('paraState', "false");
                    }
                },
                error: function() {
                    console.log('error');
                }
            })
        }

        getCheckBtnState()
    </script>

    <script src="/src/control.js"></script>

</body>

</html>