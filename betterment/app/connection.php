<?php
if($_SERVER['HTTP_HOST']=="localhost" or $_SERVER['HTTP_HOST']=="192.168.8.102")
		{	
			//local  

				 DEFINE ('DB_USER', 'root');
				 DEFINE ('DB_PASSWORD', '');
				 DEFINE ('DB_HOST', 'localhost'); //host name depends on server
				 DEFINE ('DB_NAME', 'betterment');
		}
		else
		{
			//local live 

		 	 DEFINE ('DB_USER', 'jconnect_betterment');
			 DEFINE ('DB_PASSWORD', '=eDlH^R6h=3b');
			 DEFINE ('DB_HOST', 'localhost'); //host name depends on server
			 DEFINE ('DB_NAME', 'jconnect_betterment');
		}

	
	$mysqli =mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
	
	mysqli_query($mysqli,"SET NAMES 'utf8'");
	
	?>