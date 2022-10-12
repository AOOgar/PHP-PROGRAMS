<?php
//starting a session
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="images/jconnectorzicon.png">
    <link rel="icon" type="image/png" href="images/jconnectorzicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Checkout</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    
	<!-- Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="assets/fa/css/font-awesome.min.css" />
    <!-- CSS Files -->
    <link href="./assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="./assets/css/now-ui-kit.css?v=1.1.0" rel="stylesheet" />
   <!-- my demo-->
    <link href="./assets/css/demo.css" rel="stylesheet" />
	<!-- my javascrit cart -->
	<script src="assets/simpleCart.js"></script>
	<script src="assets/jquery.1.6.1.min.js"></script>
	
	<script type="text/javascript">
	//make a naria note
	simpleCart.currency({
		code: "NAR",
		name: "Naria",
		symbol: "&#8358;"
	});
	
	//activate the naria
	simpleCart.currency("NAR");
	
	var originalMethod = simpleCart.writeCart;
	simpleCart.extend({
		writeCart: function (selector){
			originalMethod(selector);
			simpleCart.trigger('afterCartCreate');
		}
	});
	
	//make my cart in tabular form
	simpleCart({
		cartStyle: "table"
	});
	
	
	//some bootstrap classes to add little sleek design
	simpleCart.on('afterCartCreate', function(){
		console.log("After create");
		$('.simpleCart_items').addClass('table').addClass('table-hover');
		$('.item-remove a').addClass('btn').addClass('btn-primary').addClass('btn-round');
		$('.item-remove').innerHTML = "fa fa-times";
	
		//$('.item-decrement a').addClass('btn').addClass('btn-primary');
		//$('.item-increment a').addClass('btn').addClass('btn-primary');
	});
	
	//set up for checkout
	simpleCart({
		checkout: {
			type: "SendForm",
			url: "checkout.php",
			method: "GET"
			
			
			
		}
	});
	
	
	</script>
	
	
</head>

<body class="profile-page sidebar-collapse">
    <?php
	
	//adding header
include("header.php");

	
	?>
	
	<div class="wrapper">
        <div class="page-header page-header-small" filter-color="orange">
            <div class="page-header-image" data-parallax="true" style="background-image: url('images/cosmetics2.jpg');">
            </div>
            
			 <div class="container">
                <div class="content-center">
                  <a href="javascript:;" id="checkout" class="btn btn-default btn-round btn-lg btn-icon simpleCart_checkout" rel="tooltip" title="Checkout" >
                        <i class="fa fa-shopping-cart"></i>
                    </a>
                    <div class="content">
                        
                        <div class="social-description">
                            <h2>5</h2>
                            <p>Items in cart</p>
                        </div>
                       
                    </div>
                </div>
            </div>
			
			
        </div>
	
	
	 <div class="section">
            <div class="container">
	
	      <!--login/register button for non-user . before finally checkout -->
		   <div class="button-container">
                    <i href="#" class="btn btn-primary btn-round btn-lg"   data-toggle="modal" data-target="#login"><i class="fa fa-key"> </i> Login or Register</i>
 	
                </div>
		  
		  <div  data-background-color="orange" class="container-fluid">
			<form class="form" method="post">
			<div class="header text-center">
                                    <h4 class="title title-up">Check out</h4>
									
                                    <div class="social-line">
                                        <b  class="btn btn-neutral btn-twitter btn-icon btn-lg btn-round">
                                            <i class="fa fa-shopping-cart"></i>
                                        </b>
                                    </div>
									
                                </div>
			
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
                                <input type="text" class="form-control form-control-success" placeholder="Phone Number" name="phone" required>
                            </div>
						<div class="input-group form-group-no-border input-lg">
                                <span class="input-group-addon">
                                    <i class="fa fa-location-arrow"></i>
                                </span>
                                <input type="Text" class="form-control form-control-success" placeholder="City" name="city" required>
                            </div>
						<div class="textarea-container input-group form-group-no-border input-lg">
                            <textarea class="form-control" name="name" rows="4" cols="80" placeholder="Full Address..." required ></textarea>
						</div>
		  
		  
					
		  
		  
				<input type="submit" class="btn btn-default btn-round btn-lg" value="Place Order" name="order">
		  
		  
		  
			</form>
		</div>  

			</div>
	</div>
	
	
	
	
	
	
	  <!-- login Modal -->
        <div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header justify-content-center">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                            <i class="now-ui-icons ui-1_simple-remove"></i>
                        </button>
                        <h4 class="title title-up">Login</h4>
                    </div>
                    <div class="modal-body">
                        <form class="form"  method="get" >
						
						 <div class="input-group form-group-no-border input-lg">
                                <span class="input-group-addon">
                                    <i class="fa fa-envelope"></i>
                                </span>
                                <input type="email" class="form-control form-control-success" placeholder="Email.." name="email" required>
                            </div>
							
							 <div class="input-group form-group-no-border input-lg">
                                <span class="input-group-addon">
                                    <i class="fa fa-key"></i>
                                </span>
                                <input type="password" class="form-control form-control-success" placeholder="Password.." name="password" required>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-primary" value="Login" name="login">
						
                        <input type="submit" class="btn btn-warning" value="Register" name="register" >
						</form>
                    </div>
                </div>
            </div>
        </div>
        <!--  End Modal -->
	
	
	
	
	
	<?php
	   
	   //adding footer
include("footer.php");

	   
	   ?>
	
	</div>
</body>
<!--   Core JS Files am puting this down here to boost site loaad time  -->

<script src="./assets/js/core/jquery.3.2.1.min.js" type="text/javascript"></script>
<script src="./assets/js/core/popper.min.js" type="text/javascript"></script>
<script src="./assets/js/core/bootstrap.min.js" type="text/javascript"></script>


<script src="./assets/js/plugins/nouislider.min.js" type="text/javascript"></script>

<script src="./assets/js/now-ui-kit.js?v=1.1.0" type="text/javascript"></script>


</html>