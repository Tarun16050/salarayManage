<?php
    require_once'../php/dbOperation.php';
    $response = array();
    if($_SERVER['REQUEST_METHOD']=='POST'){
        if(isset($_POST['user_id']) && isset($_POST['user_email']) && isset($_POST['user_mobile']) && isset($_POST['amount']) && isset($_POST['date']) && isset($_POST['salary_month']) && isset($_POST['salary_year'])){                
            $db = new  dbOperation();
            $result = $db->createSalaryData($_POST['user_id'],$_POST['user_email'],$_POST['user_mobile'],$_POST['amount'],$_POST['date'],$_POST['salary_month'],$_POST['salary_year']);
            if($result == 1){
                $response['error']=false;
                $response['message']= "Successfully Added Salary";               
            }
            elseif($result == 2){
                $response['error']=true;
                $response['message']= "Some error occurred please try again..";
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