<?php
    include '../database.php';
    $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
    $phone = mysqli_real_escape_string($con, $phone);
    $sql = "SELECT * FROM registration_user WHERE `mobile` = '{$phone}'";
    $result = mysqli_query($con, $sql);
    if (!$result) {
        die('Error in SQL query: ' . mysqli_error($con));
    }
    $phoneExists = mysqli_num_rows($result) > 0;
    mysqli_free_result($result);
    mysqli_close($con);
    $response = array(
        'exists' => $phoneExists
    );
    echo json_encode($response);
?>