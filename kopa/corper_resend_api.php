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

	//retive all the entry from front-end
$username = $_GET['username'];
$email = $_GET['email'];

	
			  
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
	 
				$set['kopa']=array('message' => "Verification Mail has been Sent",'status'=>'1');
	 
				$msg = json_encode($set);
				echo $msg;
			
		  

	
?>