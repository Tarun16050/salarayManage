<?php
    class dbOperation{
        private $con;
        function __construct()
        {
            require_once dirname(__FILE__).'/dbConnect.php';
            $db = new dbConnect();
            $this->con =$db->connect();
        }
        // Insert data into registration_user Table 
        function createUser($Fname,$Lname,$email,$mobile,$password){
            if($this->isemailExist($email)){return 0;}
            elseif($this->ismobileExist($mobile)){return 3;}
            else{
                $pass =md5($password);
                $stmt =$this->con->prepare("INSERT INTO `registration_user`(`id`, `Fname`, `Lname`, `email`, `mobile`, `password`,`image`,`image_path`) VALUES (NULL,?,?,?,?,?,'default_image.jpg','default_image.jpg')");
                $stmt->bind_param("sssss",$Fname,$Lname,$email,$mobile,$pass);
                if($stmt->execute()){return 1;}else{return 2;}
            }
        }
        //  // Insert data into registration_user Table 
        // function createUser($Fname,$Lname,$email,$mobile,$password,$image,$image_path){
        //     if($this->isemailExist($email)){return 0;}
        //     elseif($this->ismobileExist($mobile)){return 3;}
        //     else{
        //         $pass =md5($password);
        //         $stmt =$this->con->prepare("INSERT INTO `registration_user`(`id`, `Fname`, `Lname`, `email`, `mobile`, `password`,`image`,`image_path`) VALUES (NULL,?,?,?,?,?,?,?)");
        //         $stmt->bind_param("sssssss",$Fname,$Lname,$email,$mobile,$pass,$image,$image_path);
        //         if($stmt->execute()){return 1;}else{return 2;}
        //     }
        // }
        
        // User Login query 
        public function userLogin($username, $pass){
        	$password = md5($pass);
        	$stmt = $this->con->prepare("SELECT id FROM registration_user WHERE email = ? AND password = ?");
        	$stmt->bind_param("ss",$username,$password);
        	$stmt->execute();
        	$stmt->store_result(); 
        	return $stmt->num_rows > 0; 
        }
        // Select the data into registration_user table for specific user.
        public function getUserByUsername($username){
			$stmt = $this->con->prepare("SELECT * FROM registration_user WHERE email = ?");
			$stmt->bind_param("s",$username);
			$stmt->execute();
			return $stmt->get_result()->fetch_assoc();
	    }
	    //check email is allredy present or not.
	    private function isemailExist($email){
			$stmt = $this->con->prepare("SELECT id FROM registration_user WHERE email = ?");
			$stmt->bind_param("s", $email);
			$stmt->execute(); 
			$stmt->store_result(); 
			return $stmt->num_rows > 0; 
		}
		//check mobile number is allredy present or not.
		private function ismobileExist($username){
			$stmt = $this->con->prepare("SELECT id FROM registration_user WHERE mobile = ?");
			$stmt->bind_param("s", $username);
			$stmt->execute(); 
			$stmt->store_result(); 
			return $stmt->num_rows > 0; 
		}
	    // Insert data into salary Table 
		public function createSalaryData($user_id,$user_email,$user_mobile,$amount,$date,$salary_month,$salary_year){
			$stmt =$this->con->prepare("INSERT INTO `salary`(`id`, `user_id`, `user_email`, `user_mobile`, `amount`, `amount_date` ,`salary_month`,`salary_year`) VALUES (NULL,?,?,?,?,?,?,?)");
			$stmt->bind_param("issssss",$user_id,$user_email,$user_mobile,$amount,$date,$salary_month,$salary_year);
			if($stmt->execute()){return 1;}else{return 2;}
        }
        // Select the data into salary table for specific user.
        public function getSalaryData($username,$user_id){
			$stmt = $this->con->prepare("SELECT * FROM salary WHERE user_email = ? and user_id = ? ORDER BY id DESC");
			$stmt->bind_param("si",$username,$user_id);
			$stmt->execute();
			$result = $stmt->get_result();
			$response = array(); 
			while($commissionData = $result->fetch_assoc()){
                $response['data'][] = $commissionData;
            }
            return $response;
	    }
		// Insert data into balance_history Table
		public function createBalanceHistoryData($user_id,$amount,$reason,$date,$time,$balance_Status,$total_amount){	
			$stmt =$this->con->prepare("INSERT INTO `balance_history`(`id`, `user_id`, `amount`, `reason`, `date`, `time`,`balance_Status`,`total_amount`) VALUES (NULL,?,?,?,?,?,?,?)");
            // 	$stmt->bind_param("iissssi",$user_id,$amount,$reason,$date,$time,$balance_Status,$total_amount);
            $stmt->bind_param("idssssd",$user_id,$amount,$reason,$date,$time,$balance_Status,$total_amount);
			if($stmt->execute()){return 1;}else{return 2;}
        }
        // get amount to old record of balance_history Table for specific user.
        public function getAmountBalanceHistory($user_id){
			$stmt = $this->con->prepare("SELECT * FROM balance_history WHERE user_id = ? order by id desc ");
			$stmt->bind_param("i",$user_id);
			$stmt->execute();
		    return $stmt->get_result()->fetch_assoc();
	    }
		// Select the data into balance_history table for specific user.
		public function getBalanceHistoryData($user_id){
			$stmt = $this->con->prepare("SELECT * FROM balance_history WHERE user_id = ? ORDER BY id DESC");
			$stmt->bind_param("i",$user_id);
			$stmt->execute();
			$result = $stmt->get_result();
		    while ($commissionData = $result->fetch_assoc()){
                $response['datas'][] = $commissionData;
            }
            return $response;
	    }
	    public function getTotalSalary($user_id){
			$stmt = $this->con->prepare("SELECT  SUM(amount) AS total_salary FROM salary WHERE user_id = ? GROUP BY user_id ORDER BY id DESC");
			$stmt->bind_param("i", $user_id);
			$stmt->execute();
			
			$res = $stmt->get_result()->fetch_assoc()['total_salary'];
			$formatted_salary = number_format((float)$res, 2, '.', '');
			return $formatted_salary;
// 			return $stmt->get_result()->fetch_assoc()['total_salary'];
			// $result = $stmt->get_result();
			// $response = array('datas' => array());		
			// while ($salaryData = $result->fetch_assoc()){
			// 	$response['datas'][] = $salaryData;
			// }		
			// return $response;
		}
		public function getNoOFDeposit($user_id){
            $stmt = $this->con->prepare("SELECT  COUNT(balance_Status) AS balance_Status FROM balance_history WHERE user_id = ? AND balance_Status = 'Deposit' GROUP BY user_id ORDER BY id DESC");
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            return $stmt->get_result()->fetch_assoc()['balance_Status'];
        }
    	public function getNoOFWithdraw($user_id){
            $stmt = $this->con->prepare("SELECT  COUNT(balance_Status) AS balance_Status FROM balance_history WHERE user_id = ? AND balance_Status = 'Withdraw' GROUP BY user_id ORDER BY id DESC");
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            return $stmt->get_result()->fetch_assoc()['balance_Status'];
        }
        public function getTotalTransection($user_id){
            $stmt = $this->con->prepare("SELECT COUNT(balance_Status) AS balance_Status FROM balance_history WHERE user_id = ?   ORDER BY id DESC");
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            return $stmt->get_result()->fetch_assoc()['balance_Status'];
        }
        public function getTotalBlances($user_id){
            // $stmt = $this->con->prepare("SELECT user_id, total_amount  FROM balance_history WHERE user_id = ?  GROUP BY user_id ORDER BY id DESC");
            // $stmt->bind_param("i", $user_id);
            // $stmt->execute();
            // return $stmt->get_result()->fetch_assoc();
             $stmt = $this->con->prepare("SELECT total_amount FROM balance_history WHERE user_id = ? ORDER BY id DESC LIMIT 1");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        return $result->fetch_assoc()['total_amount'];
    } else {
        return null; // or any default value you prefer
    }
        }

        // public function emailtemplate(){
        //     $stmt = $this->con->prepare("SELECT template_content FROM email_templates WHERE id = 1");
        //     $stmt->execute();
        //     $result = $stmt->get_result()->fetch_assoc()['template_content'];
        //     return $stmt->get_result()->fetch_assoc()['template_content'];
        // }
        
        public function emailtemplate() {
            $stmt = $this->con->prepare("SELECT template_content FROM email_templates WHERE id = 1");
            $stmt->execute();
            $result = $stmt->get_result()->fetch_assoc();  // Fetch the result once
            return $result['template_content'];  // Return the template content
        }

        public function editProfile($id, $email, $fname, $lname, $dob, $image)
    {
        $stmt = $this->con->prepare("SELECT * FROM registration_user WHERE email = ? AND id = ?");
        $stmt->bind_param("si", $email, $id);
        $stmt->execute();
        $user_data =  $stmt->get_result()->fetch_assoc();
        if (!empty($image)) {
            $image = str_replace(' ','_',$image);
            $image_decode = base64_decode($image ); 
            $filename = 'user_' . rand() . ".jpg";
            file_put_contents("uploads/" . $filename, $image_decode);
        } else {
            $filename = "default_image.jpg";
        }
        $fname = !empty($fname) ? $fname : $user_data['Fname'];
        $lname = !empty($lname) ? $lname : $user_data['Lname'];
        $dob = !empty($dob) ? $dob : $user_data['dob_date'];
        // $dob = !empty($dob)? date('Y-m-d',$dob) : $user_data['dob_date'];
        $dob = !empty($dob) ? date('Y-m-d', strtotime($dob)) : $user_data['dob_date'];
        if($filename == "default_image.jpg"){
            $filename = $user_data['image_path'] ?$user_data['image_path']:$filename;
        }
        $stmt = $this->con->prepare("UPDATE `registration_user` SET `Fname`='$fname',`Lname`='$lname',`image`='$filename',`image_path`='$filename',`dob_date`='$dob' WHERE `id` = '$id' AND `email` = '$email' ");
        if ($stmt->execute()) {
            $stmt = $this->con->prepare("SELECT * FROM registration_user WHERE email = ? AND id = ?");
            $stmt->bind_param("si", $email, $id);
            $stmt->execute();
            return $stmt->get_result()->fetch_assoc();
        } else {
            return 2;
        }
    }
    public function createNotes($user_id,$amount,$notes,$date){
        $stmt =$this->con->prepare("INSERT INTO `notes`(`id`, `user_id`, `amount`, `description`, `date`) VALUES (NULL,?,?,?,?)");
        $stmt->bind_param("isss",$user_id,$amount,$notes,$date);
        if($stmt->execute()){return 1;}else{return 2;}
    }
    // Select the data into notes table for specific user. 
    public function getNotesData($user_id){
        $stmt = $this->con->prepare("SELECT * FROM notes WHERE user_id = ? ORDER BY id DESC");
        $stmt->bind_param("i",$user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $response = array(); 
        while($commissionData = $result->fetch_assoc()){
            $response['data'][] = $commissionData;
        }
        return $response;
    }
    public function deletNotes($user_id, $notes_id){
        $stmt =$this->con->prepare("DELETE FROM notes WHERE user_id = ? AND id = ? ");
        $stmt->bind_param("si",$user_id,$notes_id);
        if($stmt->execute()){return 1;}else{return 2;}
    }
    public function updateNotes($user_id, $notes_id,$amount, $description, $date, $updated_at){
        $stmt =$this->con->prepare("UPDATE notes SET amount = ?, description = ?, date = ?, update_at = ? WHERE id = ? AND user_id = ? ");
        $stmt->bind_param("ssssii",$amount, $description, $date, $updated_at, $notes_id, $user_id);
        if($stmt->execute()){return 1;}else{return 2;}
    }

    public function deletSalary($user_id, $salary_id){
        $stmt =$this->con->prepare("DELETE FROM salary WHERE user_id = ? AND id = ? ");
        $stmt->bind_param("si",$user_id,$salary_id);
        if($stmt->execute()){return 1;}else{return 2;}
    }
    public function updateSalary($user_id, $salary_id,$amount, $salary_month, $salary_year, $date, $updated_at){
        $stmt =$this->con->prepare("UPDATE salary SET amount = ?, salary_month = ?,  salary_year = ?,  amount_date = ?, updated_at = ? WHERE id = ? AND user_id = ? ");
        $stmt->bind_param("sssssii",$amount, $salary_month, $salary_year, $date, $updated_at, $salary_id, $user_id);
        if($stmt->execute()){return 1;}else{return 2;}
    }

    public function deletHistory($user_id, $history_id){
        $stmt =$this->con->prepare("DELETE FROM balance_history WHERE user_id = ? AND id = ? ");
        $stmt->bind_param("si",$user_id,$history_id);
        if($stmt->execute()){return 1;}else{return 2;}
    }

    public function updateHistory($user_id, $history_id,$reason, $date, $updated_at){
        $stmt =$this->con->prepare("UPDATE balance_history SET reason = ?, date = ?, update_at = ? WHERE id = ? AND user_id = ? ");
        $stmt->bind_param("sssii",$reason, $date, $updated_at, $history_id, $user_id);
        if($stmt->execute()){return 1;}else{return 2;}
    }

    }
?>