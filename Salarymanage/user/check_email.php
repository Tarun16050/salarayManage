<?php
    include '../database.php';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $email = mysqli_real_escape_string($con, $email);
    $sql = "SELECT * FROM registration_user WHERE `email` = '{$email}'";
    $result = mysqli_query($con, $sql);
    if (!$result) {
        die('Error in SQL query: ' . mysqli_error($con));
    }
    $emailExists = mysqli_num_rows($result) > 0;
    mysqli_free_result($result);
    mysqli_close($con);
    $response = array(
        'exists' => $emailExists
    );
    echo json_encode($response);
?>
