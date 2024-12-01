<?php
    require_once'../php/dbOperation.php';
    $response = array();
    $salaryrecord = array();
    if($_SERVER['REQUEST_METHOD']=='POST'){
	if(isset($_POST['id']) and isset($_POST['email']) and isset($_POST['fname']) and isset($_POST['lname']) and isset($_POST['dob'])){
		 $db = new  dbOperation();
			$user = $db->editProfile($_POST['id'],$_POST['email'],$_POST['fname'],$_POST['lname'],$_POST['dob'],$_POST['uploadimage']);
			if($user != 2){
			$response['error'] = false; 
			$response['id'] = $user['id'];
			$response['email'] = $user['email'];
			$response['mobile'] = $user['mobile'];
			$response['Fname'] = $user['Fname'];
			$response['Lname'] = $user['Lname'];
			$response['image'] = $user['image'];
			$response['image_path'] = $user['image_path'];
            $response['dob_date'] = $user['dob_date'];
			}else{
				$response['error'] = true; 
				$response['message'] = "Something went wrong";
			}
	}else{
		$response['error'] = true; 
		$response['message'] = "Required fields are missing";
	}
}
echo json_encode($response);
?>