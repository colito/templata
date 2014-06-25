<?php
	$hostadress = "localhost";
	$username = "root";
	$password = "";
	$my_sql_db = "word_world_wonder";
	
	$connect = mysql_connect($hostadress, $username, $password);
	
	if (!$connect)
	{
	  die('Could not connect: ' . mysql_error());
	}
	else	
	{
		//echo "Successful connection";
		mysql_select_db($my_sql_db, $connect);
	}
?>
