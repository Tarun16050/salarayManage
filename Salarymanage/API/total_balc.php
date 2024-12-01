<?php
    require_once'../php/dbOperation.php';
    $response = array();
    if($_SERVER['REQUEST_METHOD']=='POST'){
        
            $db = new  dbOperation();
			$checks = $db->getAmountBalanceHistory($_POST['user_id']);
			print_r($checks);  
			if($checks){$total_blc = $checks['total_amount'];}else{$total_blc = 0;}
			print_r("Total Balance = ".$total_blc);
			
    }