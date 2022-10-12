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
    <title>Jconnectorz - Downloads</title>
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
        <div class="page-header page-header-small" filter-color="orange">
            <div class="page-header-image" data-parallax="true" style="background-image: url('images/<?php echo date('l') ?>.jpg');">
            </div>
            <div class="container">
                <div class="content-center">
                  
                    <div class="text-center">
                        <img src="images/jconnectorz.png" alt="Jconnectorz logo" />
						 <h3>Softwares for Download</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="section section-about-us">
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
                                       
									   <a class="btn btn-primary"  href=" " >View App..</a>
									   
                                    </div>
                                </div>
                            </div>
                        </div>
				   
				   
				   
				   
				   <div class="col-md-10 col-lg-8 col-xl-6 ml-auto mr-auto">
                           
                            <!-- Nav tabs -->
                            <div class="card">
                                <ul class="nav nav-tabs justify-content-center" role="tablist">
                                    <li class="nav-item">
									<img src="images/wednesday.jpg" alt="" />
                                    </li>
                                    
                                </ul>
                                <div class="card-body">
                                    <!-- Tab panes -->
                                    <div class="tab-content text-center">
                                        <div class="tab-pane active" id="home" role="tabpanel">
										<h4>OK this will be the title for 1st post</h4>
                                            <p>I will use here to put the description of post before the user reads it fully. Am using a card for this section to loop through posts, i will also limit the post to maybe 4 or 6.</p>
                                        </div>
                                       
									   <a class="btn btn-primary"  href=" " >View App..</a>
									   
                                    </div>
                                </div>
                            </div>
                        </div>
				   
				   
				   
				   
				   
				   
				   
				   
				   
				     
				  
				
				  
				   
                </div>
				
				
				
				<ul class="pagination">
                                    <li class="page-item">
                                        <a class="page-link" href="#link" aria-label="Previous">
                                            <span aria-hidden="true"><i class="fa fa-angle-double-left" aria-hidden="true"></i></span>
                                        </a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="#link">1</a>
                                    </li>
                                    <li class="page-item active">
                                        <a class="page-link" href="#link">2</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="#link">3</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="#link" aria-label="Next">
                                            <span aria-hidden="true"><i class="fa fa-angle-double-right" aria-hidden="true"></i></span>
                                        </a>
                                    </li>
                                </ul>
		
				
				
				
				
				
				
				
				
				
				
				
            
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