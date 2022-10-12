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




$del = mysqli_query($mysqli, "DELETE FROM comments where id='$id' ");

if($del){
	$_SESSION['deleted'] = "Comment deleted Successfully";
	header('location:comment.php');
	
}



?>
