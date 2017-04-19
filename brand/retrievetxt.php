<?php
	if(isset($_GET['id']))
	{
		require_once("brand_query.php");
		$brand = new Brand();
		$brand->getBrand();
	}	
?>