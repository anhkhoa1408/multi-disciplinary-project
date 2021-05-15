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
    <script src="/src/jquery-3.6.0.min.js"></script>
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

        <!-- Content section -->
        <div id="content-section">

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
            <script src="src/gauge.js"></script>

            <!-- button ON/OFF -->
            <div class="toggle">
                <p class="off-switch">OFF</p>
                <label class="switch">
                    <input type="checkbox">
                    <span class="slider round"></span>
                </label>
                <p class="on-switch">ON</p>
            </div>


        </div>

        <script>
            $.ajax({
                url: "Server/subscribe.php",
                type: 'GET',
                success: function(data) {
                    console.log(data);
                }
            });
        </script>

    </div>
</body>

</html>