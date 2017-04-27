

<!-- User -->
<?php 
	require_once("user_query.php");
?>

<!-- Update category modal wrapper -->
<div id="update-user-dialog-wrapper">
</div>

<div id="user-save-dialog-wrapper">
</div>
<!-- Category content wrapper -->

<div class="view-user-contents content-wrapper" style="position: relative;z-index: inherit;">
	<div class="panel">
		<header class="panel-heading">
			<h4>
				Users
			</h4>
		</header>
		<div class="panel-body user-table-panel">
			<table id="user-table" class="table table-striped table-bordered" 
			 cellspacing="0">
				<thead>
					<tr>
						<th>
						</th>
						<th>
							Username
						</th>
						<th>
							Name
						</th>
						<th>
							Address
						</th>
						<th>
							Birthdate
						</th>
						<th>
							Contact No.
						</th>	
						<th>
						</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$user = new User();
						//$user->getUserAll();
						$array_output = json_decode($user->getUserAll());
						//echo count($array_output);
						//echo key($array_output);
						if (key($array_output) !== "result")
						{
							foreach($array_output as $user_data)
							{
								echo "<tr>";
								echo "<td>".
										"<input type='checkbox'". 
										"name='check_". $user_data->Username. "'". "/>".
									"</td>";
								echo "<td>".
										$user_data->Username. 
									"</td>";
								echo "<td>".
										$user_data->LastName. ", ". $user_data->FirstName. " ". $user_data->MiddleName. 
									"</td>";
								echo "<td>".
										$user_data->Address. 
									"</td>";
								echo "<td>".
										$user_data->BirthDate. 
									"</td>";
								echo "<td>".
										$user_data->ContactNo. 
									"</td>";
								echo "<td>". 
									"<form id='update-usr-frm' method='post' action='/user/update-user.php'>".
										"<button type='button'". "id='". $user_data->Username . 
										"' name='Update'". "value=''". 
										"class='btn btn-success'". "style='display:block;margin-bottom:10px;margin-top:10px;'>".
											"Update Info".
										"</button>".
										"<button type='button'". "id='". $user_data->Username . 
										"' name='ChangePass'". "value=''". 
										"class='btn btn-success'". "style='display:block;margin-bottom:10px;'>".
											"Update Password".
										"</button>".
										"<button type='button'". "id='". $user_data->Username . 
										"' name='ChangeRole'". "value=''". 
										"class='btn btn-success'". "style='display:block;margin-bottom:10px;'>".
											"Update Role".
										"</button>".
									"</form>".
									"</td>";
								echo "</tr>";
							}
						}
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<!-- <link rel="stylesheet" type="text/css" href="/contents/dataTables/css/jquery.dataTables.min.css" /> -->
<link rel="stylesheet" type="text/css" href="/contents/dataTables/css/dataTables.bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="/contents/user-dialog-style.css" />
<script type="text/javascript" src="/contents/dataTables/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="/contents/dataTables/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" src="/scripts/user/user-all.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$("#user-table").DataTable({
			"aoColumns": [{"bSearchable": false}, {"bSearchable": false}, {"bSearchable": true}, {"bSearchable": false},
						  {"bSearchable": false}, {"bSearchable": false}, {"bSearchable": false}],
			"order": [[2, "asc"]],
			"lengthMenu": [5, 10, 25, 50, 100],
			"iDisplayLength": 5
		});
		var brow_height = $(window).height();
		var brow_width = $(window).width();
		//alert(brow_height + "g");
		// firefox browser with 768 reso in 18 inch computer
		var usertblscroll_height;
		usertblscroll_height = brow_height - 169;
		usertblscroll_width = brow_width - 288;
		$(".user-table-panel").slimscroll({
			axis:'both',
			wheelStep: 300,
			height: '480px'
		});
		$(".slimScrollDiv").css("height", usertblscroll_height);
		$(".user-table-panel").css("height", usertblscroll_height);
		//$(".slimScrollBarY").css("width",'778px');
	});
</script>
