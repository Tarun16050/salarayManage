<?php include 'header/header_startding.php';?> 
<?php  $id = !empty($_GET['id'])?$_GET['id']:'';
$urlname = !empty($_GET['urlname'])?$_GET['urlname']:'';

if($urlname == 'salaryDetails'){
    $sql  ="SELECT * FROM salary WHERE `id`={$id}";
    $showdata = mysqli_query($con,$sql);
    $arrdata=mysqli_fetch_array($showdata);
    $user_sql = "SELECT * FROM registration_user WHERE `id`={$arrdata['user_id']}";
    $result = mysqli_query($con,$user_sql);
    $user_data = mysqli_fetch_array($result);
}
function testt($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>


<div class="container_register">
    <div class="title">Salary</div>    
    <div class="content">
        <form action="" method="post" enctype="multipart/form-data" id="admin_form">
            <div class="information">User Details </div><hr/>
            <div class="user-details">
                <div class="input-box">
                    <span class="details">User email<span class="star">*</span></span>
                     <input type="text"   value="<?= !empty($arrdata['user_email'])?$arrdata['user_email']:''; ?>"  name="email" id="email" >
                    <p id="errors_Email" class="field_erros"></p> 
                </div>
                <div class="input-box">
                    <input type="hidden" id="hidden_id" name="hidden_id" >
                    <input type="hidden" id="hidden_email" name="hidden_email" >
                    <input type="hidden" id="hidden_mobile" name="hidden_mobile" >
                     <div id="userDetails"></div>
                </div>
            </div>
            <div class="information">Salary Details </div><hr/>
            <div class="user-details" id="user_salary_details">
                <div class="input-box">
                    <span class="details">Salary Amount<span class="star">*</span></span>
                    <input type="text" value="<?= !empty($arrdata['amount'])?$arrdata['amount']:''; ?>" name="salary_amount" id="salary_amount" onkeypress="return isNumberKey(event)" autocomplete="off">
                    <p id="errors_salary_amount" class="field_erros"></p>
                </div>
                <div class="input-box">
                    <span class="details">Salary Month<span class="star">*</span></span>
                    <select class="select" name="salary_month" id="salary_month">
                        <option value="">Select Month</option>
                        <option value="January" <?= (!empty($arrdata['salary_month']) && $arrdata['salary_month'] == 'January') ? 'selected' : ''; ?>>January</option>
                        <option value="February" <?= (!empty($arrdata['salary_month']) && $arrdata['salary_month'] == 'February') ? 'selected' : ''; ?>>February</option>
                        <option value="March" <?= (!empty($arrdata['salary_month']) && $arrdata['salary_month'] == 'March') ? 'selected' : ''; ?>>March</option>
                        <option value="April" <?= (!empty($arrdata['salary_month']) && $arrdata['salary_month'] == 'April') ? 'selected' : ''; ?>>April</option>
                        <option value="May" <?= (!empty($arrdata['salary_month']) && $arrdata['salary_month'] == 'May') ? 'selected' : ''; ?>>May</option>
                        <option value="June" <?= (!empty($arrdata['salary_month']) && $arrdata['salary_month'] == 'June') ? 'selected' : ''; ?>>June</option>
                        <option value="July" <?= (!empty($arrdata['salary_month']) && $arrdata['salary_month'] == 'July') ? 'selected' : ''; ?>>July</option>
                        <option value="August" <?= (!empty($arrdata['salary_month']) && $arrdata['salary_month'] == 'August') ? 'selected' : ''; ?>>August</option>
                        <option value="September" <?= (!empty($arrdata['salary_month']) && $arrdata['salary_month'] == 'September') ? 'selected' : ''; ?>>September</option>
                        <option value="October" <?= (!empty($arrdata['salary_month']) && $arrdata['salary_month'] == 'October') ? 'selected' : ''; ?>>October</option>
                        <option value="November" <?= (!empty($arrdata['salary_month']) && $arrdata['salary_month'] == 'November') ? 'selected' : ''; ?>>November</option>
                        <option value="December" <?= (!empty($arrdata['salary_month']) && $arrdata['salary_month'] == 'December') ? 'selected' : ''; ?>>December</option>
                    </select>
                    <p id="errors_salary_month" class="field_erros"></p> 
                </div>
                <div class="input-box">
                    <span class="details">Salary Year<span class="star">*</span></span>
                    <input type="text" pattern="[0-9]{4}" maxlength="4"  value="<?=  !empty($arrdata['salary_year'])?$arrdata['salary_year']:''; ?>"  name="salary_year" id="salary_year" autocomplete="off" >
                    <p id="errors_salary_year" class="field_erros"></p> 
                </div>
                <div class="input-box">
                    <span class="details">Salary Date<span class="star">*</span></span>
                    <input type="text" value="<?= !empty($arrdata['amount_date'])?date('Y-m-d', strtotime($arrdata['amount_date'])):''; ?>" name="salary_date" id="salary_date" autocomplete="off">
                    <p id="errors_SalaryDate" class="field_errors"></p>
                </div>
            </div>
            <div class="button" id="submit_button">
              <input type="submit" value="<?= ($urlname == 'salaryDetails')?'Update':'Submit'?>" name="submit">
            </div>              
        </form>
    </div>   
</div>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<?php if($urlname == 'salaryDetails'){?><script>$('#user_salary_details').show(); $('#submit_button').hide(); </script> <?php }
else{?> <script>$('#user_salary_details').hide(); $('#submit_button').hide(); </script> <?php } ?>
<script>
    $(function() {
        $("#salary_date").datepicker({
            dateFormat: 'yy-mm-dd',  
            changeMonth: true,
            changeYear: true,
            yearRange: "-100:+0"    
        });
    });
    function isNumberKey(evt) {
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        return true;
    }

   //email checker 
    // Function to validate email format
    function validateEmail(email) {
        var errorField = document.getElementById('errors_Email');
        errorField.textContent = '';

        if (email === '') {
            errorField.textContent = 'Email cannot be empty.';
            return false;
        } else {
            // Perform a basic check for email format
            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                errorField.textContent = 'Invalid email format.';
                return false;
            }
        }

        return true;
    }

    // Event listener for real-time validation
    document.getElementById('email').addEventListener('input', function() {
        validateEmail(this.value.trim());
    });

    // Event listener for blur validation
    document.getElementById('email').addEventListener('blur', function() {
    var email = this.value.trim();
    if (validateEmail(email)) {
        $.ajax({
            url: 'check_email.php',
            type: 'POST',
            data: { email: email },
            dataType: 'json',
            success: function(response) {
                var userDetails = $('#userDetails');
                
                if (response['success']) {
                    var data = response['data'];
                    $('#hidden_id').val(data['id']);
                    $('#hidden_email').val(data['email']);
                    $('#hidden_mobile').val(data['mobile']);
                    var display ='<div class="success" style="background: #84f784;border: 5px solid #00800094;border-radius: 13px;padding-left: 20px;font: -webkit-control;"><p style="color:black;">ID : ' + data['id']+ '</p><p style="color:black;">Name : ' + data['Fname'] + ' ' + data['Lname'] + '</p><p style="color:black;">Email : ' + data['email'] + '</p><p style="color:black;">Mobile No. : ' + data['mobile'] + '</p></div>';
                    userDetails.html(display);
                    $('#user_salary_details').show(); $('#submit_button').show();
                } else {
                    $('#submit_button').hide();
                    userDetails.html('<div class="res_erro" style="background: lightcoral; border: 5px solid #ff000057; padding: 13px; border-radius: 13px; font-size: large; display: flex; align-items: center;"><span class="glyphicon glyphicon-remove" style="color: #ff000057; font-size: 20px; margin-top: 2px;"></span><p style="padding: 0;margin-left: 10px;margin-top: 15px; color:red;">Email does not exist.</p></div>');
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX error: ' + error);
                $('#errors_Email').text('Error checking email.');
            }
        });
    }
});
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<?php
if(isset($_POST['submit']))
{   $error = [];
    $id = !empty($_GET['id'])?$_GET['id']:'';
    $urlname = !empty($_GET['urlname'])?$_GET['urlname']:'';    
    
    $salary_amount = !empty($_POST['salary_amount'])?$_POST['salary_amount']:'';
    $salary_year = !empty($_POST['salary_year'])?$_POST['salary_year']:'';
    $salary_month = !empty($_POST['salary_month'])?$_POST['salary_month']:'';
    $salary_date = !empty($_POST['salary_date'])?$_POST['salary_date']:'';
    $email = !empty($_POST['email'])?$_POST['email']:'';
    $hidden_id = !empty($_POST['hidden_id'])?$_POST['hidden_id']:0;
    $hidden_email = !empty($_POST['hidden_email'])?$_POST['hidden_email']:'';
    $hidden_mobile = !empty($_POST['hidden_mobile'])?$_POST['hidden_mobile']:'';

    $uiser_email = $hidden_email;
    $user_id = $hidden_id;
    $user_mobile = $hidden_mobile;
    
    if(!empty($id) && !empty($urlname)){
        if(!empty($user_id) && !empty($uiser_email) && !empty($user_mobile)){
            $update = "UPDATE `salary` SET `id`='$id',`user_id`='$user_id',`user_email`=' $uiser_email',`user_mobile`='$user_mobile',`amount`='$salary_amount',`salary_month`='$salary_month',`salary_year`='$salary_year',`amount_date`='$salary_date' WHERE `id`={$id}";
            $res=mysqli_query($con,$update);   
            $message = "Updatation has been successful.";     
            $error_massage = "Your record has not been Updated !</br>Please Try Again ";}
        else{$res = false;$error_massage = "Your record has not been Updated !</br>Please Try Again "; }
    }else{
        if(!empty($user_id) && !empty($uiser_email) && !empty($user_mobile)){
            $insert = "INSERT INTO `salary`(`user_id`, `user_email`, `user_mobile`, `amount`, `salary_month`, `salary_year`, `amount_date`) VALUES ('$user_id','$uiser_email','$user_mobile','$salary_amount','$salary_month','$salary_year','$salary_date')";
            $res=mysqli_query($con,$insert);
            $message = "Successful Add Your Salary."; 
            $error_massage = "Your Salary has not been Saved !</br>Plase Try Again";
        }else{$res = false;$error_massage = "Your record has not been Updated !</br>Please Try Again "; }
    }

    if($res){ ?>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    icon: 'success',
                    title: '<?php echo $message; ?>',
                    showConfirmButton: false,
                    timer: 1500
                }).then(function() {
                    window.location.href = "list_salary_details.php";
                });
            });
        </script>   
        <?php }else{ ?> <script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    icon: 'error',
                    title: '<?php echo $error_massage; ?>',
                    showConfirmButton: false,
                    timer: 1500
                }).then(function() {
                    var id = <?php echo $id ;?>;
                    var url = '<?php echo $urlname;?>';
                    window.location.href = "addSalary.php?id="+id+ "&urlname=" + url;
                });
            });
        </script><?php }
}
?>