<?php
    require_once'../php/dbOperation.php';
    $response = array();
    $salaryrecord = array();
    if($_SERVER['REQUEST_METHOD']=='POST'){
	if(isset($_POST['user_id'])){
		 $db = new  dbOperation();
			$user = $db->getBalanceHistoryData($_POST['user_id']);
			$response['error'] = false; 
            $response['datas'] = $user ;		
        
}else{
            $response['error'] = true; 
            $response['message'] = "Required fields are missing";
        }
    }
echo json_encode($response);
?>