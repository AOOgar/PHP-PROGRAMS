<?php

$con = mysqli_connect('localhost', 'root', '','email_validation');

function row_count($result){
	return mysqli_num_rows($result);
}

function escape($string){
	global $con;
	return mysqli_real_escape_string($con, $string);
}

function query($query){

	global $con;
	$result = mysqli_query($con, $query);
	confirm($result);
	return $result;
}

function confirm($result){
	global $con;

	if (!$result) {
		die("QUERY FAILED" . mysqli_error($con));
	}
}

function fetch_array($result){
	global $con;
	return mysqli_fetch_array($result);
}

?>