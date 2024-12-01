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
    <meta name="google-site-verification" content="FRkYGdhUUI7mpGPUeJuosZh1DrG28wUDn7M7uU7SUis" />
    <title>SalaryManager Admin</title>
    <link rel="icon" type="image/x-icon" href="/admin/images/logoapp.png">
  
</head>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<link rel="stylesheet" href="css/dashboard.css">
<link rel="stylesheet" href="css/sidenavbar.css">
<script src="js/dashboard.js"></script>
<link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>



<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous">
<body class="home">





<div class="wrapper">
  <!-- Sidebar Holder -->
  <nav id="sidebar">
    <div class="sidebar-header">
      <!-- <img src="https://dcdh7ea8gkhvt.cloudfront.net/wp-content/themes/indianic/assets/images/indianic-black-logo.svg"> -->
      <div class="logo" style="color: white;">                   
            <img src="images/user_logo.png" alt="user_logo" height="100px" style="width: 21%;">
            <h4 ><?php echo $_SESSION['print_fname'] ;?>  <?php echo $_SESSION['print_lname'] ;?> </h4>
            <h6><?php echo $_SESSION['print_email'] ;?></h6>
        </a>
    </div>
    </div>

        <ul class="list-unstyled components" style="color: white;">
            <li><a href="dashboard.php"><i class="fa fa-home" aria-hidden="true"></i><span class="hidden-xs hidden-sm"></span> &nbsp;&nbsp; Dashboard</a></li>
            <li><a href="adminUser.php"><i class="fa fa-user-secret" aria-hidden="true"></i><span class="hidden-xs hidden-sm"></span> &nbsp;&nbsp; Admin User</a></li>
            <li><a href="registration_User.php"><i class="fa fa-user-plus" aria-hidden="true"></i><span class="hidden-xs hidden-sm"></span> &nbsp;&nbsp; Register Users</a></li>
            <li><a href="list_salary_details.php"><i class="fa fa-user" aria-hidden="true"></i><span class="hidden-xs hidden-sm"> </span> &nbsp;&nbsp; Salary Details</a></li>
            <li><a href="list_transaction_history.php"><i class="fa fa-history" aria-hidden="true"></i><span class="hidden-xs hidden-sm">&nbsp;&nbsp; </span>&nbsp;&nbsp;  Transaction History </a></li>
            <li><a href="list_notes.php"><i class="fa fa-sticky-note" aria-hidden="true"></i><span class="hidden-xs hidden-sm">&nbsp;&nbsp; </span>&nbsp;&nbsp;  Notes </a></li>
            <!-- <li><a href="Complaints_list.php"><i class="fa fa-list-alt" aria-hidden="true"></i><span class="hidden-xs hidden-sm">Complaints </span></a></li>                         -->
        </ul>
  </nav>

  <!-- Page Content Holder -->
  <div id="content">

    <header class="py-3 mb-3 border-bottom">
      <div class="container-fluid d-grid gap-3 align-items-center" style="grid-template-columns: 1fr 2fr;">
        <button type="button" id="sidebarCollapse" class="navbar-btn">
          <span></span>
          <span></span>
          <span></span>
        </button>

        <button type="button" id="sidebarCollapselogout" class="navbar-btn pull-right" title="Log Out" style="margin-right:10px">
         <a href="logout.php"><span class="glyphicon glyphicon-log-in"></span></a>
        </button>
        <!-- <div class="d-flex align-items-center">       
          <div class="flex-shrink-0 dropdown onhover-dropdown">
            <div class="pull-right ">
                <a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a>
            </div>
          </div>
        </div> -->
      </div>
    </header>

    <div class="container demo">

      


    <!-- </div>
  </div>
</div> -->


<?php  } ?>