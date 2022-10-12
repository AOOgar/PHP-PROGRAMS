<?php
//Get file name
 //so as to know which file is active
      $currentFile = $_SERVER["SCRIPT_NAME"];
	  //extract it from forward /
      $parts = Explode('/', $currentFile);
      $currentFile = $parts[count($parts) - 1]; 
	  

?>	
	<div class="sidebar-wrapper">
            <div class="logo">
                <a href="" class="simple-text">
                    Ebonyi For Umahi
                </a>
            </div>

            <ul class="nav">
                <li class="<?php if($currentFile=="dashboard.php"){echo "active";}?>">
                    <a href="dashboard.php">
                        <i class="ti-panel"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="<?php if($currentFile=="photo.php"){echo "active";}?>">
                    <a href="photo.php">
                        <i class="ti-gallery"></i>
                        <p>Add Photos</p>
                    </a>
                </li>
                <li class="<?php if($currentFile=="record.php"){echo "active";}?>">
                    <a href="record.php">
                        <i class="ti-cup"></i>
                        <p>Add Record of success </p>
                    </a>
                </li>
                <li class="<?php if($currentFile=="news.php"){echo "active";}?>">
                    <a href="news.php">
                        <i class="ti-thought"></i>
                        <p>Add News & Events</p>
                    </a>
                </li>
				 
                <li class="<?php if($currentFile=="join.php"){echo "active";}?>">
                    <a href="join.php">
                        <i class="ti-email"></i>
                        <p>Join Requests</p>
                    </a>
                </li>
                <li  class="<?php if($currentFile=="record-list.php"){echo "active";}?>">
                    <a href="record-list.php">
                        <i class="ti-map"></i>
                        <p>All Record of sucess</p>
                    </a>
                </li>
                <li class="<?php if($currentFile=="news-list.php"){echo "active";}?>">
                    <a href="news-list.php">
                        <i class="ti-bell"></i>
                        <p>All News</p>
                    </a>
                </li>
				<li class="<?php if($currentFile=="comment.php"){echo "active";}?>">
                    <a href="comment.php">
                        <i class="ti-thought"></i>
                        <p>All comments</p>
                    </a>
                </li>
				
            </ul>
    	</div>
    </div>