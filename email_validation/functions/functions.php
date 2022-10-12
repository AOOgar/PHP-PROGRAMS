<?php
/******** helper functions ********************/
function clean ($string){
	return htmlentities($string);
}

function redirect ($location){
	return header ("Location: {$location}");
}

function set_messages($message){
	if (!empty($message)) {
		# code...
		$_SESSION['message'] = $message;
	}
	else{
		$message = "";
	}
}

function display_message(){
	if (isset($_SESSION['message'])) {
		# code...
		echo $_SESSION['message'];
		unset($_SESSION['message']);
	}
}

function token_generator(){
	$token =  $_SESSION['token'] = md5(uniqid(mt_rand(), true));
	return $token;
}

function validaton_errors($error_message){

$error_message = <<<DELIMITER
<div class="alert alert-danger alert-dismissible" role="alert">
<button type="button" class="close" data-dismiss="alert" arie-label="Close">
<span arial-hidden="true">&times;</span></button>
<strong>Warning!</strong>$error_message

DELIMITER;
return $error_message;

}


function email_exists($email){
	$sql = "SELECT * FROM users WHERE email = '$email'";
	$result = query($sql);

	if (row_count($result) == 1) {
		return true;
	}
	else
	{
		return false;
	}
}


function username_exists($username){
	$sql = "SELECT  * FROM users WHERE username = '$username'";
	$result = query($sql);

	if (row_count($result) == 1) {
		return true;
	}
	else
	{
		return false;
	}
}


function send_email($email, $subject, $msg, $header){
	return mail($email, $subject, $msg, $header);
}


/******** validation functions ********************/

function validate_user_registration(){
	
	$errors = [];

	$min = 3;
	$max = 20;


	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		
		$first_name 		= 	clean($_POST['first_name']);
		$last_name 			= 	clean($_POST['last_name']);
		$email	 			= 	clean($_POST['email']);
		$username	 		= 	clean($_POST['username']);
		$password	 		= 	clean($_POST['password']);
		$confirm_password	= 	clean($_POST['confirm_password']);

		if (strlen($first_name) < $min) {
		$errors[] = "First Name can not be less than {$min} characters";
		}

		if (strlen($first_name) > $max) {
		$errors[] = "First Name can not be greater than {$max} characters";
		}

		if (strlen($last_name) < $min) {
		$errors[] = "Last Name can not be less than {$min} characters";
		}

		if (strlen($last_name) > $max) {
		$errors[] = "Last Name can not be greater than {$max} characters";
		}

		if (strlen($email) < $min) {
		$errors[] = "Email can not be less than {$min} characters";
		}

		if (strlen($email) > $max) {
		$errors[] = "Email can not be greater than {$max} characters";
		}

		if (email_exists($email)) {
			$errors[] = "Sorry email alrady exixt";
		}

		if (strlen($username) < $min) {
		$errors[] = "Username can not be less than {$min} characters";
		}

		/*if (strlen($username) > $max) {
		$errors[] = "Username can not be greater than {$max} characters";
		}*/

		if (username_exists($username)) {
			$errors[] = "Sorry username alrady exixt";
		}

		if ($password != $confirm_password) {

			$errors[] = "Your password fields do not match";
		}

		if (!empty($errors)) {
			foreach ($errors as $key => $error) {
				
			/****** Display validation errors   ******************/
			echo validaton_errors($error);
	
			}
		}
		else{
			if (register_user($first_name, $last_name,$username,$email,$password)) {
				
				set_messages("Please chech your email or spam for activation link");
				redirect("index.php");			
			} else{


				set_messages("Sorry we can not register the user");
				redirect("index.php");		


			}
		}
	}// validation ends here
}//function ends here


/****** register users function   ******************/
function register_user($first_name, $last_name,$username,$email,$password){

		$first_name 		= 	clean($first_name);
		$last_name 			= 	clean($last_name);
		$email	 			= 	clean($email);
		$username	 		= 	clean($username);
		$password	 		= 	clean($password);

	if (email_exists($email)) {
		return false;
	}
	else if (username_exists($username)) {
		return false;
	}
	else{
		$password = md5($password);
		$validation_code = md5($username . microtime());
		$insert = "INSERT INTO users(first_name, last_name, username, validation_code, email, password, active)";
		$insert.= "VALUE('$first_name', '$last_name', '$username', '$validation_code', '$email', '$password',  0)";
		$show_result = query($insert);
		confirm($show_result);

		$subject 	= "Activate Account";
		$msg 		= "Please click the link below the activate your account
		http://localhost/email_validation/activate.php?email=$email&code=$validation_code";
		$header 	= "From: noreply@ourwebsite.com";

		send_email($email, $subject, $msg, $header);
		
		return true;
	}

}


/****** Activate user function   ******************/

function activate_user(){
	if ($_SERVER['REQUEST_METHOD'] == "GET") {

		if (isset($_GET['email'])) {
			$email = clean($_GET['email']);
			$validation_code = clean($_GET['code']);

			$activation = "SELECT users_id FROM users WHERE email = '".escape($_GET['email'])."' AND validation_code = '".escape($_GET['code'])."'";
			$result = query($activation);
			confirm($result);

			if (row_count($result) == 1) {

				$updateCode = "UPDATE users SET active = 1, validation_code = 0 WHERE email = '".escape($email)."' AND validation_code ='".escape($validation_code)."'";
				$resultUpdate = query($updateCode);
				confirm($resultUpdate);
				set_messages("Your account had been activated, please login to continue");
				redirect("index.php");
				
			}else{
				set_messages("Your account can not be activated, please try again");
				redirect("index.php");

			}
		}
	}
}

/****** Validate user login   ******************/
function validate_user_login(){
	
	$errors = [];

	$min = 3;
	$max = 20;

	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		$email	 			= 	clean($_POST['email']);
		$password	 		= 	clean($_POST['password']);
		$remember	 		= 	isset($_POST['remember']);

		if (empty($email)) {
			$errors[] = "Email field cannot be empty";
		}

		if (empty($password)) {
			$errors[] = "Email field cannot be empty";
		}


		if (!empty($errors)) {
			foreach ($errors as $key => $error) {
				
			/****** Display validation errors   ******************/
			echo validaton_errors($error);
	
			}
		}
		else{

			if (login_user($email, $password, $remember)) {
				redirect("redirect_dashboard.php");
			}
			else{

				echo validaton_errors("Your credentials are not correct");
			}
		}
	}
}// functin to validate user login ends here


/****** Login Function  ******************/

function login_user($email, $password, $remember)
{
	$database 	= "SELECT password, email FROM users WHERE email = '".escape($email)."' AND ACTIVE = 1";
	$result 	= query($database);
	if (row_count($result) == 1)
	{
		$row 			= fetch_array($result);
		$db_password 	= $row['password'];

		if (md5($password) === $db_password) {

			if ($remember == "on") {
		
				setcookie('email', $email, time() + 86400);
			}

			$_SESSION['email'] = $email;
		
			return true;
		}
	}
	else{
		return false;
	}
}// end of functions for login here

/****** Logged Function  ******************/
function logged_in(){
	if (isset($_SESSION['email']) || isset($_COOKIE['email'])) {
		return true;
	} else
	{
		return false;
	}
}// end logged in function

/****** Recover password  ******************/
function recover_password(){
	if ($_SERVER['REQUEST_METHOD'] == "POST") 
	{
		if (isset($_SESSION['token']) && $_POST['token'] === $_SESSION['token']) 
		{

			$email = clean($_POST['email']);

			if (email_exists($email)) 
			{
				$validation_code = md5($email + microtime());
				setcookie('temp_access_code', $validation_code, time()+60);
				$sql = "UPDATE users SET validation_code = '".escape($validation_code)."' WHERE email = '".escape($email)."'";
				$result = query($sql);
				confirm($result);
				$subject = "Please reset your password";
				$message = "Here is your password reset code {$validation_code}
				click here to reset your password http://localhost/email_validation/code.php?email=$email&code=$validation_code";
				$header = "From: noreply@youurwebsite.com";
				if(send_email($email, $subject, $message, $header))
				{

					echo validaton_errors("Email could not be send");
					
				}

				set_messages("Please check your email or spam folder for password reset code");
				redirect("index.php");
				
			}
			else
			{

				echo validaton_errors("This email does not exist");
			}
			
			
		}
	}

}// recover password ends here

/****** Code validation functino starts from here ******************/
function validate_code(){
	if (isset($_COOKIE['temp_access_code'])) {

			if (!isset($_GET['email']) && !isset($_GET['code'])) {
				redirect("index.php");
				
			}else if(empty($_GET['email']) || empty($_GET['code'])){

				redirect("index.php");

			}else{
				if (isset($_POST['code'])) {
					
					$email = clean($_GET['email']);
					$validation_code = clean($_POST['code']);

					$sql = "SELECT users_id FROM users WHERE validation_code='".escape($validation_code)."' AND email = '".escape($email)."'";
					$result = query($sql);

					if (row_count($result) ==1) {

						setcookie('temp_access_code', $validation_code, time()+300);

						redirect("recoverPassword.php?email=$email&code=$validation_code");
					}else{
						echo validaton_errors("Sorry, wrong validation code");
					}

				}
			}
	}
	else{
		set_messages("Sorry your validation code has expired.");
		redirect("resetPassword.php");

	}
}

/****** Password reset function  ******************/

function password_reset(){
	if (isset($_COOKIE['temp_access_code'])) {

		if (isset($_GET['email']) && isset($_GET['code'])) {

			if (isset($_SESSION['token']) && isset($_POST['token'])){

				if($_POST['token'] === $_SESSION['token']) {

					if ($_POST['password']===$_POST['confirm_password']) {

						$updated_password  = md5($_POST['password']);

							$sql = "UPDATE users SET password = '".escape($updated_password)."', validation_code = 0 WHERE email = '".escape($_GET['email'])."'";
								$result = query($sql);

								set_messages("Congratulations, password successfully changed.");
								redirect("index.php");
					
						}

					}
				}
			} 
		}else{
		set_messages("Sorry your time as expired");
		redirect("resetPassword.php");
	}
}	