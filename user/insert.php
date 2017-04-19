<?php
	if (isset($_POST['lnametxt']) && isset($_POST['fnametxt']) && 
        isset($_POST['mnametxt']) && isset($_POST['gender']) &&
        isset($_POST['bdatetxt']) && isset($_POST['addresstxt']) &&
        isset($_POST['contacttxt']) && isset($_POST['unametxt']) &&
        isset($_POST['role']))
	{
		require_once("user_query.php");
		$user = new User();
		$user->insertUser();
	}	
?>
