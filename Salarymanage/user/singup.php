<?php
session_start();
require_once dirname(__FILE__) . '/database.php';

$errors = [];
$formData = [
    'fname' => '',
    'lname' => '',
    'email' => '',
    'mobile' => '',
    'psw' => '',
    'cpsw' => ''
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $formData = [
        'fname' => isset($_POST['fname']) ? trim($_POST['fname']) : '',
        'lname' => isset($_POST['lname']) ? trim($_POST['lname']) : '',
        'email' => isset($_POST['email']) ? trim($_POST['email']) : '',
        'mobile' => isset($_POST['mobile']) ? trim($_POST['mobile']) : '',
        'psw' => isset($_POST['psw']) ? trim($_POST['psw']) : '',
        'cpsw' => isset($_POST['cpsw']) ? trim($_POST['cpsw']) : ''
    ];

    if (empty($formData['fname'])) {
        $errors['fname'] = 'First Name is required.';
    }

    if (empty($formData['lname'])) {
        $errors['lname'] = 'Last Name is required.';
    }

    if (empty($formData['email']) || !filter_var($formData['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'A valid email is required.';
    }

    if (empty($formData['mobile'])) {
        $errors['mobile'] = 'Phone Number is required.';
    }

    if (empty($formData['psw'])) {
        $errors['psw'] = 'Password is required.';
    }

    if ($formData['psw'] !== $formData['cpsw']) {
        $errors['cpsw'] = 'Passwords do not match.';
    }

    if (empty($errors)) {
        $email = mysqli_real_escape_string($con, $formData['email']);
        $mobile = mysqli_real_escape_string($con, $formData['mobile']);

        // Check if email already exists
        $emailQuery = "SELECT * FROM `registration_user` WHERE `email`='$email'";
        $emailResult = mysqli_query($con, $emailQuery);
        if (mysqli_num_rows($emailResult) > 0) {
            $errors['email'] = 'Email already exists.';
        }

        // Check if mobile number already exists
        $mobileQuery = "SELECT * FROM `registration_user` WHERE `mobile`='$mobile'";
        $mobileResult = mysqli_query($con, $mobileQuery);
        if (mysqli_num_rows($mobileResult) > 0) {
            $errors['mobile'] = 'Mobile number already exists.';
        }

        if (empty($errors)) {
            $password = mysqli_real_escape_string($con, md5($formData['psw']));
            $insertQuery = "INSERT INTO `registration_user` (`fname`, `lname`, `email`, `mobile`, `password`) 
                            VALUES ('{$formData['fname']}', '{$formData['lname']}', '$email', '$mobile', '$password')";

            if (mysqli_query($con, $insertQuery)) {
                header("Location: /Salarymanage/user/index.php");
                exit();
            } else {
                $errors['database'] = 'Failed to insert data. Please try again later.';
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Salary Manage">
    <meta name="keywords" content="how to salary manage in india 2024">
    <meta name="description" content="If you want to manage your salary and salary-related data you can Here manage the data simply way.">
    <meta name="google-site-verification" content="FRkYGdhUUI7mpGPUeJuosZh1DrG28wUDn7M7uU7SUis" />
    <link rel="stylesheet" href="/Salarymanage/user/css/login.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>User Registration</title>
</head>
<body>
<div class="login_form">
    <form action="singup.php" class="form" method="post" enctype="multipart/form-data" id="admin_form">
        <h3 class="form_title">Welcome to Salary Manage</h3>
        <h3 class="form_title">User Registration</h3>
        <p id="errors_first_name" class="field_erros"><?= isset($errors['fname']) ? $errors['fname'] : ''; ?></p>
        <div class="form_div">
            <input type="text" placeholder="" name="fname" id="first_name" class="form_input" value="<?= htmlspecialchars($formData['fname']); ?>">
            <label class="form_label">First Name</label>
        </div>
        <p id="errors_last_name" class="field_erros"><?= isset($errors['lname']) ? $errors['lname'] : ''; ?></p>
        <div class="form_div">
            <input type="text" placeholder="" name="lname" id="last_name" class="form_input" value="<?= htmlspecialchars($formData['lname']); ?>">
            <label class="form_label">Last Name</label>
        </div>
        <p id="errors_email" class="field_erros"><?= isset($errors['email']) ? $errors['email'] : ''; ?></p>
        <div class="form_div">
            <input type="text" placeholder="" class="form_input" name="email" id="email" value="<?= htmlspecialchars($formData['email']); ?>">
            <label class="form_label">Email</label>
        </div>
        <p id="errors_phone" class="field_erros"><?= isset($errors['mobile']) ? $errors['mobile'] : ''; ?></p>
        <div class="form_div">
            <input type="tel" placeholder="" name="mobile" id="phone" class="form_input" value="<?= htmlspecialchars($formData['mobile']); ?>">
            <label class="form_label">Phone Number</label>
        </div>
        <p id="errors_password" class="field_erros"><?= isset($errors['psw']) ? $errors['psw'] : ''; ?></p>
        <div class="form_div">
            <input type="password" placeholder="" name="psw" id="password" class="form_input">
            <label class="form_label">Password</label>
        </div>
        <p id="errors_confirm_password" class="field_erros"><?= isset($errors['cpsw']) ? $errors['cpsw'] : ''; ?></p>
        <div class="form_div">
            <input type="password" placeholder="" name="cpsw" id="confirm_password" class="form_input">
            <label class="form_label">Confirm Password</label>
        </div>
        <input type="submit" class="form_button_singup" value="Sign Up" name="submit">
        <p>Have an account? <a href="index.php"><span style="color: blue;">Log in</span></a></p>
    </form>
    <p id="error_login_message" class="field_erros"><?= isset($errors['login']) ? $errors['login'] : ''; ?></p>
</div>

<script src="/Salarymanage/user/js/signup.js"></script>
</body>
</html>
