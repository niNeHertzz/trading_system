
<?php
	if(isset($_POST['categorytxt']) && isset($_POST['categoryid']))
	{
		require_once("category_query.php");
		$categ = new Category();
		$categ->updateCategory();
	}
?>