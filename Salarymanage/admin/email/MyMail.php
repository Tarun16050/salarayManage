<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
function sendEmail($to, $subject, $txt, $headers) {
$response = array();
require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPDebug = 1;
$mail->SMTPAuth = true;
$mail->SMTPSecure ="ssl";// "tls";
$mail->Port =465;// 587;
$mail->Host = "smtp.gmail.com";
$mail->Username = "tanupatidar098@gmail.com"; // Your Gmail email address
$mail->Password = trim("teumffnulgzuqmql"); // Your Gmail password

$mail->setFrom("tanupatidar098@gmail.com", "Tarun Patidar");
$mail->addAddress($to, $headers);
// $mail->addReplyTo($to, "Tarun Patidar");
$mail->isHTML(true);
$mail->Subject = $subject;
$mail->Body = $txt;

if ($mail->send()) {
    $response['error']=false;
    $response['message']= "Email Send Successfully";
} else {
    $response['error']=true;
    $response['message']= "Email is not Send Sorry!";
}

}
?>
