<?php
    require_once'../php/dbOperation.php';
    $response = array();
    if($_SERVER['REQUEST_METHOD']=='POST'){
        if(isset($_POST['user_id']) && isset($_POST['salary_id'])){     
            $db = new  dbOperation();
			$result = $db->deletSalary($_POST['user_id'],$_POST['salary_id']);
			if($result == 1){
                $response['error']=false;
                $response['message']= "Successfully Deleted Record";               
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