<!DOCTYPE HTML>
<!--
	Designed by Jesse(Coders)
-->
<?php
include 'conn.php';
$sus_msg ="";
$sus_msg2="";
$sus_msg3="";
if(isset($_POST['contact'])){
	$name = $_POST['name_cus'];
	$email = $_POST['email_cus'];
	$msg =$_POST['message_cus'];
	
	$query1 = mysqli_query($mysqli,"INSERT into contact (name,email,message) values('$name','$email','$msg')");
	if($query1){
		$sus_msg = "Message sent, we will get back to you.";
	}
	
}


if(isset($_POST['order'])){
	$product = $_POST['product_name'];
	$email_p =$_POST['email_p'];
	$quantity =$_POST['quantity'];
	$address = $_POST['location'];
	$phone = $_POST['phone_p'];
	$city = $_POST['city'];
	
	$query2 = mysqli_query($mysqli,"INSERT into already (product_name,email,quantity,address,phone_number,city) values('$product','$email_p','$quantity','$address','$phone','$city')");
	
	if($query2){
		$sus_msg2="Order Placed we will get back to you.";
	}
}


if(isset($_POST['Make_Request'])){
	$name = $_POST['name_cp'];
	$email_cp =$_POST['email_cp'];
	$length = $_POST['length'];
	$waist = $_POST['waist'];
	$sleeve =$_POST['sleeve'];
	$round = $_POST['round_sleeve'];
	$chest = $_POST['chest'];
	
	$query3 = mysqli_query($mysqli,"INSERT into custom 
	(name,email,full_length,waist,sleeve_length,round_sleeve,brust_chest) values ('$name','$email_cp',$length,'$waist','$sleeve','$round','$chest')");
	
	if($query3){
		$sus_msg3 ="Request Made, we will get Back to you";
	}
}

?>
<html>
	<head>
		<title>Modarac Concept - Bespoke sewing and Production</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		
		<!--slider things -->
		 <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/full-slider.css" rel="stylesheet">
	<link rel="icon" href="images/micon.png" />
			
		
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
		
		
		<style>
		
		
	.fa {
		text-decoration: none;
		border-bottom: none;
		position: relative;
	}

		.fa:before {
			-moz-osx-font-smoothing: grayscale;
			-webkit-font-smoothing: antialiased;
			font-family: FontAwesome;
			font-style: normal;
			font-weight: normal;
			text-transform: none !important;
		}

		.fa > .label {
			display: none;
		}

		
		
		</style>
		
		
		
	</head>
	<body>

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Header -->
					<header id="header">
						<h1><a href="index.php"><strong>Modarac Concept</strong> </a></h1>
						<nav>
							<ul>
								<li><abbr title="About" ><a href="#footer" class="fa fa-info-circle fa-2x"></a></abbr></li>
								<li><abbr title="Services"><a href="#footer2" class=" fa fa-cogs fa-2x"></a></abbr><li> 
								<li><abbr title="Contact"><a href="#footer3" class=" fa fa-phone fa-2x"></a></abbr></li>
								</ul>
						</nav>
					</header>
					
					
					
					
					
				
				<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner" role="listbox">
          <!-- Slide One - Set the background image for this slide in the line below -->
          <div class="carousel-item active" style="background-image: url('css/mod1.jpg')">
            <div class="carousel-caption d-none d-md-block">
              
			  </div>
          </div>
          <!-- Slide Two - Set the background image for this slide in the line below -->
          <div class="carousel-item" style="background-image: url('css/mod2.png')">
            <div class="carousel-caption d-none d-md-block">
             
            </div>
          </div>
          <!-- Slide Three - Set the background image for this slide in the line below -->
         
		   <div class="carousel-item" style="background-image: url('css/mod3.png')">
            <div class="carousel-caption d-none d-md-block">
              
            </div>
          </div>
		  
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
				
				
				
				
				
				<center><h1>Our Products</h1></center>
				<!-- Main -->
					<div id="main">
					
						<article class="thumb">
							<a href="images/mod1.jpeg" class="image"><img src="images/mod1.jpeg" alt="" width="360px" height="247px" /></a>
							<h2>Native top <br/>₦1,800</h2>
							<p></p>
						</article>
						<article class="thumb">
							<a href="images/mod2.jpg" class="image"><img src="images/mod2.jpg" alt="" width="360px" height="247px" /></a>
							<h2>Native long Sleeve<br/>₦2,500</h2>
							<p></p>
						</article>
						<article class="thumb">
							<a href="images/mod3.jpg" class="image"><img src="images/mod3.jpg" alt="" width="360px" height="247px" /></a>
							<h2>Native long Sleeve<br/>₦2,500</h2>
							<p></p>
						</article>
						<article class="thumb">
							<a href="images/mod4.jpeg" class="image"><img src="images/mod4.jpeg" alt="" width="360px" height="247px" /></a>
							<h2>V shape trouser<br/>₦5,000</h2>
							<p></p>
						</article>
						<article class="thumb">
							<a href="images/mod5.jpeg" class="image"><img src="images/mod5.jpeg" alt="" width="360px" height="247px" /></a>
							<h2>long grown<br/>₦7,500</h2>
							<p></p>
						</article>
						<article class="thumb">
							<a href="images/mod6.jpeg" class="image"><img src="images/mod6.jpeg" alt="" width="360px" height="247px" /></a>
							<h2>Short sewn grown<br/>₦4,000</h2>
							<p></p>
						</article>
						<article class="thumb">
							<a href="images/mod7.jpeg" class="image"><img src="images/mod7.jpeg" alt="" width="360px" height="247px" /></a>
							<h2>Red Long Sleeve<br/>₦3,500</h2>
							<p></p>
						</article>
						<article class="thumb">
							<a href="images/mod8.jpeg" class="image"><img src="images/mod8.jpeg" alt="" width="360px" height="247px" /></a>
							<h2>Black line sleeve<br/>₦3,000</h2>
							<p></p>
						</article>
						<article class="thumb">
							<a href="images/mod9.jpeg" class="image"><img src="images/mod9.jpeg" alt="" width="360px" height="247px" /></a>
							<h2>Purple Shirt<br/>₦4,800</h2>
							<p></p>
						</article>
						<article class="thumb">
							<a href="images/mod10.jpeg" class="image"><img src="images/mod10.jpeg" alt="" width="360px" height="247px" /></a>
							<h2>Short Blouse<br/>₦6,800</h2>
							<p></p>
						</article>
						<article class="thumb">
							<a href="images/mod11.jpeg" class="image"><img src="images/mod11.jpeg" alt="" width="360px" height="247px" /></a>
							<h2>flay Grown<br/>₦5,500</h2>
							<p></p>
						</article>
						<article class="thumb">
							<a href="images/mod12.jpeg" class="image"><img src="images/mod12.jpeg" alt="" width="360px" height="247px" /></a>
							<h2>Blouse<br/>₦5,000</h2>
							<p></p>
						</article>
					</div>

				<!-- Footer -->
					<footer id="footer" class="panel">
						<div class="inner split">
							<div>
								<section>
									<h2>Modarac Concept</h2>
									<h6><i>Bespoke sewing and production</i></h6>
									<p>Modarac Concept is a company that provides one of the best bespoke tailoring for men, women and children. We design cloth specifically to suit your style and comfort. We are 99.9% committed to quality services and deliver on time.</p>
								</section>
								<section>
									<h2>Follow Us ...</h2>
									<ul class="icons">
										<li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
										<li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
										<li><a href="#" class="icon fa-instagram"><span class="label">Instagram</span></a></li>
										<li><a href="https://api.whatsapp.com/send?phone=+2348059235487&text=Hi%20i%20want%20to%20place%20an%20order%20on%20Modarac%20Concept." class="icon fa-whatsapp"><span class="label">WhatsApp</span></a></li>
									
									</ul>
								</section>
								<p class="copyright">
									&copy; Modarac Concept. Designed: By Jesse(Coders).
								</p>
							</div>
							<div>
								<section>
									<h2>Ogunyanwo Damilola Rachel</h2>
									<h6><i>Creative Director</i></h6>
									<p>Clothes are Custom made according to your measurement and when you use fabric from Us, you can count on them being cut and sewn in a way that accentuate your figure. we also use the best quality materials available.</p>
									<p>Bad fit spoils more than just your look hence accurate fitting and aesthetic finishing is our watchword.</p>
									<img src="images/mlogo.png" alt="Modarac Logo" />
								</section>
							</div>
						</div>
					</footer>
					
					
					
					<!--Services -->
					
					<footer id="footer2" class="panel">
						<div class="inner split">
							<div>
								<section>
								<h2>Request already Made Product</h2>
									<form method="post" >
										<div class="field half first">
											<input type="text" name="product_name" id="product name" placeholder="Product Name" required />
										</div>
										<div class="field half">
											<input type="email" name="email_p" id="email" placeholder="Your Email" required />
										</div>
										<div class="field half first">
											<input type="text" name="quantity" id="quantity" placeholder="Enter Quantity" required />
										</div>
										<div class="field half">
											<input type="text" name="location" id="location" placeholder="Enter your Address" required />
										</div>
										
										<div class="field half first">
											<input type="text" name="phone_p" id="phone" placeholder="Enter your phone number" required />
										</div>
										<div class="field half">
											<input type="text" name="city" id="city" placeholder="Enter City" />
										<br/>
										<ul class="actions">
											<li><input type="submit" value="Push" name="order" class="special" /></li>
											<li><input type="reset" value="Reset" id="reset"/></li>
										</ul>
										<p><?php echo $sus_msg2; ?></p>
									</form>
								</section>
								<br/>
								<p class="copyright">
									&copy; Modarac Concept. Designed: By Jesse(Coders).
								</p>
							</div>
							<div>
								<section>
									<h2>Request Custom made Product</h2>
									<form method="post" >
										<div class="field half first">
											<input type="text" name="name_cp" id="name" placeholder="Name" required />
										</div>
										<div class="field half">
											<input type="email" name="email_cp" id="email" placeholder="Email" required />
										</div>
										<div class="field half first">
											<input type="text" name="length"  placeholder="Full Length" required />
										</div>
										<div class="field half">
											<input type="text" name="waist"  placeholder="Waist measurement" required />
										</div>
										
										<div class="field">
											<textarea name="sleeve" id="message" rows="1" placeholder="Sleeve length" required ></textarea>
										</div>
										<div class="field">
											<textarea name="round_sleeve" id="message" rows="1" placeholder="Round sleeve" required ></textarea>
										</div>
										<div class="field">
											<textarea name="chest" id="message" rows="1" placeholder="Burst or Chest measurement" required ></textarea>
										</div>
										<ul class="actions">
											<li><input type="submit" value="Make Request" name="Make_Request" class="special" /></li>
											<li><input type="reset" value="Reset" id="reset"/></li>
										</ul>
										<p><?php echo $sus_msg3; ?></p>
									</form>
								</section>
							</div>
						</div>
					</footer>
					
					
					
					
					
					<!--contact-->
					<footer id="footer3" class="panel">
						<div class="inner split">
							<div>
								<section>
									<h2>Contacts</h2>
									
									<p>Contact us to arrange a convenient date fro accurate measurement. We offer free pick up and delivery in Abuja.<br/>Atelier-1242, trans engineering layout,Dawaki extension Abuja.</p> <p> Phone:  <a href="tel:08059235487">+2348059235487</a>   <a href="tel:08059235487"><i class="icon fa-phone"> </i> Call Now </a> </p> <p>Email: info@modaracconcept.com</p>
								</section>
								
								<p class="copyright">
									&copy; Modarac Concept. Designed: By Jesse(Coders).
								</p>
							</div>
							<div>
								<section>
									<h2>Get in touch</h2>
									<form method="post" >
										<div class="field half first">
											<input type="text" name="name_cus" id="name" placeholder="Name" required/>
										</div>
										<div class="field half">
											<input type="email" name="email_cus" id="email" placeholder="Email" required/>
										</div>
										<div class="field">
											<textarea name="message_cus" id="message" rows="4" placeholder="Message" required></textarea>
										</div>
										<ul class="actions">
											<li><input type="submit" value="Send" name="contact" class="special" /></li>
											<li><input type="reset" value="Reset" id="reset"/></li>
											<p><?php echo $sus_msg; ?></p>
										</ul>
									</form>
								</section>
							</div>
						</div>
					</footer>

			</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.poptrox.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>

			
			
			
			<!-- slider things -->
			 <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/popper/popper.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
			
			
			
			
	</body>
</html>