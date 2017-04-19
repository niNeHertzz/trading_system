<?php
	if(isset($_POST['brandtxt']))
	{
		require_once("brand_query.php");
		$brand = new Brand();
		$brand->insertBrand();
	}	
?>