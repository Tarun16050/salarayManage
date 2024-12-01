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
    elseif($_POST['urlname'] == 'registration_user_Details'){
        $x = $_POST["id"];
        $status_update_query = "DELETE FROM `registration_user` WHERE `id`=$x";
        $status_update_query_run = mysqli_query($con, $status_update_query);
        if ($status_update_query_run) {
            echo "Delete successful";
        } else {
            echo "Delete failed";
        }
        mysqli_close($con);
    }
    elseif($_POST['urlname'] == 'transactionHistory'){
        $x = $_POST["id"];
        $status_update_query = "DELETE FROM `balance_history` WHERE `id`=$x";
        $status_update_query_run = mysqli_query($con, $status_update_query);
        if ($status_update_query_run) {
            echo "Delete successful";
        } else {
            echo "Delete failed";
        }
        mysqli_close($con);
    }
    elseif($_POST['urlname'] == 'notesdelete'){
        $x = $_POST["id"];
        $status_update_query = "DELETE FROM `notes` WHERE `id`=$x";
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
