<?php
	if(isset($_GET['id']))
	{
		require_once("category_query.php");
		$categ = new Category();
		$categ->getCategory();
	}	
?>