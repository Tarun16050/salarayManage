<?php include 'header/header_startding.php';?> 
<?php
//   require_once  dirname(__FILE__).'/email/MyMail.php';
if(isset($_POST['submit']))
{
  $error = [];
  $fname=testt($_POST['fname']);
  $lname=testt($_POST['lname']);
  $mobile=testt($_POST['mobile']);
  $email=testt($_POST['email']);
  if(isset($email) && empty($email)){ $error['email'] = "Please enter your email"; }
  else{$sql = "SELECT * FROM registration_user WHERE email = '$email'";
       $result = $con->query($sql);
        if ($result->num_rows > 0) {  $error['email'] = "email is allready register "; } 
  }
  // image validation
  if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $file = $_FILES['image'];
    $fileType = $file['type'];
    $fileSize = $file['size'];
    if (strpos($fileType, 'image') !== 0) {
        $error['image'] = 'Please upload an image file.';
    }else if ($fileSize > 1048576) {
        $error['image'] = 'Image size should be less than 1 MB.';
    }
    if (empty($error)) {
      $filenameWithoutSpaces = str_replace(' ', '_', $file['name']);
        $uniqueFilename = uniqid() . '_' . $filenameWithoutSpaces;
        move_uploaded_file($file['tmp_name'], dirname(__FILE__).'/../API/uploads/' . $uniqueFilename);
        // echo 'File uploaded successfully.';
    }
} else {
  $error['image'] =  'No file uploaded.';
}
  //end image validation 
  $psw=testt($_POST['psw']);
  $md_password = md5($psw);
  $cpsw=testt($_POST['cpsw']);  
  $opt='Select Option'; 
  if(empty($error)){    
    $ins="INSERT INTO `registration_user`(`fname`, `lname`, `mobile`, `email`, `password`,`image`,`image_path`) VALUES ('$fname','$lname','$mobile','$email','$md_password','$uniqueFilename','$uniqueFilename')";
    $res=mysqli_query($con,$ins);
    if($res)
    {?>
      <script> 
      // if (confirm("Registration has been successful. Click OK to proceed to adminUser.php.")) {    
      //   window.location.href = "adminUser.php";
      // }
      alert("Registration has been successful.");
      window.location.href = "registration_User.php";
</script><?php
    require_once  '/API/../MyMail.php';
    $to = $email;
    $subject = "Welcome To Salary Manage Application";
    $txt = file_get_contents("emailTemplate.php");;
    $headers = $fname.' '.$lname ;
    $emailContent = str_replace("{username}", $email, $txt);
    $emailContent = str_replace("{password}", $psw, $emailContent);
    sendEmail($to,$subject,$emailContent,$headers);
    }else{ ?>
      <script>alert("Your From is not Submitted ");</script><?php
    }
 }
}

function testt($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
<div class="container_register">
<div class="title">Admin Registration</div>
      <div class="information">Basic Information</div><hr/>
        <div class="content">
        <form action="registration_user_by_admin.php" method="post" enctype="multipart/form-data" id="admin_form">
            <div class="user-details">
              <div class="input-box">
                <span class="details">First Name<span class="star">*</span></span>
                <input type="text" placeholder="Enter your First name"  name="fname" id="first_name" value="<?= isset($_POST['fname']) ? $_POST['fname'] : ''; ?>">
                <p id="errors_first_name" class="field_erros"></p>
              </div>
              <div class="input-box">
                <span class="details">Last Name<span class="star">*</span></span>
                <input type="text" placeholder="Enter your Last Name"  name="lname"id="last_name" value="<?= isset($_POST['lname']) ? $_POST['lname'] : ''; ?>">
                <p id="errors_last_name" class="field_erros"></p>
              </div>
              <div class="input-box">
                <span class="details">Image<span class="star">*</span></span>
                <input type="file" id="upload_img" name="image">
                <p id="errors_upload_img" class="field_erros"><?= isset($error['image']) ? $error['image'] : ''; ?></p>
              </div>
            </div>
              
              <?php /*?>
              <div class="input-box">
                <span class="details">Date Of Birth<span class="star">*</span> </span>
                <input type="date" placeholder="Enter your Date of Birth"   name="DOB" id="dob" value="<?= isset($_POST['DOB']) ? $_POST['DOB'] : ''; ?>">
                <p id="errors_dob" class="field_erros"></p>
              </div>
              <div class="input-box">
                <span class="details" name="gender">Gender<span class="star">*</span></span>
                <select class="select" id="gender" name="gender"  value="<?= isset($_POST['gender']) ? $_POST['gender'] : ''; ?>">
                  <option value="Select Option">Select Option</option>
                  <option value="Male" <?= (isset($_POST['gender']) && $_POST['gender'] == 'Male') ? 'selected' : ''; ?>>Male</option>
                  <option value="Female"  <?= (isset($_POST['gender']) && $_POST['gender'] == 'Female') ? 'selected' : ''; ?>>Female</option>
                  <option value="Other" <?= (isset($_POST['gender']) && $_POST['gender'] == 'Other') ? 'selected' : ''; ?>>Other</option>                      
                </select>   
                <p id="errors_gender" class="field_erros"></p>          
              </div>                          
            </div>
            <div class="information">Address and Contact details</div><hr/>
            <div class="user-details">              
              <div class="input-box">
                <span class="details">Address<span class="star">*</span></span>
                <textarea  class="textarea" rows="4" cols="50" placeholder="Enter Full Address"   name="Address" id="address" ><?= isset($_POST['Address']) ? $_POST['Address'] : ''; ?></textarea>                  
                <p id="errors_Address" class="field_erros"></p> 
              </div>
            </div> <?php */?>
            <div class="information">Login Details</div><hr/>
            <div class="user-details">
              <div class="input-box">
                <span class="details">Email<span class="star">*</span></span>
                <input type="text" placeholder="Enter your email" value="<?= isset($_POST['email']) ? $_POST['email'] : ''; ?>"  name="email" id="email">
                <p id="errors_Email" class="field_erros"><?= isset($error['email']) ? $error['email'] : ''; ?></p> 
              </div>
              <div class="input-box">
                <span class="details">Phone Number<span class="star">*</span></span>
                <input type="tel" placeholder="Enter your number"  name="mobile" id="phone" value="<?= isset($_POST['mobile']) ? $_POST['mobile'] : ''; ?>">
                <p id="errors_Phone" class="field_erros"></p> 
              </div>
              <div class="input-box">
                <span class="details">Password<span class="star">*</span></span>
                <input type="password" placeholder="Enter your password"  name="psw" id="password" value="<?= isset($_POST['psw']) ? $_POST['psw'] : ''; ?>">
                <p id="errors_Password" class="field_erros"></p> 
              </div>
              <div class="input-box">
                <span class="details">Confirm Password<span class="star">*</span></span>
                <input type="password" placeholder="Confirm your password"  name="cpsw" id="confirm_Password" value="<?= isset($_POST['cpsw']) ? $_POST['cpsw'] : ''; ?>">
                <p id="errors_Confirm_Password" class="field_erros"></p> 
              </div>
            </div>    
            <div class="button">
              <input type="submit" value="Register" name="submit">
            </div>
        </form>
      </div>   
      </div> 
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
      <script src="js/validation.js"></script>    
<?php include 'header/header_ending.php';?>


<script>
  $(document).ready(function() {
    $('#upload_img').change(function() {
        var file = this.files[0];
        var fileType = file.type;
        var fileSize = file.size; // in bytes

        // Check if the file is an image
        if (fileType.split('/')[0] !== 'image') {
            $('#errors_upload_img').text('Please select an image file.');
            this.value = '';
            return false;
        }

        // Check file size (in bytes)
        if (fileSize > 1048576) { // 1 MB (1 MB = 1048576 bytes)
            $('#errors_upload_img').text('Image size should be less than 1 MB.');
            this.value = '';
            return false;
        }

        // Clear any previous error messages
        $('#errors_upload_img').text('');
    });
});

</script>