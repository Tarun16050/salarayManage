<?php
    require_once'../php/dbOperation.php';
    $response = array();
    if($_SERVER['REQUEST_METHOD']=='POST'){
        if(isset($_POST['user_id']) && isset($_POST['salary_id'])&& isset($_POST['amount']) && isset($_POST['date'])&& isset($_POST['salary_month']) && isset($_POST['salary_year']) && isset($_POST['updated_at'])){     
            $db = new  dbOperation();
			$result = $db->updateSalary($_POST['user_id'],$_POST['salary_id'],$_POST['amount'],$_POST['salary_month'],$_POST['salary_year'],$_POST['date'],$_POST['updated_at']);
			if($result == 1){
                $response['error']=false;
                $response['message']= "Successfully Updataed Recods";               
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
        $response['message']= "Invalid Request";
    }
    echo json_encode($response);
?>