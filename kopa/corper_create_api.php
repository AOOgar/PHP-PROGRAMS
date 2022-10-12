<?php
#API for creating a trend
include('connection.php');
$origin=isset($_SERVER['HTTP_ORIGIN'])?$_SERVER['HTTP_ORIGIN']:$_SERVER['HTTP_HOST'];
header('Access-Control-Allow-Origin: '.$origin);        
header('Access-Control-Allow-Methods: POST, OPTIONS, GET, PUT');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Headers: Authorization, X-Requested-With');
header('P3P: CP="NON DSP LAW CUR ADM DEV TAI PSA PSD HIS OUR DEL IND UNI PUR COM NAV INT DEM CNT STA POL HEA PRE LOC IVD SAM IVA OTC"');
header('Access-Control-Max-Age: 1');


if(!isset($_POST['title']) || !isset($_POST['description']) || !isset($_POST['creator_email']) ){
	
	 header( 'Content-Type: application/json; charset=utf-8');
	 
	 $set['kopa']=array('message' => "Please supply the required fields",'status'=>'0');
	 
	 $msg = json_encode($set);
	 echo $msg;
	 
}else{
	
	//retive all the entry from front-end
$creator_email = $_POST['creator_email'];	
$created_by = $_POST['created_by'];
$title = $_POST['title'];
$description = $_POST['description'];
$category = $_POST['category'];
$date_created= date("M")." ".date("d")." ".date("Y");
$replies = 0;
	
	
	//check if entered email already exist in database
		  $qry=mysqli_query($mysqli,"select * from `corpers` where email='$creator_email' ");
		  $info = mysqli_fetch_assoc($qry);
		
		if($info['status'] == 1){
			
			
			//account status will be 0 which means not activated
		$qry = "INSERT INTO `trends` (title, description, creator_email, created_by, replies,  date_created, category) VALUES('$title', '$description', '$creator_email', '$created_by', '$replies', '$date_created', '$category')";
		
		//actual query
		 $execute = mysqli_query($mysqli,$qry);
		 
		 if($execute){
			 //when trend has been created
			 
			 
			 header( 'Content-Type: application/json; charset=utf-8');
	 
			$set['kopa']=array('message' => "New trend created successfully",'status'=>'1');
	 
			$msg = json_encode($set);
			echo $msg;	
			 
		 }
		 
		 
		 
		}else{
		
			header( 'Content-Type: application/json; charset=utf-8');
	 
			$set['kopa']=array('message' => "Please verify your account, before you can create a trend",'status'=>'0');
	 
			$msg = json_encode($set);
			echo $msg;		
			
		}
		  
		  
}



	
?>