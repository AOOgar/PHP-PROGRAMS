<?php
#API for getting profile
include('connection.php');
$origin=isset($_SERVER['HTTP_ORIGIN'])?$_SERVER['HTTP_ORIGIN']:$_SERVER['HTTP_HOST'];
header('Access-Control-Allow-Origin: '.$origin);        
header('Access-Control-Allow-Methods: POST, OPTIONS, GET, PUT');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Headers: Authorization, X-Requested-With');
header('P3P: CP="NON DSP LAW CUR ADM DEV TAI PSA PSD HIS OUR DEL IND UNI PUR COM NAV INT DEM CNT STA POL HEA PRE LOC IVD SAM IVA OTC"');
header('Access-Control-Max-Age: 1');

if(isset($_POST['email'])){
	$email = $_POST['email'];
	
 
		$query=mysqli_query($mysqli,"SELECT * from corpers where email='$email' ");
	
		if($query){
			
			if(mysqli_num_rows($query) > 0){
				
				$data = mysqli_fetch_assoc($query);
		
				
			$set['kopa'] = array('username' => $data['username'], 'email' => $data['email'] , 'id' => $data['id'], 'phone' => $data['phone'], 'userStatus' => $data['status'] , 'statecode' => $data['statecode'] ,  'skills' => $data['skills'] , 'callup' => $data['callup'] , 'profile_img' => $data['profile_img'],  'deploy_state' => $data['deploy_state'], 'serving' => $data['serving'], 'hide' => $data['hide'],'status'=>'1');
		
		header( 'Content-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();
	
				
				
			}else{
				 header( 'Content-Type: application/json; charset=utf-8');
	 
				$set['kopa']=array('message' => "User not found",'status'=>'0');
	 
				 $msg = json_encode($set);
				 echo $msg;
			}
			
			
			
		}
	
	
	
}else{
	 header( 'Content-Type: application/json; charset=utf-8');
	 
	 $set['kopa']=array('message' => "Please supply the required fields",'status'=>'0');
	 
	 $msg = json_encode($set);
	 echo $msg;
}

	
?>