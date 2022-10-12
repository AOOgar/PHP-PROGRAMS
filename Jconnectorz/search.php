<?php
//start a session 
session_start();

//check if the search button was not clicked
if(!isset($_POST['search'])){
	
header("location:index.php");

	}
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="images/jconnectorzicon.png">
    <link rel="icon" type="image/png" href="images/jconnectorzicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Jconnectorz - Search Results</title>
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
	
	//check if the search button was clicked
	if(isset($_POST['search'])){
		
		//retrive the search keyword
		$keyword = $_POST['search_word'];
		
		
		
	}
	
	
	
	
	
	
	?>
	
    <div class="wrapper">
        <div class="page-header page-header-small" filter-color="orange">
            <div class="page-header-image" data-parallax="true" style="background-image: url('images/<?php echo date('l') ?>.jpg');">
            </div>
            <div class="container">
                <div class="content-center">
                  
                    <div class="text-center">
                        <img src="images/jconnectorz.png" alt="Jconnectorz logo" />
						 <h3>Results for <?php echo $keyword; ?></h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="section section-about-us">
            <div class="container">
                <div class="row">
                   
				   <div class="col-md-4">
                                       
													   
					<div class="card"  >
					  <img class="card-img-top item_thumb" src="assets/img/bg8.jpg" alt="Card image cap">
					  <div class="card-block card-body">
						<h5 class="card-title item_name">My Post Title</h5>
						<p class="card-text">  
						this will be the discription of the post. i need little more write up so it will get filled up
						</p>
						<a href="post.php" class="btn btn-primary" ><i class="fa fa-book"></i> Read More</a>
						
					  </div>
					</div>
						
				</div>
				
				<div class="col-md-4">
                                       
													   
					<div class="card"  >
					  <img class="card-img-top item_thumb" src="assets/img/bg5.jpg" alt="Card image cap">
					  <div class="card-block card-body">
						<h5 class="card-title item_name">My Post Title</h5>
						<p class="card-text">  
						this will be the discription of the post. i need little more write up so it will get filled up
						</p>
						<a href="post.php" class="btn btn-primary" ><i class="fa fa-book"></i> Read More</a>
						
					  </div>
					</div>
						
				</div>
				
				<div class="col-md-4">
                                       
													   
					<div class="card"  >
					  <img class="card-img-top item_thumb" src="assets/img/bg11.jpg" alt="Card image cap">
					  <div class="card-block card-body">
						<h5 class="card-title item_name">My Post Title</h5>
						<p class="card-text">  
						this will be the discription of the post. i need little more write up so it will get filled up
						</p>
						<a href="post.php" class="btn btn-primary" ><i class="fa fa-book"></i> Read More</a>
						
					  </div>
					</div>
						
				</div>
				  
				  
			<div class="col-md-4">
                                       
													   
					<div class="card"  >
					  <img class="card-img-top item_thumb" src="assets/img/bg1.jpg" alt="Card image cap">
					  <div class="card-block card-body">
						<h5 class="card-title item_name">My Post Title</h5>
						<p class="card-text">  
						this will be the discription of the post. i need little more write up so it will get filled up
						</p>
						<a href="post.php" class="btn btn-primary" ><i class="fa fa-book"></i> Read More</a>
						
					  </div>
					</div>
						
				</div>
				
				<div class="col-md-4">
                                       
													   
					<div class="card"  >
					  <img class="card-img-top item_thumb" src="assets/img/bg4.jpg" alt="Card image cap">
					  <div class="card-block card-body">
						<h5 class="card-title item_name">My Post Title</h5>
						<p class="card-text">  
						this will be the discription of the post. i need little more write up so it will get filled up
						</p>
						<a href="post.php" class="btn btn-primary" ><i class="fa fa-book"></i> Read More</a>
						
					  </div>
					</div>
						
				</div>
				
				<div class="col-md-4">
                                       
													   
					<div class="card"  >
					  <img class="card-img-top item_thumb" src="assets/img/bg3.jpg" alt="Card image cap">
					  <div class="card-block card-body">
						<h5 class="card-title item_name">My Post Title</h5>
						<p class="card-text">  
						this will be the discription of the post. i need little more write up so it will get filled up
						</p>
						<a href="post.php" class="btn btn-primary" ><i class="fa fa-book"></i> Read More</a>
						
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