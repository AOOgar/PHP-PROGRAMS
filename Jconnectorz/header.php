<?php

 //Get file name
 //so as to know which file is active
      $currentFile = $_SERVER["SCRIPT_NAME"];
	  //extract it from forward /
      $parts = Explode('/', $currentFile);
      $currentFile = $parts[count($parts) - 1]; 
	  
	  
?> 
 
 <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-primary fixed-top navbar-transparent " color-on-scroll="300">
        <div class="container">
            <div class="navbar-translate">
                <a class="navbar-brand" href="index.php" rel="tooltip" title="Created and Developed by Jesse(Coders)" data-placement="bottom" >
                    Jconnectorz
                </a>
                <button class="navbar-toggler navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-bar bar1"></span>
                    <span class="navbar-toggler-bar bar2"></span>
                    <span class="navbar-toggler-bar bar3"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse justify-content-end" id="navigation" data-nav-image="assets/img/blurred-image-1.jpg">
                <ul class="navbar-nav">
				<li class="nav-item">
                        <a class="nav-link " href="index.php" >
                            <i class="fa fa-home"></i>
                            <p>Home</p>
							<?php if($currentFile=="index.php"){echo "<i class='now-ui-icons loader_gear spin'></i>";}?>
							
                        </a>
                    </li>
					<li class="nav-item">
                        <a class="nav-link" href="about.php" >
                            <i class="now-ui-icons travel_info"></i>
                            <p>About Us</p>
							<?php if($currentFile=="about.php"){echo "<i class='now-ui-icons loader_gear spin'></i>";}?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="blog.php" >
                            <i class="now-ui-icons transportation_air-baloon"></i>
                            <p>Blog</p>
							<?php if($currentFile=="blog.php"||$currentFile=="post.php"){echo "<i class='now-ui-icons loader_gear spin'></i>";}?>
                        </a>
                    </li>
                   <li class="nav-item">
                        <a class="nav-link" href="contact.php" >
                            <i class="now-ui-icons ui-1_email-85"></i>
                            <p>Contact Us</p>
							<?php if($currentFile=="contact.php"){echo "<i class='now-ui-icons loader_gear spin'></i>";}?>
                        </a>
                    </li>
					<li class="nav-item">
                        <a class="nav-link" href="download.php" >
                            <i class="now-ui-icons arrows-1_cloud-download-93"></i>
                            <p>Downloads</p>
							<?php if($currentFile=="download.php"){echo "<i class='now-ui-icons loader_gear spin'></i>";}?>
                        </a>
                    </li>
					<li class="nav-item">
                        <a class="nav-link" href="products.php" >
                            <i class="fa fa-shopping-cart"></i>
                            <p>Market Place</p>
							<?php if($currentFile=="products.php" || $currentFile=="checkout.php"){echo "<i class='now-ui-icons loader_gear spin'></i>";}?>
                        </a>
                    </li>
					
					
					
					<li class="nav-item">
                        <a class="nav-link "  data-toggle="modal" data-target="#subscribe">
                            <i class="now-ui-icons ui-1_send"></i>
                            <p>Subscribe</p>
                        </a>
                    </li>
					<li class="nav-item">
                        <a class="nav-link" rel="tooltip" title="Search" data-placement="bottom" data-toggle="modal" data-target="#search">
                            <i class="fa fa-search"></i>
                            <p class="d-lg-none d-xl-none">Search</p>
							<?php if($currentFile=="search.php"){echo "<i class='now-ui-icons loader_gear spin'></i>";}?>
                        </a>
                    </li>
					
				
					
					
					
					
					
                    <li class="nav-item">
                        <a class="nav-link" rel="tooltip" title="Like us on Facebook" data-placement="bottom" href="https://web.facebook.com/JspeechApp" target="_blank">
                            <i class="fa fa-facebook-square"></i>
                            <p class="d-lg-none d-xl-none">Facebook</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" rel="tooltip" title="View Your Orders." data-placement="bottom" href="account.php" >
                            <i class="fa fa-user"></i>
                            <p class="d-lg-none d-xl-none">My Account</p>
							<?php if($currentFile=="account.php" || $currentFile=="login.php" || $currentFile=="register.php"){echo "<i class='now-ui-icons loader_gear spin'></i>";}?>
                        </a>
                    </li>
					
					
					
					
					
					
					
                </ul>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->
	
	
	
	 <!-- Mini Modal -->
        <div class="modal fade modal-mini modal-primary" id="subscribe" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
				
				
				 <button type="button" class="btn btn-link btn-neutral" data-dismiss="modal">&times;</button>
                    
					<div class="modal-header justify-content-center">
					
                        <div class="modal-profile">
						
                            <i class="now-ui-icons ui-1_send"></i>
							
                        </div>
                    </div>
                    <div class="modal-body">
					
                        <form class="form" method="post">
						
						 <div class="input-group form-group-no-border">
                                        <span class="input-group-addon">
                                            <i class="now-ui-icons users_circle-08"></i>
                                        </span>
                                        <input type="text" class="form-control" name="name" placeholder="Name...">
                                    </div>
                                   
                                    <div class="input-group form-group-no-border">
                                        <span class="input-group-addon">
                                            <i class="now-ui-icons ui-1_email-85"></i>
                                        </span>
                                        <input type="email" class="form-control" required name="email" placeholder="Email...">
                                    </div>
									<center>
									<input type="submit" class="btn btn-neutral btn-round btn-lg" value="Subscribe">
									</center>
						</form>
						
						
                    </div>
                    <div class="modal-footer">
                        
                       
                    </div>
                </div>
            </div>
        </div>
        <!--  End Modal -->
		
		
		
		  <!-- Search Modal -->
        <div class="modal fade" id="search" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header justify-content-center">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                            <i class="now-ui-icons ui-1_simple-remove"></i>
                        </button>
                        <h4 class="title title-up">Search</h4>
                    </div>
                    <div class="modal-body">
                        <form class="form" role="search" method="post" action="search.php">
						
						 <div class="input-group form-group-no-border input-lg">
                                <span class="input-group-addon">
                                    <i class="fa fa-search"></i>
                                </span>
                                <input type="text" class="form-control form-control-success" placeholder=" Search for Post or Product" name="search_word" required>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" name="search">Search</button>
						</form>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!--  End Modal -->
		