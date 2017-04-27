
<!-- Update User -->
<?php 
	require("retrievetxt.php");
?>

<div id="update-user-error-dialog-wrapper">
</div>	
<div id="user-save-dialog-wrapper">
</div>
<!-- New user content wrapper -->

<div class="update-user-contents content-wrapper" style="position: relative;z-index: inherit;">
	<div class="panel">
		<header class="panel-heading">
			<h4>
				Update User
			</h4>
		</header>
		<div class="panel-body user-form-panel" style="">
			<form id="update-user-form" method="post" action="/user/update-user.php" enctype="multipart/form-data">
				<div class="form-group row" style="">
					<div class="col-sm-3 col-md-3 col-lg-3" style="padding-top: 65px;">
						<label>Last Name</label>
						<input type="text" name="lnametxt" value="<?php echo $row->LastName; ?>" 
						class="form-control personal-basic-info name">
					</div>
					<div class="col-sm-3 col-md-3 col-lg-3" style="padding-top: 65px;">
						<label>First Name</label>
						<input type="text" name="fnametxt" value="<?php echo $row->FirstName; ?>" 
						class="form-control personal-basic-info name">
					</div>
					<div class="col-sm-3 col-md-3 col-lg-3" style="padding-top: 65px;">
						<label>Middle Name</label>
						<input type="text" name="mnametxt" value="<?php echo $row->MiddleName; ?>" 
						class="form-control personal-basic-info name">
					</div>
					<div class="col-sm-3 col-md-3 col-lg-3" style="padding-top: 87px;">
							<input type="file" name="profile_pic_image" 
							class="btn btn-default btn-custom" value=""
							style="width:245px;" 
							accept=".png, .jpg">
					</div>
				</div>
				<div class="form-group row">
					<div class="col-sm-2 col-md-2 col-lg-2">
						<label>Gender</label>
						<select name="gender" class="form-control">
							<option value="Male">Male</option>
							<option value="Female">Female</option>
						</select>
					</div>
					<div class="col-sm-3 col-md-2 col-lg-2">
						<label>Birth Date</label>
						<input type="text" name="bdatetxt" value="<?php echo $row->BirthDate; ?>" 
						class="form-control" id="bdate-picker">
					</div>
					<div class="col-sm-3 col-md-5 col-lg-5">
						<label>Address</label>
						<input type="text" name="addresstxt" value="<?php echo $row->Address; ?>" 
						class="form-control personal-basic-info">
					</div>
					<div class="col-sm-3 col-md-3 col-lg-3">
						<label>Contact No.</label>
						<input type="text" name="contacttxt" value="<?php echo $row->ContactNo; ?>" 
						class="form-control"
						id="contact">
					</div>
				</div>
				<div class="form-group row" style="padding-left: 15px;padding-top:15px;">
					<input type="hidden" name="un" value="<?php echo $row->Username; ?>" />
					<button id="signup-btn" class="btn btn-default" type="button" 
					name="signup">Save</button>
				</div>
			</form>
		</div>
	</div>
</div>

<link rel="stylesheet" type="text/css" href="/contents/user-error-dialog-style.css" />
<script type="text/javascript" src="/scripts/user/user-all.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		// retrieve gender and role in db to be selected
		var gender_selected = "<?php echo $gender; ?>";
		var role_selected = "<?php echo $role; ?>";
		$("select[name='gender'] option").each(function() {
			if ($(this).val() == gender_selected)
			{
				$(this).attr("selected", "selected");
			}
		});
		$("select[name='role'] option").each(function() {
			if ($(this).val() == role_selected)
			{
				$(this).attr("selected", "selected");
			}
		});
		
		var brow_height = $(window).height();
		var userformscroll_height;
		userformscroll_height = brow_height - 169;
		$(".user-form-panel").slimscroll({
			wheelStep: 300,
			height: '480px'
		});
		$(".slimScrollDiv").css("height", userformscroll_height);
		$(".user-form-panel").css("height", userformscroll_height);
	});
</script>
