<?php
	

		// define('host',gethostbyname(gethostname()));
		// define('dbuser', 'sim_admin');
		// define('dbpass', 'simsa123');
		// define('database', 'simkimban_dev');
		$host = gethostbyname(gethostname());
		$dbuser = 'sim_admin';
		$dbpass = 'simsa123';
		$database = 'simkimban_dev';
		//$output["Username"] = "Unable to Connect";
		$mysqli = new mysqli($host, $dbuser, $dbpass, $database);
		if($mysqli->connect_error)
		{
			die(json_encode("Unable to Connect"));
		}
?>