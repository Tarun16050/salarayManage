<?php include 'header/header_startding.php';?> 
<link rel="stylesheet" href="../admin/css/allCommon.css">
<ul class="nav nav-tabs ">
    <li class="nav-item">
      <a class="nav-link active" href="#" id="salary_tab">All Transaction History</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#" id="salary_total_tab">withdrawal</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#" id="year_salary_total_tab">Deposit  </a>
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
                    <td><?php  echo $res['amount'] ;  ?></td>
                    <td><?php  echo $res['total_amount'] ; ?></td>   
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
                    <td><?php  echo $res['amount'] ;  ?></td>
                    <td><?php  echo $res['total_amount'] ; ?></td>   
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