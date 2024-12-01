<?php
session_start();
include '../database.php';
if(empty($_SESSION['print_email'])){header("Location: index.php");}else{
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SalaryManager Admin</title>
    <link rel="icon" type="image/x-icon" href="/admin/images/logoapp.png">
</head>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<link rel="stylesheet" href="css/dashboard.css">
<link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>



<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous">
<body class="home">
    <div class="container-fluid display-table">
        <div class="row display-table-row">
            <div class="col-md-2 col-sm-1 hidden-xs display-table-cell v-align box" id="navigation">
                <div class="logo" style="color: white;">                   
                        <img src="images/user_logo.png" alt="user_logo" height="100px" style="width: 21%;">
                        <h4 ><?php echo $_SESSION['print_fname'] ;?>  <?php echo $_SESSION['print_lname'] ;?> </h4>
                        <h4><?php echo $_SESSION['print_email'] ;?></h4>
                    </a>
                </div>
                <div class="navi">
                    <ul>
                        <li class=""><a href="dashboard.php"><i class="fa fa-home" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Dashboard</span></a></li>
                        <li><a href="adminUser.php"><i class="fa fa-user-secret" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Admin User</span></a></li>
                        <li><a href="registration_User.php"><i class="fa fa-user-plus" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Register Users</span></a></li>
                        <li><a href="salary_details.php"><i class="fa fa-user" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Salary Details</span></a></li>
                        <!-- <li><a href="Complaints_list.php"><i class="fa fa-list-alt" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Complaints </span></a></li>                         -->
                    </ul>
                </div>
            </div>
            <div class="col-md-10 col-sm-11 display-table-cell v-align" style="padding-right: 0;">
        
                <div class="row">
                    <header>                       
                        <div class="col-md-12">
                            <div class="pull-right">
                            <a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a>
                            </div>
                        </div>
                    </header>
                </div>
                <div class="user-dashboard">
                 <?php  } ?>