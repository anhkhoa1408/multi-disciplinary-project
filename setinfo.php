<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SprinklerIOT</title>
    <link rel="stylesheet" href="/assets/fontawesome-free-5.15.3-web/fontawesome-free-5.15.3-web/css/all.css">
    <link rel="stylesheet" href="/style.css">
    <link rel="stylesheet" href="/src/gauge.css">
    <link rel="stylesheet" href="/src/toggle.css">
    <link rel="stylesheet" href="/src/slider.css">
</head>

<body>
    <div id="main">
        <!-- Header section -->
        <div id="header-section">
            <img src="" alt="" class="logo">

            <div class="sign-out">
                <a href="/html/login.html"><i class="fas fa-sign-out-alt"></i></a>
            </div>
        </div>

        <!-- Navigation section -->
        <div id="nav-section">
            <ul class="nav">
                <li><a href="/index.php" class="home-page"><i class="btn fas fa-home"></i></a>Home</li>
                <li><a href="/html/setinfo.html" class="set-info-page"><i class="btn fas fa-sliders-h"></i></a>Parameter</li>
                <li><a href="/html/settime.html" class="set-time-page"><i class="btn far fa-clock"></i></a>Time</li>
            </ul>
        </div>

        <!-------------------------------------------------------------------------------------------------->
        <!--Author:Nguyen Van Khoa ------------------------------------------------------------------------->
        <!--Id: Content-slider ----------------------------------------------------------------------------->
        <!--Note: Set Info---------------------------------------------------------------------------------->
        <div id="content-slider">

            <!--Temperature-->
            <div class="slidecontainer">
                <input type="range" min="0" max="50" value="0" class="slider-temperature" id="Temperature">

                <div class="gauge gauge-temp">
                    <div class="temperature">
                        <p>Temperature</p>
                    </div>
                </div>

                <div class="gauge gauge-temp-number">
                    <div class="temperature-number">
                        <p><span id="demo"></span>°C</p>
                    </div>
                </div>
            </div>

            <!--Humidity-->
            <div class="slidecontainer">
                <input type="range" min="20" max="90" value="0" class="slider-humidity" id="Humidity">

                <div class="gauge gauge-humid">
                    <div class="humidity">
                        <p>Humidity</p>
                    </div>
                </div>

                <div class="gauge gauge-humid-number">
                    <div class="humidity-number">
                        <p><span id="humid"></span>%</p>
                    </div>
                </div>
            </div>

            <button type="button" class="set-info-btn" onclick="alert('Hello world!')">Submit!</button>

            <script src="/src/slider.js"></script>
        </div>
    </div>
</body>