<?php include 'header/header_startding.php';?>
<div class=" back_container">
   <u> <h2 class="dash_main_heading">Salary</h2></u>
   <div class="containerss">
        <div class="container_1" style="background-color: rgb(189 145 45);">
            <h3 class='fc'>Total number of Records</h3>
            <?php $selectquery="SELECT count(*) as total from salary WHERE `user_id` =".$userData['id']."";                
                $result=mysqli_query($con,$selectquery);
                $data=mysqli_fetch_assoc($result);  ?>
            <h2 class='tt'><?php  echo $data['total']; ?></h2>
        </div>
        <div class="container_1" style="background-color: rgb(45 189 177);">
            <h3 class='fc'>Total Salary Amount</h3>
            <?php $selectquery="SELECT SUM(amount) as total from salary WHERE `user_id` =".$userData['id']."";                
                $result=mysqli_query($con,$selectquery);
                $data=mysqli_fetch_assoc($result);  ?>
            <h2 class='tt'><?php  echo $data['total']; ?></h2>
        </div>
   </div>
</div>
<div class=" back_container">
    <u><h2 class="dash_main_heading">Balance History</h2></u>
    <div class="containerss">
        <div class="container_1" style="background-color: rgb(189 145 45);">
            <h3 class='fc'>Total number of Records</h3>
            <?php $selectquery="SELECT count(*) as total from balance_history WHERE `user_id` =".$userData['id']."";              
                $result=mysqli_query($con,$selectquery);
                $data=mysqli_fetch_assoc($result);  ?>
            <h2 class='tt'><?php  echo $data['total']; ?></h2>
        </div>
        <div class="container_1" style="background-color: rgb(45 149 189);">
            <h3 class='fc'>Total number of Deposit Records</h3>
            <?php $selectquery="SELECT count(*) as total from balance_history WHERE `balance_Status`='Deposit' AND `user_id` =".$userData['id']."";              
                $result=mysqli_query($con,$selectquery);
                $data=mysqli_fetch_assoc($result);  ?>
            <h2 class='tt'><?php  echo $data['total']; ?></h2>
        </div>
        <div class="container_1" style="background-color: rgb(201 198 104);">
            <h3 class='fc'>Total number of Withdrawal Records</h3>
            <?php $selectquery="SELECT count(*) as total from balance_history WHERE `balance_Status`='Withdraw' AND `user_id` =".$userData['id']."";              
                $result=mysqli_query($con,$selectquery);
                $data=mysqli_fetch_assoc($result);  ?>
            <h2 class='tt'><?php  echo $data['total']; ?></h2>
        </div>
        <div class="container_1" style="background-color: rgb(45 189 177);">
            <h3 class='fc'>Total Remaing Balance Amount</h3>
            <?php $query = "SELECT * FROM balance_history WHERE `user_id` = '{$userData['id']}' ORDER BY id DESC LIMIT 1";
			$result_query = mysqli_query($con, $query);
			$total_amounts = mysqli_fetch_array($result_query, MYSQLI_ASSOC);
			$remaing_amount  = !empty($total_amounts['total_amount']) ? $total_amounts['total_amount']:0;  ?>
            <h2 class='tt'><?php  echo $remaing_amount; ?></h2>
        </div>
    </div>
</div>
<?php include 'header/header_ending.php';?>