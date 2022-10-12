<?php
#API for Updating user profile
include('connection.php');
 $origin=isset($_SERVER['HTTP_ORIGIN'])?$_SERVER['HTTP_ORIGIN']:$_SERVER['HTTP_HOST'];
header('Access-Control-Allow-Origin: '.$origin);        
header('Access-Control-Allow-Methods: POST, OPTIONS, GET, PUT');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Headers: Authorization, X-Requested-With');
header('P3P: CP="NON DSP LAW CUR ADM DEV TAI PSA PSD HIS OUR DEL IND UNI PUR COM NAV INT DEM CNT STA POL HEA PRE LOC IVD SAM IVA OTC"');
header('Access-Control-Max-Age: 1');

if(isset($_POST['email']) && isset($_POST['former']) &&  isset($_POST['new']) && $_POST['email'] !="" ){
	

	//retive all the entry from front-end
$username = $_POST['username'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$statecode = $_POST['statecode'];
$deploy_state = $_POST['deploy_state'];
$skills = $_POST['skills'];
$callup = $_POST['callup'];
$former = $_POST['former'];
$new = $_POST['new'];

	if($former == "" && $new == "" ){
		//chanage password NOT called for, update without password 
		$qrry=mysqli_query($mysqli,"select id from `corpers` where email='$email' ");
		
		if(mysqli_num_rows($qrry) > 0){
		
		 $qry=mysqli_query($mysqli,"UPDATE corpers SET username='$username', phone='$phone', statecode='$statecode', skills='$skills', deploy_state='$deploy_state', callup='$callup' where email='$email'");
		 
		 if($qry){
			 //send json output
			   header( 'Content-Type: application/json; charset=utf-8');
	 
				$set['kopa']=array('message' => "Profile Updated successfully ",'status'=>'1');
	 
				$msg = json_encode($set);
				echo $msg; 
		 }
		 
		 
		}else{
			 //send json output
			   header( 'Content-Type: application/json; charset=utf-8');
	 
				$set['kopa']=array('message' => "Wrong email. user not found ",'status'=>'0');
	 
				$msg = json_encode($set);
				echo $msg; 
			
		}
		
	}elseif($former != "" && $new != "" ){
		//change password also requested , update profle and password
		
		//1st check that former password is correct
		$qry=mysqli_query($mysqli,"select * from `corpers` where email='$email' ");
		
		if (mysqli_num_rows($qry) > 0){
			
			$row=mysqli_fetch_array($qry);
		//compare use entry with encryted password
			if(password_verify($former, $row['password'])){
				
				
				$hashpassword = password_hash($new, PASSWORD_DEFAULT);
				
				 $query=mysqli_query($mysqli,"UPDATE corpers SET username='$username', phone='$phone', statecode='$statecode', skills='$skills',  deploy_state='$deploy_state', callup='$callup', password='$hashpassword' where email='$email'");
				
				
				if($query){
					  header( 'Content-Type: application/json; charset=utf-8');
	 
				$set['kopa']=array('message' => "Profile and password Updated successfully ",'status'=>'1');
	 
				$msg = json_encode($set);
				echo $msg; 
				}
				
				
			}else{
				header( 'Content-Type: application/json; charset=utf-8');
	 
				$set['kopa']=array('message' => "Former password is Wrong. Please input correct password",'status'=>'0');
	 
				$msg = json_encode($set);
				echo $msg;
			}
		
		}else{
			 //send json output
			   header( 'Content-Type: application/json; charset=utf-8');
	 
				$set['kopa']=array('message' => "Wrong email. user not found ",'status'=>'0');
	 
				$msg = json_encode($set);
				echo $msg; 
			
		}
	
	
		  
	}else{
	 //send json output
			   header( 'Content-Type: application/json; charset=utf-8');
	 
				$set['kopa']=array('message' => "Please fill in former and new password",'status'=>'0');
	 
				$msg = json_encode($set);
				echo $msg; 
}

}else{
	 //send json output
			   header( 'Content-Type: application/json; charset=utf-8');
	 
				$set['kopa']=array('message' => "Please fill in email.",'status'=>'0');
	 
				$msg = json_encode($set);
				echo $msg; 
}

	
?>