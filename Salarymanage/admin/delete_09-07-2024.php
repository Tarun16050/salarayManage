<?php
include("../database.php");
    if($_POST['urlname'] == 'salaryDetails'){
        $x = $_POST["id"];
        $status_update_query = "DELETE FROM `salary` WHERE `id`=$x";
        $status_update_query_run = mysqli_query($con, $status_update_query);
        if ($status_update_query_run) {
            echo "Delete successful";
        } else {
            echo "Delete failed";
        }
        mysqli_close($con);
    }
    else{
        $x = $_POST["id"];
        $status_update_query = "DELETE FROM `admin_user` WHERE `id`=$x";
        $status_update_query_run = mysqli_query($con, $status_update_query);
        if ($status_update_query_run) {
            echo "Delete successful";
        } else {
            echo "Delete failed";
        }
        mysqli_close($con); 
    }
?>
