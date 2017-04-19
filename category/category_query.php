
<?php
	
	class Category {

		//
		// load all category in the table
		public function getCategoryAll() {
			require("../connect_db.php");
			$select_qry = "Select CategoryId, Category from Categories";
			$result = $mysqli->query($select_qry);

			if ($result->num_rows > 0)
			{
				while($row = $result->fetch_assoc())
				{
					echo "<tr>".
						 	"<td>".
						 		"<input type=\"checkbox\"". "name=\"check_". $row["CategoryId"]. "\"". "/>".
						 	"</td>".
						 	"<td>".
						 		$row["Category"].
						 	"</td>".
						 	"<td>".
						 		"<button type=\"button\"". "id=\"". $row["CategoryId"] . "\" name=\"Update\"". "value=\"\"". 
						 		"class=\"btn btn-success\"". "onclick=\"updateCategoryModal(". $row["CategoryId"] .")\">".
									"Update".
								"</button>".
							"</td>".
						 "</tr>";	
				}
			}
			//echo $result->num_rows;
			$result->free();
			$mysqli->close();
		}

		// insert category function
		public function insertCategory() {
			require("../connect_db.php");
			$category = $mysqli->real_escape_string($_POST['categorytxt']);
			// check if existing
			$check_category_exst = "Select *from Categories ".
								   "Where Category = '". $category . "'";
			$checking_result = $mysqli->query($check_category_exst);
			if($checking_result->num_rows > 0)
			{
				echo "The category you entered was already existing.";
			}
			else
			{
				$insert_qry = "Insert into Categories(Category) Values('". $category ."')";
				$result = $mysqli->query($insert_qry);
				if(!$result)
				{
					die('Error : ('. $mysqli->errno .') '. $mysqli->error);
				}
			}
			$checking_result->free();
			$mysqli->close();
		}

		// get specific category function
		public function getCategory() {
			require("../connect_db.php");
			$categoryid = htmlspecialchars($_GET['id']);
			$select_qry = "Select Category from Categories ". 
						   "Where CategoryId = ". $categoryid;
			$result = $mysqli->query($select_qry);
			if($result->num_rows > 0)
			{
				while($row = $result->fetch_assoc())
				{
					echo $row["Category"];
				}
			}
			$result->free();
			$mysqli->close();
		}

		// update category function
		public function updateCategory() {
			require("../connect_db.php");
			$categoryid = $mysqli->real_escape_string($_POST['categoryid']);
			$category = $mysqli->real_escape_string($_POST['categorytxt']);

			// check if existing
			$check_category_exst = "Select *from Categories ".
								   "Where Category = '". $category . "'";
			$checking_result = $mysqli->query($check_category_exst);
			
			if ($checking_result->num_rows > 0)
			{
				echo "The category you entered was already existing.";
			}
			else
			{
				// update current category selected in db
				$update_qry = "Update Categories ".
						  "Set Category = '". $category . "' ".
						  "Where CategoryId = ". $categoryid;
				$result = $mysqli->query($update_qry);
				if(!$result)
				{
					die('Error : ('. $mysqli->errno .') '. $mysqli->error);
				}
			}
			$checking_result->free();
			$mysqli->close();
		}

		public function deleteCategory() {

		}
	}
?>