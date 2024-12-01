<?php include 'header/header_startding.php';?> 
<?php  $id = !empty($_GET['id'])?$_GET['id']:'';
$urlname = !empty($_GET['urlname'])?$_GET['urlname']:'';
$status = !empty($_GET['status'])?$_GET['status']:'';

    $query = "SELECT * FROM balance_history WHERE `user_id` = '{$userData['id']}' ORDER BY id DESC LIMIT 1";
    $result_query = mysqli_query($con, $query);
    $total_amounts = mysqli_fetch_array($result_query, MYSQLI_ASSOC);
    $remaing_amount  = !empty($total_amounts['total_amount']) ? $total_amounts['total_amount']:0;

if($urlname == 'transactionHistory'){
    $sql  ="SELECT * FROM balance_history WHERE `id`={$id}";
    $showdata = mysqli_query($con,$sql);
    $arrdata=mysqli_fetch_array($showdata);
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
                        <span class="details">Name<span class="star">*</span></span>
                        <input type="text"   value="<?= !empty($userData['Fname'])?$userData['Fname'].' '.$userData['Lname']:''; ?>"  name="email" id="email" readonly style="background-color: #f3f2f2;" >
                    </div>
                    <div class="input-box">
                        <span class="details">Email<span class="star">*</span></span>
                        <input type="text"   value="<?= !empty($userData['email'])?$userData['email']:''; ?>"  name="email" id="email" readonly style="background-color: #f3f2f2;"  >
                    </div>
                </div>
            <!-- </div> -->
            <div class="information">Transaction Details</div><hr/>
            <h4> <span style="color: #0000FF; ">Remaining Amount :</span> <span style="color: #00FF00; font-weight: bolder;"><?php echo $remaing_amount; ?> </span> </h4>
            <div class="user-details" id="user_salary_details">
                <div class="input-box">
                    <span class="details">Total Amount<span class="star">*</span></span>
                    <input type="text" readonly value="<?= !empty($arrdata['total_amount'])?$arrdata['total_amount']:$remaing_amount ; ?>" name="total_amount" id="total_amount" class="total_amount" >
                    <p id="errors_salary_amount" class="field_erros"></p>
                </div>
                <div class="input-box">
                    <span class="details"><span id="tran_amount_status"> Deposite/withdrawal Amount </span><span class="star">*</span></span>
                    <?php if($urlname == 'transactionHistory'){?> 
                    <input type="text" readonly value="<?= !empty($arrdata['amount'])?$arrdata['amount']:''; ?>" name="transaction_amount" id="transaction_amount" onkeypress="return isNumberKey(event)" autocomplete="off" class="total_amount">
                        <?php }else{ ?>
                    <input type="text" value="" name="transaction_amount" id="transaction_amount" onkeypress="return isNumberKey(event)" autocomplete="off">
                    <?php } ?>
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
                    <p id="errors_SalaryDate" class="field_erros"></p>
                </div>
            </div>
            <div class="input-box" id="user_salary_details_1">
                <span class="details">Reason<span class="star">*</span></span>
                <textarea rows="2"  name="reason" id="reason" autocomplete="off"><?= !empty($arrdata['reason']) ? $arrdata['reason'] : ''; ?></textarea>
                <p id="errors_reason" class="field_erros"></p> 
            </div>            
            <div class="button" id="submit_button">
              <input type="submit" value="<?= ($urlname == 'transactionHistory')?'Update':'Submit'?>" name="submit" >
            </div>              
        </form>
    </div>   
</div>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script>
     function isNumberKey(evt) {
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        return true;
    }
    $(document).ready(function() {
        // Initialize datepicker
        $("#salary_date").datepicker({
            dateFormat: 'yy-mm-dd',
            changeMonth: true,
            changeYear: true,
            yearRange: "-100:+0",
            onSelect: function(dateText) {
                if (dateText !== '') {
                    $('#errors_SalaryDate').text('');
                }
            }
        });

        // Validate transaction amount for withdrawal
        <?php if($status == 'withdrawal'){ ?>
        $('#transaction_amount').on('blur', function() {
            let transaction_amount = $('#transaction_amount').val();
            let total_amount = $('#total_amount').val();
            transaction_amount = parseFloat(transaction_amount);
            total_amount = parseFloat(total_amount);
            if (isNaN(transaction_amount)) {
                $('#errors_transaction_amount').text('Withdrawal Amount is Required.');
                $('#submit_button').hide();
            } else {
                if (transaction_amount >= total_amount) {
                    $('#errors_transaction_amount').text('The amount must be less than the total amount.');
                    $('#submit_button').hide();
                } else {
                    $('#submit_button').show();
                    $('#errors_transaction_amount').text('');
                }
            }
        });
        <?php } ?>

        // Update transaction amount status text
        <?php if($status == 'deposit'){ ?>
        $('#tran_amount_status').text('Deposit Amount');
        <?php } else if($status == 'withdrawal'){ ?>
        $('#tran_amount_status').text('Withdrawal Amount');
        <?php } else { ?>
        $('#tran_amount_status').text('Deposit/Withdrawal Amount');
        <?php } ?>

        // Form validation on submit
        $('#admin_form').on('submit', function(event) {
            let isValid = true;
            let transaction_amount = $('#transaction_amount').val().trim();
            let reason = $('#reason').val().trim();
            let salaryDate = $('#salary_date').val().trim();

            // Clear previous error messages
            $('#errors_transaction_amount').text('');
            $('#errors_reason').text('');
            $('#errors_SalaryDate').text('');

            // Validate Transaction mode
            if (transaction_amount === '') {
                $('#errors_transaction_amount').text('Please select a Amount.');
                isValid = false;
            }

            // Validate Reason
            if (reason === '') {
                $('#errors_reason').text('Please enter a Reason.');
                isValid = false;
            }

            // Validate Salary Date
            if (salaryDate === '') {
                $('#errors_SalaryDate').text('Please enter a salary date.');
                isValid = false;
            }

            // Prevent form submission if not valid
            if (!isValid) {
                event.preventDefault();
            }
        });

        // Clear error messages on input
        $('#reason').on('input', function() {
            let reason = $(this).val().trim();
            if (reason !== '') {
                $('#errors_reason').text('');
            }
        });

        $('#transaction_mode').on('change', function() {
            let transaction_mode = $(this).val().trim();
            if (transaction_mode !== '') {
                $('#errors_transaction_mode').text('');
            }
        });

        $('#salary_date').on('change', function() {
            let salaryDate = $(this).val().trim();
            if (salaryDate !== '') {
                $('#errors_SalaryDate').text('');
            }
        });
    });
</script>



<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<?php if($status == 'deposit'){?><script>$('#transaction_mode').val('Deposit').prop('disabled', true).css('background-color', '#f3f2f2');</script><?php }
else if($status == 'withdrawal'){?><script>$('#transaction_mode').val('Withdraw').prop('disabled', true).css('background-color', '#f3f2f2');</script><?php }
else if($status == 'edit'){?><script>$('#transaction_mode').prop('disabled', true).css('background-color', '#f3f2f2');</script><?php }?>

<?php
if(isset($_POST['submit']))
{   $error = [];
    $id = !empty($_GET['id'])?$_GET['id']:'';
    $urlname = !empty($_GET['urlname'])?$_GET['urlname']:'';
    if(!empty($userData['email']) && !empty($userData['mobile']) && !empty($userData['id']) ){
        $status = !empty($_GET['status'])?$_GET['status']:''; 
        $reasons = !empty($_POST['reason'])?$_POST['reason']:'';
        $transaction_amount = !empty($_POST['transaction_amount'])?$_POST['transaction_amount']:'';
        $total_amount = !empty($_POST['total_amount'])?$_POST['total_amount']:'';
        $salary_date = !empty($_POST['salary_date'])?$_POST['salary_date']:'';
        $email = !empty($_POST['email'])?$_POST['email']:'';
        $uiser_email = $userData['email'];
        $user_id = $userData['id'];
        $user_mobile = $userData['mobile'];
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
        background-color: #f3f2f2;
    }
</style>
