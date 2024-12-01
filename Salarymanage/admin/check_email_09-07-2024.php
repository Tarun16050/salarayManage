<?php
    include '../database.php';

    $email = $_POST['email'];
    $email = mysqli_real_escape_string($con, $email);
    $sql = "SELECT * FROM registration_user WHERE `email` = '{$email}'";
    $result = mysqli_query($con, $sql);
    if (!$result) { 
        die('Error in SQL query: ' . mysqli_error($con));
    }
    $user_data = mysqli_fetch_array($result, MYSQLI_ASSOC);
    if ($user_data) {
        $response = array('success' => true, 'data' => $user_data);
    } else {
        $response = array('success' => false, 'message' => 'No user found with that email address.');
    }
    // print_r($user_data);
    $data = mysqli_free_result($result);
    mysqli_close($con);

    header('Content-Type: application/json');
    echo json_encode($response);
?>
