<?php
session_start();
require_once dirname(__FILE__).'/database.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $hashedPassword = md5($password);
    if(!empty($email)){
        $update = "UPDATE `registration_user` SET `password` = '$hashedPassword' WHERE `email` = '$email'";
        $res=mysqli_query($con,$update);
        if ($res) {echo json_encode(['success' => 'success']); } else {echo json_encode(['success' => 'error']);}
    }else{echo json_encode(['success' => 'error']);}
} 
else {
    echo json_encode(['success' => 'error']);
}
?>
