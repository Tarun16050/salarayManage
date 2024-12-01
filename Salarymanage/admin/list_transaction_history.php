<?php include 'header/header_startding.php';?> 
<link rel="stylesheet" href="../admin/css/allCommon.css">
<ul class="nav nav-tabs ">
    <li class="nav-item">
      <a class="nav-link active" href="#" id="salary_tab">All Transaction History</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#" id="year_salary_total_tab">Deposit  </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#" id="salary_total_tab">withdrawal</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#" id="deposite_total_tab">Total Deposit  </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#" id="withdrawal_total_tab">Total withdrawal  </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#" id="deposite_yearly_tab">Yearly Deposit  </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#" id="withdrawal_yearly_tab">Yearly withdrawal  </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#" id="deposite_monthly_tab">Monthly Deposit  </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#" id="withdrawal_monthly_tab">Monthly withdrawal  </a>
    </li>
</ul>
<div class="table_data_print tab-content " id="salary" >
    <div class="panel panel-primary">
        <div class="panel-heading">All Transaction List
            <a href="add_transaction_history.php?status=withdrawal"class='btn btn-primary pull-right' style="background-color: #428bca; padding-top: 0%;">Withdrawal From</a>
            <a href="add_transaction_history.php?status=deposit"class='btn btn-primary pull-right' style="background-color: #428bca; padding-top: 0%;">Deposit From</a>
        </div>
        <div class="panel-body table-responsive">
            <table class="table table-hover" id="table_registration_User">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>User Name</th>
                        <th>User Email</th>
                        <th>Status</th>
                        <th>Deposite/withdrawal Amount</th>
                        <th>Total Amount </th>
                        <th>Description</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php               
            // $sql="SELECT * FROM `balance_history`";
            $sql = "SELECT balance_history.*, registration_user.Fname, registration_user.Lname, registration_user.email FROM balance_history LEFT JOIN registration_user ON balance_history.user_id = registration_user.id ORDER BY balance_history.id DESC";
            $querry= mysqli_query($con,$sql);
            $row=mysqli_num_rows($querry);
            if( $row)
            {
              $s_no=0;
              while($res=mysqli_fetch_array($querry))
              {
                $s_no++;
                ?>
                  <tr>
                    <td><?php  echo $s_no  ; ?></td>                    
                    <td><?php  echo $res['Fname'] . ' ' .$res['Lname']; ?></td>
                    <td><?php  echo $res['email']; ?></td>
                    <td><?php  echo $res['balance_Status']; ?></td>   
                    <td><?php  echo ($res['balance_Status'] == 'Deposit') ?  '<span style="color:green; font-weight: bold;">'. $res['amount'].'</span>' : '<span style="color:red; font-weight: bold;">'. $res['amount'].'</span>' ;  ?></td>
                    <td><?php  echo '<span style="color:#0066ff; font-weight: bold;">'. $res['total_amount'] .'</span>'; ?></td>   
                    <td><?php  echo $res['reason']; ?></td>
                    <td><?php  echo $res['date']; ?></td>
                    <td>            
                        <button class="fa fa-edit btn_fa" onclick="checkAccept(<?php  echo $res['id'];   ?>,'transactionHistory')" title="Edit" style="font-size:20px;" >
                        <button class="fa fa-times-circle btn_fa" onclick="checkDelete(<?php  echo $res['id'];  ?>,'transactionHistory')" title="Delete" style="font-size:23px;">
                    </td>
                  </tr>
                <?php
              }
            }
            else{ ?> <h3 style="color: red;"> Register User records are not available </h3> <?php } ?>                     
                </tbody>
            </table>
            
        </div>
    </div>
</div>

<div class="table_data_print tab-content" id="salary_total"  style="display: none;" >
    <div class="panel panel-primary">
        <div class="panel-heading">withdrawal Transaction List
            <a href="add_transaction_history.php?status=withdrawal"class='btn btn-primary pull-right' style="background-color: #428bca; padding-top: 0%;">Withdrawal From</a>
            <a href="add_transaction_history.php?status=deposit"class='btn btn-primary pull-right' style="background-color: #428bca; padding-top: 0%;">Deposit From</a>
        </div>
        <div class="panel-body table-responsive">
            <table class="table table-hover" id="table_registration_User_1">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>User Name</th>
                        <th>User Email</th>
                        <th>Status</th>
                        <th>withdrawal Amount</th>
                        <th>Total Amount </th>
                        <th>Description</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                <?php               
            $sql="SELECT balance_history.*, registration_user.Fname, registration_user.Lname, registration_user.email FROM balance_history LEFT JOIN registration_user ON balance_history.user_id = registration_user.id WHERE balance_history.balance_Status = 'Withdraw' ORDER BY balance_history.id DESC";
            $querry= mysqli_query($con,$sql);
            $row=mysqli_num_rows($querry);
            if( $row)
            {
              $s_no=0;
              while($res=mysqli_fetch_array($querry))
              {
                $s_no++;
                ?>
                  <tr>
                    <td><?php  echo $s_no  ; ?></td>                    
                    <td><?php  echo $res['Fname'] . ' ' .$res['Lname']; ?></td>
                    <td><?php  echo $res['email']; ?></td>
                    <td><?php  echo $res['balance_Status']; ?></td>   
                    <td><?php  echo '<span style="color:#0066ff; font-weight: bold;">'.$res['amount'] .'</span>' ;  ?></td>
                    <td><?php  echo '<span style="color:#a625be; font-weight: bold;">'.$res['total_amount']  .'</span>'; ?></td>   
                    <td><?php  echo $res['reason']; ?></td>
                    <td><?php  echo $res['date']; ?></td>
                  </tr>
                <?php
              }
            }
            else{ ?> <h3 style="color: red;"> Register User records are not available </h3> <?php } ?>                     
                </tbody>
            </table>            
        </div>
    </div>
</div>

<div class="table_data_print tab-content" id="year_salary_total" style="display: none;">
    <div class="panel panel-primary">
        <div class="panel-heading">
            Deposit Transaction List
            <a href="add_transaction_history.php?status=withdrawal"class='btn btn-primary pull-right' style="background-color: #428bca; padding-top: 0%;">Withdrawal From</a>
            <a href="add_transaction_history.php?status=deposit"class='btn btn-primary pull-right' style="background-color: #428bca; padding-top: 0%;">Deposit From</a>
        </div>
        <div class="panel-body table-responsive">
            <table class="table table-hover" id="table_registration_User_2">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>User Name</th>
                        <th>User Email</th>
                        <th>Status</th>
                        <th>Deposite Amount</th>
                        <th>Total Amount </th>
                        <th>Description</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                <?php               
            $sql="SELECT balance_history.*, registration_user.Fname, registration_user.Lname, registration_user.email FROM balance_history LEFT JOIN registration_user ON balance_history.user_id = registration_user.id WHERE balance_history.balance_Status = 'Deposit' ORDER BY balance_history.id DESC";
            $querry= mysqli_query($con,$sql);
            $row=mysqli_num_rows($querry);
            if( $row)
            {
              $s_no=0;
              while($res=mysqli_fetch_array($querry))
              {
                $s_no++;
                ?>
                  <tr>
                    <td><?php  echo $s_no  ; ?></td>                    
                    <td><?php  echo $res['Fname'] . ' ' .$res['Lname']; ?></td>
                    <td><?php  echo $res['email']; ?></td>
                    <td><?php  echo $res['balance_Status']; ?></td>   
                    <td><?php  echo '<span style="color:#0066ff; font-weight: bold;">'.$res['amount'].'</span>' ;  ?></td>
                    <td><?php  echo '<span style="color:#a625be; font-weight: bold;">'.$res['total_amount'],'</span>' ; ?></td>   
                    <td><?php  echo $res['reason']; ?></td>
                    <td><?php  echo $res['date']; ?></td>
                  </tr>
                <?php
              }
            }
            else{ ?> <h3 style="color: red;"> Register User records are not available </h3> <?php } ?>                     
                </tbody>
            </table>
            
        </div>
    </div>
</div>

<div class="table_data_print tab-content" id="deposite_total" style="display: none;">
    <div class="panel panel-primary">
        <div class="panel-heading">
            Total Deposit Transaction List
            <a href="add_transaction_history.php?status=withdrawal"class='btn btn-primary pull-right' style="background-color: #428bca; padding-top: 0%;">Withdrawal From</a>
            <a href="add_transaction_history.php?status=deposit"class='btn btn-primary pull-right' style="background-color: #428bca; padding-top: 0%;">Deposit From</a>
        </div>
        <div class="panel-body table-responsive">
            <table class="table table-hover" id="table_deposite_total">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>User Name</th>
                        <th>User Email</th>
                        <th>Status</th>
                        <th>No. of Total Transaction</th>
                        <th>No of Total Amount </th>
                    </tr>
                </thead>
                <tbody>
                <?php               
            $sql="SELECT balance_history.user_id, registration_user.id,balance_history.balance_Status, COUNT(balance_history.amount) AS count_tran, SUM(balance_history.amount) AS total_amount, registration_user.Fname, registration_user.Lname, registration_user.email FROM balance_history LEFT JOIN registration_user ON balance_history.user_id = registration_user.id WHERE balance_history.balance_Status = 'Deposit' GROUP BY balance_history.user_id, registration_user.Fname, registration_user.Lname, registration_user.email";
            $querry= mysqli_query($con,$sql);
            $row=mysqli_num_rows($querry);
            if( $row)
            {
              $s_no=0;
              while($res=mysqli_fetch_array($querry))
              {
                $s_no++;
                ?>
                  <tr>
                    <td><?php  echo $s_no  ; ?></td>                    
                    <td><?php  echo $res['Fname'] . ' ' .$res['Lname']; ?></td>
                    <td><?php  echo $res['email']; ?></td>
                    <td><?php  echo $res['balance_Status']; ?></td>   
                    <td><?php  echo '<span style="color:crimson; font-weight: bold;">'.$res['count_tran']  .'</span>';  ?></td>
                    <td><?php  echo '<span style="color:#0066ff; font-weight: bold;">'. $res['total_amount'] .'</span>' ; ?></td>
                  </tr>
                <?php
              }
            }
            else{ ?> <h3 style="color: red;"> Register User records are not available </h3> <?php } ?>                     
                </tbody>
            </table>
            
        </div>
    </div>
</div>

<div class="table_data_print tab-content" id="withdrawal_total" style="display: none;">
    <div class="panel panel-primary">
        <div class="panel-heading">
        Total Withdrawal Transaction List
            <a href="add_transaction_history.php?status=withdrawal"class='btn btn-primary pull-right' style="background-color: #428bca; padding-top: 0%;">Withdrawal From</a>
            <a href="add_transaction_history.php?status=deposit"class='btn btn-primary pull-right' style="background-color: #428bca; padding-top: 0%;">Deposit From</a>
        </div>
        <div class="panel-body table-responsive">
            <table class="table table-hover" id="table_withdrawal_total">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>User Name</th>
                        <th>User Email</th>
                        <th>Status</th>
                        <th>No. of Total Transaction</th>
                        <th>No of Total Amount </th>
                    </tr>
                </thead>
                <tbody>
                <?php               
            $sql="SELECT balance_history.user_id, registration_user.id,balance_history.balance_Status, COUNT(balance_history.amount) AS count_transaction, SUM(balance_history.amount) AS total_amount, registration_user.Fname, registration_user.Lname, registration_user.email FROM balance_history LEFT JOIN registration_user ON balance_history.user_id = registration_user.id WHERE balance_history.balance_Status = 'Withdraw' GROUP BY balance_history.user_id, registration_user.Fname, registration_user.Lname, registration_user.email";
            $querry= mysqli_query($con,$sql);
            $row=mysqli_num_rows($querry);
            if( $row)
            {
              $s_no=0;
              while($res=mysqli_fetch_array($querry))
              {
                $s_no++;
                ?>
                  <tr>
                    <td><?php  echo $s_no  ; ?></td>                    
                    <td><?php  echo $res['Fname'] . ' ' .$res['Lname']; ?></td>
                    <td><?php  echo $res['email']; ?></td>
                    <td><?php  echo $res['balance_Status']; ?></td>   
                    <td><?php  echo '<span style="color:crimson; font-weight: bold;">'.$res['count_transaction'].'</span>' ;  ?></td>
                    <td><?php  echo '<span style="color:#0066ff; font-weight: bold;">'. $res['total_amount'] .'</span>' ; ?></td>
                  </tr>
                <?php
              }
            }
            else{ ?> <h3 style="color: red;"> Register User records are not available </h3> <?php } ?>                     
                </tbody>
            </table>
            
        </div>
    </div>
</div>

<div class="table_data_print tab-content" id="deposite_yearly" style="display: none;">
    <div class="panel panel-primary">
        <div class="panel-heading">
            Yearly Deposit Transaction List
            <a href="add_transaction_history.php?status=withdrawal"class='btn btn-primary pull-right' style="background-color: #428bca; padding-top: 0%;">Withdrawal From</a>
            <a href="add_transaction_history.php?status=deposit"class='btn btn-primary pull-right' style="background-color: #428bca; padding-top: 0%;">Deposit From</a>
        </div>
        <div class="panel-body table-responsive">
            <table class="table table-hover" id="table_deposite_yearly">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>User Name</th>
                        <th>User Email</th>
                        <th>Status</th>
                        <th>Year</th>
                        <th>No. of Total Transaction</th>
                        <th>No of Total Amount </th>
                    </tr>
                </thead>
                <tbody>
                <?php               
            $sql="SELECT balance_history.user_id, registration_user.id,balance_history.balance_Status, YEAR(balance_history.date) AS deposit_year, COUNT(balance_history.amount) AS count_transaction, SUM(balance_history.amount) AS total_amount, registration_user.Fname, registration_user.Lname, registration_user.email FROM balance_history LEFT JOIN registration_user ON balance_history.user_id = registration_user.id WHERE balance_history.balance_Status = 'Deposit' GROUP BY balance_history.user_id, deposit_year, registration_user.Fname, registration_user.Lname, registration_user.email ORDER BY deposit_year DESC, balance_history.id DESC";
            $querry= mysqli_query($con,$sql);
            $row=mysqli_num_rows($querry);
            if( $row)
            {
              $s_no=0;
              while($res=mysqli_fetch_array($querry))
              {
                $s_no++;
                ?>
                  <tr>
                    <td><?php  echo $s_no  ; ?></td>                    
                    <td><?php  echo $res['Fname'] . ' ' .$res['Lname']; ?></td>
                    <td><?php  echo $res['email']; ?></td>
                    <td><?php  echo $res['balance_Status']; ?></td>   
                    <td><?php  echo '<span style="color:black; font-weight: bold;">'.$res['deposit_year'].'</span>' ;  ?></td>
                    <td><?php  echo '<span style="color:crimson; font-weight: bold;">'.$res['count_transaction'].'</span>' ; ?></td>   
                    <td><?php  echo '<span style="color:#0066ff; font-weight: bold;">'. $res['total_amount'] .'</span>' ?></td>
                  </tr>
                <?php
              }
            }
            else{ ?> <h3 style="color: red;"> Register User records are not available </h3> <?php } ?>                     
                </tbody>
            </table>
            
        </div>
    </div>
</div>

<div class="table_data_print tab-content" id="withdrawal_yearly" style="display: none;">
    <div class="panel panel-primary">
        <div class="panel-heading">
            Yearly Withdrawal Transaction List
            <a href="add_transaction_history.php?status=withdrawal"class='btn btn-primary pull-right' style="background-color: #428bca; padding-top: 0%;">Withdrawal From</a>
            <a href="add_transaction_history.php?status=deposit"class='btn btn-primary pull-right' style="background-color: #428bca; padding-top: 0%;">Deposit From</a>
        </div>
        <div class="panel-body table-responsive">
            <table class="table table-hover" id="table_withdrawal_yearly">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>User Name</th>
                        <th>User Email</th>
                        <th>Status</th>
                        <th>Year</th>
                        <th>No. of Total Transaction</th>
                        <th>No of Total Amount </th>
                    </tr>
                </thead>
                <tbody>
                <?php               
            $sql="SELECT balance_history.user_id, registration_user.id, balance_history.balance_Status, YEAR(balance_history.date) AS withdraw_year, COUNT(balance_history.amount) AS count_transaction, SUM(balance_history.amount) AS total_amount, registration_user.Fname, registration_user.Lname, registration_user.email FROM balance_history LEFT JOIN registration_user ON balance_history.user_id = registration_user.id WHERE balance_history.balance_Status = 'Withdraw' GROUP BY balance_history.user_id, withdraw_year, registration_user.Fname, registration_user.Lname, registration_user.email ORDER BY withdraw_year DESC, balance_history.id DESC";
            $querry= mysqli_query($con,$sql);
            $row=mysqli_num_rows($querry);
            if( $row)
            {
              $s_no=0;
              while($res=mysqli_fetch_array($querry))
              {
                $s_no++;
                ?>
                  <tr>
                    <td><?php  echo $s_no  ; ?></td>                    
                    <td><?php  echo $res['Fname'] . ' ' .$res['Lname']; ?></td>
                    <td><?php  echo $res['email']; ?></td>
                    <td><?php  echo $res['balance_Status']; ?></td>   
                    <td><?php  echo '<span style="color:black; font-weight: bold;">'.$res['withdraw_year'].'</span>' ;  ?></td>
                    <td><?php  echo '<span style="color:crimson; font-weight: bold;">'.$res['count_transaction'].'</span>' ; ?></td>   
                    <td><?php  echo '<span style="color:#0066ff; font-weight: bold;">'. $res['total_amount'] .'</span>' ?></td>
                  </tr>
                <?php
              }
            }
            else{ ?> <h3 style="color: red;"> Register User records are not available </h3> <?php } ?>                     
                </tbody>
            </table>
            
        </div>
    </div>
</div>

<div class="table_data_print tab-content" id="deposite_monthly" style="display: none;">
    <div class="panel panel-primary">
        <div class="panel-heading">
            Monthly Deposit Transaction List
            <a href="add_transaction_history.php?status=withdrawal"class='btn btn-primary pull-right' style="background-color: #428bca; padding-top: 0%;">Withdrawal From</a>
            <a href="add_transaction_history.php?status=deposit"class='btn btn-primary pull-right' style="background-color: #428bca; padding-top: 0%;">Deposit From</a>
        </div>
        <div class="panel-body table-responsive">
            <table class="table table-hover" id="table_deposite_monthly">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>User Name</th>
                        <th>User Email</th>
                        <th>Status</th>
                        <th>Month</th>
                        <th>Year</th>
                        <th>No. of Total Transaction</th>
                        <th>No of Total Amount </th>
                    </tr>
                </thead>
                <tbody>
                <?php               
            $sql="SELECT balance_history.user_id,balance_history.balance_Status, YEAR(balance_history.date) AS deposit_year, MONTH(balance_history.date) AS deposit_month, COUNT(balance_history.amount) AS count_transaction, SUM(balance_history.amount) AS total_amount, registration_user.Fname, registration_user.Lname, registration_user.email FROM balance_history LEFT JOIN registration_user ON balance_history.user_id = registration_user.id WHERE balance_history.balance_Status = 'Deposit' GROUP BY balance_history.user_id, deposit_year, deposit_month, registration_user.Fname, registration_user.Lname, registration_user.email ORDER BY deposit_year DESC, deposit_month DESC";
            $querry= mysqli_query($con,$sql);
            $row=mysqli_num_rows($querry);
            if( $row)
            {
              $s_no=0;
              while($res=mysqli_fetch_array($querry))
              {
                $s_no++;
                ?>
                    <tr>
                        <td><?php  echo $s_no  ; ?></td>                    
                        <td><?php  echo $res['Fname'] . ' ' .$res['Lname']; ?></td>
                        <td><?php  echo $res['email']; ?></td>
                        <td><?php  echo $res['balance_Status']; ?></td>   
                        <!-- <td><?php  echo $res['deposit_month'] ;  ?></td> -->
                        <td><?php  echo '<span style="color:#1454ed; font-weight: bold;">'.date("F", mktime(0, 0, 0, $res['deposit_month'], 1)) .'</span>';  ?></td>
                        <td><?php  echo '<span style="color:black; font-weight: bold;">'.$res['deposit_year']   .'</span>' ;?></td>
                        <td><?php  echo '<span style="color:crimson; font-weight: bold;">'.$res['count_transaction']  .'</span>' ;?></td>
                        <td><?php  echo '<span style="color:#0066ff; font-weight: bold;">'. $res['total_amount'] .'</span>' ?></td>
                    </tr>
                <?php
              }
            }
            else{ ?> <h3 style="color: red;"> Register User records are not available </h3> <?php } ?>                     
                </tbody>
            </table>
            
        </div>
    </div>
</div>

<div class="table_data_print tab-content" id="withdrawal_monthly" style="display: none;">
    <div class="panel panel-primary">
        <div class="panel-heading">
            Monthly Withdrawal Transaction List
            <a href="add_transaction_history.php?status=withdrawal"class='btn btn-primary pull-right' style="background-color: #428bca; padding-top: 0%;">Withdrawal From</a>
            <a href="add_transaction_history.php?status=deposit"class='btn btn-primary pull-right' style="background-color: #428bca; padding-top: 0%;">Deposit From</a>
        </div>
        <div class="panel-body table-responsive">
            <table class="table table-hover" id="table_withdrawal_monthly">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>User Name</th>
                        <th>User Email</th>
                        <th>Status</th>
                        <th>Month</th>
                        <th>Year</th>
                        <th>No. of Total Transaction</th>
                        <th>No of Total Amount </th>
                    </tr>
                </thead>
                <tbody>
                <?php               
            $sql="SELECT balance_history.user_id, YEAR(balance_history.date) AS withdraw_year, MONTH(balance_history.date) AS withdraw_month, balance_history.balance_Status, COUNT(balance_history.amount) AS count_transaction, SUM(balance_history.amount) AS total_amount, registration_user.Fname, registration_user.Lname, registration_user.email FROM balance_history LEFT JOIN registration_user ON balance_history.user_id = registration_user.id WHERE balance_history.balance_Status = 'Withdraw' GROUP BY balance_history.user_id, withdraw_year, withdraw_month, registration_user.Fname, registration_user.Lname, registration_user.email ORDER BY withdraw_year DESC, withdraw_month DESC";
            $querry= mysqli_query($con,$sql);
            $row=mysqli_num_rows($querry);
            if( $row)
            {
              $s_no=0;
              while($res=mysqli_fetch_array($querry))
              {
                $s_no++;
                ?>
                    <tr>
                        <td><?php  echo $s_no  ; ?></td>                    
                        <td><?php  echo $res['Fname'] . ' ' .$res['Lname']; ?></td>
                        <td><?php  echo $res['email']; ?></td>
                        <td><?php  echo $res['balance_Status']; ?></td>   
                        <!-- <td><?php  echo $res['withdraw_month'] ;  ?></td> -->
                        <td><?php  echo '<span style="color:#1454ed; font-weight: bold;">'.date("F", mktime(0, 0, 0, $res['withdraw_month'], 1)) .'</span>';  ?></td>
                        <td><?php  echo '<span style="color:black; font-weight: bold;">'.$res['withdraw_year']   .'</span>' ;?></td>
                        <td><?php  echo '<span style="color:crimson; font-weight: bold;">'.$res['count_transaction']  .'</span>' ;?></td>   
                        <td><?php  echo '<span style="color:#0066ff; font-weight: bold;">'. $res['total_amount'] .'</span>'; ?></td>
                    </tr>
                <?php
              }
            }
            else{ ?> <h3 style="color: red;"> Register User records are not available </h3> <?php } ?>                     
                </tbody>
            </table>
            
        </div>
    </div>
</div>


<?php include 'header/header_ending.php';?>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script type="text/javascript">
  function checkDelete(x,name){
    var y = confirm('Are you sure Delete the recoard ?');
    if(y){
      var xhr = new XMLHttpRequest();
      xhr.open("POST", "delete.php", true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      xhr.onreadystatechange = function() {
        if (xhr.readyState === 4) {
          if (xhr.status === 200) {
            Swal.fire({
              icon: 'success',
              title: 'Successfully Deleted',
              showConfirmButton: false,
              timer: 1500
            }).then(function() {
              window.location.href = "list_transaction_history.php";
            });
          } else {
            console.log("Error Deleting status");
          }
        }
      };
      var params = "id=" + encodeURIComponent(x) + "&urlname=" + encodeURIComponent(name);
    xhr.send(params);
    }
  }
  function checkAccept(x,urlname){
    var y = confirm('Are you sure \nYoy Are Update the recoard ?');
    if(y){window.location.href = "add_transaction_history.php?id="+x+ "&urlname=" + urlname + "&status=edit";}
    else{window.location.href = "list_transaction_history.php";}
  }

  $(document).ready(function(){let table = new DataTable('#table_registration_User');});
  $(document).ready(function(){let table = new DataTable('#table_registration_User_1');});
  $(document).ready(function(){let table = new DataTable('#table_registration_User_2');});
  $(document).ready(function(){let table = new DataTable('#table_deposite_total');});
  $(document).ready(function(){let table = new DataTable('#table_withdrawal_total');});
  $(document).ready(function(){let table = new DataTable('#table_deposite_yearly');});
  $(document).ready(function(){let table = new DataTable('#table_withdrawal_yearly');});
  $(document).ready(function(){let table = new DataTable('#table_deposite_monthly');});
  $(document).ready(function(){let table = new DataTable('#table_withdrawal_monthly');});

  document.addEventListener("DOMContentLoaded", function() {
      const tabs = document.querySelectorAll('.nav-link');
      const tabContents = document.querySelectorAll('.tab-content');
      tabs.forEach(tab => {
          tab.addEventListener('click', function(e) {
              e.preventDefault();
              tabs.forEach(t => t.classList.remove('active'));
              tab.classList.add('active');
              tabContents.forEach(content => content.style.display = 'none');
              const targetId = tab.getAttribute('id').replace('_tab', '');
              document.getElementById(targetId).style.display = 'block';
          });
      });
  });

  function findYearlydata(){
    var year = document.getElementById('input_year').value;
    
  }
</script>

<style>
  .nav-tabs .nav-item .nav-link.active {
    background-color: #428bca;
    color: #fff;
  }
  .table_data_print {
    margin-top: 0px;
  }
  .fa-search {
    cursor: pointer;
    margin-left: 10px; 
  }
</style>