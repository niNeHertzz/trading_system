

<!-- New User -->
<?php 
	require_once("user_query.php");
?>
<div id="new-user-error-dialog-wrapper">
</div>	
<div id="user-save-dialog-wrapper">
</div>
<!-- New user content wrapper -->

<div class="new-user-contents content-wrapper" style="position: relative;z-index: inherit;">
	<div class="panel">
		<header class="panel-heading">
			<h4>
				New User
			</h4>
		</header>
		<div class="panel-body user-form-panel" style="">
			<form id="new-user-form" method="post" action="/user/new-user.php" enctype="multipart/form-data">
				<div class="form-group row" style="">
					<div class="col-sm-3 col-md-3 col-lg-3" style="padding-top: 65px;">
						<label>Last Name</label>
						<input type="text" name="lnametxt" value="" class="form-control personal-basic-info name">
					</div>
					<div class="col-sm-3 col-md-3 col-lg-3" style="padding-top: 65px;">
						<label>First Name</label>
						<input type="text" name="fnametxt" value="" class="form-control personal-basic-info name">
					</div>
					<div class="col-sm-3 col-md-3 col-lg-3" style="padding-top: 65px;">
						<label>Middle Name</label>
						<input type="text" name="mnametxt" value="" class="form-control personal-basic-info name">
					</div>
					<div class="col-sm-3 col-md-3 col-lg-3" style="padding-left: 45px;">
						<div style="width:120px;height: 110px;
						border:1px solid gray;border-radius: 3px;">
							<a href="#">
								<img class="profile-pic" />
							</a>
						</div>
						<div style="padding-left:12px;margin-top: 15px;">
							<button class="btn btn-default btn-custom" type="button" 
							name="upload-pic-btn">Upload Pic</button>
							<input type="file" name="profile_pic_image" value="" style="display:none"
							accept=".png, .jpg">
						</div>
					</div>
				</div>
				<div class="form-group row">
					<div class="col-sm-2 col-md-2 col-lg-2">
						<label>Gender</label>
						<select name="gender" class="form-control">
							<option value="Select Gender">Select Gender...</option>
							<option value="Male">Male</option>
							<option value="Female">Female</option>
						</select>
					</div>
					<div class="col-sm-3 col-md-2 col-lg-2">
						<label>Birth Date</label>
						<input type="text" name="bdatetxt" value="" class="form-control" id="bdate-picker">
					</div>
					<div class="col-sm-3 col-md-5 col-lg-5">
						<label>Address</label>
						<input type="text" name="addresstxt" value="" class="form-control personal-basic-info">
					</div>
					<div class="col-sm-3 col-md-3 col-lg-3">
						<label>Contact No.</label>
						<input type="text" name="contacttxt" value="" class="form-control"
						id="contact">
					</div>
				</div>
				<div class="form-group row">
					<div class="col-sm-3 col-md-2 col-lg-2">
						<label>Username</label>
						<input type="text" name="unametxt" value="" class="form-control">
					</div>
					<div class="col-sm-3 col-md-3 col-lg-3">
						<label>Password</label>
						<input type="password" name="pwordtxt" value="" class="form-control">
					</div>
					<div class="col-sm-3 col-md-3 col-lg-3">
						<label>Confirm Password</label>
						<input type="password" name="confrm_pwordtxt" value="" class="form-control">
					</div>
					<div class="col-sm-2 col-md-2 col-lg-2">
						<label>Role</label>
						<select name="role" class="form-control">
							<option value="Select Role">Select Role...</option>
							<option value="Management">Management</option>
							<option value="Sales Head">Sales Head</option>
							<option value="Sales Staff">Sales Staff</option>
							<option value="IT">IT</option>
						</select>
					</div>
				</div>
				<div class="form-group row" style="padding-left: 15px;padding-top:15px;">
					<button id="signup-btn" class="btn btn-default" type="button" 
					name="signup">Sign-up</button>
				</div>
			</form>
		</div>
	</div>
</div>

<link rel="stylesheet" type="text/css" href="/contents/user-error-dialog-style.css" />
<script type="text/javascript">
	$(document).ready(function(){
		
		var brow_height = $(window).height();
		//alert(brow_height + "g");
		// firefox browser with 768 reso in 18 inch computer
		var usertblscroll_height;
		usertblscroll_height = brow_height - 169;
		$(".user-table-panel").slimscroll({
			wheelStep: 300,
			height: '480px'
		});
		$(".slimScrollDiv").css("height", usertblscroll_height);
		$(".user-form-panel").css("height", usertblscroll_height);
	});
</script>
<script type="text/javascript" src="/scripts/user/user-all.js"></script>
