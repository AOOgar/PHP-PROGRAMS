<?php
#API for registration
include('connection.php');
$origin=isset($_SERVER['HTTP_ORIGIN'])?$_SERVER['HTTP_ORIGIN']:$_SERVER['HTTP_HOST'];
header('Access-Control-Allow-Origin: '.$origin);        
header('Access-Control-Allow-Methods: POST, OPTIONS, GET, PUT');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Headers: Authorization, X-Requested-With');
header('P3P: CP="NON DSP LAW CUR ADM DEV TAI PSA PSD HIS OUR DEL IND UNI PUR COM NAV INT DEM CNT STA POL HEA PRE LOC IVD SAM IVA OTC"');
header('Access-Control-Max-Age: 1');

if(!isset($_POST['username']) || !isset($_POST['password']) || !isset($_POST['email']) ){
	
	 header( 'Content-Type: application/json; charset=utf-8');
	 
	 $set['kopa']=array('message' => "Please supply the required fields",'status'=>'0');
	 
	 $msg = json_encode($set);
	 echo $msg;
	 
}else{
	
	//retive all the entry from front-end
$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$stateCode = $_POST['statecode'];
$deploy_state = $_POST['deploy_state'];

	
	
	//check if entered email already exist in database
		  $qry=mysqli_query($mysqli,"select * from `corpers` where email='$email' ");
		  $num = mysqli_num_rows($qry);
		
		if($num <= 0){
			
			//encryt password before sending to datebase
			$hashpassword = password_hash($password, PASSWORD_DEFAULT);
			
			//account status will be 0 which means not activated
		$qry = "INSERT INTO `corpers` (username, password, email, phone, statecode,  deploy_state, status, serving) VALUES('$username', '$hashpassword', '$email', '$phone', '$stateCode', '$deploy_state', '0', 'yes')";
		//actual query
		 $execute = mysqli_query($mysqli,$qry);
		 
		  if ($execute) {
			  //user Registered successfully
			  
			  //register curl for welcome email
			  
			   $fields = '{"personalizations": [{"to": [{"email": "'.$email.'"}],"dynamic_template_data":{"username": "'.$username.'", "email":"'.$email.'"}}],"from": {"email": "info@trendingad.com", "name":"Kopa"},"template_id": "d-de80169a186242dfa7b2926daee46f96", "reply_to":{"email":"info@trendingad.com"}}';
				
				$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "https://api.sendgrid.com/v3/mail/send");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Authorization: Bearer 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'
    ));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
    
    $response = curl_exec($ch);
    curl_close($ch);		  
			  
			  
			  
			  //send json output
			   header( 'Content-Type: application/json; charset=utf-8');
	 
				$set['kopa']=array('message' => "Registration Successful.".$username." has been registered ",'status'=>'1');
	 
				$msg = json_encode($set);
				echo $msg;
			
		  }
			
		}else{
		
			header( 'Content-Type: application/json; charset=utf-8');
	 
			$set['kopa']=array('message' => "Email already exist. Please use another email",'status'=>'0');
	 
			$msg = json_encode($set);
			echo $msg;		
			
		}
		  
		  
}



	
?>