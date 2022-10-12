<?php
if($_SERVER['HTTP_HOST']=="localhost" or $_SERVER['HTTP_HOST']=="192.168.1.125")
		{	
			//local  

				 DEFINE ('DB_USER', 'root');
				 DEFINE ('DB_PASSWORD', '');
				 DEFINE ('DB_HOST', 'localhost'); //host name depends on server
				 DEFINE ('DB_NAME', 'modarac');
		}
		else
		{
			//local live 

		 	 DEFINE ('DB_USER', 'modaracc_mod');
			 DEFINE ('DB_PASSWORD', 'lilian@@123');
			 DEFINE ('DB_HOST', 'localhost'); //host name depends on server
			 DEFINE ('DB_NAME', 'modaracc_mod');
		}

	
	$mysqli =mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
	
	mysqli_query($mysqli,"SET NAMES 'utf8'");
	
	?>