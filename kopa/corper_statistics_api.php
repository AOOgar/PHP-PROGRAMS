<?php
$origin=isset($_SERVER['HTTP_ORIGIN'])?$_SERVER['HTTP_ORIGIN']:$_SERVER['HTTP_HOST'];
header('Access-Control-Allow-Origin: '.$origin);        
header('Access-Control-Allow-Methods: POST, OPTIONS, GET, PUT');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Headers: Authorization, X-Requested-With');
header('P3P: CP="NON DSP LAW CUR ADM DEV TAI PSA PSD HIS OUR DEL IND UNI PUR COM NAV INT DEM CNT STA POL HEA PRE LOC IVD SAM IVA OTC"');
header('Access-Control-Max-Age: 1');
#API for statistics
include('connection.php');
 
	 
	//need to retrun the total register members, number of questions asked, number of unaswered questions
	
	//get members
	$query1 = mysqli_query($mysqli, "SELECT id from corpers");
	$members = mysqli_num_rows($query1);
	
	$query2 = mysqli_query($mysqli, "SELECT id from trends");
	 $trends = mysqli_num_rows($query2);
	 
	 $query3 = mysqli_query($mysqli, "SELECT id from trends where replies =0");
	 $unanswered = mysqli_num_rows($query3);
	 
	 
		$set['kopa'] = array('members' => $members,'trends' => $trends,'unanswered' =>$unanswered, 'status'=>'1');
		
		header( 'Content-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();
			
		
		  




	
?>