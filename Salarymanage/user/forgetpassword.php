<?php require_once dirname(__FILE__).'/database.php'; ?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SalaryManage - Forget Password</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .login-container {
            margin-top: 100px;
        }
        .login-card {
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            background-color: white;
        }
        .form-title {
            margin-bottom: 20px;
            font-size: 1.5rem;
            color: #333;
        }
        .error-data {
            margin-top: 10px;
        }
        .otp-section {
            display: none; /* Initially hide OTP fields */
        }
    </style>
</head>
<body>
<div class="container login-container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="login-card">
                <h3 class="text-center form-title">Forget Password</h3>
                <form id="reset-form" method="POST">
                    <p class="error-data text-danger" id="error_login"></p>
                    
                    <div class="form-group">
                        <input type="email" class="form-control" name="email" id="email" placeholder="Email" required autocomplete="off">
                    </div>

                    <button type="button" id="generate-otp" class="btn btn-primary ">Send OTP</button>

                    <div class="otp-section">
                        <div class="form-group mt-3">
                            <input type="text" class="form-control" name="otp" id="otp" placeholder="Enter OTP" required autocomplete="off">
                        </div>
                        <input type="button" class="btn btn-success btn-block" id="reset-password" value="Reset Password">
                    </div>
                </form>
                <div class="text-center mt-3">
                    <p><a href="index.php">Can't reset your password?</a></p>
                    <p>OR</p>
                    <p>Don't have an account? <a href="singup.php">Sign up</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#generate-otp').click(function() {
        let email = $('#email').val();
        $('#error_login').text(''); // Clear previous error message

        // Validate email format
        if (!validateEmail(email)) {
            $('#error_login').text('Please enter a valid email address.');
            return;
        }

        // AJAX call to check if email exists
        $.ajax({
            url: 'check_forget_email.php', // Create this file to check email existence
            method: 'POST',
            data: { email: email },
            dataType: 'json',
            success: function(response) {
                if (response.exists) {
                    $('#error_login').text('');
                    $('.otp-section').show();
                    // Simulate sending OTP
                    $.ajax({
                        url: 'send_otp.php', // Create this file to send OTP
                        method: 'POST',
                        data: { email: email },
                        dataType: 'json',
                        success: function() {
                        }
                    });
                } else {
                    $('#error_login').text('Email does not exist.');
                }
            },
            error: function() {
                $('#error_login').text('An error occurred while checking the email.');
            }
        });
    });

    $('#reset-password').click(function() {
        let otp = $('#otp').val();
        $('#error_login').text(''); 
        $.ajax({
            url: 'validate_otp.php', 
            method: 'POST',
            data: { otp: otp },
            dataType: 'json',
            success: function(response) {
                if (response.valid) {
                    window.location.href = 'reset_password.php';
                } else {
                    $('#error_login').text('Invalid OTP. Please try again.');
                }
            },
            error: function() {
                $('#error_login').text('An error occurred while validating the OTP.');
            }
        });
    });

    function validateEmail(email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(String(email).toLowerCase());
    }
});
</script>
<?php

?>
</body>
</html>
