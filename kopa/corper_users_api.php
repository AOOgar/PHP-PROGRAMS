<?php
$origin=isset($_SERVER['HTTP_ORIGIN'])?$_SERVER['HTTP_ORIGIN']:$_SERVER['HTTP_HOST'];
header('Access-Control-Allow-Origin: '.$origin);        
header('Access-Control-Allow-Methods: POST, OPTIONS, GET, PUT');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Headers: Authorization, X-Requested-With');
header('P3P: CP="NON DSP LAW CUR ADM DEV TAI PSA PSD HIS OUR DEL IND UNI PUR COM NAV INT DEM CNT STA POL HEA PRE LOC IVD SAM IVA OTC"');
header('Access-Control-Max-Age: 1');
#API for seeing others corpers
include('connection.php');
 
	 
	//retive all the entry from front-end

	//size optional
	if(isset($_GET['size'])){
		$size = $_GET['size'];
	}else{
		$size = 20;
	}
	
	//email optional
	if(isset($_GET['email']) && $_GET['email'] !=""){
		$email = $_GET['email'];
	}else{
		$email = " ";
	}
	
	$jsonObj= array();	
	
	//since password is encryted want to check if user exist first
		$qry=mysqli_query($mysqli,"SELECT * from corpers  ORDER BY id DESC limit $size");
		
		  //if num of rows is 0 user not found
		if (mysqli_num_rows($qry) > 0){
			
			while($data = mysqli_fetch_assoc($qry))
		{
			
			if($email == $data['email']){
				continue;
			}
			
			$row['id'] = $data['id'];
			$row['username'] = $data['username'];
			$row['email'] = $data['email'];
			$row['phone'] = $data['phone'];
			$row['statecode'] = $data['statecode'];
			$row['skills'] = $data['skills'];
			
			$row['callup'] = $data['callup'];
			$row['deploy_state'] = $data['deploy_state'];
			$row['serving'] = $data['serving'];
 			 

			array_push($jsonObj,$row);
		
		}

		$set['kopa'] = $jsonObj;
		
		header( 'Content-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();
			
		}
		  




	
?>