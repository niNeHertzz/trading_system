
<?php
	
	class User {

		//
		// load all category in the table
		public function getUserAll() {
			require("../connect_db.php");
			$select_qry = "Select UserId, Username, LastName, FirstName, MiddleName,
						   BirthDate, Address, ContactNo from Users";
			$result = $mysqli->query($select_qry);

			if ($result->num_rows > 0)
			{
				while($row = $result->fetch_assoc())
				{
					$output[] = $row;
					// echo "<tr>".
					// 	 	"<td>".
					// 	 		"<input type=\"checkbox\"". "name=\"check_". $row["UserId"]. "\"". "/>".
					// 	 	"</td>".
					// 	 	"<td>".
					// 	 		$row["Username"].
					// 	 	"</td>".
					// 	 	"<td>".
					// 	 		$row["LastName"]. ", ". $row["FirstName"]. " ". $row["MiddleName"].
					// 	 	"</td>".
					// 	 	"<td>".
					// 	 		$row["Address"].
					// 	 	"</td>".
					// 	 	"<td>".
					// 	 		$row["BirthDate"].
					// 	 	"</td>".
					// 	 	"<td>".
					// 	 		$row["ContactNo"].
					// 	 	"</td>".
					// 	 	"<td>".
					// 	 		"<button type=\"button\"". "id=\"". $row["UserId"] . "\" name=\"Update\"". "value=\"\"". 
					// 	 		"class=\"btn btn-success\"". "onclick=\"updateUserModal(". $row["UserId"] .")\">".
					// 				"Update".
					// 			"</button>".
					// 		"</td>".
					// 	 "</tr>";	
				}
			}
			//echo $result->num_rows;
			$result->free();
			$mysqli->close();
			$user_data = json_encode($output);
			return $user_data;
		}

		// insert user function
		public function insertUser() {
			require("../connect_db.php");
			$uname = $mysqli->real_escape_string($_POST['unametxt']);
			$pword = $mysqli->real_escape_string($_POST['pwordtxt']);
			$lname = $mysqli->real_escape_string($_POST['lnametxt']);
			$fname = $mysqli->real_escape_string($_POST['fnametxt']);
			$mname = $mysqli->real_escape_string($_POST['mnametxt']);
			$gender = $mysqli->real_escape_string($_POST['gender']);
			
			$date_create = date_create($_POST['bdatetxt']);
			$bdate_format = date_format($date_create, "Y-m-d");
			$bdate = $mysqli->real_escape_string($bdate_format);
			$address = $mysqli->real_escape_string($_POST['addresstxt']);
			$contactno = $mysqli->real_escape_string($_POST['contacttxt']);
			//$email = $mysqli->real_escape_string($_POST['emailtxt']);
			$role = $mysqli->real_escape_string($_POST['role']);
			
			// check user if existing
			$user_exst_qry = "Select *from Users ".
							 "Where LastName = '". $lname . "'".
							 " AND FirstName = '". $fname . "'".
							 " AND MiddleName = '". $mname. "'".
							 " AND BirthDate = '". $bdate . "'";

			$user_exst_result = $mysqli->query($user_exst_qry);
			if($user_exst_result->num_rows > 0)
			{
				echo "The user you entered has already an account.";
			}
			else
			{
				// check username if existing
				$uname_exst_qry = "Select *from Users ".
								  "Where Username = '". $uname. "'";
				$uname_exst_result = $mysqli->query($uname_exst_qry);
				if($uname_exst_result->num_rows > 0)
				{
					echo "The username you entered was already existing.";
				}
				else
				{
					// insert user to users table
					$insert_user_qry = "Insert into Users(Username, 
													 Password, 
													 LastName, 
													 FirstName, 
													 MiddleName, 
													 Gender,
													 BirthDate,
													 Address,
													 ContactNo,
													 Email) ".
									"Values('". $uname .   "', ".
											"'". $pword .  "', ".
											"'". $lname .  "', ".
											"'". $fname .  "', ".
											"'". $mname .  "', ".
											"'". $gender . "', ".
											"'". $bdate .  "', ".
											"'". $address ."', ".
											"'". $contactno ."', ".
											"'')";
					$insert_user_result = $mysqli->query($insert_user_qry);
					if(!$insert_user_result)
					{
						die('Error : ('. $mysqli->errno .') '. $mysqli->error);
					}

					// retrieve role id of role selected
					$role_qry = "Select RoleId from UserRoles ".
								"Where Role = '". $_POST['role']. "'";
					$role_result = $mysqli->query($role_qry);
					$roleid_selected;
					if($role_result->num_rows > 0)
					{
						while($row = $role_result->fetch_assoc())
						{
							$roleid_selected = $row["RoleId"];
							
						}
						
					}
					$role_result->free();
					// retrieve user id of user inserted
					$user_qry = "Select UserId from Users ".
									"Where Username = '". $uname. "'";
					$user_result = $mysqli->query($user_qry);
					$userid_inserted;
					if($user_result->num_rows > 0)
					{
						while($row = $user_result->fetch_assoc())
						{
							$userid_inserted = $row["UserId"];
						}
					}
					$user_result->free();
					// insert ids to user permission table
					$permission_qry = "Insert into UserPermission(UserId,
																  RoleId) ".
										 "Values(". $userid_inserted .", ".
										  			$roleid_selected .")";
					$permission_result = $mysqli->query($permission_qry);
					if(!$permission_result)
					{
						die('Error : ('. $mysqli->errno .') '. $mysqli->error);
					}
				}
				$uname_exst_result->free();
			}
			$user_exst_result->free();
			$mysqli->close();
		}

		// get specific category function
		public function getUser() {
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
		public function updateUser() {
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

		public function deleteUser() {

		}
	}
?>