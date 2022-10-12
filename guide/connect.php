<?php
if($_SERVER['HTTP_HOST']=="localhost" or $_SERVER['HTTP_HOST']=="192.168.1.125")
		{	
			//local  

				 DEFINE ('DB_USER', 'root');
				 DEFINE ('DB_PASSWORD', '');
				 DEFINE ('DB_HOST', 'localhost'); //host name depends on server
				 DEFINE ('DB_NAME', 'ebonyi');
		}
		else
		{
			//local live 

		 	 DEFINE ('DB_USER', 'ebonyiuo_try');
			 DEFINE ('DB_PASSWORD', 'XJA+0VP!#x;I');
			 DEFINE ('DB_HOST', 'localhost'); //host name depends on server
			 DEFINE ('DB_NAME', 'ebonyiuo_try');
		}

	
	$mysqli =mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
	
	mysqli_query($mysqli,"SET NAMES 'utf8'");
	
	?>