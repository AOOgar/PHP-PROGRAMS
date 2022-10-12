<?php
$origin=isset($_SERVER['HTTP_ORIGIN'])?$_SERVER['HTTP_ORIGIN']:$_SERVER['HTTP_HOST'];
header('Access-Control-Allow-Origin: '.$origin);        
header('Access-Control-Allow-Methods: POST, OPTIONS, GET, PUT');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Headers: Authorization, X-Requested-With');
header('P3P: CP="NON DSP LAW CUR ADM DEV TAI PSA PSD HIS OUR DEL IND UNI PUR COM NAV INT DEM CNT STA POL HEA PRE LOC IVD SAM IVA OTC"');
header('Access-Control-Max-Age: 1');
#API for registration
include('connection.php');
 
	 


if( !isset($_POST['password']) || !isset($_POST['email']) ){
	
	 header( 'Content-Type: application/json; charset=utf-8');
	 
	 $set['kopa']=array('message' => "Please suppply the required fields",'status'=>'0');
	 
	 $msg = json_encode($set);
	 echo $msg;
	 
}else{
	
	//retive all the entry from front-end

	$password = $_POST['password'];
	$email = $_POST['email'];

	
	//since password is encryted want to check if user exist first
		$qry=mysqli_query($mysqli,"select * from `corpers` where email='$email'");
		
		  //if num of rows is 0 user not found
		if (mysqli_num_rows($qry) > 0){
			
			$row=mysqli_fetch_array($qry);
		//compare use entry with encryted password
			if(password_verify($password, $row['password'])){
				header( 'Content-Type: application/json; charset=utf-8');
	 
				$set['kopa']=array('message' => "Login Successful. ".$row['username']." has been Recognized",'status'=>'1');
	 
				$msg = json_encode($set);
				echo $msg;
				
				
			}else{
				header( 'Content-Type: application/json; charset=utf-8');
	 
				$set['kopa']=array('message' => "Wrong Password. Please Check your Password",'status'=>'0');
	 
				$msg = json_encode($set);
				echo $msg;
			}
			
			
		}else{
			 header( 'Content-Type: application/json; charset=utf-8');
	 
			$set['kopa']=array('message' => "Wrong Email. No User With this email",'status'=>'0');
	 
			$msg = json_encode($set);
			echo $msg;
			
		}
		  
}



	
?>