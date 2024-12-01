<?php
session_start();
$email = $_POST['email'];
$otp = rand(100000, 999999);
$_SESSION['otp'] = $otp;
$_SESSION['otp_email'] = $email;

// $subject = "Your OTP Code";
// $message = "Your OTP code is: $otp";
// $headers = "From: no-reply@example.com";

require_once  '../API/MyMail.php';
$to = $email;
$subject = "Forget Password On Salary Manage Application";
$txt = file_get_contents("../API/otpemailTemplate.php");;
// $headers = $fname.' '.$lname ;
$emailContent = str_replace("{username}", $otp, $txt);
// $emailContent = str_replace("{password}", $psw, $emailContent);
sendEmail($to,$subject,$emailContent,$headers);


if(sendEmail($to,$subject,$emailContent,$headers)) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to send OTP.']);
}
?>
