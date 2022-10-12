<?php
//start a session 
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="images/jconnectorzicon.png">
    <link rel="icon" type="image/png" href="images/jconnectorzicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Jconnectorz - About Us</title>
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

<body class="landing-page sidebar-collapse">
    <?php
	//adding header
	include('header.php');
	
	?>
	
	
	
	
    <div class="wrapper">
        <div class="page-header page-header-small">
            <div class="page-header-image" data-parallax="true" style="background-image: url('images/<?php echo date('l') ?>.jpg');">
            </div>
            <div class="container">
                <div class="content-center">
                    
                    <div class="text-center">
                        <img src="images/jconnectorz.png" alt="Jconnectorz logo" />
                    </div>
                </div>
            </div>
        </div>
        <div class="section section-about-us">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 ml-auto mr-auto text-center">
                        <h2 class="title">About Us</h2>
                        <h5 class="description">Welcome.
Jconnectorz  is owned and managed by Jesse(Coders).

I specialize in android Developement, functional front-end & Back-end Web development and windows desktop Development.</h5>
                    </div>
                </div>
                <div class="separator separator-primary"></div>
                <div class="section-story-overview">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="image-container image-left" style="background-image: url('images/Friday.jpg')">
                                <!-- First image on the left side -->
                                <p class="blockquote blockquote-primary">"To Achive Varying Content. We have Team of contributors and authors who add info for your benefit."
                                    <br>
                                    <br>
                                    <small>- Jconnectorz</small>
                                </p>
                            </div>
                            <!-- Second image on the left side of the article -->
                            <div class="image-container" style="background-image: url('images/Saturday.jpg')"></div>
                        </div>
                        <div class="col-md-5">
                            <!-- First image on the right side, above the article -->
                            <div class="image-container image-right" style="background-image: url('images/wednesday.jpg')"></div>
                           
                            <p>Also, i build websites and applications with fanatical attention to details and offer a range of development services.
						I offer several of my software for free download which are available on this site. And mobile Apps are availble on Play Store
                            </p>
                            <p>
                                I’m a passionate, optimistic &amp; dedicated man who takes up responsibilities with utmost enthusiasm and see to it that I complete my tasks and assignments in time. I’ve a great amount of perseverance to achieve my goal. My optimistic and planned approach in things I do is what driving me towards my success.
                            </p>
                            <p>We try to give you authentic and functional information from our articles and post (we put effort to research and come out with quality information that will benefit you).  We put our time and energy into developing interesting, suitable and nice softwares as well as websites for you.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section section-team text-center">
            <div class="container">
                <h2 class="title">Here is our team Jconnectorz</h2>
                <div class="team">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="team-player">
                                <img src="images/jesse.jpg" alt="Thumbnail Image" class="rounded-circle img-fluid img-raised">
                                <h4 class="title">Jesse(Coders)</h4>
                                <p class="category text-primary">Software/Web Developer</p>
                                <p class="description"></p>
                                
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="team-player">
                                <img src="images/victor.jpg" alt="Thumbnail Image" class="rounded-circle img-fluid img-raised">
                                <h4 class="title">Victor Alozie</h4>
                                <p class="category text-primary">Medical Doctor</p>
                                <p class="description"></p>
                                
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="team-player">
                                <img src="images/cassy.jpg" alt="Thumbnail Image" class="rounded-circle img-fluid img-raised">
                                <h4 class="title">Cassandra Uzosike</h4>
                                <p class="category text-primary">Dentist</p>
                                <p class="description"></p>
                                
                            </div>
                        </div>
						
						 <div class="col-md-4">
                            <div class="team-player">
                                <img src="images/rejoice.jpg" alt="Thumbnail Image" class="rounded-circle img-fluid img-raised">
                                <h4 class="title">Rejoice Eze</h4>
                                <p class="category text-primary">Professional Make-up Artist</p>
                                <p class="description"></p>
                                
                            </div>
                        </div>
						
						
						
						
						
                    </div>
                </div>
            </div>
        </div>
        <div class="section section-contact-us text-center">
            <div class="container">
                <h2 class="title">Want to work with us?</h2>
                <p class="description">Your Contribution is important to Us.</p>
                <div class="row">
                    <div class="col-lg-6 text-center col-md-8 ml-auto mr-auto">
					<form method="post">
                        <div class="input-group input-lg">
                            <span class="input-group-addon">
                                <i class="now-ui-icons users_circle-08"></i>
                            </span>
                            <input type="text" class="form-control" placeholder="First Name...">
                        </div>
                        <div class="input-group input-lg">
                            <span class="input-group-addon">
                                <i class="now-ui-icons ui-1_email-85"></i>
                            </span>
                            <input type="text" class="form-control" placeholder="Email...">
                        </div>
                        <div class="textarea-container">
                            <textarea class="form-control" name="name" rows="4" cols="80" placeholder="Type a message..."></textarea>
                        </div>
                        <div class="send-button">
                            <button type="submit" class="btn btn-primary btn-round btn-block btn-lg">Send Message</a>
                        </div>
						</form>
                    </div>
                </div>
            </div>
        </div>
		
        
		<?php
		//adding footer
		include('footer.php');
		
		?>
		
		
		
    </div>
</body>
<!--   Core JS Files   -->
<script src="assets/js/core/jquery.3.2.1.min.js" type="text/javascript"></script>
<script src="assets/js/core/popper.min.js" type="text/javascript"></script>
<script src="assets/js/core/bootstrap.min.js" type="text/javascript"></script>

<script src="assets/js/plugins/bootstrap-switch.js"></script>

<script src="assets/js/plugins/nouislider.min.js" type="text/javascript"></script>

<script src="assets/js/plugins/bootstrap-datepicker.js" type="text/javascript"></script>

<script src="assets/js/now-ui-kit.js?v=1.1.0" type="text/javascript"></script>

</html>