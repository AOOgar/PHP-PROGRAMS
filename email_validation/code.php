<!DOCTYPE html>
<html lang="en">

<!--================================================================================
	Item Name: Materialize - Material Design Admin Template
	Version: 3.0
	Author: GeeksLabs
	Author URL: http://www.themeforest.net/user/geekslabs
================================================================================ -->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="msapplication-tap-highlight" content="no">
    <meta name="description" content="Materialize is a Material Design Admin Template,It's modern, responsive and based on Material Design by Google. ">
    <meta name="keywords" content="materialize, admin template, dashboard template, flat admin template, responsive admin template,">
    <title>Complete Email Verification Code</title>


     <?php include 'components/css.php';?>

</head>
<body>
<div class="signup-container">
    
    <div class="account-left"> 

        <div class="account-text">
         <h1>Email Verification</h1>
         <p align="justify">Thanks for having interest in our software. This is a complete Registration and Login Systemm with email validation and verification. Purchase, download and enjoy the software because this help you to develop more mature backend for you respectives software. </p>

        </div><!--  close account-left div-->

    </div><!--  close account-left div-->


    <div class="account-right">
        <?php display_message();?>
        <?php  validate_code(); ?>
        <?php include 'components/enterCodeHere.php';?>

    </div><!--  close account-right div-->

</div><!--  close signup-container div-->
	

<?php include 'components/js.php';?>

</body>

</html>