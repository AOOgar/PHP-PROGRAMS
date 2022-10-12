<?php
//start a session
session_start();

//if session is not set
if(!isset($_SESSION['id'])){
	header('location:index.php');
}

//add conection
include('connect.php');



if(!isset($_GET['id'])){
header('location:news-list.php');
}


$id = $_GET['id'];

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
	
		<script src="ckeditor/ckeditor.js"></script>

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
                    <a class="navbar-brand" href="#">Edit News & Event</a>
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

		
				<?php
					
					
					$pick = mysqli_query($mysqli, "SELECT * FROM news where id='$id'");
					$row = mysqli_fetch_array($pick);
					
					
					
					?>

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-4 col-md-5">
                        <div class="card card-user">
                            <div class="image" id="content">
                               <img src ="../images/<?php echo $row['image']; ?>"  alt="image" />
                            </div>
                            
                        </div>
                       
                    </div>
					
					
					
					
					
                    <div class="col-lg-8 col-md-7">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Edit News & Events</h4>
                            </div>
                            <div class="content">
                                <form  method="post" enctype="multipart/form-data">
                        
						
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Pick </label>
                                                <input type="file"  class="form-control border-input" placeholder=""  accept="image/*" name="photo_image" id="file1"  />
                                            </div>
                                        </div>
                                    </div>
									
									
									 <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Title</label>
                                                <input type="text" class="form-control border-input" value="<?php echo $row['title']; ?>" placeholder="Enter Title" name="title" required="required" >
												
                                            </div>
                                        </div>
                                    </div>
									
									
									 <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>News detail</label>
                                                <textarea rows="5" class="form-control border-input"  placeholder="Here can be your description" required="required"  name="info"><?php echo $row['info']; ?></textarea>
												<script>CKEDITOR.replace( 'info' );</script>
                                            </div>
                                        </div>
                                    </div>
									
									
									
									
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-info btn-fill btn-wd" name="upload">Edit News</button>
                                    </div>
                                    <div class="clearfix"></div>
                                </form>
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

	
	<script>
	
	//get the content of image
var input = document.querySelector('input[type=file]');

input.onchange = function(){
	var file = input.files[0];
	
	//trying to validate image before upload

	
	//function to prepare image
	drawOnCanvas(file);
	
	//function to display image
	displayAsImage(file);
	

};




function drawOnCanvas(file){
	 var reader = new FileReader();
	 
	 reader.onload = function(e){
		
		var dataURL = e.target.result, c = document.querySelector('canvas'), ctx = c.getContext('2d'), img = new Image();
		
		img.onload = function(){
			
			c.width = img.width;
			c.height = img.height;
			ctx.drawImage(img, 0, 0);
			
		};
		
		img.src = dataURL;
		
		
	 };
	 
	 
	 reader.readAsDataURL(file);
	 
	 
}


function displayAsImage(file){
	var imgURL= URL.createObjectURL(file), img = document.createElement('img');
	
	img.onload = function(){
		
		URL.revokeObjectURL(imgURL);
	};
	
	img.src = imgURL;
	
	//put the image name into a label for users on small devices to see
	//document.getElementById('image_name').innerHTML = document.getElementById('file1').value;
	//adding the image into content for preview
	document.getElementById('content').innerHTML ="";
	
	document.getElementById('content').append(img);
	
}
	</script>


<?php

//if upload button is clicked
if(isset($_POST['upload'])){

	//set location that image should b uploaded to
	$target_locate = "../images/";
	
	//the image with full path
	$file = $target_locate.basename($_FILES["photo_image"]["name"]);
	$imageFileType = pathinfo($file,PATHINFO_EXTENSION);
	$check = @getimagesize($_FILES["photo_image"]["tmp_name"]);
	
	$image =basename($_FILES["photo_image"]["name"]);
	$title = $_POST['title'];
	$info = $_POST['info'];
	
	
	if(!empty($_FILES["photo_image"]["tmp_name"])){
	
	//check if the image alreday exist
	
	$check2 = mysqli_query($mysqli, "SELECT * FROM news where image ='$image'");
	
	if(mysqli_num_rows($check2) == 0){
		
	//actual upload
	if(move_uploaded_file($_FILES["photo_image"]["tmp_name"],$file)){
		
		//insert
		
		$add = mysqli_query($mysqli, "UPDATE news SET image='$image', title='$title', info='$info' where id='$id'");
		
		if($add){
			?>
			
		<script type="text/javascript">
		 $.notify({
            	icon: "ti-save-alt",
            	message: "Edit Uploaded Successfully."

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
		}
		
		
		
	}
	
	
	
	}else{
		
	?>
	
	<script type="text/javascript">
		 $.notify({
            	icon: "ti-save-alt",
            	message: "Image Already Exist."

            },{
                type: 'warning',
				
				
                timer: 5000,
				placement: {
                from: 'top',
                align: 'center'
            }
            });
		
		
		</script>
	
	
		
	<?php	
		
	}
	
	
	}else{
		
		///no image uploaded
		
		
		$add = mysqli_query($mysqli, "UPDATE news SET title='$title', info='$info' where id='$id'");
		
		if($add){
			?>
			
		<script type="text/javascript">
		 $.notify({
            	icon: "ti-save-alt",
            	message: "Edit Uploaded Successfully."

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
		}
		
		
		
		
		
		
	}
	
	
	
	
	
	
	
	
}



?>	
	

	
	
	
	
	
</html>
