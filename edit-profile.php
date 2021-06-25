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
                    <h5>Signed in as </br> <?php echo $_SESSION['user'] ?></h5>
                    <li><i class="fas fa-user-alt"></i><a href="" class="setting">Your Profile</a></li>
                    <li><i class="fas fa-sign-out-alt"></i><a href="/login.php">Sign out</a></li>
                </ul>
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
            <div id="edit-profile-section">
                <div class="profile-container">
                    <div class="profile-menu">
                        <label>Edit Profile</label>
                        <ul>
                            <li>Change Password</li>
                            <li>Change AioKey</li>
                        </ul>
                    </div>
                    <div class="profile-content">
                        <div class="password-content" style="display: flex">
                            <div class="form-group">
                                <label for="currentPassword">Password</label>
                                <input name="currentPassword" type="password" class="form-control" placeholder="Password">
                                <div style="margin: 3px 0px; color: rgb(253, 76, 76); font-size: 13px">
                                    <label id="currentPassword-error" class="error" for="currentPassword"></label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="newPassword">New Password</label>
                                <input name="newPassword" type="password" class="form-control" placeholder="New Password">
                                <div style="margin: 3px 0px; color: rgb(253, 76, 76); font-size: 13px">
                                    <label id="newPassword-error" class="error" for="newPassword"></label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="repeatPassword">Repeat Password</label>
                                <input name="repeatPassword" type="password" class="form-control" placeholder="Repeat Password">
                                <div style="margin: 3px 0px; color: rgb(253, 76, 76); font-size: 13px">
                                    <label id="repeatPassword-error" class="error" for="repeatPassword"></label>
                                </div>
                            </div>

                            <button class="change-btn" onclick="handlePassword()">Change</button>
                        </div>

                        <div class="key-content" style="display: none">
                            <!-- <div class="form-group">
                                <label for="currentKey">AioKey</label>
                                <input name="currentKey" type="key" class="form-control" placeholder="AioKey">
                                <div style="margin: 3px 0px; color: rgb(253, 76, 76); font-size: 13px">
                                    <label id="currentKey-error" class="error" for="currentKey"></label>
                                </div>
                            </div> -->
                            <div class="form-group">
                                <label for="newKey">New AioKey</label>
                                <input name="newKey" type="key" class="form-control" placeholder="New AioKey">
                                <div style="margin: 3px 0px; color: rgb(253, 76, 76); font-size: 13px">
                                    <label id="newKey-error" class="error" for="newKey"></label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="repeatKey">Repeat AioKey</label>
                                <input name="repeatKey" type="key" class="form-control" placeholder="Repeat AioKey">
                                <div style="margin: 3px 0px; color: rgb(253, 76, 76); font-size: 13px">
                                    <label id="repeatKey-error" class="error" for="repeatKey"></label>
                                </div>
                            </div>

                            <button class="change-btn" onclick="handleKey()">Change</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div id="toast"></div>


    </div>

    <!-- Function to handle Password -->
    <script>
        var validPassword = "<?php echo $_SESSION['pass'] ?>";
        // console.log(validPassword)

        function handlePassword() {
            var currentPassword = $("input[name='currentPassword']").val();
            var newPassword = $("input[name='newPassword']").val();
            var repeatPassword = $("input[name='repeatPassword']").val();

            if (currentPassword === '') {
                $('#currentPassword-error').prop('innerHTML', 'You must fill out this field!');
                return;
            } else if (currentPassword !== validPassword) {
                $('#currentPassword-error').prop('innerHTML', 'Your current password is not correct!');
                return;
            } else {
                $('#currentPassword-error').prop('innerHTML', '');
            }

            if (newPassword === '') {
                $('#newPassword-error').prop('innerHTML', 'You must fill out this field!');
                return;
            } else {
                $('#newPassword-error').prop('innerHTML', '');
            }

            if (repeatPassword === '') {
                $('#repeatPassword-error').prop('innerHTML', 'You must fill out this field!');
                return;
            } else {
                $('#repeatPassword-error').prop('innerHTML', '');
            }

            if (newPassword !== repeatPassword) {
                $('#repeatPassword-error').prop('innerHTML', 'Repeat password and new password must be the same!');
                return;
            } else {
                $('#repeatPassword-error').prop('innerHTML', '');
            }

            $.ajax({
                url: "update-password.php",
                type: "POST",
                data: {
                    password: newPassword
                },
                success: function(message) {
                    // console.log(message)
                    if (message === "1")
                        showSuccessToast("Update password successfully");
                    else
                        showErrorToast("Error");
                }
            })
        }
    </script>


    <script>
        // var validPassword = "<?php echo $_SESSION['pass'] ?>";
        // console.log(validPassword)

        function handleKey() {
            // var currentPassword = $("input[name='currentPassword']").val();
            var newKey = $("input[name='newKey']").val();
            var repeatKey = $("input[name='repeatKey']").val();

            // if (currentPassword === '') {
            //     $('#currentPassword-error').prop('innerHTML', 'You must fill out this field!');
            //     return;
            // } else if (currentPassword !== validPassword) {
            //     $('#currentPassword-error').prop('innerHTML', 'Your current password is not correct!');
            //     return;
            // } else {
            //     $('#currentPassword-error').prop('innerHTML', '');
            // }

            if (newKey === '') {
                $('#newKey-error').prop('innerHTML', 'You must fill out this field!');
                return;
            } else {
                $('#newKey-error').prop('innerHTML', '');
            }

            if (repeatKey === '') {
                $('#repeatKey-error').prop('innerHTML', 'You must fill out this field!');
                return;
            } else {
                $('#repeatKey-error').prop('innerHTML', '');
            }

            if (newKey !== repeatKey) {
                $('#repeatKey-error').prop('innerHTML', 'Repeat key and new key must be the same!');
                return;
            } else {
                $('#repeatKey-error').prop('innerHTML', '');
            }

            $.ajax({
                url: "update-aiokey.php",
                type: "POST",
                data: {
                    key: newKey
                },
                success: function(message) {
                    if (message === "1")
                        showSuccessToast("Update key successfully");
                    else
                        showErrorToast("Error");
                }
            })
        }
    </script>

    <script>
        $('.profile-menu ul li').first().click(function() {
            console.log(1)
            $('.password-content').css('display', 'flex')
            $('.profile-menu ul li').first().css({
                'background-color': 'rgb(226, 250, 237)',
                'border-left': '4px solid rgb(0, 202, 67)'
            })
            $('.profile-menu ul li').last().css({
                'background-color': '#fff',
                'border-left': 'none'
            })
            $('.key-content').css('display', 'none');
        })

        $('.profile-menu ul li').last().click(function() {
            console.log(2)
            $('.password-content').css('display', 'none');
            $('.profile-menu ul li').first().css({
                'background-color': '#fff',
                'border-left': 'none'
            })
            $('.profile-menu ul li').last().css({
                'background-color': 'rgb(226, 250, 237)',
                'border-left': '4px solid rgb(0, 202, 67)'
            })
            $('.key-content').css('display', 'flex');
        })
    </script>

    <!--  -->
    <script src="/src/control.js"></script>



    <script src="/src/toast-message.js"></script>

</body>

</html>