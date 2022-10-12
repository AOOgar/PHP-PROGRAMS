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
	#actions are either hide or unhide NYSC Codes
	
	if(isset($_GET['hide']) &&  $_GET['hide'] !="" ){
		//change user hide to 1
		$qry=mysqli_query($mysqli,"select * from `corpers` where email='$email'");
		
		if (mysqli_num_rows($qry) > 0){
			
			
			//check if query id to hide or unhide nysc codes
			
			if($_GET['hide'] == "yes"){
				
				$query = mysqli_query($mysqli, "UPDATE corpers SET hide='1' where email='$email'");
			
				if($query){
				header('Content-Type: application/json; charset=utf-8');
		 
					$set['kopa']=array('message' => "Nysc Codes hidden Successfully ",'status'=>'1');
		 
					$msg = json_encode($set);
					echo $msg;	
				}
			}elseif($_GET['hide'] == "no"){
				
				$query = mysqli_query($mysqli, "UPDATE corpers SET hide='0' where email='$email'");
			
				if($query){
				header('Content-Type: application/json; charset=utf-8');
		 
					$set['kopa']=array('message' => "Nysc Codes Unhidden Successfully ",'status'=>'1');
		 
					$msg = json_encode($set);
					echo $msg;	
				}
				
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