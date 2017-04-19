
<?php
	
	class Brand {

		//
		// load all brand in the table
		public function getBrandAll() {
			require("../connect_db.php");
			$select_qry = "Select BrandId, Brand from Brands";
			$result = $mysqli->query($select_qry);

			if ($result->num_rows > 0)
			{
				while($row = $result->fetch_assoc())
				{
					echo "<tr>".
						 	"<td>".
						 		"<input type=\"checkbox\"". "name=\"check_". $row["BrandId"]. "\"". "/>".
						 	"</td>".
						 	"<td>".
						 		$row["Brand"].
						 	"</td>".
						 	"<td>".
						 		"<button type=\"button\"". "id=\"". $row["BrandId"] . "\" name=\"Update\"". "value=\"\"". 
						 		"class=\"btn btn-success\"". "onclick=\"updateBrandModal(". $row["BrandId"] .")\">".
									"Update".
								"</button>".
							"</td>".
						 "</tr>";	
				}
			}
			$result->free();
			$mysqli->close();
		}

		// insert brand function
		public function insertBrand() {
			require("../connect_db.php");
			$brand = $mysqli->real_escape_string($_POST['brandtxt']);
			// check if existing
			$check_brand_exst = "Select *from Brands ".
								   "Where Brand = '". $brand . "'";
			$checking_result = $mysqli->query($check_brand_exst);
			if($checking_result->num_rows > 0)
			{
				echo "The brand you entered was already existing.";
			}
			else
			{
				$insert_qry = "Insert into Brands(Brand) Values('". $brand ."')";
				$result = $mysqli->query($insert_qry);
				if(!$result)
				{
					die('Error : ('. $mysqli->errno .') '. $mysqli->error);
				}
			}
			$checking_result->free();
			$mysqli->close();
		}
		
		// get specific brand function
		public function getBrand() {
			require("../connect_db.php");
			$brandid = htmlspecialchars($_GET['id']);
			$select_qry = "Select Brand from Brands ". 
						   "Where BrandId = ". $brandid;
			$result = $mysqli->query($select_qry);
			if($result->num_rows > 0)
			{
				while($row = $result->fetch_assoc())
				{
					echo $row["Brand"];
				}
			}
			$result->free();
			$mysqli->close();
		}

		// update category function
		public function updateBrand() {
			require("../connect_db.php");
			$brandid = $mysqli->real_escape_string($_POST['brandid']);
			$brand = $mysqli->real_escape_string($_POST['brandtxt']);
			
			// check if existing
			$check_brand_exst = "Select *from Brands ".
								   "Where Brand = '". $brand . "'";
			$checking_result = $mysqli->query($check_brand_exst);
			
			if ($checking_result->num_rows > 0)
			{
				echo "The brand you entered was already existing.";
			}
			else
			{
				// update current brand selected in db
				$update_qry = "Update Brands ".
						  "Set Brand = '". $brand . "' ".
						  "Where BrandId = ". $brandid;
				$results = $mysqli->query($update_qry);

				if(!$results)
				{
					die('Error : ('. $mysqli->errno .') '. $mysqli->error);
				}
			}
			$checking_result->free();
			$mysqli->close();
		}
		
		public function deleteBrand() {

		}
	}
?>