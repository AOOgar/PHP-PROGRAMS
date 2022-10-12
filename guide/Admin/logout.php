<?php
//start a session
session_start();

//destroy all session
session_destroy();

//redirect to login page
header("location:index.php");

//exit
exit();

?>