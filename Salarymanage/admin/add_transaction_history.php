<?php include 'header/header_startding.php';?> 
<?php  $id = !empty($_GET['id'])?$_GET['id']:'';
$urlname = !empty($_GET['urlname'])?$_GET['urlname']:'';
$status = !empty($_GET['status'])?$_GET['status']:'';

if($urlname == 'transactionHistory'){
    $sql  ="SELECT * FROM balance_history WHERE `id`={$id}";
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
    <div class="title">Transaction From</div>    
    <div class="content">
        <form action="" method="post" enctype="multipart/form-data" id="admin_form">
            <div class="information">User Details </div><hr/>
            <div class="user-details">
                <div class="input-box">
                    <span class="details">User email<span class="star">*</span></span>
                    <input type="text"   value="<?= !empty($arrdata['user_email'])?$arrdata['user_email']:''; ?>"  name="email" id="email"  autocomplete="off">
                    <p id="errors_Email" class="field_erros"></p> 
                </div>
                <div class="input-box">
                    <input type="hidden" id="hidden_id" name="hidden_id" >
                    <input type="hidden" id="hidden_email" name="hidden_email" >
                    <input type="hidden" id="hidden_mobile" name="hidden_mobile" >
                     <div id="userDetails" ></div>
                </div>
            </div>
            <div class="information">Transaction Details </div><hr/>
            <div class="user-details" id="user_salary_details">
            <div class="input-box">
                    <span class="details">Total Amount<span class="star">*</span></span>
                    <input type="text" readonly value="<?= !empty($arrdata['total_amount'])?$arrdata['total_amount']:''; ?>" name="total_amount" id="total_amount" class="total_amount" >
                    <p id="errors_salary_amount" class="field_erros"></p>
                </div>
                <div class="input-box">
                    <span class="details"><span id="tran_amount_status"> Deposite/withdrawal Amount </span><span class="star">*</span></span>
                    <input type="text" value="<?= !empty($arrdata['amount'])?$arrdata['amount']:''; ?>" name="transaction_amount" id="transaction_amount" onkeypress="return isNumberKey(event)" autocomplete="off">
                    <p id="errors_transaction_amount" class="field_erros"></p>
                </div>
                <div class="input-box">
                    <span class="details">Transaction Mode<span class="star">*</span></span>
                    <select class="select" name="transaction_mode" id="transaction_mode">
                        <option value="">Select Transaction Mode</option>
                        <option value="Withdraw" <?= (!empty($arrdata['balance_Status']) && $arrdata['balance_Status'] == 'Withdraw') ? 'selected' : ''; ?>>Withdraw</option>
                        <option value="Deposit" <?= (!empty($arrdata['balance_Status']) && $arrdata['balance_Status'] == 'Deposit') ? 'selected' : ''; ?>>Deposit</option>
                    </select>
                    <p id="errors_transaction_mode" class="field_erros"></p> 
                </div>
                <div class="input-box">
                    <span class="details">Transaction Date<span class="star">*</span></span>
                    <input type="date" value="<?= !empty($arrdata['date'])?date('Y-m-d', strtotime($arrdata['date'])):''; ?>" name="salary_date" id="salary_date" autocomplete="off">
                    <p id="errors_SalaryDate" class="field_errors"></p>
                </div>
            </div>
            <div class="input-box" id="user_salary_details_1">
                <span class="details">Reason<span class="star">*</span></span>
                <textarea rows="2"  name="reason" id="reason" autocomplete="off"><?= !empty($arrdata['reason']) ? $arrdata['reason'] : ''; ?></textarea>
                <p id="errors_salary_year" class="field_erros"></p> 
            </div>
            <div class="input-box" id="user_salary_details_1">
                <p  class="field_erros" id="all_error"></p>
            </div>
            
            <div class="button" id="submit_button">
              <input type="submit" value="<?= ($urlname == 'transactionHistory')?'Update':'Submit'?>" name="submit" id="submit_button_input">
            </div>              
        </form>
    </div>   
</div>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<?php if($urlname == 'transactionHistory'){?><script>$('#user_salary_details').show(); $('#user_salary_details_1').show(); $('#submit_button').hide(); </script> <?php }
else{?> <script>$('#user_salary_details').hide(); $('#user_salary_details_1').hide(); $('#submit_button').hide(); </script> <?php } ?>
<?php if($status == 'deposit'){?><script>$('#transaction_mode').val('Deposit').prop('disabled', true).css('background-color', '#ccc');</script><?php }
else if($status == 'withdrawal'){?><script>$('#transaction_mode').val('Withdraw').prop('disabled', true).css('background-color', '#ccc');</script><?php }
else if($status == 'edit'){?><script>$('#transaction_mode').prop('disabled', true).css('background-color', '#ccc');$('#transaction_amount').prop('disabled', true).css('background-color', '#ccc');</script><?php }?>


<script>
    $(function() {
        $("#salary_date").datepicker({
            dateFormat: 'yy-mm-dd',  // Format as YYYY-MM-DD
            changeMonth: true,
            changeYear: true,
            yearRange: "-100:+0"    // Optional: restrict years to the last 100 years
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
            data: { email: email , urlname:'transactionHistory'},
            dataType: 'json',
            success: function(response) {
                var userDetails = $('#userDetails');
                
                if (response['success']) {
                    var data = response['data'];
                    $('#hidden_id').val(data['id']);
                    $('#hidden_email').val(data['email']);
                    $('#hidden_mobile').val(data['mobile']);
                    $('#total_amount').val(response['total_amount']);
                    var display ='<div class="success" style="background: #84f784;border: 5px solid #00800094;border-radius: 13px;padding-left: 20px;font: menu;"><p class="addsalary_p" style="color: black;font-weight: bold;">ID : ' + data['id']+ '</p><p style="color: black;font-weight: bold;">Name : ' + data['Fname'] + ' ' + data['Lname'] + '</p><p class="addsalary_p" style="color: black;font-weight: bold;">Email : ' + data['email'] + '</p><p class="addsalary_p"style="color: black;font-weight: bold;">Mobile No. : ' + data['mobile'] + '</p></div>';
                    userDetails.html(display);
                    $('#user_salary_details').show();$('#user_salary_details_1').show(); $('#submit_button').show();
                } else {
                    $('#submit_button').hide();
                    userDetails.html('<div class="res_erro" style="background: lightcoral; border: 5px solid #ff000057; padding: 13px; border-radius: 13px; font-size: large; display: flex; align-items: center;"><span class="glyphicon glyphicon-remove" style="color: #ff000057; font-size: 20px; margin-top: 2px;"></span><p style="padding: 0;margin-left: 10px;margin-top: 15px; color:#740000;">Email does not exist.</p></div>');
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX error: ' + error);
                $('#errors_Email').text('Error checking email.');
            }
        });
    }
});
<?php if($status == 'withdrawal'){ ?>
    $('#transaction_amount').on('blur', function() {
        let transaction_amount = $('#transaction_amount').val();
        let total_amount  = $('#total_amount').val();
        transaction_amount = parseFloat(transaction_amount);
        total_amount = parseFloat(total_amount);
        if (isNaN(transaction_amount)) {
            $('#errors_transaction_amount').text('Withdrawal Amount is Required.');
            $('#submit_button').hide();
        }else{
        if(transaction_amount >= total_amount ){
            $('#errors_transaction_amount').text('The amount must be less than the total amount.');
            $('#submit_button').hide();
        }
        else{
            $('#submit_button').show();
            $('#errors_transaction_amount').text('');
        }}
    });
<?php } ?>

<?php if($status == 'deposit'){ ?>    
        $('#tran_amount_status').text('Deposit Amount');    
<?php }elseif($status == 'withdrawal'){ ?>    
        $('#tran_amount_status').text('Withdrawal Amount');    
<?php }else{ ?>    
        $('#tran_amount_status').text('Deposit/Withdrawal Amount');    
<?php } ?>

function validateForm() {
        var email = document.getElementById('email').value.trim();
        var total_amount = document.getElementById('total_amount').value.trim();
        var transaction_amount = document.getElementById('transaction_amount').value.trim();
        var transaction_mode = document.getElementById('transaction_mode').value.trim();
        var salary_date = document.getElementById('salary_date').value.trim();
        var reason = document.getElementById('reason').value.trim();

        // Check if any required field is empty
        if (email === '' || total_amount === '' || transaction_amount === '' || transaction_mode === '' || salary_date === '' || reason === '') {
            
            return false;
        }
        return true;
    }

    // Add event listeners to all input/select elements for validation
    var formInputs = document.querySelectorAll('#admin_form input, #admin_form select, #admin_form textarea');
    formInputs.forEach(function(input) {
        input.addEventListener('keyup', function() {
            if (validateForm()) {
                document.getElementById('submit_button_input').removeAttribute('disabled');
                document.getElementById('all_error').innerHTML = '';
            } else {
                document.getElementById('submit_button_input').setAttribute('disabled', 'disabled');
                 document.getElementById('all_error').innerHTML = 'Note : *  fields are required';
            }
        });
        input.addEventListener('change', function() {
            if (validateForm()) {
                document.getElementById('submit_button_input').removeAttribute('disabled');
                document.getElementById('all_error').innerHTML = '';
            } else {
                document.getElementById('submit_button_input').setAttribute('disabled', 'disabled');
                 document.getElementById('all_error').innerHTML = 'Note : *  fields are required';
            }
        });
    });

</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<?php
if(isset($_POST['submit']))
{   $error = [];
    $id = !empty($_GET['id'])?$_GET['id']:'';
    $urlname = !empty($_GET['urlname'])?$_GET['urlname']:'';
    $status = !empty($_GET['status'])?$_GET['status']:''; 
    $reasons = !empty($_POST['reason'])?$_POST['reason']:'';
    $transaction_amount = !empty($_POST['transaction_amount'])?$_POST['transaction_amount']:'';
    $total_amount = !empty($_POST['total_amount'])?$_POST['total_amount']:'';
    $salary_date = !empty($_POST['salary_date'])?$_POST['salary_date']:'';
    $email = !empty($_POST['email'])?$_POST['email']:'';
    $hidden_id = !empty($_POST['hidden_id'])?$_POST['hidden_id']:0;
    $hidden_email = !empty($_POST['hidden_email'])?$_POST['hidden_email']:'';
    $hidden_mobile = !empty($_POST['hidden_mobile'])?$_POST['hidden_mobile']:'';

    $uiser_email = $hidden_email;
    $user_id = $hidden_id;
    $user_mobile = $hidden_mobile;
    $dates = new DateTime();
    $datetime = new DateTime();
    $datetime = $datetime->format('Y-m-d H:i:s');
    
    if(!empty($id) && !empty($urlname)){
        if(!empty($user_id) && !empty($uiser_email) && !empty($user_mobile) && !empty($status) && $status == 'edit'){
            $update = "UPDATE `balance_history` SET `reason`='$reasons',`date`='$salary_date' WHERE `id`={$id}";
            $res=mysqli_query($con,$update);   
            $message = "Updatation has been successful.";     
            $error_massage = "Your record has not been Updated !</br>Please Try Again ";}
        else{$res = false;$error_massage = "Your record has not been Updated !</br>Please Try Again "; }
    }else{
        if(!empty($user_id) && !empty($uiser_email) && !empty($user_mobile)){
            if(!empty($status)){
                // $total_amount = intval($total_amount);  
                // $transaction_amount = intval($transaction_amount);
                $total_amount = floatval($total_amount);  
                $transaction_amount = floatval($transaction_amount);
                if($status == 'deposit'){
                    $bal_amount = $total_amount + $transaction_amount;
                    $insert = "INSERT INTO `balance_history`(`user_id`, `amount`, `reason`, `balance_Status`, `total_amount`, `date`, `time`) VALUES ('$user_id','$transaction_amount','$reasons','Deposit','$bal_amount','$salary_date','$datetime')";
                    $res=mysqli_query($con,$insert);
                    $message = "(Deposit) Transaction Successful"; 
                    $error_massage = "(Deposit) Transaction Failed !</br>Plase Try Again";
                }
                else if($status == 'withdrawal'){
                    $bal_amount = $total_amount - $transaction_amount;
                    $insert = "INSERT INTO `balance_history`(`user_id`, `amount`, `reason`, `balance_Status`, `total_amount`, `date`, `time`) VALUES ('$user_id','$transaction_amount','$reasons','Withdraw','$bal_amount','$salary_date','$datetime')";
                    $res=mysqli_query($con,$insert);
                    $message = "(Withdraw) Transaction Successful"; 
                    $error_massage = "(Withdraw) Transaction Failed !</br>Plase Try Again";
                }
            }
            else{$res = false;$error_massage = "Server Issues  !</br>Please Try Again "; }
        }else{$res = false;$error_massage = "Server Issues  !</br>Please Try Again "; }

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
                    window.location.href = "list_transaction_history.php";
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
                    var urls = '<?php echo $status;?>';
                    window.location.href = "addSalary.php?id="+id+ "&urlname=" + url +"&status="+urls;
                });
            });
        </script><?php }
}
?>
<style>
    input[type="date"]::-webkit-calendar-picker-indicator {
        display: none;
    }
    .input-box textarea {
        width: 100%; 
        max-width: 100%;
        padding: 10px;
        font-size: 18px;      
    }
    .total_amount{
        background-color: #ccc;
    }
</style>
