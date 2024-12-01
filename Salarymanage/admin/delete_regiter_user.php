<?php
include("../database.php");  
    $x = $_POST["id"];
    $status_update_query = "DELETE FROM `registration_user` WHERE `id`=$x";
    $status_update_query_run = mysqli_query($con, $status_update_query);
    if ($status_update_query_run) {
        echo "Delete successful"; // Send a response back to the JavaScript function
    } else {
        echo "Delete failed";
    }
    mysqli_close($con);
?>
