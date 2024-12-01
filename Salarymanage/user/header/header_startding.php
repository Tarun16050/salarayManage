<?php
session_start();
include '../database.php';
if(empty($_SESSION['loginData'])){header("Location: index.php");}else{$userData = $_SESSION['loginData'];
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SalaryManager User</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous">
    <link rel="icon" type="image/x-icon" href="/user/images/logoapp.png">
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="css/sidenavbar.css">
    <link rel="stylesheet" href="../user/css/allCommon.css">
    <script src="js/dashboard.js"></script>
  </head>
  <body class="home">
    <div class="wrapper">
      <nav id="sidebar">
        <div class="sidebar-header">
          <div class="logo" style="color: white;">                   
              <!-- <img src="images/user_logo.png" alt="user_logo" height="100px" style="width: 21%;"> -->
              <?php 
              if(!empty($userData['image_path'])){
              $image_path = "../API/uploads/" . $userData['image_path'];
              if (file_exists($image_path)) { ?>
                <img class="image_showing_list" src="../API/uploads/<?php echo $userData['image_path']?> " alt="image not found " width="200" height="200">
              <?php }else{?> 
                <img class="image_showing_list" src="../API/uploads/default_image.jpg" alt="image not found " width="200" height="200">
              <?php }}else{ ?><img class="image_showing_list" src="../API/uploads/default_image.jpg" alt="image not found " width="200" height="200"> <?php } ?>
              
              <h4 ><?php echo $userData['Fname'] ;?>  <?php echo $userData['Lname'] ;?> </h4>
              <h6><?php echo $userData['email'] ;?></h6>
          </div>
          <div class="edituserprofile"><a class="Profilelink" href="editProfile.php">Profile</a> | <a class="logoutlink"  href="logout.php">LogOut</a></div>
        </div>
        <ul class="list-unstyled components" style="color: white;">
            <li><a href="dashboard.php"><i class="fa fa-home" aria-hidden="true"></i><span class="hidden-xs hidden-sm"></span> &nbsp;&nbsp; Dashboard</a></li>
            <li><a href="list_salary_details.php"><i class="fa fa-user" aria-hidden="true"></i><span class="hidden-xs hidden-sm"> </span> &nbsp;&nbsp; Salary Details</a></li>
            <li><a href="list_transaction_history.php"><i class="fa fa-history" aria-hidden="true"></i><span class="hidden-xs hidden-sm">&nbsp;&nbsp; </span>&nbsp;&nbsp;  Transaction History </a></li>
            <li><a href="list_notes.php"><i class="fa fa-sticky-note" aria-hidden="true"></i><span class="hidden-xs hidden-sm">&nbsp;&nbsp; </span>&nbsp;&nbsp;  Notes </a></li>
        </ul>
      </nav>
      <div id="content">
        <header class="py-3 mb-3 border-bottom">
          <div class="container-fluid d-grid gap-3 align-items-center" style="grid-template-columns: 1fr 2fr;">
            <button type="button" id="sidebarCollapse" class="navbar-btn">
              <span></span>
              <span></span>
              <span></span>
            </button>
            <!-- <img src="/user/images/logo.png" alt="welcomeLogo" style=" height: 54px; position: absolute;"> -->
            <img src="/Salarymanage/user/images/png_logo_with_welcome.png" alt="welcomeLogo" style=" height: 54px; position: absolute;">
            <!-- <button type="button" id="sidebarCollapselogout" class="navbar-btn pull-right" title="Log Out" style="margin-right:10px">
              <a href="logout.php"><span class="glyphicon glyphicon-log-in"></span></a>
            </button> -->
          </div>
        </header>
        <div class="container demo">
<?php  } ?>