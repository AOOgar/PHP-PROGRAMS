<?php

 //Get file name
 //so as to know which file is active
      $currentFile = $_SERVER["SCRIPT_NAME"];
	  //extract it from forward /
      $parts = Explode('/', $currentFile);
      $currentFile = $parts[count($parts) - 1]; 
	  
	  
?> 

<header class="main-header">
    <!-- Logo -->
    <a href="dashboard.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini">Jcon</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><img src="dist/jconnectorz-white.png" /></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
         
		 
          <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning">10</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 10 notifications</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-aqua"></i> 5 new members joined today
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the
                      page and may cause design problems
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-red"></i> 5 new members joined
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-shopping-cart text-green"></i> 25 sales made
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-user text-red"></i> You changed your username
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#">Up to speed</a></li>
            </ul>
          </li>
          <!-- Tasks: style can be found in dropdown.less -->
          
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="../images/jesse.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs">Jesse(Coders)</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="../images/jesse.jpg" class="img-circle" alt="User Image">

                <p>
                  Jesse Coders
                  <small>Software/web Developer</small>
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="profile.php" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="logout.php" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="../images/jesse.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Jesse Coders</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
     
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="<?php if($currentFile=="dashboard.php"){echo "active";}?> ">
          <a href="dashboard.php">
            <i class="fa fa-dashboard "></i> <span>Dashboard</span>
            <span class="pull-right-container">
             <?php if($currentFile=="dashboard.php"){echo "<i class='fa fa-spinner fa-spin'></i>";}?>
            </span>
          </a>
          
        </li>
        <li class="<?php if($currentFile=="create.php"){echo "active";}?>">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Create New Post</span>
            <span class="pull-right-container">
             <?php if($currentFile=="create.php"){echo "<i class='fa fa-spinner fa-spin'></i>";}?>
            </span>
          </a>
         
        </li>
		<li class="<?php if($currentFile=="Edit.php"){echo "active";}?>">
          <a href="edit.php">
            <i class="fa fa-edit"></i> <span>Edit Posts</span>
            <span class="pull-right-container">
			<small class="label pull-right bg-blue">25</small>
               <?php if($currentFile=="edit.php"){echo "<i class='fa fa-spinner fa-spin'></i>";}?>
            </span>
          </a>
        </li>
		<li class="<?php if($currentFile=="comment.php"){echo "active";}?>">
          <a href="comment.php">
            <i class="fa fa-comment"></i> <span>Comments</span>
            <span class="pull-right-container">
			<small class="label pull-right bg-green">18</small>
               <?php if($currentFile=="comment.php"){echo "<i class='fa fa-spinner fa-spin'></i>";}?>
            </span>
          </a>
        </li>
		<li class="<?php if($currentFile=="product.php"){echo "active";}?>">
          <a href="product.php">
            <i class="fa fa-shopping-cart"></i> <span>Products</span>
            <span class="pull-right-container">
			<small class="label pull-right bg-red">13</small>
               <?php if($currentFile=="edit.php"){echo "<i class='fa fa-spinner fa-spin'></i>";}?>
            </span>
          </a>
        </li>
		<li class="<?php if($currentFile=="subscribers.php"){echo "active";}?>">
          <a href="subscribers.php">
            <i class="fa fa-send"></i> <span>Subscribers</span>
            <span class="pull-right-container">
			<small class="label pull-right bg-yellow">20</small>
               <?php if($currentFile=="subscribers.php"){echo "<i class='fa fa-spinner fa-spin'></i>";}?>
            </span>
          </a>
        </li>
		<li class="<?php if($currentFile=="newsletter.php"){echo "active";}?>">
          <a href="newsletter.php">
            <i class="fa fa-envelope-o"></i> <span>Newsletter</span>
            <span class="pull-right-container">
               <?php if($currentFile=="newsletter.php"){echo "<i class='fa fa-spinner fa-spin'></i>";}?>
            </span>
          </a>
        </li>
		<li class="<?php if($currentFile=="register.php"){echo "active";}?>">
          <a href="register.php">
            <i class="fa fa-user-plus"></i> <span>Add New Admin</span>
            <span class="pull-right-container">
			<small class="label pull-right bg-red">5</small>
               <?php if($currentFile=="register.php"){echo "<i class='fa fa-spinner fa-spin'></i>";}?>
            </span>
          </a>
        </li>
        <li class="<?php if($currentFile=="profile.php"){echo "active";}?>">
          <a href="profile.php">
            <i class="fa fa-user"></i> <span>Profile</span>
            <span class="pull-right-container">
               <?php if($currentFile=="profile.php"){echo "<i class='fa fa-spinner fa-spin'></i>";}?>
            </span>
          </a>
        </li>
        
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>