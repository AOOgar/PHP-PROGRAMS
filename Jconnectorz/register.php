<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="images/jconnectorzicon.png">
    <link rel="icon" type="image/png" href="images/jconnectorzicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Login | Jconnectorz </title>
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

<body class="login-page sidebar-collapse">
   
   <?php
   //adding tthe header
   include('header.php');
   
   ?>
   
   
    <div class="page-header" filter-color="orange">
        <div class="page-header-image" style="background-image:url(images/<?php echo date('l'); ?>.jpg)"></div>
        <div class="container">
            <div class="col-md-4 content-center">
                <div class="card card-login card-plain">
                    <form class="form" method="post" >
                        <div class="header header-primary text-center">
                            <div class="logo-container">
                                <img src="images/jconnectorzicon.png" alt="logo">
								
                            </div>
                        </div>
                        <div class="content">
                            <div class="input-group form-group-no-border input-lg">
                                <span class="input-group-addon">
                                    <i class="now-ui-icons ui-1_email-85"></i>
                                </span>
                                <input type="email" name="email" class="form-control" placeholder="Email..." required>
                            </div>
                            <div class="input-group form-group-no-border input-lg">
                                <span class="input-group-addon">
                                    <i class="fa fa-key"></i>
                                </span>
                                <input type="password" placeholder="password..." name="password" class="form-control" required />
                            </div>
							<div class="input-group form-group-no-border input-lg">
                                <span class="input-group-addon">
                                    <i class="fa fa-key"></i>
                                </span>
                                <input type="password" placeholder="Confirm password..." name="confirm" class="form-control" required />
                            </div>
                        </div>
                        <div class="footer text-center">
                            <button type="submit" name="login" class="btn btn-primary btn-round btn-lg btn-block">Sign Up</button>
                        </div>
                        <div class="pull-center">
                            <h6>
                                <a href="login.php" class="link">Alreday have account? Login</a>
                            </h6>
                        </div>
                       
                    </form>
                </div>
            </div>
        </div>
        <footer class="footer">
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