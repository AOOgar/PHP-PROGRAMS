<?php
$origin=isset($_SERVER['HTTP_ORIGIN'])?$_SERVER['HTTP_ORIGIN']:$_SERVER['HTTP_HOST'];
header('Access-Control-Allow-Origin: '.$origin);        
header('Access-Control-Allow-Methods: POST, OPTIONS, GET, PUT');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Headers: Authorization, X-Requested-With');
header('P3P: CP="NON DSP LAW CUR ADM DEV TAI PSA PSD HIS OUR DEL IND UNI PUR COM NAV INT DEM CNT STA POL HEA PRE LOC IVD SAM IVA OTC"');
header('Access-Control-Max-Age: 1');
#API for verification
include('connection.php');
 
	 


if( !isset($_GET['email']) ){
	
	 header( 'Content-Type: application/json; charset=utf-8');
	 
	 $set['kopa']=array('message' => "Please supply an email",'status'=>'0');
	 
	 $msg = json_encode($set);
	 echo $msg;
	 
}else{
	
	$email = $_GET['email'];
	//check which action to do. 
	#actions are either verify or finished
	
	if(isset($_GET['verify']) &&  $_GET['verify'] !="" ){
		//change user status to 1
		$qry=mysqli_query($mysqli,"select * from `corpers` where email='$email'");
		
		if (mysqli_num_rows($qry) > 0){
			
			
			$query = mysqli_query($mysqli, "UPDATE corpers SET status='1' where email='$email'");
			
			if($query){
			header( 'Content-Type: application/json; charset=utf-8');
	 
				$set['kopa']=array('message' => "Account Verfication successful ",'status'=>'1');
	 
				$msg = json_encode($set);
				echo $msg;	
			}
			
			
		}else{
			header( 'Content-Type: application/json; charset=utf-8');
	 
				$set['kopa']=array('message' => "User not found",'status'=>'0');
	 
				$msg = json_encode($set);
				echo $msg;
		}
		
		
	}elseif(isset($_GET['finished']) &&  $_GET['finished'] !="" ){
		//change user profile serving to no(i.e Ex corper)
		$qry=mysqli_query($mysqli,"select * from `corpers` where email='$email'");
		
		if (mysqli_num_rows($qry) > 0){
			
			$query = mysqli_query($mysqli, "UPDATE corpers SET serving='no' where email='$email'");
			
			if($query){
			header( 'Content-Type: application/json; charset=utf-8');
	 
				$set['kopa']=array('message' => "Profile Updated, Congrats on passing Out. ",'status'=>'1');
	 
				$msg = json_encode($set);
				echo $msg;	
			}
			
			
		}else{
			header( 'Content-Type: application/json; charset=utf-8');
	 
				$set['kopa']=array('message' => "User not found",'status'=>'0');
	 
				$msg = json_encode($set);
				echo $msg;
		}
		
	}
	
	
	
	
	
	
}



	
?>