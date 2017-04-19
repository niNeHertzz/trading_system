<?php
	if(isset($_POST['categorytxt']))
	{
		require_once("category_query.php");
		$categ = new Category();
		$categ->insertCategory();
	}	
?>