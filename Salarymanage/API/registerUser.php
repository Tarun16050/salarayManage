<?php
    require_once'../php/dbOperation.php';
    $response = array();
    if($_SERVER['REQUEST_METHOD']=='POST'){
        if(isset($_POST['Fname']) && isset($_POST['Lname']) && isset($_POST['email']) && isset($_POST['mobile']) && isset($_POST['password'])){
            $db = new  dbOperation();
            $result =  $db->createUser($_POST['Fname'],$_POST['Lname'],$_POST['email'],$_POST['mobile'],$_POST['password']);
            if($result == 1){
                $response['error']=false;
                $response['message']= "User Registered Successfully";
                
                require_once  'MyMail.php';
                $to = $_POST['email'];
                $subject = "Welcome To Salary Manage Application";
                // $txt = file_get_contents("emailTemplate.php");;
                $headers = $_POST['Fname'].' '.$_POST['Lname'] ;
                $template = $db->emailtemplate();
                $emailContent = str_replace("{username}", $_POST['email'], $template);
                $emailContent = str_replace("{password}", $_POST['password'], $emailContent);
                sendEmail($to,$subject,$emailContent,$headers);
            }
            elseif($result == 2){
                $response['error']=true;
                $response['message']= "Some error occurred please try again..";
            }
             elseif($result == 0){
                $response['error']=true;
                $response['message']= "Email Allready Exits";
            }
             elseif($result == 3){
                $response['error']=true;
                $response['message']= "mobile Number Allready Exits";
            }
        }
        else{
            $response['error']=true;
            $response['message']= "Required fields are missing";
        }
    }
    else{
        $response['error']=true;
        $response['message']= "Invalid Request(!post)";
    }
    echo json_encode($response);
?>