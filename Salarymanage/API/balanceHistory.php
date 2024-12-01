<?php
    require_once'../php/dbOperation.php';
    $response = array();
    if($_SERVER['REQUEST_METHOD']=='POST'){
        if(isset($_POST['user_id']) && isset($_POST['amount']) && isset($_POST['reason']) && isset($_POST['date']) && isset($_POST['time']) && isset($_POST['balance_Status']) ){     
            $db = new  dbOperation();
			$checks = $db->getAmountBalanceHistory($_POST['user_id']);
			if($checks){$total_blc = $checks['total_amount'];}else{$total_blc = 0;}
			if($_POST['balance_Status'] =='Withdraw'){
			    $total_amounts = $total_blc - $_POST['amount'];
			    if($total_blc > $_POST['amount']){
    			$result = $db->createBalanceHistoryData($_POST['user_id'],$_POST['amount'],$_POST['reason'],$_POST['date'],$_POST['time'],$_POST['balance_Status'],$total_amounts);
                if($result == 1){
                    $response['error']=false;
                    $response['message']= "Withdraw Success";         
                }
                elseif($result == 2){
                    $response['error']=true;
                    $response['message']= "Some error occurred please try again..";
                }
			    }
			    else{
			        $response['error']=true;
                    $response['message']= "Amount is not satisfied";
			    }
			}
			elseif($_POST['balance_Status'] =='Deposit'){
			    $total_amounts = $total_blc + $_POST['amount'];
			    $result = $db->createBalanceHistoryData($_POST['user_id'],$_POST['amount'],$_POST['reason'],$_POST['date'],$_POST['time'],$_POST['balance_Status'],$total_amounts);
                if($result == 1){
                    $response['error']=false;
                    $response['message']= "Successfully Deposit";               
                }
                elseif($result == 2){
                    $response['error']=true;
                    $response['message']= "Some error occurred please try again..";
                }     
			}
        }
        else{
            $response['error']=true;
            $response['message']= "Required fields are missing";
        }
    }
    else{
        $response['error']=true;
        $response['message']= "Invalid Request(!post)";
    }
    echo json_encode($response);
?>