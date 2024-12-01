<?php include 'header/header_startding.php';?> 
<?php  $id = !empty($_GET['id'])?$_GET['id']:'';
$urlname = !empty($_GET['urlname'])?$_GET['urlname']:'';

if($urlname == 'salaryDetails'){
    $sql  ="SELECT * FROM salary WHERE `id`={$id}";
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
    <div class="title">Salary</div>    
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
                    <p id="errors_SalaryDate" class="field_erros"></p>
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
<script>
    $(function() {
        $("#salary_date").datepicker({
            dateFormat: 'yy-mm-dd',  
            changeMonth: true,
            changeYear: true,
            yearRange: "-100:+0",
            onSelect: function(dateText) {
            // When a date is selected, remove the error message if it's valid
            if (dateText !== '') {
                $('#errors_SalaryDate').text('');
                console.log('Salary date selected:', dateText);
            }
        }
        });
    });
    function isNumberKey(evt) {
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        return true;
    }

    document.getElementById('admin_form').addEventListener('submit', function(event) {
    let isValid = true;
    let salaryAmount = document.getElementById('salary_amount').value.trim();
    let salaryMonth = document.getElementById('salary_month').value.trim();
    let salaryYear = document.getElementById('salary_year').value.trim();
    let salaryDate = document.getElementById('salary_date').value.trim();
    
    // Clear previous error messages
    document.getElementById('errors_salary_amount').innerText = '';
    document.getElementById('errors_salary_month').innerText = '';
    document.getElementById('errors_salary_year').innerText = '';
    document.getElementById('errors_SalaryDate').innerText = '';

    // Validate Salary Amount
    if (salaryAmount === '' || isNaN(salaryAmount) || parseFloat(salaryAmount) <= 0) {
        document.getElementById('errors_salary_amount').innerText = 'Please enter a valid salary amount.';
        isValid = false;
    }

    // Validate Salary Month
    if (salaryMonth === '') {
        document.getElementById('errors_salary_month').innerText = 'Please select a salary month.';
        isValid = false;
    }

    // Validate Salary Year
    if (!/^\d{4}$/.test(salaryYear) || parseInt(salaryYear) < 1900 || parseInt(salaryYear) > new Date().getFullYear()) {
        document.getElementById('errors_salary_year').innerText = 'Please enter a valid salary year.';
        isValid = false;
    }

    // Validate Salary Date
    if (salaryDate === '') {
        document.getElementById('errors_SalaryDate').innerText = 'Please enter a salary date.';
        isValid = false;
    }

    // If the form is not valid, prevent submission
    if (!isValid) {
        event.preventDefault();
    }
});

document.getElementById('salary_amount').addEventListener('input', function() {
    let salaryAmount = this.value.trim();
    if (!isNaN(salaryAmount) && parseFloat(salaryAmount) > 0) {
        document.getElementById('errors_salary_amount').innerText = '';
    }
});

document.getElementById('salary_month').addEventListener('change', function() {
    let salaryMonth = this.value.trim();
    if (salaryMonth !== '') {
        document.getElementById('errors_salary_month').innerText = '';
    }
});

document.getElementById('salary_year').addEventListener('input', function() {
    let salaryYear = this.value.trim();
    if (/^\d{4}$/.test(salaryYear) && parseInt(salaryYear) >= 1900 && parseInt(salaryYear) <= new Date().getFullYear()) {
        document.getElementById('errors_salary_year').innerText = '';
    }
});

document.getElementById('salary_date').addEventListener('change', function() {
        let salaryDate = this.value.trim();
        if (salaryDate !== '') {
            document.getElementById('errors_SalaryDate').innerText = '';
            console.log('Salary date valid');
        }
    });

</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<?php
if(isset($_POST['submit']))
{   $error = [];
    $id = !empty($_GET['id'])?$_GET['id']:'';
    $urlname = !empty($_GET['urlname'])?$_GET['urlname']:'';    
    if(!empty($userData['email']) && !empty($userData['mobile']) && !empty($userData['id']) ){
        $salary_amount = !empty($_POST['salary_amount'])?$_POST['salary_amount']:'';
        $salary_year = !empty($_POST['salary_year'])?$_POST['salary_year']:'';
        $salary_month = !empty($_POST['salary_month'])?$_POST['salary_month']:'';
        $salary_date = !empty($_POST['salary_date'])?$_POST['salary_date']:'';
        $email = !empty($_POST['email'])?$_POST['email']:'';
        $uiser_email = $userData['email'];
        $user_id = $userData['id'];
        $user_mobile = $userData['mobile'];
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