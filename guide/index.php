<?php
//start session
session_start();
//add connection file
include('connect.php');


?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> 
<html class="no-js"> <!--<![endif]-->
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Ebonyi For Umahi</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Support Governor Umahi for more Ebonyi Growth" />
	<meta name="keywords" content="Ebonyi, umahi, dave, governor of ebonyi, ebonyi state, ebonyi election, ebonyi development" />
	<meta name="author" content="Ebonyi" />

 

  	<!-- Facebook and Twitter integration -->
	<link rel="canonical" href="http://ebonyi4umahi.com.ng/" />
	<meta property="og:title" content="Ebonyi For Umahi"/>
	<meta property="og:image" content="http://ebonyi4umahi.com.ng/images/dave.jpg"/>
	<meta property="og:image" content="http://ebonyi4umahi.com.ng/images/daveu.jpg"/>
	<meta property="og:image" content="http://ebonyi4umahi.com.ng/images/banner.jpg"/>
	<meta property="og:url" content="http://ebonyi4umahi.com.ng"/>
	<meta property="og:site_name" content="Ebonyi For Umahi"/>
	<meta property="og:description" content="Support Governor Umahi for more Ebonyi Growth"/>
	<meta name="twitter:title" content="Ebonyi For Umahi" />
	<meta name="twitter:image" content="http://ebonyi4umahi.com.ng/images/banner.jpg" />
	<meta name="twitter:url" content="http://ebonyi4umahi.com.ng" />
	<meta name="twitter:card" content="summary" />

	<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
	<link rel="shortcut icon" href="favicon.ico">
	
	<link href="https://fonts.googleapis.com/css?family=Amita:700" rel="stylesheet">
	<link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,600,400italic,700' rel='stylesheet' type='text/css'>
	<link href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' rel='stylesheet' type='text/css'>
	
	
	<!-- Animate.css -->
	<link rel="stylesheet" href="css/animate.css">
	<!-- Flexslider -->
	<link rel="stylesheet" href="css/flexslider.css">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="css/icomoon.css">
	<!-- Magnific Popup -->
	<link rel="stylesheet" href="css/magnific-popup.css">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="css/bootstrap.css">

	<!-- 
	Default Theme Style 
	You can change the style.css (default color purple) to one of these styles
	
	

	-->
	<link rel="stylesheet" href="css/style.css">
	
	

	<!-- Styleswitcher ( This style is for demo purposes only, you may delete this anytime. ) -->
	
	<!-- End demo purposes only -->


	<style>
	/* For demo purpose only */

	/*
	GREEN
	8dc63f
	RED
	FA5555
	TURQUOISE
	27E1CE
	BLUE 
	2772DB
	ORANGE
	FF7844
	YELLOW
	FCDA05
	PINK
	F64662
	PURPLE
	7045FF

	*/
	
	/* For Demo Purposes Only ( You can delete this anytime :-) */
	#colour-variations {
		padding: 10px;
		-webkit-transition: 0.5s;
	  	-o-transition: 0.5s;
	  	transition: 0.5s;
		width: 140px;
		position: fixed;
		left: 0;
		top: 100px;
		z-index: 999999;
		background: #fff;
		/*border-radius: 4px;*/
		border-top-right-radius: 4px;
		border-bottom-right-radius: 4px;
		-webkit-box-shadow: 0 0 9px 0 rgba(0,0,0,.1);
		-moz-box-shadow: 0 0 9px 0 rgba(0,0,0,.1);
		-ms-box-shadow: 0 0 9px 0 rgba(0,0,0,.1);
		box-shadow: 0 0 9px 0 rgba(0,0,0,.1);
	}
	#colour-variations.sleep {
		margin-left: -140px;
	}
	#colour-variations h3 {
		text-align: center;;
		font-size: 11px;
		letter-spacing: 2px;
		text-transform: uppercase;
		color: #777;
		margin: 0 0 10px 0;
		padding: 0;;
	}

	#colour-variations ul,
	#colour-variations ul li {
		padding: 0;
		margin: 0;
	}
	#colour-variations ul {
		margin-bottom: 20px;
		float: left;	
	}
	#colour-variations li {
		list-style: none;
		display: inline;
	}
	#colour-variations li a {
		width: 20px;
		height: 20px;
		position: relative;
		float: left;
		margin: 5px;
	}



	#colour-variations li a[data-theme="style"] {
		background: #8dc63f;
	}
	#colour-variations li a[data-theme="red"] {
		background: #FA5555;
	}
	#colour-variations li a[data-theme="turquoise"] {
		background: #27E1CE;
	}
	#colour-variations li a[data-theme="blue"] {
		background: #2772DB;
	}
	#colour-variations li a[data-theme="orange"] {
		background: #FF7844;
	}
	#colour-variations li a[data-theme="yellow"] {
		background: #FCDA05;
	}
	#colour-variations li a[data-theme="pink"] {
		background: #F64662;
	}
	#colour-variations li a[data-theme="purple"] {
		background: #7045FF;
	}

	#colour-variations a[data-layout="boxed"],
	#colour-variations a[data-layout="wide"] {
		padding: 2px 0;
		width: 48%;
		border: 1px solid #ededed;
		text-align: center;
		color: #777;
		display: block;
	}
	#colour-variations a[data-layout="boxed"]:hover,
	#colour-variations a[data-layout="wide"]:hover {
		border: 1px solid #777;
	}
	#colour-variations a[data-layout="boxed"] {
		float: left;
	}
	#colour-variations a[data-layout="wide"] {
		float: right;
	}

	.option-toggle {
		position: absolute;
		right: 0;
		top: 0;
		margin-top: 5px;
		margin-right: -30px;
		width: 30px;
		height: 30px;
		background: #8dc63f;
		text-align: center;
		border-top-right-radius: 4px;
		border-bottom-right-radius: 4px;
		color: #fff;
		cursor: pointer;
		-webkit-box-shadow: 0 0 9px 0 rgba(0,0,0,.1);
		-moz-box-shadow: 0 0 9px 0 rgba(0,0,0,.1);
		-ms-box-shadow: 0 0 9px 0 rgba(0,0,0,.1);
		box-shadow: 0 0 9px 0 rgba(0,0,0,.1);
	}
	.option-toggle i {
		top: 2px;
		position: relative;
	}
	.option-toggle:hover, .option-toggle:focus, .option-toggle:active {
		color:  #fff;
		text-decoration: none;
		outline: none;
	}
	
	.img-responsiv{
	height: 200px;	
	}
	
	nav a{
		color: red !important;
		font-style: bold !important;
	}
	
	.headx{
	
	border-bottom: 5px dashed #207700;
	color: #315600 !important;
	font-family: 'Amita', cursive;
	background-color: #A4E71E;
	border-radius: 2em;
	}
	
	</style>
	<!-- End demo purposes only -->


	<!-- Modernizr JS -->
	<script src="js/modernizr-2.6.2.min.js"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->

	</head>


	<!-- 
		INFO:
		Add 'boxed' class to body element to make the layout as boxed style.
		Example: 
		<body class="boxed">	
	-->
	<body>
	
	<!-- Loader -->
	<div class="fh5co-loader"></div>
	
	<div id="fh5co-page">
	
	
		<?php
		//add header file
		include('header.php');
		
		?>
		
		<!-- #fh5co-header -->
		
		<section id="fh5co-hero" class="js-fullheight" style="background-image: url(images/banner4.JPG);" data-next="yes">
			<div class="fh5co-overlay"></div>
			<div class="container">
			<div class="fh5co-intro js-fullheight">
			
			
			
			
			<div class="row">
					<div class="col-md-4 col-sm-6 col-xs-12 animate-box">
						<div class="fh5co-feature">
							<div class="fh5co-icon">
								
							</div>
							<h3><b>Support Governor Umahi for more Ebonyi Growth</b></h3>
							
						</div>
					</div>
					<div class="col-md-4 col-sm-6 col-xs-12 animate-box">
						<div class="fh5co-feature">
							<div class="fh5co-icon">
								
							</div>
							
							<a href="images/daveu.jpg" class="fh5co-project-item image-popup">
							<img src="images/daveu.jpg" alt="Image" class="img-responsive img-rounded img-circle">
						</a>
						</div>
					</div>
					<div class="clearfix visible-sm-block"></div>
					<div class="col-md-4 col-sm-6 col-xs-12 animate-box">
						<div class="fh5co-feature">
							<div class="fh5co-icon">
								
							</div>
							
							<h3><b>The Spokesman of the South-East</b></h3>
							
						</div>
					</div>
					
					</div>
			
			
			
			
			
			
			
			</div>
			
	
				
			</div>
			<div class="fh5co-learn-more animate-box">
				<a href="#" class="scroll-btn">
					
					<span class="arrow"><i class="icon-chevron-down"></i></span>
				</a>
			</div>
		</section>
		<!-- END #fh5co-hero -->


			<section id="fh5co-features">
			<div class="container">
				<div class="row text-center row-bottom-padded-md">
					<div class="col-md-8 col-md-offset-2">
						<figure class="fh5co-devices animate-box"><a href="images/banner.jpg" class="image-popup"><img src="images/banner.jpg" alt="Brigde Built" class="img-responsive"></a></figure>
						<h1 class="fh5co-lead animate-box">Creating a state for every citizen</h1>
						<p class="fh5co-sub-lead animate-box"><strong>Your Voice is heard in our Government we are listening.</strong></p>
					</div>
				</div>
				
			</div>
		</section>	

		<!-- END #fh5co-features -->
		
		
		
		
		
		<section id="fh5co-projects">
			<div class="container">
				<div class="row row-bottom-padded-md">
					<div class="col-md-6 col-md-offset-3 text-center">
						<h2 class="fh5co-lead animate-box headx"><b>Record of Success<b></h2>
						<p class="fh5co-sub-lead animate-box"></p>
					</div>
				</div>
				<div class="row">
					<?php
					//pick the re ords of sucess
					
					$rec = mysqli_query($mysqli, "SELECT * FROM records ORDER BY id DESC limit 6");
					
					while($row_rec = mysqli_fetch_array($rec)){
					?>
					
					<div class="col-md-4 col-sm-6 col-xxs-12 animate-box">
						<a href="images/<?php echo $row_rec['image']; ?>" class="fh5co-project-item image-popup">
						<center>
							<img src="images/<?php echo $row_rec['image']; ?>" alt="Image" class="img-responsive img-responsiv">
							</center>
							<div class="fh5co-text">
								<h2><?php echo  substr($row_rec['info'], 0, 35);?></h2>
								<p></p>
							</div>
						</a>
					</div>
					
					
					<?php
					
					}
					
					?>
	
				</div>
			</div>
		</section>
		<!-- END #fh5co-projects -->

	

		<!--biography -->
		
		<div id="fh5co-info" id="about">
			<div class="container">
				<div class="row">
					<div class="col-md-6">
						<figure class="animate-box">
							<img src="images/dave.png" alt="David Nweze Umahi" class="img-responsive">
						</figure>
					</div>
					<div class="col-md-6">
						<div class="fh5co-label animate-box">Little about</div>
						<h3 class="fh5co-lead animate-box">Chief Dave Umahi</h3>
						<p class="fh5co-sub-lead animate-box">He is a unique personality. He is a man of many parts. In politics, he exhibits outstanding leadership qualities that make him a credible politician. From 2007 to 2009, Chief Umahi was appointed the Acting State Chairman of Peoples Democratic Party, Ebonyi State. Following his performance as Acting Chairman, he was elected the substantive state Chairman, Peoples Democratic Party, Ebonyi State during the 2009 State Congress of the Party ; a position he held till 2011. His Excellency, Engr. David Umahi has since assumption of office proved himself a very dependable assistant to Chief Martin N. Elechi in the administration of Ebonyi State.</p>
					</div>
				</div>
			</div>
		</div>
		
		
		
		<!--News -->
		
		
		<section id="fh5co-projects">
			<div class="container">
				<div class="row row-bottom-padded-md">
					<div class="col-md-6 col-md-offset-3 text-center">
						<h2 class="fh5co-lead animate-box headx">News & Events</h2>
						<p class="fh5co-sub-lead animate-box"></p>
					</div>
				</div>
				<div class="row">
					<?php
					//pick the news
					
					$new = mysqli_query($mysqli, "SELECT * FROM news ORDER BY id DESC limit 6");
					
					while($row_new = mysqli_fetch_array($new)){
					?>
					
					<div class="col-md-4 col-sm-6 col-xxs-12 animate-box">
						<a href="news_info.php?news_id=<?php echo $row_new['id'];  ?>" class="fh5co-project-item "  >
						<center>
							<img src="images/<?php echo $row_new['image']; ?>" alt="Image" class="img-responsive img-responsiv">
							</center>
							<div class="fh5co-text">
								<h2><?php echo substr($row_new['title'], 0, 35); ?></h2>
								<p><?php echo substr($row_new['info'], 0, 35); ?>...</p>
							</div>
						</a>
					</div>
					
		
					<?php
					
					}
					
					?>

					
					
					
				</div>
			</div>
		</section>
		<!-- END #fh5co-news -->
		
		

		<section id="fh5co-features-2">
			<div class="container">
				<div class="col-md-6 col-md-push-6">
					<figure class="fh5co-feature-image animate-box">
					<a class="image-popup" href="images/power.jpg">
						<img src="images/power.jpg" alt="Electrical Power ">
						</a>
					</figure>
				</div>
				<div class="col-md-6 col-md-pull-6">
					<span class="fh5co-label animate-box"></span>
					<h2 class="fh5co-lead animate-box">Umahi for Governor</h2>
					<div class="fh5co-feature">
						<div class="fh5co-icon animate-box"><i class="icon-check2"></i></div>
						<div class="fh5co-text animate-box">
							<h3>The Independence to do whats right</h3>
							<p></p>
						</div>
					</div>
					<div class="fh5co-feature">
						<div class="fh5co-icon animate-box"><i class="icon-check2"></i></div>
						<div class="fh5co-text animate-box">
							<h3>The Experience to get it done</h3>
							<p></p>
						</div>
					</div>
					<div class="fh5co-feature">
						<div class="fh5co-icon animate-box"><i class="icon-check2"></i></div>
						<div class="fh5co-text animate-box">
							<h3>The path to Prosperity</h3>
						</div>
					</div>

					<div class="fh5co-btn-action animate-box">
						<button type="button" class="btn btn-primary btn-cta">And Many More</button>
					</div>

				</div>
			</div>
		</section>
		<!-- END #fh5co-features-2 -->
		
		
		
		<section id="fh5co-testimonials">
			<div class="container">
				<div class="row row-bottom-padded-sm">
					<div class="col-md-6 col-md-offset-3 text-center">
						<div class="fh5co-label animate-box">Comments</div>
						<h2 class="fh5co-lead animate-box">Give you opinion</h2>
					</div>
				</div>
				<div class="row">
					<div class="col-md-8 col-md-offset-2 text-center animate-box">
						<div class="flexslider">
					  		<ul class="slides">
							
							<?php
							$retrive = mysqli_query($mysqli, "SELECT * from comments  ORDER BY id DESC limit 3 ");
							while($com = mysqli_fetch_array($retrive)){
							?>
							   <li>
							      <blockquote>
							      	<p>&ldquo;<?php echo $com['comments']; ?>r&rdquo;</p>
							      	<p><cite>&mdash; <?php echo $com['name']; ?></cite></p>
							      </blockquote>
							   </li>
							  <?php
							}
							  ?>
							   
							</ul>
						</div>
						<div class="flexslider-controls">
						   <ol class="flex-control-nav">
						      <li class="animate-box"><i class="fa fa-comments fa-2x"></i></li>
						      <li class="animate-box"><i class="fa fa-comments fa-2x"></i></li>
						      <li class="animate-box"><i class="fa fa-comments fa-2x"></i></li>
						   </ol>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- END #fh5co-testimonials -->
		
	
		
<!--photos -->
		<section id="fh5co-projects">
			<div class="container">
				<div class="row row-bottom-padded-md">
					<div class="col-md-6 col-md-offset-3 text-center">
						<h2 class="fh5co-lead animate-box headx">Photos</h2>
						<p class="fh5co-sub-lead animate-box">Gallery</p>
					</div>
				</div>
				<div class="row">
					
					<?php
					//pick the records of sucess
					
					$pho = mysqli_query($mysqli, "SELECT * FROM photo ORDER BY id DESC limit 6");
					
					while($row_pho = mysqli_fetch_array($pho)){
					?>
					<div class="col-md-4 col-sm-6 col-xxs-12 animate-box">
						<a href="images/<?php echo $row_pho['image']; ?>" class="fh5co-project-item image-popup">
							<img src="images/<?php echo $row_pho['image']; ?>" alt="Image" class="img-responsive img-responsiv">
							<div class="fh5co-text">
								<h2></h2>
								<p></p>
							</div>
						</a>
					</div>
					<?php
					
					}
					
					?>

					
					
				</div>
			</div>
		</section>
		<!-- END #fh5co-photos-->
		

		
		
		
		<section id="fh5co-projects">
			<div class="container">
				<div class="row row-bottom-padded-md">
					<div class="col-md-6 col-md-offset-3 text-center">
						<h2 class="fh5co-lead animate-box headx">Mission</h2>
						<p class="fh5co-sub-lead animate-box"></p>
					</div>
				</div>
				<div class="row">
					
					<center>Our Mission is to enchance the welfare of our people, and empower all Ebonyians to be self reliant, through the compassionate delivery of transparent and God-fearing goverance, based on integrity nd dignity.</center>
					
					
					
				</div>
			</div>
		</section>
		<!-- END #fh5co-photos-->
		

		
		
		
		
		
		
		
		
		
		<footer id="fh5co-footer">
			<div class="container">
				<div class="row row-bottom-padded-md">
				
					<div class="col-md-3 col-sm-6 col-xs-12 animate-box">
						<div class="fh5co-footer-widget">
							
							<ul class="fh5co-links">
								<li><a href="record.php?cat=Poverty">Poverty alleviation</a></li>
								<li><a href="record.php?cat=Food">Food & Nutrition</a></li>
								<li><a href="record.php?cat=Health">Health & Well Being</a></li>
								<li><a href="record.php?cat=Quality">Quality Education</a></li>
								
							</ul>
						</div>
					</div>

					<div class="col-md-3 col-sm-6 col-xs-12 animate-box">
						<div class="fh5co-footer-widget">
							
							<ul class="fh5co-links">
								<li><a href="record.php?cat=Water">Water & Sanitation</a></li>
								<li><a href="record.php?cat=Geneder">Geneder Equality</a></li>
								<li><a href="record.php?cat=Infrastructure">Infrastructure Development</a></li>
							
								
							</ul>
						</div>
					</div>
					

					<div class="col-md-3 col-sm-6 col-xs-12 animate-box">
						<div class="fh5co-footer-widget">
							
							
						</div>
					</div>

					<div class="col-md-3 col-sm-6 col-xs-12 animate-box">
						<div class="fh5co-footer-widget">
							<h3>Follow Us</h3>
							<ul class="fh5co-social">
								<li><a href="#"><i class="icon-twitter"></i></a></li>
								<li><a href="#"><i class="icon-facebook"></i></a></li>
								<li><a href="#"><i class="icon-instagram"></i></a></li>
								
							</ul>
						</div>
					</div>

				</div>
				
			</div>
			<div class="fh5co-copyright animate-box">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<p class="fh5co-left"><small>&copy; <script>
                            document.write(new Date().getFullYear())
                        </script> <a href="index.php">Ebonyi For Umahi</a>. All Rights Reserved.</small></p>
							
						</div>
					</div>
				</div>
			</div>
		</footer>
		<!-- END #fh5co-footer -->
	</div>
	<!-- END #fh5co-page -->
	
	<!-- For demo purposes Only ( You may delete this anytime :-) 
	<div id="colour-variations">
		<a class="option-toggle"><i class="icon-gear"></i></a>
		<h3>Site Colors</h3>
		<ul>
			<li><a href="javascript: void(0);" data-theme="style"></a></li>
			<li><a href="javascript: void(0);" data-theme="red"></a></li>
			<li><a href="javascript: void(0);" data-theme="turquoise"></a></li>
			<li><a href="javascript: void(0);" data-theme="blue"></a></li>
			<li><a href="javascript: void(0);" data-theme="orange"></a></li>
			<li><a href="javascript: void(0);" data-theme="yellow"></a></li>
			<li><a href="javascript: void(0);" data-theme="pink"></a></li>
			<li><a href="javascript: void(0);" data-theme="purple"></a></li>
		</ul>
	</div>
	<!-- End demo purposes only -->

	
	
	<!--Modals  -->
	
	
		<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
		<div class="container">
				<div class="row row-bottom-padded-md">
				
					<div class="col-md-3 col-sm-6 col-xs-12 animate-box">
						<div class="fh5co-footer-widget">
							
							<ul class="fh5co-links">
								<li><a href="record.php?cat=Poverty">Poverty alleviation</a></li>
								<li><a href="record.php?cat=Food">Food & Nutrition</a></li>
								<li><a href="record.php?cat=Health">Health & Well Being</a></li>
								<li><a href="record.php?cat=Quality">Quality Education</a></li>
								
							</ul>
						</div>
					</div>

					<div class="col-md-3 col-sm-6 col-xs-12 animate-box">
						<div class="fh5co-footer-widget">
							
							<ul class="fh5co-links">
								<li><a href="record.php?cat=Water">Water & Sanitation</a></li>
								<li><a href="record.php?cat=Geneder">Geneder Equality</a></li>
								<li><a href="record.php?cat=Infrastructure">Infrastructure Development</a></li>
							
								
							</ul>
						</div>
					</div>
					
					
					
					</div>
					
					<div class="row row-bottom-padded-md">	
						
					<div class="col-md-3 col-sm-6 col-xs-12 animate-box">
						<div class="fh5co-footer-widget">
							
							
						</div>
					</div>

					
					
					</div>

				
				
			</div>
		
		
		
		
		
      </div>
     
    </div>
  </div>
</div>
	
	<!--Join Us Modal -->
	<div class="modal fade" id="join" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Fill Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  <?php
	  if(isset($_SESSION['msg'])){
		  
		  echo $_SESSION['msg'];
	  }else{
		  
	  
	  
	  ?>
        <form method="post" >
          <div class="form-group">
            <label for="recipient-name" class="form-control-label">Name:</label>
            <input type="text" class="form-control" id="name" name="name" required="required">
          </div>
          <div class="form-group">
            <label for="message-text" class="form-control-label">Email:</label>
            <input type="email" class="form-control" id="email" name="email" required="required">
          </div>
		   <div class="form-group">
            <label for="message-text" class="form-control-label">Phone:</label>
            <input type="number" class="form-control" id="phone" name="phone" required="required">
          </div>
		   <div class="form-group">
            <label for="message-text" class="form-control-label">Location:</label>
            <input type="text" class="form-control" id="location" name="location" required="required">
          </div>
		   <div class="form-group">
            <label for="message-text" class="form-control-label">State of Origin:</label>
            
			<select class="form-control" id="Origin" name="origin" required="required">
<option>ABUJA FCT</option>
<option>ABIA</option>
<option>ADAMAWA</option>
<option>AKWA IBOM</option>
<option>ANAMBRA</option>
<option>BAUCHI</option>
<option>BAYELSA</option>
<option>BENUE</option>
<option>BORNO</option>
<option>CROSS RIVER</option>
<option>DELTA</option>
<option>EBONYI</option>
<option>EDO</option>
<option>EKITI</option>
<option>ENUGU</option>
<option>GOMBE</option>
<option>IMO</option>
<option>JIGAWA</option>
<option>KADUNA</option>
<option>KANO</option>
<option>KATSINA</option>
<option>KEBBI</option>
<option>KOGI</option>
<option>KWARA</option>
<option>LAGOS</option>
<option>NASSARAWA</option>
<option>NIGER</option>
<option>OGUN</option>
<option>ONDO</option>
<option>OSUN</option>
<option>OYO</option>
<option>PLATEAU</option>
<option>RIVERS</option>
<option>SOKOTO</option>
<option>TARABA</option>
<option>YOBE</option>
<option>ZAMFARA</option>
</select>
          </div>
		  
		  </div>
		   <div class="modal-footer">
 
        <button type="submit" class="btn btn-primary" name="join">Join</button>
      </div>
        </form>
      
	  <?php
	  }
	  ?>
     
    </div>
  </div>
</div>
	
	
		
			<!-- Modal -->
<div class="modal fade" id="about" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
		
			
		<div id="fh5co-info" id="about">
			
				<div class="row">
					<div class="col-md-12">
						<figure class="animate-box">
							<img src="images/dave.png" alt="David Nweze Umahi" class="img-responsive">
						</figure>
					</div>
				</div>
					
				<div class="row">
					<div class="col-md-12">
						<div class="fh5co-label animate-box">Little about</div>
						<h3 class="fh5co-lead animate-box">Chief Dave Umahi</h3>
						<p class="fh5co-sub-lead animate-box">He is a unique personality. He is a man of many parts. In politics, he exhibits outstanding leadership qualities that make him a credible politician. From 2007 to 2009, Chief Umahi was appointed the Acting State Chairman of Peoples Democratic Party, Ebonyi State. Following his performance as Acting Chairman, he was elected the substantive state Chairman, Peoples Democratic Party, Ebonyi State during the 2009 State Congress of the Party ; a position he held till 2011. His Excellency, Engr. David Umahi has since assumption of office proved himself a very dependable assistant to Chief Martin N. Elechi in the administration of Ebonyi State.</p>
					</div>
				</div>
		</div>

		
      </div>
     
    </div>
  </div>
</div>
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	

	<?php
	
	if(isset($_POST['join'])){
	$name = $_POST['name'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$location = $_POST['location'];
	$origin= $_POST['origin'];
		
		
		//check if email exists
		$check = mysqli_query($mysqli,"SELECT * FROM joins where email='$email' ");
	
	if(mysqli_num_rows($check) == 0){
		//email not joined
		
		$reg = mysqli_query($mysqli, "INSERT INTO joins (name, email, phone, location, state_of) VALUES ('$name', '$email', '$phone', '$location', '$origin') ");
		
		if($reg){
			$_SESSION['email']= $email;
			$_SESSION['msg']="Request Sent Successfully";
			?>
			<script>location = location</script>
			
			<?php
		}
		
		
		
	}else{
		$_SESSION['email']= $email;
		$_SESSION['msg']="Email Already Registered";
		
		?>
			<script>location= location</script>
			
		<?php
		
		
		
	}
		
		
	}
	
	?>
	
	
	
	
	
	<!-- jQuery -->
	<script src="js/jquery.min.js"></script>
	<!-- jQuery Easing -->
	<script src="js/jquery.easing.1.3.js"></script>
	<!-- Bootstrap -->
	<script src="js/bootstrap.min.js"></script>
	<!-- Waypoints -->
	<script src="js/jquery.waypoints.min.js"></script>
	<!-- Flexslider -->
	<script src="js/jquery.flexslider-min.js"></script>
	<!-- Magnific Popup -->
	<script src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/magnific-popup-options.js"></script>
	<!-- <script src="js/jquery.menu-aim.js"></script>  menu aim -->
	
	<!-- For demo purposes only styleswitcher ( You may delete this anytime ) -->
	<script src="js/jquery.style.switcher.js"></script>
	<script>
		$(function(){
			$('#colour-variations ul').styleSwitcher({
				defaultThemeId: 'theme-switch',
				hasPreview: false,
				cookie: {
		          	expires: 30,
		          	isManagingLoad: true
		      	}
			});	
			$('.option-toggle').click(function() {
				$('#colour-variations').toggleClass('sleep');
			});
		});
	</script>
	<!-- End demo purposes only -->

	<!-- Main JS (Do not remove) -->
	<script src="js/main.js"></script>

	<!-- 
	INFO:
	jQuery Cookie for Demo Purposes Only. 
	The code below is to toggle the layout to boxed or wide 
	-->
	<script src="js/jquery.cookie.js"></script>
	<script>
		$(function(){

			if ( $.cookie('layoutCookie') != '' ) {
				$('body').addClass($.cookie('layoutCookie'));
			}

			$('a[data-layout="boxed"]').click(function(event){
				event.preventDefault();
				$.cookie('layoutCookie', 'boxed', { expires: 7, path: '/'});
				$('body').addClass($.cookie('layoutCookie')); // the value is boxed.
			});

			$('a[data-layout="wide"]').click(function(event){
				event.preventDefault();
				$('body').removeClass($.cookie('layoutCookie')); // the value is boxed.
				$.removeCookie('layoutCookie', { path: '/' }); // remove the value of our cookie 'layoutCookie'
			});
		});
	</script>
	
	
	
	

	</body>
</html>

