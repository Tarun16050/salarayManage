<?php include 'header/header_startding.php';?> 
<?php
 $update_id = $_GET["id"];
 $sql  ="SELECT * FROM admin_user WHERE `id`={$update_id}";
$showdata = mysqli_query($con,$sql);
$arrdata=mysqli_fetch_array($showdata); 
function testt($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
    ?>
<div class="container_register">
<input type="hidden" id="hiddenvalue" value="<?= $arrdata['role_type']; ?>" >
<div class="title"><?php echo $arrdata['role_type']; ?> Registration</div>
      <div class="information">Basic Information</div><hr/>
        <div class="content">
        <form action="" method="post" enctype="multipart/form-data" id="admin_form">
            <div class="user-details">
              <div class="input-box">
                <span class="details">First Name<span class="star">*</span></span>
                
                <input type="text" placeholder="Enter your First name"  name="fname" id="first_name" value="<?= $arrdata['fname']; ?>">
                <p id="errors_first_name" class="field_erros"></p>
              </div>
              <div class="input-box">
                <span class="details">Last Name<span class="star">*</span></span>
                <input type="text" placeholder="Enter your Last Name"  name="lname"id="last_name" value="<?= $arrdata['lname'] ; ?>">
                <p id="errors_last_name" class="field_erros"></p>
              </div> 
              <div class="input-box">
                <span class="details">Date Of Birth<span class="star">*</span> </span>
                <input type="date" placeholder="Enter your Date of Birth"   name="DOB" id="dob" value="<?= $arrdata['DOB'] ; ?>">
                <p id="errors_dob" class="field_erros"></p>
              </div>
              <div class="input-box">
                <span class="details" name="gender">Gender<span class="star">*</span></span>
                <select class="select" id="gender" name="gender"  value="<?= $arrdata['gender'] ?>">
                  <option value="Select Option">Select Option</option>
                  <option value="Male" <?= $arrdata['gender'] == 'Male' ? 'selected' : ''; ?>>Male</option>
                  <option value="Female"<?= $arrdata['gender'] == 'Female' ? 'selected' : ''; ?>>Female</option>
                  <option value="Other"<?= $arrdata['gender'] == 'Other' ? 'selected' : ''; ?>>Other</option>                      
                </select>   
                <p id="errors_gender" class="field_erros"></p>          
              </div>                          
            </div>
            <div class="information">Address and Contact details</div><hr/>
            <div class="user-details">              
              <div class="input-box">
                <span class="details">Address<span class="star">*</span></span>
                <textarea  class="textarea" rows="4" cols="50" placeholder="Enter Full Address"   name="Address" id="address" ><?= $arrdata['address'] ; ?></textarea>                  
                <p id="errors_Address" class="field_erros"></p> 
              </div>
            </div>
            <div class="information">Login Details</div><hr/>
            <div class="user-details">
              <div class="input-box">
                <span class="details">Email</span>
                <input type="text" readonly  value="<?= $arrdata['email']; ?>"  name="email" id="email" style="background-color: #a5a5a54d;">
                <p id="errors_Email" class="field_erros"></p> 
              </div>
              <div class="input-box">
                <span class="details">Phone Number<span class="star">*</span></span>
                <input type="tel" placeholder="Enter your number"  name="mobile" id="phone" value="<?= $arrdata['mobile']; ?>">
                <p id="errors_Phone" class="field_erros"></p> 
              </div>
              <div class="input-box">
                <span class="details">Password<span class="star">*</span></span>
                <input type="password" placeholder="Enter your password"  name="psw" id="password" value="<?= $arrdata['password'] ?>">
                <p id="errors_Password" class="field_erros"></p> 
              </div>
              <div class="input-box">
                <span class="details">Confirm Password<span class="star">*</span></span>
                <input type="password" placeholder="Confirm your password"  name="cpsw" id="confirm_Password" value="<?= $arrdata['password'] ?>">
                <p id="errors_Confirm_Password" class="field_erros"></p> 
              </div>
            </div>    
            <div class="button">
              <input type="submit" value="Update" name="submit">
            </div>
        </form>
      </div>   
      </div> 
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
      <script src="js/validation.js"></script>
    <!-- <script src="js/emailvalidation.js"></script> -->
<?php include 'header/header_ending.php';?>
<?php
if(isset($_POST['submit']))
{   $error = [];
    $ids = $_GET["id"];    
    $fname=testt($_POST['fname']);
    $lname=testt($_POST['lname']);
    $DOB=testt($_POST['DOB']);
    $gender=testt($_POST['gender']);
    $Address=testt($_POST['Address']); 
    $mobile=testt($_POST['mobile']);
    $email=testt($_POST['email']);
    $psw=testt($_POST['psw']);
    $cpsw=testt($_POST['cpsw']);  
    $opt='Select Option'; 
    if(empty($error)){    
        $ins="UPDATE `admin_user` SET `id`='$ids',`fname`='$fname',`lname`='$lname',`DOB`='$DOB',`gender`='$gender',`address`='$Address',`mobile`='$mobile',`email`='$email',`password`='$psw' WHERE `id`={$ids}";
        $res=mysqli_query($con,$ins);
        if($res)
        {?>
          <script>
            document.addEventListener("DOMContentLoaded", function() {
              // var getid = document.getElementById("hiddenvalue");
              var getid = document.querySelector("#hiddenvalue");
              var condition_value = getid.value;              
              alert("Updatation has been successful.");              
              if (condition_value === 'Admin') {window.location.href = "adminUser.php";} else {window.location.href = "adminDsdo.php";}
            });
  </script>
 
    <?php
        // if($arrdata['role_type'] == 'Admin'){header("Location: adminUser.php"); }
        // else{header("Location: adminDsdo.php");  }       
        }else{ ?>
          <script>alert("Your From is not Submitted ");</script><?php
        }
     }
}
?>