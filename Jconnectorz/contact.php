<?php
//starting a session
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="images/jconnectorzicon.png">
    <link rel="icon" type="image/png" href="images/jconnectorzicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Jconnectorz - Contact Us</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    
	<!-- Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="assets/fa/css/font-awesome.min.css" />
    <!-- CSS Files -->
    <link href="./assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="./assets/css/now-ui-kit.css?v=1.1.0" rel="stylesheet" />
   <!-- my demo-->
    <link href="./assets/css/demo.css" rel="stylesheet" />
</head>

<body class="login-page sidebar-collapse">
    <?php
	
	//adding header
include("header.php");

	
	?>
	
	
	
    <div class="page-header" filter-color="orange">
        <div class="page-header-image" style="background-image:url(images/<?php echo date('l'); ?>.jpg)"></div>
        <div class="container">
            <div class="col-md-4 content-center">
                <div class="card card-login card-plain">
				
                    <form class="form" method="post">
                        <div class="header header-primary text-center">
						<br/>
						
                            <div class="logo-container">
                               <img class="n-logo" src="images/jconnectorzicon.png" alt="Jconnectorz Logo">
                            </div>
							
                        </div>
                        <div class="content">
                            <div class="input-group form-group-no-border input-lg">
                                <span class="input-group-addon">
                                    <i class="now-ui-icons users_circle-08"></i>
                                </span>
                                <input type="text" class="form-control" placeholder="Name..." required>
                            </div>
                            <div class="input-group form-group-no-border input-lg">
                                <span class="input-group-addon">
                                    <i class="now-ui-icons ui-1_email-85"></i>
                                </span>
                                <input type="email" placeholder="Email" class="form-control" required />
                            </div>
							 <div class="input-group form-group-no-border input-lg">
                                <span class="input-group-addon">
                                    <i class="fa fa-phone"></i>
                                </span>
                                <input type="text" placeholder="Phone Number" class="form-control"  />
                            </div>
							
							<div class="textarea-container input-group form-group-no-border input-lg">
                            <textarea class="form-control" name="name" rows="4" cols="80" placeholder="Type a message..." required ></textarea>
                        </div>
							
                        </div>
                        <div class="footer text-center">
                            <button type="submit" class="btn btn-primary btn-round btn-lg btn-block">Send Message</button>
                        </div>
                       
                    </form>
                </div>
            </div>
        </div>
       
	   
	   
	   
    </div>
	
	
	
	
	        <div class="section section-about-us">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 ml-auto mr-auto text-center">
                        <h2 class="title">Contact Us</h2>
                        <h5 class="description">Need a Website or Mobile App? Want our services or you want to get in touch?, Contact Us by Filling the form Above. And we will get back to you.. We provide you with more information and answer any question you may have.</h5>
                    </div>
                </div>
                <div class="separator separator-primary"></div>
                <div class="section ">
                    <div class="row">
                        <div class="col-md-6">
                          
                                <!-- First image on the left side -->
                                <p class="blockquote blockquote-primary">If this is an urgent matter please contact us on:

<a href="tel:07063581203"> 2347063581203</a>  or <a href="mailto:uchejesse126@gmail.com">uchejesse126@gmail.com</a>

                                    <br>
                                    <br>
                                    <small>- Jconnectorz</small>
                                </p>
                            </div>
                           
                        <div class="col-md-5">
                           
                            Our customer support and account management team provides Adequate services.  We are passionate about our products(Soft wares)  as well as our Users and it shows in the level of service that we provide.

we are always happy to find a solution for your needs. if a solution does not already exist, we will create a new solution to resolve your needs.
<h4 class="text-info"><strong>What you get when asking your QUESTION during contact?</strong></h4>
<ul>
 	<li>less than 12 - hour response to your question, or issues.</li>
 	<li>Plan of action summarised in a follow up email.</li>
</ul>
&nbsp;
                            <p>
                                
You are not going to hit a ridiculously long phone menu when you call us. Your email isn't going to the email abyss, never to been seen or heard from again.
<h4 class="text-success"><strong>Can i, as a Guest post on Jconnectorz?</strong></h4>
Yes!, to have dynamic and vast info. jconnectorz accept real and infomative posts. Fill the form above requesting to be a Contributor and we will get back to you. 
                            </p>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
	
	
	
	
	
	<?php
	   
	   //adding footer
include("footer.php");

	   
	   ?>
	
	
</body>
<!--   Core JS Files am puting this down here to boost site loaad time  -->

<script src="./assets/js/core/jquery.3.2.1.min.js" type="text/javascript"></script>
<script src="./assets/js/core/popper.min.js" type="text/javascript"></script>
<script src="./assets/js/core/bootstrap.min.js" type="text/javascript"></script>


<script src="./assets/js/plugins/nouislider.min.js" type="text/javascript"></script>

<script src="./assets/js/now-ui-kit.js?v=1.1.0" type="text/javascript"></script>


</html>