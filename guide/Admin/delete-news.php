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
	header('location:record-list.php');
}

$id = $_GET['id'];


//delete the image 
$get1 = mysqli_query($mysqli,"SELECT * FROM news where id='$id'");
$row = mysqli_fetch_array($get1);

//link of file
$url ="../images/".$row['image'];
unlink($url);

$del = mysqli_query($mysqli, "DELETE FROM news where id='$id' ");

if($del){
	$_SESSION['deleted'] = "News deleted Successfully";
	header('location:news-list.php');
	
}



?>
