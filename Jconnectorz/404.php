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
    <title>Jconnectorz - Error</title>
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
   
    
        <div class="page-header clear-filter" filter-color="orange">
            <div class="page-header-image" data-parallax="true" style="background-image: url('images/<?php echo date('l'); ?>.jpg');">
            </div>
            <div class="container">
                <div class="content-center brand">
                    <img class="n-logo" src="images/jconnectorzicon.png" alt="">
                    <h1 class="h1-seo">404.</h1>
                    <h3>Error Page not found </h3>
                </div>
                <h6 class="category category-absolute">Sorry seems there is an error in the link </h6>
            </div>
        </div>
		
	
		<footer class="footer" style='color:#fff;'>
            <div class="container">
                <nav>
                    <ul>
                        <li>
                            <a href="index.php">
                                Home
                            </a>
                        </li>
                        <li>
                            <a href="about.php">
                                About Us
                            </a>
                        </li>
                        <li>
                            <a href="blog.php">
                                Blog
                            </a>
                        </li>
                        <li>
                            <a href="contact.php">
                                Contact
                            </a>
                        </li>
                    </ul>
                </nav>
                <div class="copyright">
                    &copy;
                    <script>
                        document.write(new Date().getFullYear())
                    </script>, Developed By Jesse(coders).
                </div>
            </div>
        </footer>
		
		

</body>
<!--   Core JS Files am puting this down here to boost site loaad time  -->

<script src="./assets/js/core/jquery.3.2.1.min.js" type="text/javascript"></script>
<script src="./assets/js/core/popper.min.js" type="text/javascript"></script>
<script src="./assets/js/core/bootstrap.min.js" type="text/javascript"></script>


<script src="./assets/js/plugins/nouislider.min.js" type="text/javascript"></script>

<!-- Control Center for Now Ui Kit: parallax effects, scripts for the example pages etc -->
<script src="./assets/js/now-ui-kit.js?v=1.1.0" type="text/javascript"></script>

