
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
			else
			{
				$output["result"] = "";
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
					// create directory for uploaded profile pictures
					$curdir = getcwd();
					$rootdir = substr($curdir,0,strlen($curdir)-5);
					if(!file_exists($rootdir."/upload-images/profile-pics/".$uname))
					{
						mkdir($rootdir."/upload-images/profile-pics/".$uname);
					}
					// save image and its path
					$up_default_path = $rootdir ."contents/images/profile_pics/";
									 /*$rootdir."/upload-images/profile-pics/".$uname .
										   "/def-prof-pic.jpg";*/
					$default_image;
					if ($gender == "Male") 
					{
						//copy($rootdir."/contents/images/profile_pics/default-profile-img-male.jpg",
						//	 $up_default_path);
						$default_image = "default-profile-img-male.jpg";
					}
					else if ($gender == "Female")
					{
						//copy($rootdir."/contents/images/profile_pics/default-profile-img-female.jpg",
						//	 $up_default_path);
						$default_image = "default-profile-img-female.jpg";
					}
					$insert_defaultpic_qry = "Update Users ".
												 "Set ImageName = '". $default_image ."', ".
												 "ImagePath = '".
												 				  substr($up_default_path,
												 						 strlen($rootdir), 
																		 strlen($up_default_path)).
																  $default_image . "' ".
												 "Where Username = '". $uname . "'";
					$insert_defaultpic_result = $mysqli->query($insert_defaultpic_qry);
					if(!$insert_defaultpic_result)
					{
						die('Error : ('. $mysqli->errno .') '. $mysqli->error);
					}
				}
				$uname_exst_result->free();
			}
			$user_exst_result->free();
			$mysqli->close();
		}

		// get specific user function
		public function getUser() {
			require("../connect_db.php");
			$username = htmlspecialchars($_POST['user']);
			$selectid_qry = "Select UserId from users Where Username = '".$username."'";
			$selectid_result = $mysqli->query($selectid_qry);
			$selectid_row = $selectid_result->fetch_assoc();
			

			$select_qry = "Select Username, LastName, FirstName, MiddleName, ". 
						  "Gender, BirthDate, Address, ".
						  "ContactNo, Password, ImagePath, Role ".
						  "from  UserPermission inner join Users ".
						  "on UserPermission.UserId = Users.UserId Inner Join UserRoles ".
						  "on UserPermission.RoleId = UserRoles.RoleId ". 
						  "Where Users.UserId = ". $selectid_row["UserId"];
						  
			
			$result = $mysqli->query($select_qry);
			if($result->num_rows > 0)
			{
				$rows = $result->fetch_assoc();
			} 
			$result->free();
			$mysqli->close();
			$users_data = json_encode($rows);
			return $users_data;
		}
		// update category function
		public function updateUser() {
			require("../connect_db.php");
			$uname = $mysqli->real_escape_string($_POST['un']);
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

			$user_exst_qry = "Select *from Users ".
							 "Where LastName = '". $lname . "'".
							 " AND FirstName = '". $fname . "'".
							 " AND MiddleName = '". $mname. "'".
							 " AND BirthDate = '". $bdate . "'".
							 " AND Username = '". $uname ."'";
			// check if existing
			$user_exst_result = $mysqli->query($user_exst_qry);
			
			if ($user_exst_result->num_rows > 0)
			{
				echo "The user you entered was already existing.";
			}
			else
			{
				// update current category selected in db
				$update_qry = "Update Users ".
						  "Set LastName = '". $lname . "', ".
						  "FirstName = '". $fname . "', ".
						  "MiddleName = '". $mname . "', ".
						  "Gender = '". $gender . "', ".
						  "BirthDate = '". $bdate ."', ".
						  "Address = '". $address ."', ".
						  "ContactNo = '". $contactno ."', ".
						  "Where Username = ". $uname;
				$result = $mysqli->query($update_qry);
				if(!$result)
				{
					die('Error : ('. $mysqli->errno .') '. $mysqli->error);
				}
			}
			$user_exst_result->free();
			$mysqli->close();
		}

		public function deleteUser() {

		}
	}
?>