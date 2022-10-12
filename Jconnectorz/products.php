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
    <title>Market Place</title>
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
		
		$('table').addClass('table').addClass('table-hover');
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
	  //adding the header
	  include('header.php');
	  
	  ?>
	  
	  
	  
    <div class="wrapper">
        <div class="page-header page-header-small" filter-color="orange">
            <div class="page-header-image" data-parallax="true" style="background-image: url('images/cosmetics2.jpg');">
            </div>
            
        </div>
        <div class="section">
            <div class="container">
                <div class="button-container">
                    <i href="#" class="btn btn-primary btn-round btn-lg">Easily Purchase Cosmetics</i>
                    <a href="#" class="btn btn-default btn-round btn-sm " rel="tooltip" title="View Saved Items"  data-toggle="modal" data-target="#Cart">
					<i class="fa fa-cart-plus"></i>
					<span class="badge simpleCart_quantity" id="simpleCart_quantity" ></span>
                       
						
                    </a>
					
					
                    
                </div>
                
                <div class="row">
                    <div class="col-md-6 ml-auto mr-auto">
                        <h4 class="title text-center"></h4>
                        <div class="nav-align-center">
                            <ul class="nav nav-pills nav-pills-primary" role="tablist">
                                <li class="nav-item">
								<center class="text-center text-primary">Lips</center>
                                    <a class="nav-link active" data-toggle="tab" href="#lips" role="tablist">
									
                                        <i class="now-ui-icons shopping_tag-content"></i>
										
                                    </a>
									
                                </li>
                                <li class="nav-item">
								<center class="text-center text-primary">Powders</center>
                                    <a class="nav-link " data-toggle="tab" href="#powders" role="tablist">
									
                                        <i class="fa  fa-paw"></i>
                                    </a>
                                </li>
                                <li class="nav-item">
								<center class="text-center text-primary">Skin Cares</center>
                                    <a class="nav-link" data-toggle="tab" href="#skin" role="tablist">
									
                                        <i class="fa fa-hand-paper-o"></i>
                                    </a>
                                </li>
								<li class="nav-item">
								<center class="text-center text-primary">Perfumes</center>
                                    <a class="nav-link" data-toggle="tab" href="#perfumes" role="tablist">
									
                                        <i class="now-ui-icons objects_diamond"></i>
                                    </a>
                                </li>
								<li class="nav-item">
								<center class="text-center text-primary">Eyes</center>
                                    <a class="nav-link" data-toggle="tab" href="#eyes" role="tablist">
									
                                        <i class="fa fa-eye"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- Tab panes -->
                    <div class="tab-content gallery">
                        <div class="tab-pane " id="powders" role="tabpanel">
                            <div class="col-md-12 ml-auto mr-auto">
                                <div class="row">
								
                                    <div class="col-md-4">
                                       
													   
								 <div class="card simpleCart_shelfItem"  >
				  <img class="card-img-top item_thumb" src="assets/img/bg8.jpg" alt="Card image cap">
				  <div class="card-block card-body">
					<h5 class="card-title item_name">Active Powder</h5>
					<p class="card-text">  <b class="text-success item_price">₦900 </b> <strike class="text-danger">₦1300</strike> </p>
					<p class="card-text">Clay 1 1.0 floz(30 ml)</p>
					
					
					
					
					
					
					<a href="javascript:;" class="btn btn-primary item_add" onclick="return alert('Item Added');" >Add to Cart</a>
					<a href="#" class="btn btn-info"  ><i class="fa fa-whatsapp "></i> Contact Seller</a>
				  </div>
				</div>
									   
									   
									  
							 
									</div>
									
									
									
                                    <div class="col-md-4">
                                       

										 <div class="card simpleCart_shelfItem"  >
				  <img class="card-img-top item_thumb" src="assets/img/bg8.jpg" alt="Card image cap">
				  <div class="card-block card-body">
					<h5 class="card-title item_name">Blossm Powder</h5>
					<p class="card-text">  <b class="text-success item_price">₦2000</b>  <strike class="text-danger">₦1300</strike> </p>
					<p class="card-text">Clay 1 1.0 floz(30 ml)</p>
					
					
					
					
					
					<a href="javascript:;" class="btn btn-primary item_add"  onclick="return alert('Item Added');" >Add to Cart</a>
					<a href="#" class="btn btn-info"><i class="fa fa-whatsapp "></i> Contact Seller</a>
				  </div>
				</div>
						



                                    </div>
									
									
									
							<div class="col-md-4">
                                       

										 <div class="card simpleCart_shelfItem"  >
				  <img class="card-img-top item_thumb" src="assets/img/bg11.jpg" alt="Card image cap">
				  <div class="card-block card-body">
					<h5 class="card-title item_name">Cleaner X</h5>
					<p class="card-text">  <b class="text-danger item_price">₦850</b> <strike>₦1300</strike> </p>
					<p class="card-text">Clay 1 1.0 floz(30 ml)</p>
					<a href="javascript:;" class="btn btn-primary item_add" onclick="return alert('Item Added');"  >Add to Cart</a>
					<a href="#" class="btn btn-info"><i class="fa fa-whatsapp "></i> Contact Seller</a>
				  </div>
				</div>
						



                                    </div>		
									
									
									
									
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane active" id="lips" role="tabpanel">
                            <div class="col-md-10 ml-auto mr-auto">
                               
							    <div class="row">
								
                                    <div class="col-md-4">
                                       
													   
								 <div class="card simpleCart_shelfItem"  >
				  <img class="card-img-top item_thumb" src="images/lips1.png" alt="Card image cap">
				  <div class="card-block card-body">
					<h5 class="card-title item_name">Lips Bom</h5>
					<p class="card-text">  <b class="text-success item_price">₦300</b> <strike  class="text-danger">₦1300</strike> </p>
					<p class="card-text">Clay 1 1.0 floz(30 ml)</p>
					<a href="javascript:;" class="btn btn-primary item_add"  onclick="return alert('Item Added');"  >Add to Cart</a>
					<a href="#" class="btn btn-info"><i class="fa fa-whatsapp "></i> Contact Seller</a>
				  </div>
				</div>
									   
									   
									  
							 
									</div>
									
									
									
                                    <div class="col-md-4">
                                       

										 <div class="card simpleCart_shelfItem"  >
				  <img class="card-img-top item_thumb" src="images/lips2.png" alt="Card image cap">
				  <div class="card-block card-body">
					<h5 class="card-title item_name">Muti color</h5>
					<p class="card-text">  <b class="text-success item_price">₦2500</b> <strike class="text-danger">₦1300</strike> </p>
					<p class="card-text">Clay 1 1.0 floz(30 ml)</p>
					<a href="javascript:;" class="btn btn-primary item_add" onclick="return alert('Item Added');" >Add to Cart</a>
					<a href="#" class="btn btn-info"><i class="fa fa-whatsapp "></i> Contact Seller</a>
				  </div>
				</div>
						



                                    </div>
									
									
									
							<div class="col-md-4">
                                       

										 <div class="card simpleCart_shelfItem"  >
				  <img class="card-img-top item_thumb" src="assets/img/bg11.jpg" alt="Card image cap">
				  <div class="card-block card-body">
					<h5 class="card-title item_name">O Lips</h5>
					<p class="card-text">  <b class="text-danger item_price">₦1300</b></p>
					<a href="javascript:;" class="btn btn-primary item_add" onclick="return alert('Item Added');" >Add to Cart</a>
					<a href="#" class="btn btn-info"><i class="fa fa-whatsapp "></i> Contact Seller</a>
				  </div>
				</div>
						



                                    </div>		
									
									
									
									
                                </div>
							   
							   
							   
                            </div>
                        </div>
						<div class="tab-pane" id="skin" role="tabpanel">
                            <div class="col-md-10 ml-auto mr-auto">
                               
							    <div class="row">
								
                                    <div class="col-md-4">
                                       
													   
								 <div class="card simpleCart_shelfItem"  >
				  <img class="card-img-top item_thumb" src="images/lips1.png" alt="Card image cap">
				  <div class="card-block card-body">
					<h5 class="card-title item_name">Lips Bom</h5>
					<p class="card-text">  <b class="text-success item_price">₦1500</b> <strike class="text-danger">₦2000</strike> </p>
					<p class="card-text">Clay 1 1.0 floz(30 ml)</p>
					<a href="javascript:;" class="btn btn-primary item_add" onclick="return alert('Item Added');" >Add to Cart</a>
					<a href="#" class="btn btn-info"><i class="fa fa-whatsapp "></i> Contact Seller</a>
				  </div>
				</div>
									   
									   
									  
							 
									</div>
									
									
									
                                    <div class="col-md-4">
                                       

										 <div class="card simpleCart_shelfItem"  >
				  <img class="card-img-top item_thumb" src="images/lips2.png" alt="Card image cap">
				  <div class="card-block card-body">
					<h5 class="card-title item_name">Muti color</h5>
					<p class="card-text">  <b class="text-danger item_price">₦2500</b></p>
					<a href="javascript:;" class="btn btn-primary item_add" onclick="return alert('Item Added');"  >Add to Cart</a>
					<a href="#" class="btn btn-info"><i class="fa fa-whatsapp "></i> Contact Seller</a>
				  </div>
				</div>
						



                                    </div>
									
									
									
							<div class="col-md-4">
                                       

										 <div class="card simpleCart_shelfItem"  >
				  <img class="card-img-top item_thumb" src="assets/img/bg11.jpg" alt="Card image cap">
				  <div class="card-block card-body">
					<h5 class="card-title item_name">O Lips</h5>
					<p class="card-text">  <b class="text-danger item_price">₦1300</b></p>
					<a href="javascript:;" class="btn btn-primary item_add" onclick="return alert('Item Added');" >Add to Cart</a>
					<a href="#" class="btn btn-info"><i class="fa fa-whatsapp "></i> Contact Seller</a>
				  </div>
				</div>
						



                                    </div>		
									
									
									
									
                                </div>
							   
							   
							   
                            </div>
                        </div>
						
						
						
						<div class="tab-pane" id="eyes" role="tabpanel">
                            <div class="col-md-10 ml-auto mr-auto">
                               
							    <div class="row">
								
                                    <div class="col-md-4">
                                       
													   
								 <div class="card simpleCart_shelfItem"  >
				  <img class="card-img-top item_thumb" src="images/lips1.png" alt="Card image cap">
				  <div class="card-block card-body">
					<h5 class="card-title item_name">Lips Bom</h5>
					<p class="card-text">  <b class="text-success item_price">₦300</b> <strike class="text-danger">₦600</strike> </p>
					<p class="card-text">Clay 1 1.0 floz(30 ml)</p>
					<a href="javascript:;" class="btn btn-primary item_add" onclick="return alert('Item Added');"  >Add to Cart</a>
					<a href="#" class="btn btn-info"><i class="fa fa-whatsapp "></i> Contact Seller</a>
				  </div>
				</div>
									   
									   
									  
							 
									</div>
									
									
									
                                    <div class="col-md-4">
                                       

										 <div class="card simpleCart_shelfItem"  >
				  <img class="card-img-top item_thumb" src="images/lips2.png" alt="Card image cap">
				  <div class="card-block card-body">
					<h5 class="card-title item_name">Muti color</h5>
					<p class="card-text">  <b class="text-danger item_price">₦2500</b></p>
					<a href="javascript:;" class="btn btn-primary item_add" onclick="return alert('Item Added');"  >Add to Cart</a>
					<a href="#" class="btn btn-info"><i class="fa fa-whatsapp "></i> Contact Seller</a>
				  </div>
				</div>
						



                                    </div>
									
									
									
							<div class="col-md-4">
                                       

										 <div class="card simpleCart_shelfItem"  >
				  <img class="card-img-top item_thumb" src="assets/img/bg11.jpg" alt="Card image cap">
				  <div class="card-block card-body">
					<h5 class="card-title item_name">O Lips</h5>
					<p class="card-text">  <b class="text-danger item_price">₦1300</b></p>
					<a href="javascript:;" class="btn btn-primary item_add" onclick="return alert('Item Added');"  >Add to Cart</a>
					<a href="#" class="btn btn-info"><i class="fa fa-whatsapp "></i> Contact Seller</a>
				  </div>
				</div>
						



                                    </div>		
									
									
									
									
                                </div>
							   
							   
							   
                            </div>
                        </div>
						
						
						
						
                        <div class="tab-pane" id="perfumes" role="tabpanel">
                            <div class="col-md-10 ml-auto mr-auto">
                               
							   
							   <div class="row">
								
                                    <div class="col-md-4">
                                       
													   
								 <div class="card simpleCart_shelfItem"  >
				  <img class="card-img-top item_thumb" src="assets/img/bg8.jpg" alt="Card image cap">
				  <div class="card-block card-body">
					<h5 class="card-title item_name">vanilla Perfume</h5>
					<p class="card-text">  <b class="text-success item_price">₦700</b> <strike class="text-danger">₦1000</strike> </p>
					<p class="card-text">Clay 1 1.0 floz(30 ml)</p>
					<a href="javascript:;" class="btn btn-primary item_add"data-container="body" data-original-title="item Added" data-toggle="popover" data-placement="top" >Add to Cart</a>
					<a href="#" class="btn btn-info"><i class="fa fa-whatsapp "></i> Contact Seller</a>
				  </div>
				</div>
									   
									   
									  
							 
									</div>
									
									
									
                                    <div class="col-md-4">
                                       

										 <div class="card simpleCart_shelfItem"  >
				  <img class="card-img-top item_thumb" src="assets/img/bg8.jpg" alt="Card image cap">
				  <div class="card-block card-body">
					<h5 class="card-title item_name">Active men</h5>
					<p class="card-text">  <b class="text-danger item_price">₦2000</b></p>
					<a href="javascript:;" class="btn btn-primary item_add" data-container="body" data-original-title="item Added" data-toggle="popover" data-placement="top" >Add to Cart</a>
					<a href="#" class="btn btn-info"><i class="fa fa-whatsapp "></i> Contact Seller</a>
				  </div>
				</div>
						



                                    </div>
									
									
									
							<div class="col-md-4">
                                       

										 <div class="card simpleCart_shelfItem"  >
				  <img class="card-img-top item_thumb" src="assets/img/bg11.jpg" alt="Card image cap">
				  <div class="card-block card-body">
					<h5 class="card-title item_name">Smart</h5>
					<p class="card-text">  <b class="text-danger item_price">₦800</b></p>
					<a href="javascript:;" class="btn btn-primary item_add"data-container="body" data-original-title="item Added" data-toggle="popover" data-placement="top"  >Add to Cart</a>
					<a href="#" class="btn btn-info"><i class="fa fa-whatsapp "></i> Contact Seller</a>
				  </div>
				</div>
						



                                    </div>		
									
									
									
									
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
	   //adding the footer
	   include('footer.php');
	   ?>
	   
	   
	   
	   
	   
	   
	   
	   <div class="modal fade" id="Cart" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header justify-content-center">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                            <i class="now-ui-icons ui-1_simple-remove"></i>
                        </button>
                        <h4 class="title title-up">Cart</h4>
                    </div>
                    <div class="modal-body">
                       
					   <div class="simpleCart_items" >
						</div>
					   
					   
					   SubTotal: <span id="simpleCart_total" class="simpleCart_total"></span> <br />
	Shipping: <span id="simpleCart_shipping" class="simpleCart_shipping"></span> <br />
	<hr />
	<b class="text-info">Final Total: <span id="simpleCart_grandTotal" class="simpleCart_grandTotal"></span></b>
					   
					   
					   
					   
                    </div>
                    <div class="modal-footer">
                        <a href="javascript:;" class="btn btn-success btn-round simpleCart_checkout">Checkout</a>
						
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>   
	   
	   
	   
	   
	   
	
	   
	   
	   
	   
	   
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