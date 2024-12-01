<?php
session_start(); // Start the session to access stored OTP

// Get the OTP from the request
$otp = $_POST['otp'];

// Check if the OTP is set in the session
if (isset($_SESSION['otp']) && isset($_SESSION['otp_email'])) {
    // Validate the OTP
    if ($otp == $_SESSION['otp']) {
        // OTP is valid
        echo json_encode(['valid' => true]);
    } else {
        // OTP is invalid
        echo json_encode(['valid' => false]);
    }
} else {
    // OTP was not set, which could indicate a problem
    echo json_encode(['valid' => false, 'message' => 'Session expired or OTP not set.']);
}
?>
