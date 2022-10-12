<?php

//start session

session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="images/jconnectorzicon.png">
    <link rel="icon" type="image/png" href="images/jconnectorzicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Jconnectorz - Home</title>
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

<body class="index-page sidebar-collapse">
   
   <?php
   //add header file
   include("header.php");
   
   
   
   
   ?>
   
    <div class="wrapper">
        <div class="page-header clear-filter" filter-color="orange">
            <div class="page-header-image" data-parallax="true" style="background-image: url('images/<?php echo date('l'); ?>.jpg');">
            </div>
            <div class="container">
                <div class="content-center brand">
                    <img class="n-logo" src="images/jconnectorzicon.png" alt="">
                    <h1 class="h1-seo">Jconnectorz.</h1>
                    <h3>Software &amp; Web Developers<br/>We craft solutions</h3>
                </div>
                <h6 class="category category-absolute">Welcome to Jconnectorz. Get swift info!</h6>
            </div>
        </div>
		
    <div class="main">
	
	 <div class="section section-team text-center">
            <div class="container">
               
                <div class="team">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="team-player">
                               <i class="fa fa-download fa-5x" style="color:OrangeRed"></i>
                                <h4 class="title">Download our software</h4>
                                <p class="category text-primary">For Free</p>
                                <p class="description">We ofter several of our software for download on different platform.</p>
                                
                                
                                <a href="download.php" class="btn btn-primary btn-icon btn-round"><i class="fa fa-download"></i></a>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="team-player">
                               <i class="fa fa-cogs fa-5x" style="color:OrangeRed"></i>
                                <h4 class="title">Software / Web Designing</h4>
                                <p class="category text-primary">Developer</p>
                                <p class="description">This is where we sit down and layout in the details. Together with you</p>
                                <a href="contact.php" class="btn btn-primary btn-icon btn-round"><i class="fa fa-phone"></i></a>
                                
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="team-player">
                               <i class="fa fa-book fa-5x" style="color:OrangeRed"></i>
                                <h4 class="title">Several article contributors</h4>
                                <p class="category text-primary">Detailed</p>
                                <p class="description">We get information and articles written by several meticulous Authors.</p>
                                <a href="about.php" class="btn btn-primary btn-icon btn-round"><i class="fa fa-info"></i></a>
                                
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		
		
		
		
		
		
		
		
		
		
		<div class="section section-tabs">
		
			<center>
			<h3 style="color:orangeRed" >Recent Info</h3>
			</center>
                <div class="container">
                    <div class="row">
					
                        <div class="col-md-10 col-lg-8 col-xl-6 ml-auto mr-auto">
                           
                            <!-- Nav tabs -->
                            <div class="card">
                                <ul class="nav nav-tabs justify-content-center" role="tablist">
                                    <li class="nav-item">
									<img src="images/Tuesday.jpg" alt="" />
                                    </li>
                                    
                                </ul>
                                <div class="card-body">
                                    <!-- Tab panes -->
                                    <div class="tab-content text-center">
                                        <div class="tab-pane active" id="home" role="tabpanel">
										<h4>OK this will be the title for 1st post</h4>
                                            <p>I will use here to put the description of post before the user reads it fully. Am using a card for this section to loop through posts, i will also limit the post to maybe 4 or 6.</p>
                                        </div>
                                       
									   <a class="btn btn-primary"  href=" " >Read more...</a>
									   
                                    </div>
                                </div>
                            </div>
                        </div>
						
                       <div class="col-md-10 col-lg-8 col-xl-6 ml-auto mr-auto">
                           
                            <!-- Nav tabs -->
                            <div class="card">
                                <ul class="nav nav-tabs justify-content-center" role="tablist">
                                    <li class="nav-item">
									<img src="images/Wednesday.jpg" alt="" />
                                    </li>
                                    
                                </ul>
                                <div class="card-body">
                                    <!-- Tab panes -->
                                    <div class="tab-content text-center">
                                        <div class="tab-pane active" id="home" role="tabpanel">
										<h4>Also will be the title for 2nd post</h4>
                                            <p>I will use here to put the description of post before the user reads it fully. Am using a card for this section to loop through posts, i will also limit the post to maybe 4 or 6.  </p>
                                        </div>
                                       
									   <a class="btn btn-primary"  href=" " >Read more...</a>
									   
                                    </div>
                                </div>
                            </div>
							
                        </div>
						
						 <div class="col-md-10 col-lg-8 col-xl-6 ml-auto mr-auto">
                           
                            <!-- Nav tabs -->
                            <div class="card">
                                <ul class="nav nav-tabs justify-content-center" role="tablist">
                                    <li class="nav-item">
									<img src="images/Friday.jpg" alt="" />
                                    </li>
                                    
                                </ul>
                                <div class="card-body">
                                    <!-- Tab panes -->
                                    <div class="tab-content text-center">
                                        <div class="tab-pane active" id="home" role="tabpanel">
										<h4>Next will be the title for 3rd post</h4>
                                            <p>I will use here to put the description of post before the user reads it fully. Am using a card for this section to loop through posts, i will also limit the post to maybe 4 or 6.  </p>
                                        </div>
                                       
									   <a class="btn btn-primary"  href=" " >Read more...</a>
									   
                                    </div>
                                </div>
                            </div>
							
                        </div>
						
						 <div class="col-md-10 col-lg-8 col-xl-6 ml-auto mr-auto">
                           
                            <!-- Nav tabs -->
                            <div class="card">
                                <ul class="nav nav-tabs justify-content-center" role="tablist">
                                    <li class="nav-item">
									<img src="images/Saturday.jpg" alt="" />
                                    </li>
                                    
                                </ul>
                                <div class="card-body">
                                    <!-- Tab panes -->
                                    <div class="tab-content text-center">
                                        <div class="tab-pane active" id="home" role="tabpanel">
										<h4>4th post, am still considering if to show 4 or 6 post</h4>
                                            <p>I will use here to put the description of post before the user reads it fully. Am using a card for this section to loop through posts, i will also limit the post to maybe 4 or 6.  </p>
                                        </div>
                                       
									   <a class="btn btn-primary"  href=" " >Read more...</a>
									   
                                    </div>
                                </div>
                            </div>
							
                        </div>
						
		
						 <div class="col text-center">
                        <a href="blog.php" class="btn btn-simple btn-round btn-white btn-lg" >View More</a>
                    </div>
						
						
						
                    </div>
                </div>
            </div>
            <!-- End Section Tabs -->
		
		
		
		
		
		
		
		 <div class="section section-nucleo-icons">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-md-12">
                            <h2 class="title">Buy Cosmetics Easily</h2>
                            <h5 class="description">
                               We offer Professional and high quality makeup. Looking for discount Cosmetics and make up brands? We offer Best Prices on our products.                            </h5>
                              
                            <a href="products.php" class="btn btn-primary btn-simple btn-round btn-lg" >Visit Shop</a>
                           <a href="account.php" class="btn btn-primary  btn-round btn-lg" >My Account</a>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="icons-container">
                                
                               <img src="images/cosmetics.jpg" alt="Cosmetics Jconnectorz" />
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
		
		
		
		
		
		
		
		
		
		
		
		
		
	
 <div class="section section-signup" style="background-image: url('assets/img/bg11.jpg'); background-size: cover; background-position: top center; min-height: 700px;">
                <div class="container">
                    <div class="row">
                        <div class="card card-signup" data-background-color="orange">
                            <form class="form" method="post" action="">
                                <div class="header text-center">
                                    <h4 class="title title-up">Contact Us</h4>
									
                                    <div class="social-line">
                                        <b  class="btn btn-neutral btn-twitter btn-icon btn-lg btn-round">
                                            <i class="fa fa-phone"></i>
                                        </b>
                                    </div>
									
                                </div>
                                <div class="card-body">
                                    <div class="input-group form-group-no-border">
                                        <span class="input-group-addon">
                                            <i class="now-ui-icons users_circle-08"></i>
                                        </span>
                                        <input type="text" class="form-control" placeholder="Name..." required>
                                    </div>
                                    <div class="input-group form-group-no-border">
                                        <span class="input-group-addon">
                                            <i class="fa fa-phone"></i>
                                        </span>
                                        <input type="text" placeholder="Phone Number" class="form-control" />
                                    </div>
                                    <div class="input-group form-group-no-border">
                                        <span class="input-group-addon">
                                            <i class="now-ui-icons ui-1_email-85"></i>
                                        </span>
                                        <input type="email" class="form-control" placeholder="Email..." required>
                                    </div>
									
									<div class="textarea-container input-group form-group-no-border input-lg">
                            <textarea class="form-control" name="name" rows="4" cols="80" placeholder="Type a message..." required ></textarea>
                        </div>
									
                                   
                                </div>
                                <div class="footer text-center">
                                    <button type="submit" class="btn btn-neutral btn-round btn-lg">Send</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col text-center">
                        <a href="contact.php" class="btn btn-simple btn-round btn-white btn-lg" target="_blank">Open Contact Us Page</a>
                    </div>
                </div>
            </div>






	
		
		
		
		
		
		
		
		
		
		
		
<?php
//adding footer
include("footer.php");


?>
				
					
        
    </div>

	</div>
</body>
<!--   Core JS Files am puting this down here to boost site loaad time  -->

<script src="./assets/js/core/jquery.3.2.1.min.js" type="text/javascript"></script>
<script src="./assets/js/core/popper.min.js" type="text/javascript"></script>
<script src="./assets/js/core/bootstrap.min.js" type="text/javascript"></script>

<!--  Plugin for the Sliders, -->
<script src="./assets/js/plugins/nouislider.min.js" type="text/javascript"></script>

<script src="./assets/js/now-ui-kit.js?v=1.1.0" type="text/javascript"></script>


</html>