<?php
    require_once'../php/dbOperation.php';
    $response = array();
    $salaryrecord = array();
    if($_SERVER['REQUEST_METHOD']=='POST'){
	if(isset($_POST['email']) and isset($_POST['password'])){
		 $db = new  dbOperation();
		if($db->userLogin($_POST['email'], $_POST['password'])){
			$user = $db->getUserByUsername($_POST['email']);
			// $salaryData = $db->getSalaryData($_POST['email'],$user['id']);
			// $user_total_salary = $db->getTotalSalary($user['id']);            
			// $user_deposite = $db->getNoOFDeposit($user['id']);
			// $user_Withdraw = $db->getNoOFWithdraw($user['id']);
			// $user_total_trans = $db->getTotalTransection($user['id']);
			// $user_total_amounts = $db->getTotalBlances($user['id']);	
			$response['error'] = false; 
			$response['id'] = $user['id'];
			$response['email'] = $user['email'];
			$response['mobile'] = $user['mobile'];
			$response['Fname'] = $user['Fname'];
			$response['Lname'] = $user['Lname'];
			$response['image'] = $user['image'];
			$response['dob_date'] = $user['dob_date'];
			$response['image_path'] = $user['image_path'];
			// $response['salaryData'] = $salaryData;
			// $response['dashboard_total_salary'] = !empty($user_total_salary)? $user_total_salary : 0 ;
            // $response['dashboard_deposite'] = !empty($user_deposite)? $user_deposite : 0 ;
            // $response['dashboard_Withdraw'] = !empty($user_Withdraw)? $user_Withdraw : 0 ;
            // $response['dashboard_total_trans'] = !empty($user_total_trans)? $user_total_trans : 0 ;
            // $response['dashboard_total_amounts'] = !empty($user_total_amounts)? $user_total_amounts : 0 ;
			

			
        

// 			$salaryData = $db->getSalaryData($user['email'] ,$user['id']);
// 			$salary_jason_data = json_encode($salaryData);
// 			print_r($salary_jason_data);
		}else{
			$response['error'] = true; 
			$response['message'] = "Invalid username or password";			
		}
	}else{
		$response['error'] = true; 
		$response['message'] = "Required fields are missing";
	}
}
echo json_encode($response);
// https://salarymanage.000webhostapp.com/Salarymanage/API/$user['image_path'];
?>