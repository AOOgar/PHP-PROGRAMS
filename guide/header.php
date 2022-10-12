
<style>
nav a{
		color: white !important;
		font-size: 1em !important;
		letter-spacing:0.1em;
		 text-shadow:1px 1px 2px green;
	}
</style>

<section id="fh5co-header">
			<div class="container">
				<nav role="navigation">
					<ul class="pull-left left-menu">
					<li><a href="#"  data-toggle="modal" data-target="#about"><b>About</b></a></li>
					<li><a href="#"  data-toggle="modal" data-target="#myModal"><b>Record of Sucess</b></a></li>
					<li><a href="photo.php"><b>Photos</b></a></li>
						
						
					</ul>
					<h1 id="fh5co-logo"><a href="index.php"><b style="font-family: 'Amita', cursive; color:green">EBONYI FOR UMAHI</b><span>.</span></a></h1>
					<ul class="pull-right right-menu">
						<li><a href="news.php"><b>News & Event</b></a></li>
						
						<li class="fh5co-cta-btn"><a href="#" data-toggle="modal" data-target="#join"><b><?php 
						if(isset($_SESSION['email'])){
							echo $_SESSION['email'];
						}else{
							echo "Join Us";
						}
						?></b></a></li>
					</ul>
				</nav>
			</div>
		</section>
		
		
		

	
	
	