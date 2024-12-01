<?php
    require_once'../php/dbOperation.php';
    $response = array();
    if($_SERVER['REQUEST_METHOD']=='POST'){
        if(isset($_POST['Fname']) && isset($_POST['Lname']) && isset($_POST['email']) && isset($_POST['mobile']) && isset($_POST['password'])){
                // $imageData = $_POST['image'];
                // $imageFileType = strtolower(pathinfo($imageData,PATHINFO_EXTENSION));
                // $imagePath = "uploads/" . uniqid() .".". $imageFileType; // Generate a unique file name
                // $imageData = base64_decode($imageData);
            //  file_put_contents($imagePath, $imageData);
            //  $_POST['image_path'] = $imagePath;
            $db = new  dbOperation();
            $result =  $db->createUser($_POST['Fname'],$_POST['Lname'],$_POST['email'],$_POST['mobile'],$_POST['password']);
            //$_POST['image'],$_POST['image_path']
            
            if($result == 1){
                $response['error']=false;
                $response['message']= "User Registered Successfully";
                
                require_once  'MyMail.php';
                $to = $_POST['email'];
                $subject = "Welcome To Salary Manage Application";
                $txt = file_get_contents("emailTemplate.php");;
                $headers = $_POST['Fname'].' '.$_POST['Lname'] ;
                $emailContent = str_replace("{username}", $_POST['email'], $txt);
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