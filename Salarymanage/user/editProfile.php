<?php include 'header/header_startding.php';?> 
<?php  
    $id = !empty($userData['id'])?$userData['id']:'';
    $sql  ="SELECT * FROM  registration_user WHERE `id`={$id}";
    $showdata = mysqli_query($con,$sql);
    $arrdata=mysqli_fetch_array($showdata);

function testt($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css"> -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css">
<!-- <link rel="stylesheet" href="css/dropify.css"> -->
<div class="container_register">
    <div class="title">Salary</div>    
    <div class="content">
        <form action="" method="post" enctype="multipart/form-data" id="admin_form">
            <div class="information">User Details </div><hr/>
            <div class="user-details">
                <div class="input-box">
                    <span class="details">First Name<span class="star">*</span></span>
                     <input type="text"   value="<?= !empty($arrdata['Fname'])?$arrdata['Fname']:''; ?>"  name="Fname" id="Fname" placeholder="Enter First Name">
                     <p id="errors_Fname" class="field_erros"></p>
                </div>
                <div class="input-box">
                    <span class="details">Last Name<span class="star">*</span></span>
                     <input type="text"   value="<?= !empty($arrdata['Lname'])?$arrdata['Lname']:''; ?>"  name="Lname" id="Lname" placeholder="Enter Last Name">
                     <p id="errors_Lname" class="field_erros"></p>
                </div>
                <div class="input-box">
                    <span class="details">Email<span class="star">*</span></span>
                     <input type="text"   value="<?= !empty($arrdata['email'])?$arrdata['email']:''; ?>"  name="email" id="email" readonly style="background-color: #f3f2f2;"  >
                </div>
                <div class="input-box">
                    <span class="details">Mobile Number<span class="star">*</span></span>
                     <input type="text"   value="<?= !empty($arrdata['mobile'])?$arrdata['mobile']:''; ?>"  name="mobile" id="mobile" readonly style="background-color: #f3f2f2;"  >
                     <input type="hidden" value="<?= !empty($arrdata['image_path'])?$arrdata['image_path']:''; ?>" name="image_path" id="image_path">
                    </div>
                <div class="input-box">
                    <span class="details">Date of Birth<span class="star">*</span></span>
                    <input type="text" value="<?= !empty($arrdata['dob_date'])?date('Y-m-d', strtotime($arrdata['dob_date'])):''; ?>" name="salary_date" id="salary_date" autocomplete="off">
                    <p id="errors_SalaryDate" class="field_erros"></p>
                </div>
                <div class="input-box">
                    <span class="details">Upload Image</span>
                    <input type="file" name="image" class="dropify" data-default-file='' id="image">
                    
                    <p id="errors_image" class="field_erros"></p>
                </div>
                <!--  -->
                <div class="row">
                    <div class="col-md-1" id="image_"></div><br>

                </div>
                <!--  -->
            </div>
            <div class="button" id="submit_button">
              <input type="submit" value="Update" name="submit">
            </div>              
        </form>
    </div>   
</div>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
<script>
    var dvE = $('#image').dropify({});
    dvE = dvE.data('dropify')
    $(function() {
        $("#salary_date").datepicker({
            dateFormat: 'yy-mm-dd',  
            changeMonth: true,
            changeYear: true,
            yearRange: "-100:+0",
            onSelect: function(dateText) {
            if (dateText !== '') {
                $('#errors_SalaryDate').text('');
                console.log('Salary date selected:', dateText);
            }
        }
        });
    });


    document.getElementById('admin_form').addEventListener('submit', function(event) {
    let isValid = true;
    let fname = document.getElementById('Fname').value.trim();
    let lname = document.getElementById('Lname').value.trim();
    let salaryDate = document.getElementById('salary_date').value.trim();
    let fileInput = document.querySelector('input[type="file"]');
        let file = fileInput.files[0];
        let maxFileSize = 1 * 1024 * 1024; // 1 MB in bytes
    
    // Clear previous error messages
    document.getElementById('errors_Fname').innerText = '';
    document.getElementById('errors_Lname').innerText = '';
    document.getElementById('errors_image').innerText = '';
    document.getElementById('errors_SalaryDate').innerText = '';


    // Validate Salary Date
    if (fname === '') {
        document.getElementById('errors_Fname').innerText = 'Please enter a First Name.';
        isValid = false;
    }
    if (lname === '') {
        document.getElementById('errors_Lname').innerText = 'Please enter a Last Name.';
        isValid = false;
    }
    if (salaryDate === '') {
        document.getElementById('errors_SalaryDate').innerText = 'Please enter a salary date.';
        isValid = false;
    }

    let allowedTypes = ['image/jpeg', 'image/png'];
    
    if (!allowedTypes.includes(file.type)) {
        document.getElementById('errors_image').innerText = 'Only JPG and PNG images are allowed.';
        isValid = false;
    } else if (file.size > maxFileSize) {
        document.getElementById('errors_image').innerText = 'Image size should be less than 1 MB';
        isValid = false;
    }

    // if (file && file.size > maxFileSize) {
    //     document.getElementById('errors_image').innerText = 'Image size should be less than 1 MB';
    //         isValid = false;
    //     }

    // If the form is not valid, prevent submission
    if (!isValid) {
        event.preventDefault();
    }
});

document.getElementById('Fname').addEventListener('input', function() {
    let fname = this.value.trim();
    if (fname !== '') {
        document.getElementById('errors_Fname').innerText = '';
    }
    else{document.getElementById('errors_Fname').innerText = 'Please enter a First name.';    }
});
document.getElementById('Lname').addEventListener('input', function() {
    let lname = this.value.trim();
    if (lname !== '') {
        document.getElementById('errors_Lname').innerText = '';
    }
    else{document.getElementById('errors_Lname').innerText = 'Please enter a Last name.';    }
});

document.getElementById('salary_date').addEventListener('change', function() {
        let salaryDate = this.value.trim();
        if (salaryDate !== '') {
            document.getElementById('errors_SalaryDate').innerText = '';
            console.log('Salary date valid');
        }
    });

    // Image validation
document.getElementById('image').addEventListener('change', function() {
    let fileInput = this;
    let file = fileInput.files[0];
    let maxFileSize = 1 * 1024 * 1024; // 1 MB in bytes
    let allowedTypes = ['image/jpeg', 'image/png'];

    // Clear previous error message
    document.getElementById('errors_image').innerText = '';

    // Validate file type and size
    if (file) {
        if (!allowedTypes.includes(file.type)) {
            document.getElementById('errors_image').innerText = 'Only JPG and PNG images are allowed.';
        } else if (file.size > maxFileSize) {
            document.getElementById('errors_image').innerText = 'Image size should be less than 1 MB';
        } else {
            console.log('Image is valid');
        }
    }
});

</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<?php
if(isset($_POST['submit']))
{   $error = [];
    $id = !empty($userData['id'])?$userData['id']:'';   
    if(!empty($userData['email']) && !empty($userData['mobile']) && !empty($userData['id']) ){
        $Fname = !empty($_POST['Fname'])?$_POST['Fname']:'';
        $Lname = !empty($_POST['Lname'])?$_POST['Lname']:'';
        $image_names = !empty($_POST['image_path'])?$_POST['image_path']:'';
        $dob_date = !empty($_POST['salary_date'])?date('Y-m-d', strtotime($_POST['salary_date'])):'';
        $image = !empty($_FILES['image'])?$_FILES['image']:'';
        if(isset($_FILES['image'])){
            $file = $_FILES['image'];
            $fileType = $file['type'];
            $fileSize = $file['size'];
            if(!empty( $file['name'])){$filenameWithoutSpaces = str_replace(' ', '_', $file['name']);
                $uniqueFilename = uniqid() . '_' . $filenameWithoutSpaces;
                move_uploaded_file($file['tmp_name'], dirname(__FILE__).'/../API/uploads/' . $uniqueFilename);
                // echo 'File uploaded successfully.';
            }else{
                $uniqueFilename = $image_names;
            }
            
            
        }
        
        $uiser_email = $userData['email'];
        $user_id = $userData['id'];
        $user_mobile = $userData['mobile'];

            if(!empty($user_id) && !empty($uiser_email) && !empty($user_mobile)){
                // $update = "UPDATE `registration_user` SET `id`= '$id',`Fname`='$Fname',`Lname`='$Lname',`dob_date`='$dob_date',`image_path`='$uniqueFilename' WHERE `id`={$id}";
                // $res=mysqli_query($con,$update);   
                $update = "UPDATE `registration_user` SET `id`= '$id', `Fname`='$Fname', `Lname`='$Lname', `dob_date`='$dob_date', `image_path`='$uniqueFilename' WHERE `id`='$id'";
                $res = mysqli_query($con, $update);

                $message = "Updatation has been successful.";     
                $error_massage = "Your record has not been Updated !</br>Please Try Again ";}
            else{$res = false;$error_massage = "Your record has not been Updated !</br>Please Try Again "; }

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
                    window.location.href = "dashboard.php";
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