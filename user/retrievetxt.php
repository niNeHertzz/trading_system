<?php
	if(isset($_POST['user']))
    {
        require("user_query.php");
		$user = new User();
		$row = json_decode($user->getUser()); 
	}
?>