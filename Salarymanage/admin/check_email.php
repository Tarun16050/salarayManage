<?php
    // include '../database.php';

    // $email = $_POST['email'];
    // $email = mysqli_real_escape_string($con, $email);
    // $sql = "SELECT * FROM registration_user WHERE `email` = '{$email}'";
    // $result = mysqli_query($con, $sql);
    // if (!$result) { 
    //     die('Error in SQL query: ' . mysqli_error($con));
    // }
    // $user_data = mysqli_fetch_array($result, MYSQLI_ASSOC);
    // if ($user_data) {
    //     $response = array('success' => true, 'data' => $user_data);
    // } else {
    //     $response = array('success' => false, 'message' => 'No user found with that email address.');
    // }
    // // print_r($user_data);
    // $data = mysqli_free_result($result);
    // mysqli_close($con);

    // header('Content-Type: application/json');
    // echo json_encode($response);


    include '../database.php';
	$remaing_amount = '';
    $email = $_POST['email'];
    $email = mysqli_real_escape_string($con, $email);
    $sql = "SELECT * FROM registration_user WHERE `email` = '{$email}'";
    $result = mysqli_query($con, $sql);
    $transactionHistory = !empty($_POST['urlname'])?$_POST['urlname']:'';
    if (!$result) { die('Error in SQL query: ' . mysqli_error($con)); }
    $user_data = mysqli_fetch_array($result, MYSQLI_ASSOC);	
    if ($user_data) {	
		$user_ids = $user_data['id'];
		if($transactionHistory == 'transactionHistory' && $user_ids){
			$query = "SELECT * FROM balance_history WHERE `user_id` = '{$user_ids}' ORDER BY id DESC LIMIT 1";
			$result_query = mysqli_query($con, $query);
			$total_amounts = mysqli_fetch_array($result_query, MYSQLI_ASSOC);
			$remaing_amount  = !empty($total_amounts['total_amount']) ? $total_amounts['total_amount']:0;
		}
		if($remaing_amount){ $response = array('success' => true, 'total_amount' => $remaing_amount, 'data' => $user_data);	}
		else{ $response = array('success' => true, 'total_amount' => $remaing_amount,'data' => $user_data); }
    } else { $response = array('success' => false, 'message' => 'No user found with that email address.');}
    $data = mysqli_free_result($result);
    mysqli_close($con);
    // header('Content-Type: application/json');
    echo json_encode($response);
?>
