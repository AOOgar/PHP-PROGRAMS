<?php
//starting session
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="images/jconnectorzicon.png">
    <link rel="icon" type="image/png" href="images/jconnectorzicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>My Account</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    
	<!-- Fonts and icons -->
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
   //addinng header
   include('header.php');
   
   ?>
   
    <div class="wrapper">
        <div class="page-header page-header-small" filter-color="orange">
            <div class="page-header-image" data-parallax="true" style="background-image: url('images/<?php echo date('l'); ?>.jpg');">
            </div>
            <div class="container">
                <div class="content-center">
                    <div class="photo-container">
                        <img src="images/jconnectorzicon.png" alt="">
                    </div>
                    <h3 class="title"> </h3>
                    <p class="category">Email</p>
                    <div class="content">
                        <div class="social-description">
                            <h2>3</h2>
                            <p>Totals Orders</p>
                        </div>
                        <div class="social-description">
                            <h2>26</h2>
                            <p>Current Orders</p>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="section">
            <div class="container">
               
                <div class="row">
                    <div class="col-md-6 ml-auto mr-auto">
                        <h4 class="title text-center">My Account</h4>
                        <div class="nav-align-center">
                            <ul class="nav nav-pills nav-pills-primary" role="tablist">
                                <li class="nav-item">
								
                                    <center class="text-center text-primary">Orders </center>
                                    <a class="nav-link " data-toggle="tab" href="#track" role="tablist">
									
                                        <i class="fa fa-reply"></i>
										
                                    </a>
									
                                </li>
                                <li class="nav-item">
                                   <center class="text-center text-primary"> Profile</center>
                                    <a class="nav-link active" data-toggle="tab" href="#profile" role="tablist">
									
                                        <i class="fa fa-user"></i>
										</a>
                                </li>
                                
                            </ul>
                        </div>
                    </div>
                    
                    <!-- Tab panes -->
                    
                    <div class="tab-content gallery">
                        <div class="tab-pane " id="track" role="tabpanel">
                            <div class="col-md-12 ml-auto mr-auto">
                                <div class="row">
                                    
                                    <center>
									<table  class="tabel table-hover table-striped">
									<thead>
									<th> Product Name</th>
									<th>Product Price</th>
									<th>Quantity</th>
									<th> Product Status</th>
									</thead>
									<tbody>
									
									<tr>
									
									<td>iman</td>
									<td>₦1200</td>
									<td>1</td>
									<td>Awaiting Fufillment</td>
									
									
									</tr>
									
									</tbody>
									
									
									
									</table>
									
                                    </center>
                                </div>
                            </div>
                        </div>
						
						
                        <div class="tab-pane active" id="profile" role="tabpanel">
                            <div class="col-md-10 ml-auto mr-auto">
                                <div class="row">
                                   
								   <form class="form" method="post">
								   
								   <div class="input-group form-group-no-border input-lg">
                                <span class="input-group-addon">
                                    <i class="fa fa-user"></i>
                                </span>
                                <input type="text" class="form-control form-control-success" placeholder="Name" name="name" required>
                            </div>
							<div class="input-group form-group-no-border input-lg">
                                <span class="input-group-addon">
                                    <i class="fa fa-envelope"></i>
                                </span>
                                <input type="email" class="form-control form-control-success" placeholder="Email.." name="email" required>
                            </div>
							<div class="input-group form-group-no-border input-lg">
                                <span class="input-group-addon">
                                    <i class="fa fa-phone"></i>
                                </span>
                                <input type="text" class="form-control form-control-success" placeholder="Phone Number" name="phone" >
                            </div>
						<div class="input-group form-group-no-border input-lg">
                                <span class="input-group-addon">
                                    <i class="fa fa-location-arrow"></i>
                                </span>
                                <input type="Text" class="form-control form-control-success" placeholder="Default City" name="city" >
                            </div>
						<div class="textarea-container input-group form-group-no-border input-lg">
                            <textarea class="form-control" name="name" rows="4" cols="80" placeholder="Default  Address..." ></textarea>
						</div>
		  
		  
					
		  
		  
				<input type="submit" class="btn btn-default btn-round btn-lg" value="Update Profile" name="update">
		  
		    
								   </form>
								   
                                </div>
                            </div>
                        </div>
                        
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


<script src="assets/js/now-ui-kit.js?v=1.1.0" type="text/javascript"></script>

</html>