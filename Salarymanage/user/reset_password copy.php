<?php
session_start();
require_once dirname(__FILE__).'/database.php';

$email = $_SESSION['otp_email'];
if(empty($email)){
    header('Location: index.php');
}

$query = "SELECT * FROM `registration_user` WHERE `email`='$email'";
$result = mysqli_query($con, $query);
$rows = mysqli_num_rows($result);
if ($rows == 1) { 
    $fetch_data = mysqli_fetch_assoc($result); 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SalaryManage - Forget Password</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
        .input-group {
            position: relative;
        }
        .eye-icon {
            position: absolute;
            right: 15px;
            top: 12px;
            cursor: pointer;
        }
    </style>
</head>
<body>
<div class="container login-container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="login-card">
                <h3 class="text-center form-title">Change Password</h3>
                <h5 class="text-center"><?php echo $fetch_data['Fname'].' '.$fetch_data['Lname']; ?></h5>
                <form id="reset-form" method="POST">
                    <p class="error-data text-danger" id="error_login"></p>
                    
                    <div class="form-group input-group">
                        <input type="password" class="form-control" name="password" id="password" placeholder="New Password" required autocomplete="off">
                        <span class="eye-icon" id="togglePassword" onclick="togglePasswordVisibility('password')">👁️</span>
                    </div>
                    <div class="form-group input-group">
                        <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Confirm Password" required autocomplete="off">
                        <span class="eye-icon" id="toggleConfirmPassword" onclick="togglePasswordVisibility('confirm_password')">👁️</span>
                    </div>

                    <input type="button" class="btn btn-success btn-block" id="reset-password" value="Reset Password">
                </form>
                <div class="text-center mt-3">
                    <p><a href="index.php">Can't reset your password?</a></p>
                    <p>OR</p>
                    <p>Don't have an account? <a href="signup.php">Sign up</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function togglePasswordVisibility(id) {
    const input = document.getElementById(id);
    const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
    input.setAttribute('type', type);
}

$(document).ready(function() {
    $('#reset-password').click(function() {
        const password = $('#password').val();
        const confirmPassword = $('#confirm_password').val();
        const passwordPattern = /^(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{6,}$/;

        $('#error_login').text('');

        if (!passwordPattern.test(password)) {
            $('#error_login').text('Password must be at least 6 characters long and include at least one uppercase letter, one number, and one special character.');
            return;
        }

        if (password !== confirmPassword) {
            $('#error_login').text('Passwords do not match.');
            return;
        }

        // AJAX call to save the new password
        $.ajax({
            url: 'save_password.php',
            type: 'POST',
            data: {
                email: '<?php echo $email; ?>',
                password: password
            },
            dataType: 'json',
            success: function(response) {
                if (response.success === 'success') {
                    Swal.fire({
                        title: 'Success!',
                        text: 'Your password has been reset successfully!',
                        icon: 'success',
                        timer: 2000,
                        timerProgressBar: true,
                        willClose: () => {
                            window.location.href = 'index.php'; 
                        }
                    });
                } else {
                    Swal.fire({
                        title: 'Error!',
                        html: 'Your password has not been reset! <br> Please try again!',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            }
        });
    });
});
</script>
</body>
</html>
