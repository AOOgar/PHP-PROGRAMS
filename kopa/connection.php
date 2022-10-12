<?php
if($_SERVER['HTTP_HOST']=="localhost" or $_SERVER['HTTP_HOST']=="192.168.0.100")
		{	
			//local  

				 DEFINE ('DB_USER', 'root');
				 DEFINE ('DB_PASSWORD', '');
				 DEFINE ('DB_HOST', 'localhost'); //host name depends on server
				 DEFINE ('DB_NAME', 'kopa');
		}
		else
		{
			//local live 

		 	 DEFINE ('DB_USER', 'trendin1_kopa');
			 DEFINE ('DB_PASSWORD', 'o@p?1##z{@kb');
			 DEFINE ('DB_HOST', 'localhost'); //host name depends on server
			 DEFINE ('DB_NAME', 'trendin1_kopa');
		}

	
	$mysqli =mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
	
	mysqli_query($mysqli,"SET NAMES 'utf8'");
	
	?>