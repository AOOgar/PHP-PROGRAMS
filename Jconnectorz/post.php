<?php
//starting session
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="images/jconnectorzicon.png">
    <link rel="icon" type="image/png" href="images/jconnectorzicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Jconnectorz -Post</title>
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

<body class="profile-page sidebar-collapse">
   
   <?php
   //adding header
   include('header.php');
   
   
   ?>
   
   
   
    <div class="wrapper">
        <div class="page-header page-header-small" filter-color="orange">
            <div class="page-header-image" data-parallax="true" style="background-image: url('images/<?php echo date('l'); ?>.jpg');">
            </div>
            <div class="container">
                <div class="content-center">
                   
                    <h3 class="title">Title of my Post</h3>
                    <p class="category"> </p>
                   
                </div>
            </div>
        </div>
        <div class="section">
            <div class="container">
                <div class="button-container">
                    <a href="#" class="btn btn-primary btn-round btn-lg">
					<i class="fa fa-facebook-square"></i> Share
					</a>
                    <a href="whatsapp://send?text=Hi its Jesse" class="btn btn-primary btn-round btn-lg">
					<i class="fa fa-whatsapp"></i> Whatapp
					</a>
                </div>
				
                
                <div class="row">
				
                    <div class="col-md-8 ml-auto mr-auto">
                    <br/>
					<hr/>
					<br/>   
					   
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
			
			
			
			<center>
			<!--profile or writer -->
			 <div class="col-xs-4 col-sm-2">
                            <div class="team-player">
                                <img src="images/jesse.jpg" alt="Thumbnail Image" class="rounded-circle ">
                                <h4 >Jesse(Coders)</h4>
                              <p class="category text-primary">Added By <i class="fa  fa-hand-o-up"></i></p>
                              
                                
                            </div>
                        </div>
			</center>
		
		
		
		
		
		
		
            <div class="container">
                <h2 class="title">Comments</h2>
                <p class="description">Add your comment.</p>
                <div class="row">
                    <div class="col-lg-6 text-center col-md-8 ml-auto mr-auto">
					<form method="post">
                        <div class="input-group input-lg">
                            <span class="input-group-addon">
                                <i class="now-ui-icons users_circle-08"></i>
                            </span>
                            <input type="text" class="form-control" placeholder="Name...">
                        </div>
                        
                        <div class="textarea-container">
                            <textarea class="form-control" name="name" rows="4" cols="80" placeholder="Type Your Comment..."></textarea>
                        </div>
                        <div class="send-button">
                            <button type="submit" class="btn btn-primary btn-round btn-block btn-lg">Post Comment</a>
                        </div>
						</form>
						
                    </div>
                </div>
				
				<div class="row">
				<!-- comments section -->
				<div class="col-md-6">
				 <p class="blockquote blockquote-primary"><i class="fa fa-comment"></i>
				 "To Achive Varying Content. We have Team of contributors and authors who add info for your benefit."
                                    <br>
                                    <br>
                                    <b>- Jconnectorz</b>
                                </p>
				
				
				</div>
				<div class="col-md-6">
				 <p class="blockquote blockquote-primary"><i class="fa fa-comment"></i>
				 "To Achive Varying Content. We have Team of contributors and authors who add info for your benefit."
                                    <br>
                                    <br>
                                    <b>- Jconnectorz</b>
                                </p>
				
				
				</div>
				
			</div>	
				
            </div>
       
		<!-- next post -->
		<div class="col text-center">
                        <a href="" class="btn btn-simple btn-round btn-info btn-lg" >Next Post</a>
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


<script src="assets/js/now-ui-kit.js?v=1.1.0" type="text/javascript"></script>

</html>