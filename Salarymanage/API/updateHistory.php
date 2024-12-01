<?php
    require_once'../php/dbOperation.php';
    $response = array();
    if($_SERVER['REQUEST_METHOD']=='POST'){
        if(isset($_POST['user_id']) && isset($_POST['history_id'])&& isset($_POST['reason']) && isset($_POST['date'])&& isset($_POST['updated_at'])){     
            $db = new  dbOperation();
			$result = $db->updateHistory($_POST['user_id'],$_POST['history_id'],$_POST['reason'],$_POST['date'],$_POST['updated_at']);
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