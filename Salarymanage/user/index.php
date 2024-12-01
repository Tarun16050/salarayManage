<?php require_once dirname(__FILE__).'/database.php'; ?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Salarymanage/user/css/login.css">   
    <meta name="author" content="Salary Manage">
    <meta name="keywords" content="how to salary manage in india 2024">
    <meta name="description" content="If you want to manage your salary and salary-related data you can Here manage the data simply way.">
    <meta name="google-site-verification" content="FRkYGdhUUI7mpGPUeJuosZh1DrG28wUDn7M7uU7SUis" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
    <title>Salary Manage</title>
</head>
<body>
<div class="login_form">
        <form action="#" class="form">
            <h3 class="form_title"> Welcome to Salary Manage</h3>
            <h3 class="form_title"> User Login   </h3>
            <p class="error_data" id="error_login"></p>
            <p class="error_data" id="error_login_massage"></p>
            <input type="hidden"  id="error_input" value="0" name="chapchaValue">
            <div class="form_div">
                <input type="text" class="form_input" placeholder=" " name="email">
                <label class="form_label">Email</label>
            </div>
            <div class="form_div">
                <input type="password" class="form_input" placeholder=" " name="password">
                <label class="form_label">Password</label>
            </div>
            <div style="margin-bottom: 66px;margin-top: -25px;">
                <span class="float-right" style="float: right;"> 
                    <a href="/Salarymanage/user/forgetpassword.php">Forget Password</a>
                </span>
            </div>
            <div id="captcha" class="form_div">
                <div class="preview"></div>
                <div class="captcha_form"> 
                    <input type="text" id="captcha_form" class="form_input_captcha" placeholder=" ">
                    <label class="form_label_captcha">Enter Captcha</label>
                    <a class="captcha_refersh" href="">
                    <i class="material-icons">refresh</i>
                    </a>
                </div>
            </div>
            <input type="submit" class="form_button" value="Log In"  name="submit">
            <p>Don't have an account? <a href="singup.php"><span style="color: blue;">Sign up</span></a></p>
        </form>
    </div>
</body>
</html>
<script src="/Salarymanage/user/js/login.js"></script>
<?php
session_start();
if(isset($_REQUEST['submit'])){ 
    $email = isset($_REQUEST['email']) ? stripslashes($_REQUEST['email']) : '' ;   
    if(!empty($email)){ $email = mysqli_real_escape_string($con, $email); }
    $password = isset($_REQUEST['password']) ? stripslashes($_REQUEST['password']) : '' ;
    if(!empty($password)){ $password = mysqli_real_escape_string($con, $password); $password = md5($password); }
    $chapchaValue = isset($_REQUEST['chapchaValue']) ? stripslashes($_REQUEST['chapchaValue']) : 0 ;
    $query = "SELECT * FROM `registration_user` WHERE `email`='$email'AND `password`='$password' " ;
    $result = mysqli_query($con, $query) ;
    $rows = mysqli_num_rows($result);
    if ($rows == 1 ) {
    $fetch_data = mysqli_fetch_assoc($result);
    $_SESSION['loginData'] = $fetch_data;
        if($chapchaValue == 1 ){		
        header("Location: /Salarymanage/user/dashboard.php");}
        else{
            ?>
            <script>				
                const errorMessageElement1 = document.getElementById("error_login_massage");
                if (errorMessageElement1) {			
                    errorMessageElement1.textContent = "Invalid Captcha";
                } 				
            </script>
            <?php 
        }
    }
    else {?>
        <script>				
            const errorMessageElement = document.getElementById("error_login_massage");
            if (errorMessageElement) {			
                errorMessageElement.textContent = "Invalid user / password";
            } 				
        </script>
        <?php 
      }
}
?>