<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Jconnectorz | Dashboard</title>
  
    <link rel="icon" type="image/png" href="../images/jconnectorzicon.png">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- jconnectorz Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/skin-red.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-red sidebar-mini fixed">
<div class="wrapper">

<?php
  //add the header & navigation file
  
  include('header.php');
?>  
  

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" >
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Quick Glance</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
       <!-- Info boxes -->
      <div class="row">
        <div class="  col-xs-12 col-sm-6 col-md-4">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-cog fa-spin"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Visitors Online</span>
              <span class="info-box-number">90</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
		
         <!-- /.col -->
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-pie-chart"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Visitors Today</span>
              <span class="info-box-number">410</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
		
		
        

        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-mail-reply-all "></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Visitors Yesterday</span>
              <span class="info-box-number">760</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
		
		
		
		
		
		<div class="  col-xs-12 col-sm-6 col-md-4">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-diamond"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Visitors This Week</span>
              <span class="info-box-number">1,200</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
		
         <!-- /.col -->
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon " style="background-color:#8b008b" ><i class="fa  fa-calendar" style="color:#fff"></i></span>

            <div class="info-box-content">
              <span class="info-box-text"> Visitors This Month</span>
              <span class="info-box-number">2000</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
		
		
        

        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon " style="background-color:#e9967a"><i class="fa  fa-laptop " style="color:#fff"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Visitors This Year</span>
              <span class="info-box-number">52,000</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
		
		
		
		
		
		<div class="  col-xs-12 col-sm-6 col-md-4">
          <div class="info-box">
            <span class="info-box-icon " style="background-color:#db7093"><i class="fa fa-recycle fa-spin" style="color:#fff"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">OverAll Total Visitors</span>
              <span class="info-box-number">10,000</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
		
         <!-- /.col -->
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon" style="background-color:#Dc143c"><i class="fa fa-edit" style="color:#fff"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Posts Created</span>
              <span class="info-box-number">410</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
		
		
        

        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon " style="background-color:#ff00ff"><i class="fa fa-commenting " style="color:#fff"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Number of Comments</span>
              <span class="info-box-number">760</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
		
		
		
		
		
		
		
		<div class="  col-xs-12 col-sm-6 col-md-4">
          <div class="info-box">
            <span class="info-box-icon " style="background-color:#4b0082"><i class="fa fa-forumbee" style="color:#fff"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Products Available</span>
              <span class="info-box-number">43</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
		
         <!-- /.col -->
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon" style="background-color:#ffdead"><i class="fa fa-shopping-cart" style="color:#fff"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Orders Placed</span>
              <span class="info-box-number">6</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
		
		
        

     
		
		
		
		
		
		
		
		
		
			
			
		
		
			
		
		
		
		
		
	</div>
        
      <!-- /.row -->
	  
	  
	  
	  
	  
	  
     
     

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 
 <?php
 //adding the footer
 include('footer.php');
 
 ?>

  
  
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="bower_components/raphael/raphael.min.js"></script>
<script src="bower_components/morris.js/morris.min.js"></script>
<!-- Sparkline -->
<script src="bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- jQuery Knob -->
<script src="../../bower_components/jquery-knob/js/jquery.knob.js"></script>
<!-- daterangepicker -->
<script src="bower_components/moment/min/moment.min.js"></script>
<script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- Jconnectorz App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- jconnectorz dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- Jconnectorz for demo purposes -->
<script src="dist/js/demo.js"></script>











</body>
</html>
