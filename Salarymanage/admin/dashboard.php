<?php include 'header/header_startding.php';?>
<div class="containerss">
    <div class="container_1">
        <h3 class='fc'>Admin User</h3>
        <?php $selectquery="SELECT count(*) as total from admin_user WHERE role_type='Admin'";                
            $result=mysqli_query($con,$selectquery);
            $data=mysqli_fetch_assoc($result);  ?>
        <h2 class='tt'><?php  echo $data['total']; ?></h2>
    </div>
    <div class="container_1">
        <h3 class='fc'>Balance History</h3>
        <?php $selectquery="SELECT count(*) as total from balance_history ";              
            $result=mysqli_query($con,$selectquery);
            $data=mysqli_fetch_assoc($result);  ?>
        <h2 class='tt'><?php  echo $data['total']; ?></h2>
    </div>
    <div class="container_1">
        <h3 class='fc'>Register Users</h3>
        <?php $selectquery="SELECT count(*) as total from registration_user ";                
            $result=mysqli_query($con,$selectquery);
            $data=mysqli_fetch_assoc($result);  ?>
        <h2 class='tt'><?php  echo $data['total']; ?></h2>
    </div>
    <div class="container_1">
        <h3 class='fc'>Salary</h3>
        <?php $selectquery="SELECT count(*) as total from salary ";                
            $result=mysqli_query($con,$selectquery);
            $data=mysqli_fetch_assoc($result);  ?>
        <h2 class='tt'><?php  echo $data['total']; ?></h2>
    </div>
    <div class="container_1">
        <h3 class='fc'>Total Balance</h3>
        <?php $selectquery="SELECT count(*) as total from total_balance ";                
            $result=mysqli_query($con,$selectquery);
            $data=mysqli_fetch_assoc($result);  ?>
        <h2 class='tt'><?php  echo $data['total']; ?></h2>
    </div>
</div>
<?php include 'header/header_ending.php';?>
                
