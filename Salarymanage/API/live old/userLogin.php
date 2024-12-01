<?php
    require_once'../php/dbOperation.php';
    $response = array();
    $salaryrecord = array();
    if($_SERVER['REQUEST_METHOD']=='POST'){
	if(isset($_POST['email']) and isset($_POST['password'])){
		 $db = new  dbOperation();
		if($db->userLogin($_POST['email'], $_POST['password'])){
			$user = $db->getUserByUsername($_POST['email']);
			$response['error'] = false; 
			$response['id'] = $user['id'];
			$response['email'] = $user['email'];
			$response['mobile'] = $user['mobile'];
			$response['Fname'] = $user['Fname'];
			$response['Lname'] = $user['Lname'];
			$response['image'] = $user['image'];
			$response['image_path'] = $user['image_path'];
			
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