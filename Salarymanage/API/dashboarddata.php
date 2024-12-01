<?php
    require_once'../php/dbOperation.php';
    $response = array();
    $salaryrecord = array();
    if($_SERVER['REQUEST_METHOD']=='POST'){
	if(isset($_POST['email']) and isset($_POST['user_id'])){
		 $db = new  dbOperation();
// 			$user = $db->getTotalSalary($_POST['user_id']);
// 			$response['error'] = false; 
//             $response['data'] = $user ;	 
            $user = $db->getTotalSalary($_POST['user_id']);            
			$user_deposite = $db->getNoOFDeposit($_POST['user_id']);
			$user_Withdraw = $db->getNoOFWithdraw($_POST['user_id']);
			$user_total_trans = $db->getTotalTransection($_POST['user_id']);
			$user_total_amounts = $db->getTotalBlances($_POST['user_id']);
			$response['error'] = false; 
            $response['data_total_salary'] = !empty($user) ? $user : 0 ;	
            $response['data_deposite'] = !empty($user_deposite) ? $user_deposite : 0 ;
            $response['data_Withdraw'] = !empty($user_Withdraw) ? $user_Withdraw : 0 ;
            $response['data_total_trans'] = !empty($user_total_trans) ? $user_total_trans : 0 ;
            $response['data_total_amounts'] = !empty($user_total_amounts) ? $user_total_amounts : 0 ;
        
}else{
            $response['error'] = true; 
            $response['message'] = "Sorry Server is not responding Please try Agian";
        }
    }
echo json_encode($response);
?>