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

	
	
	//email optional
	if(isset($_GET['category']) && $_GET['category'] !=""){
		$category = $_GET['category'];
	
	
	$jsonObj= array();	
	
	//since password is encryted want to check if user exist first
		$qry=mysqli_query($mysqli,"SELECT * from trends where category='$category' ORDER BY id DESC limit 50");
		
		  //if num of rows is 0 user not found
		if (mysqli_num_rows($qry) > 0){
			
			while($data = mysqli_fetch_assoc($qry))
		{
			
			
			$row['id'] = $data['id'];
			$row['title'] = $data['title'];
			$row['description'] = $data['description'];
			$row['creator_email'] = $data['creator_email'];
			$row['created_by'] = $data['created_by'];
			$row['replies'] = $data['replies'];
			
			$row['date_created'] = $data['date_created'];
			$row['category'] = $data['category'];
 			 

			array_push($jsonObj,$row);
		
		}

		$set['kopa'] = $jsonObj;
		
		header( 'Content-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();
			
		}
		  

}else{
		
		header( 'Content-Type: application/json; charset=utf-8');
	 
			$set['kopa']=array('message' => "Please add a category",'status'=>'0');
	 
			$msg = json_encode($set);
			echo $msg;		
		
	}


	
?>