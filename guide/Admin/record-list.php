<?php
//start a session
session_start();

//if session is not set
if(!isset($_SESSION['id'])){
	header('location:index.php');
}

//add conection
include('connect.php');

?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Admin - Ebonyi For Umahi</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Paper Dashboard core CSS    -->
    <link href="assets/css/paper-dashboard.css" rel="stylesheet"/>

    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="assets/css/demo.css" rel="stylesheet" />

    <!--  Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/themify-icons.css" rel="stylesheet">

</head>
<body>

<div class="wrapper">
	<div class="sidebar" data-background-color="white" data-active-color="danger">

    <!--
		Tip 1: you can change the color of the sidebar's background using: data-background-color="white | black"
		Tip 2: you can change the color of the active button using the data-active-color="primary | info | success | warning | danger"
	-->

    	
    	<?php
		
		//add header
		include('header.php');
		
		include('counter.php');
		
		
		?>
		
		<style>
		
		td >img{
			width: 100px;
			height:100px;
		}
		</style>
		
    <div class="main-panel">
		 <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar bar1"></span>
                        <span class="icon-bar bar2"></span>
                        <span class="icon-bar bar3"></span>
                    </button>
                    <a class="navbar-brand" href="#">All Record of Success</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        
						<li>
                            <a href="logout.php">
								<i class="ti-settings"></i>
								<p>logout</p>
                            </a>
                        </li>
                    </ul>

                </div>
            </div>
        </nav>

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">All record Of Sucess</h4>
                                <p class="category">List of info Added</p>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-striped">
                                    <thead>
                                    	<th>Image</th>
                                    	<th>category</th>
                                    	<th>info</th>
										<th>Action</th>
                                    	
                                    </thead>
                                    <tbody>
									<?php
									
									$fetch = mysqli_query($mysqli, "SELECT * FROM records");
									
									while($rows = mysqli_fetch_array($fetch)){
							
									
									?>
									
                                        <tr>
                                        	<td><img src="../images/<?php echo $rows['image']; ?>" class="img-responsive img-fluid" alt="image"/></td>
                                        	<td><?php echo $rows['category']; ?></td>
                                        	<td><?php echo $rows['info']; ?></td>
                                        	<td> <a href="delete-record.php?id=<?php echo $rows['id']; ?>" onclick="return confirm('Are u sure you want to Delet this Info?')"><i class="ti-close"></i></a></td>
                                        	
                                        </tr>
                                       <?php
									   
									   }
									   
									   ?>
									   
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>



                </div>
            </div>
        </div>
		
		
		<footer class="footer">
            <div class="container-fluid">
               
                <div class="copyright pull-right">
                    &copy; <script>document.write(new Date().getFullYear())</script>, Ebonyi For Umahi 
                </div>
            </div>
        </footer>

		
    </div>
</div>


</body>

    <!--   Core JS Files   -->
    <script src="assets/js/jquery-1.10.2.js" type="text/javascript"></script>
	<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

	<!--  Checkbox, Radio & Switch Plugins -->
	<script src="assets/js/bootstrap-checkbox-radio.js"></script>

	<!--  Charts Plugin -->
	<script src="assets/js/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="assets/js/bootstrap-notify.js"></script>

   

    <!-- Paper Dashboard Core javascript and methods for Demo purpose -->
	<script src="assets/js/paper-dashboard.js"></script>

	<!-- Paper Dashboard DEMO methods, don't include it in your project! -->
	<script src="assets/js/demo.js"></script>


	<?php
	
	if(isset($_SESSION['deleted'])){
		
		?>
		
		<script type="text/javascript">
		 $.notify({
            	icon: "ti-save-alt",
            	message: "<?php echo $_SESSION['deleted']; ?>"

            },{
                type: 'success',
				
				
                timer: 5000,
				placement: {
                from: 'top',
                align: 'center'
            }
            });
		
		
		</script>
	
		
		<?php
		
		
		unset($_SESSION['deleted']);
		
	}
	
	
	?>
	
	
</html>
