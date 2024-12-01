<?php include 'header/header_startding.php';?> 
<link rel="stylesheet" href="../admin/css/allCommon.css">
<ul class="nav nav-tabs ">
    <li class="nav-item">
      <a class="nav-link active" href="#" id="salary_tab">Salary Details</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#" id="salary_total_tab">Salary Total</a>
    </li>
</ul>
<div class="table_data_print tab-content" id="salary" >
    <div class="panel panel-primary">
        <div class="panel-heading">Salary Details List
        <a href="addSalary.php"class='btn btn-primary pull-right' style="background-color: #428bca; padding-top: 0%;">Add Salary</a>
        </div>
        <div class="panel-body table-responsive">
            <table class="table table-hover" id="table_registration_User">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Email</th>
                        <th>Mobile No.</th>
                        <th>Salary</th>
                        <th>Month</th>
                        <th>Year</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php               
            $sql="SELECT * FROM `salary`";
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
                    <td><?php  echo $res['user_email']; ?></td>
                    <td><?php  echo $res['user_mobile']; ?></td>
                    <td><?php  echo $res['amount']; ?></td>
                    <td><?php  echo $res['salary_month']; ?></td>   
                    <td><?php  echo $res['salary_year']; ?></td>   
                    <td><?php  echo $res['amount_date']; ?></td>
                    <td>            
                        <button class="fa fa-edit btn_fa" onclick="checkAccept(<?php  echo $res['id'];   ?>,'salaryDetails')" title="Edit" style="font-size:20px;" >
                        <button class="fa fa-times-circle btn_fa" onclick="checkDelete(<?php  echo $res['id'];  ?>,'salaryDetails')" title="Delete" style="font-size:23px;">
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

<!-- <div id="salary_total" class="tab-content" style="display: none;">
  <p>This is the content for Salary Total tab.</p>
</div> -->
<div class="table_data_print tab-content" id="salary_total"  style="display: none;" >
    <div class="panel panel-primary">
        <div class="panel-heading">Total Salary Details List
        <a href="addSalary.php"class='btn btn-primary pull-right' style="background-color: #428bca; padding-top: 0%;">Add Salary</a>
        </div>
        <div class="panel-body">
            <table class="table table-hover" id="table_registration_User_1">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile No.</th>
                        <th>Total Salary</th>
                        <th>Total Record</th>
                    </tr>
                </thead>
                <tbody>
                <?php               
            $sql="SELECT COUNT(salary.id) AS total_salary_ids, SUM(salary.amount) AS total_salary_amount, registration_user.* FROM registration_user LEFT JOIN salary ON registration_user.id = salary.user_id GROUP BY registration_user.id";
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
                    <td><?php  echo $res['Fname'].' '.$res['Lname']; ?></td>            
                    <td><?php  echo $res['email']; ?></td>
                    <td><?php  echo $res['mobile']; ?></td>
                    <td style="color: #ff0914;"><?php  echo !empty($res['total_salary_amount'])?$res['total_salary_amount']:'<span style="color:black;">N/A</span>'; ?></td>
                    <td><?php  echo !empty($res['total_salary_ids'])?$res['total_salary_ids']:'N/A'; ?></td>
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
            window.location.href = "salary_details.php";
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
  if(y){window.location.href = "addSalary.php?id="+x+ "&urlname=" + urlname;}
  else{window.location.href = "salary_details.php";}
}
</script>
<script>
  $(document).ready(function(){let table = new DataTable('#table_registration_User');});
  $(document).ready(function(){let table = new DataTable('#table_registration_User_1');});

</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Get all tab links
        const tabs = document.querySelectorAll('.nav-link');

        // Get all tab content divs
        const tabContents = document.querySelectorAll('.tab-content');

        // Add click event listener to each tab
        tabs.forEach(tab => {
            tab.addEventListener('click', function(e) {
                e.preventDefault();

                // Remove 'active' class from all tabs
                tabs.forEach(t => t.classList.remove('active'));

                // Add 'active' class to the clicked tab
                tab.classList.add('active');

                // Hide all tab contents
                tabContents.forEach(content => content.style.display = 'none');

                // Display the corresponding tab content
                const targetId = tab.getAttribute('id').replace('_tab', '');
                document.getElementById(targetId).style.display = 'block';
            });
        });
    });
</script>
<style>
    /* Custom CSS for active tab */
    .nav-tabs .nav-item .nav-link.active {
        background-color: #428bca; /* Active tab background color */
        color: #fff; /* Active tab text color */
    }
    .table_data_print {
    margin-top: 0px;
}
</style>