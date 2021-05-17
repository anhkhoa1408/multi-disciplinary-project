<?php
    session_start();
    if(isset($_SESSION['name'])) {
        header('location:index.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in</title>
    <link rel="stylesheet" href="/assets/fontawesome-free-5.15.3-web/fontawesome-free-5.15.3-web/css/all.css">
    <link rel="stylesheet" href="/style.css">
    <link rel="stylesheet" href="src/signup.css">
    <script src="/src/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div id="main">
        <!-- Header section -->
        <div id="header-section">
            <img src="" alt="" class="logo">

        </div>


        <!-- Login section -->
        <div id="login-section">
            <form class="login">
                <h1 class="header">Log in</h1>
                <label for="username">User Name:</label>
                <input type="text" id="username-input">
                <div id="username-error"></div>
                <label for="password">Password:</label>
                <input type="text" id="password-input">
                <div id="password-error"></div>
                <a href="#" id="sign-up" onclick="document.getElementById('sign-up-form').style.display = 'block'">Sign up</a>
                <button type="button" class="sign-in-btn" onclick="validateLogin()">Log in</button>
            </form>
        </div>


        <!-- Signup form -->
        <div id="sign-up-form" class="modal" style="display: none;">
            <span onclick="document.getElementById('sign-up-form').style.display='none'" class="close" title="Close Modal"></span>
            <form class="modal-content">
                <div class="container">
                <h1>Sign Up</h1>
                <hr>
                <label for="username"><b>User Name</b></label>
                <input id="sign-up-username" type="text" placeholder="Enter User Name" name="username" required>

                <label for="psw"><b>Password</b></label>
                <input id="sign-up-pw" type="password" placeholder="Enter Password" name="psw" required>

                <label for="psw-repeat"><b>Repeat Password</b></label>
                <input id="sign-up-pw-repeat" type="password" placeholder="Repeat Password" name="psw-repeat" required>
                <div id="sign-up-err" style="color: red; text-align:left"></div>
                <div class="clearfix">
                    <button type="button" onclick="document.getElementById('sign-up-form').style.display='none'" class="cancelbtn">Cancel</button>
                    <button type="button" class="signupbtn" onclick="validateSignUp()">Sign Up</button>
                </div>
                </div>
            </form>
        </div>

        <!-- Function to check username and password -->
        <script>
            async function validateLogin() {
                var username = $('#username-input').val();
                var password = $('#password-input').val();
                var userNameErr = $('#username-error');
                var passwordErr = $('#password-error');

                if (username == '') {
                    userNameErr.prop('innerHTML', 'Please enter User Name!');
                    return;
                }

                if (password == '') {
                    passwordErr.prop('innerHTML', 'Please enter Password!');
                    return;
                }
                
                userNameErr.prop('innerHTML', '');

                await $.ajax({    
                    url: 'validate.php',
                    type: 'POST',
                    data: {
                        user: username, 
                        pass: password
                    },
                    cache: false,
                    success: function(message) {
                        if (message == 0)
                            passwordErr.prop('innerHTML', 'User Name or Password does not exist!');
                        else {
                            alert('Login success');
                            window.location.href = 'index.php';
                        }
                    },
                    error: function() {
                        console.log('Error');
                    }
                });
            }
        </script>

        <!-- Function to validate sign up accounts -->
        <script>
            async function validateSignUp() {
                var username = $('#sign-up-username').val();
                var password = $('#sign-up-pw').val();
                var passwordRepeat = $('#sign-up-pw-repeat').val();
                var signUpErr = $('#sign-up-err');
                if (password !== passwordRepeat) {
                    $('#sign-up-err').prop('innerHTML', 'Password and Repeat Password must be same')
                    return;
                }

                await $.ajax({
                    url: 'signup.php',
                    type: 'POST',
                    data: {
                        user: username,
                        pass: password
                    },
                    success: function(message) {
                        console.log(message)
                        if (message == 1)
                            alert('Sign up successfully');
                        else if (message == 2) {
                            $('#sign-up-err').prop('innerHTML', 'User Name is exists');
                            return;
                        } else {
                            alert('Failed to create new account, try again');
                        } 
                    }
                })
            }
        </script>

    </div>
</body>
</html>