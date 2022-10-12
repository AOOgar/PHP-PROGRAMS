<?php
//start a session
session_start();

//if session is set
if(isset($_SESSION['id'])){
	header('location:dashboard.php');
}

//add conection
include('connect.php');

//if login button is clicked
if(isset($_POST['login'])){
	//retrivre info
	$email = $_POST['email'];
	$password = $_POST['password'];
	
	$log = mysqli_query($mysqli, "SELECT * FROM admins where email ='$email' && password ='$password' ");
	
	if(mysqli_num_rows($log) < 1){
		
		$_SESSION['err']="Wrong email or Password";
		
	}else{
		$rows = mysqli_fetch_array($log);
		
		$_SESSION['id'] = $rows['id'];
		
		header('location:dashboard.php');
	
	}
	
	
	
}


?>

<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Ebonyi For Umahi</title>
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
  <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900'>
<link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>

      <link rel="stylesheet" href="asset/css/style.css">

</head>

<body>
  
<div class="container">
  <div class="info">
    <h1>Ebonyi For Umahi</h1>
  </div>
</div>
<div class="form">
  <div class="thumbnail"><i class="fa fa-user fa-3x" style="color:white"></i></div>
 
 <?php
 if(isset($_SESSION['err'])){
	 echo $_SESSION['err'];
	 unset($_SESSION['err']);
 }
 
 ?>
  
  <form class="login-form" method="post">
    <input type="email" placeholder="Email"name="email" required="required"/>
    <input type="password" placeholder="password" name="password" required="required"/>
	
    <button type="submit" name="login" id="login">login</button>
    
  </form>
</div>


  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

    <script  src="asset/js/index.js"></script>

</body>
</html>
