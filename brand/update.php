
<?php
	if(isset($_POST['brandtxt']) && isset($_POST['brandid']))
	{
		require_once("brand_query.php");
		$brand = new Brand();
		$brand->updateBrand();
	}
?>