<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SprinklerIOT</title>
    <link rel="stylesheet" href="./assets/fontawesome-free-5.15.3-web/fontawesome-free-5.15.3-web/css/all.css">
    <link rel="stylesheet" href="./src/gauge.css">
    <link rel="stylesheet" href="./src/toggle.css">
    <link rel="stylesheet" href="./src/setinfo.css">
    <script src="./src/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="./style.css">
</head>

<body>
    <div id="main">
        <!-- Header section -->
        <div id="header-section">
            <img src="" alt="" class="logo">

            <div class="sign-out">
                <a href="./login.php"><i class="fas fa-sign-out-alt"></i></a>
            </div>
        </div>

        <!-- Navigation section -->
        <div id="nav-section">
            <ul class="nav">
                <li><a href="./index.php" class="home-page"><i class="btn fas fa-home"></i></a>Home</li>
                <li><a href="./setinfo.php" class="set-info-page"><i class="btn fas fa-sliders-h"></i></a>Parameter</li>
                <li><a href="./settime.php" class="set-time-page"><i class="btn far fa-clock"></i></a>Time</li>
            </ul>
        </div>

        <!-- Content section -->
        <!-------------------------------------------------------------------------------------------------->
        <!--Author:Pham Nguyen Thai Khuong ------------------------------------------------------------------------->
        <!--Id: Range-slider ----------------------------------------------------------------------------->
        <!--Note: Set Time---------------------------------------------------------------------------------->
        <div id="content-section">

            <!-- <p>Time Range: <span class="slider-time">10:00 AM</span> - <span class="slider-time2">12:00 PM</span></p> -->

            <div class="container start">
                <div class="length range__slider start-slider">
                    <div class="length__title field-title" data-length='20'>Temperature: </div>
                    <input id="slider" type="range" min="20" max="60" value="20" />
                    
                </div>
            </div>

            <div class="container end">
                <div class="length range__slider end-slider">
                    <div class="length__title field-title" data-length='0'>Humidity:</div>
                    <input id="slider" type="range" min="0" max="1023" value="0" />
                </div>
            </div>

            <button type="button" class="button set-info-btn" onclick="submitInfo()">Submit!</button>

        </div>
        <script src="./src/setinfo.js"></script>

        <script>
           async function submitInfo(){
               var temperature = document.querySelectorAll(".length__title.field-title")[0].getAttribute('data-length');
               var humidity = document.querySelectorAll(".length__title.field-title")[1].getAttribute('data-length');
               
                await $.ajax({
                    url: 'setinfo_server.php',
                    type: 'POST',
                    data:{
                        temp:temperature,
                        humid: humidity
                    },
                    cache: false,
                    success: function(message) {
                        console.log(message)
                        alert('Success');
                    },
                    error: function() {
                        console.log('Error');
                    }
                });
           }
        </script>

    </div>
</body>

</html>