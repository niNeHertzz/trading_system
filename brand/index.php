<!Doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Simkimban | Brand</title>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js">
	</script>
	<link href="/contents/bootstrap-3.3.7/css/bootstrap.min.css" rel="stylesheet" />
	<script type="text/javascript" src="/contents/bootstrap-3.3.7/js/bootstrap.min.js"></script>
	<link href="/contents/homepage-style.css" rel="stylesheet" />
	<script type="text/javascript" src="/scripts/homepage/sidebar-resize.js"></script>
	<script type="text/javascript" src="/scripts/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<script type="text/javascript" src="/scripts/homepage/sidebar-collapse.js"></script>
	<link rel="stylesheet" type="text/css" href="/contents/font-awesome-4.7.0/css/font-awesome.min.css" />
	<script type="text/javascript" src="/scripts/homepage/sidebar-content-display.js"></script>
	<link rel="stylesheet" type="text/css" href="/contents/main-content-style.css" />
	<link rel="stylesheet" type="text/css" href="/contents/brand-content-style.css" />
	
</head>
<body style="position: relative;z-index: -7">
<div id="page-container" style="position: relative;z-index: inherit;">
	<div class="navbar navbar-default" style="position: relative;z-index: -4">
		<div class="sidebar-toggle" href="#">
			<div class="fa fa-bars">
			</div>
		</div>
		<ul class="nav top-menu pull-right">
			<li>
				<a class="dropdown-toggle" data-toggle="dropdown" href="#">
					<img alt="" src="/contents/images/profile_pics/avatar1_small.jpg">
					<span class="username">John Doe</span>
					<b class="caret"></b>
				</a>
				<ul class="dropdown-menu">
					<li>
						<a href="#">
							<i class="fa fa-user pull-right">
							</i>
							Profile
						</a>
					</li>
					<li>
						<a href="#">
							<i class="fa fa-lock pull-right">
							</i>
							Lock Account
						</a>
					</li>
					<li>
						<a href="/">
							<i class="fa fa-ban pull-right">
							</i>
							Logout
						</a>
					</li>
				</ul>
			</li>
		</ul>
	</div>
	<div id="sidebar" style="position: fixed;top: 0px;">
		<!-- <div class="sidebar-content"> -->
			<a class="sidebar-brand" href="/dashboard/">
				<img src="/contents/images/simkimban_logo_12.png" width="37px" height="33px"/>
				<span>SIMKIMBAN</span>
			</a>
			<ul class="sidebar-menu">
				<li>
					<a href="#">
						<!--<i class="glyphicon glyphicon-fire">
						</i>-->
						<span>Dashboard</span>
					</a>
				</li>
				<li>
					<a class="sidebar-nav-menu" href="#">
						<!--<i class="glyphicon glyphicon-fire">
						</i>-->
						<span>Supplier</span>
						<span class="glyphicon glyphicon-menu-right collapse-icon"></span>
					</a>
					<ul style="display: none">
						<li>
							<a href="#">
								Add Supplier
							</a>
						</li>
						<li>
							<a href="/supplier/view-supplier.php" id="view-supplier">
								View Suppliers
							</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="../category/" id="category">
						<!--<i class="glyphicon glyphicon-fire">
						</i>-->
						<span>Categories</span>
					</a>
				</li>
				<li>
					<a href="/brand/" id="brand">
						<!--<i class="glyphicon glyphicon-fire">
						</i>-->
						<span>Brands</span>
					</a>
				</li>
				<li>
					<a class="sidebar-nav-menu" href="#">
						<!--<i class="glyphicon glyphicon-fire">
						</i>-->
						<span>User</span>
						<span class="glyphicon glyphicon-menu-right collapse-icon"></span>
					</a>
					<ul style="display: none">
						<li>
							<a href="/user/new-user.php" id="new-user">
								Add User
							</a>
						</li>
						<li>
							<a href="/user/view-user.php" id="view-user">
								View Users
							</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="#">
						<!--<i class="glyphicon glyphicon-fire">
						</i>-->
						<span>Form Components</span>
					</a>
				</li>
				<li>
					<a href="#">
						<!--<i class="glyphicon glyphicon-fire">
						</i>-->
						<span>Mail</span>
					</a>
				</li>
				<li>
					<a href="#">
						<!--<i class="glyphicon glyphicon-fire">
						</i>-->
						<span>Charts</span>
					</a>
				</li>
				<li>
					<a href="#">
						<!--<i class="glyphicon glyphicon-fire">
						</i>-->
						<span>Maps</span>
					</a>
				</li>
				<li>
					<a href="#">
						<!--<i class="glyphicon glyphicon-fire">
						</i>-->
						<span>Extra</span>
					</a>
				</li>
				<li>
					<a href="#">
						<!--<i class="glyphicon glyphicon-fire">
						</i>-->
						<span>Login Page</span>
					</a>
				</li>
			</ul>
		<!-- </div> -->
	</div>
	<div class="main-content" style="position: relative;z-index: -5">
		<?php require_once('/brand_content.php'); ?>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){ 
		var browser_height = $(window).height();
		// firefox browser with 768 reso in 18 inch computer
		var sidebarscroll_height;
		$(".sidebar-menu").slimscroll({
			wheelStep: 300,
			height: '560px'
		});
		$(".slimScrollDiv").css("height", sidebarscroll_height);
		$(".sidebar-menu").css("height", sidebarscroll_height);
		// if (browser_height == 641) {
		// 	sidebarscroll_height = 641 - 81 + "px";
		// 	$(".sidebar-menu").slimscroll({
		// 		wheelStep: 300,
		// 		height: '560px'
		// 	});
		// 	$(".slimScrollDiv").css("height", sidebarscroll_height);
		// 	$(".sidebar-menu").css("height", sidebarscroll_height);
		// }
		// // firefox browser with 768 reso in 14 inch laptop
		// if (browser_height == 649) {
		// 	sidebarscroll_height = 649 - 81 + "px";
		// 	$(".sidebar-menu").slimscroll({
		// 		wheelStep: 300,
		// 		height: '569px'
		// 	});
		// 	$(".slimScrollDiv").css("height", sidebarscroll_height);
		// 	$(".sidebar-menu").css("height", sidebarscroll_height);
		// }
		// // chrome browser with 768 reso in 18 inch computer
		// if (browser_height == 662) {
		// 	sidebarscroll_height = 662 - 81 + "px";
		// 	$(".sidebar-menu").slimscroll({
		// 		wheelStep: 300,
		// 		height: '581px'
		// 	});
		// 	$(".slimScrollDiv").css("height", sidebarscroll_height);
		// 	$(".sidebar-menu").css("height", sidebarscroll_height);
		// }
		
		// // firefox browser with 800 reso in 18 inch computer
		// if (browser_height == 673) {
		// 	sidebarscroll_height = 673 - 81 + "px";
		// 	$(".sidebar-menu").slimscroll({
		// 		wheelStep: 300,
		// 		height: '591px'
		// 	});
		// 	$(".slimScrollDiv").css("height", sidebarscroll_height);
		// 	$(".sidebar-menu").css("height", sidebarscroll_height);
		// }
		// // chrome browser with 800 reso in 18 inch computer
		// if (browser_height == 694) {
		// 	sidebarscroll_height = 694 - 81 + "px";
		// 	$(".sidebar-menu").slimscroll({
		// 		wheelStep: 300,
		// 		height: '612px'
		// 	});
		// 	$(".slimScrollDiv").css("height", sidebarscroll_height);
		// 	$(".sidebar-menu").css("height", sidebarscroll_height);
		// }
		
		// // firefox browser with 720 reso in 18 inch computer
		// if (browser_height == 593) {
		// 	sidebarscroll_height = 593 - 81 + "px";
		// 	$(".sidebar-menu").slimscroll({
		// 		wheelStep: 300,
		// 		height: '510px'
		// 	});
		// 	$(".slimScrollDiv").css("height", sidebarscroll_height);
		// 	$(".sidebar-menu").css("height", sidebarscroll_height);
		// }
		// // chrome browser with 720 reso in 18 inch computer
		// if (browser_height == 614) {
		// 	sidebarscroll_height = 614 - 81 + "px";
		// 	$(".sidebar-menu").slimscroll({
		// 		wheelStep: 300
		// 	});
		// 	$(".slimScrollDiv").css("height", sidebarscroll_height);
		// 	$(".sidebar-menu").css("height", sidebarscroll_height);
		// }
		// var scroll_height = $("#sidebar .sidebar-menu").height() - 80;
		// $("#sidebar .slimScrollBar").css({ "height" : scroll_height + "px"});
		// $("#sidebar .sidebar-menu").on("mouseenter",function(){
			
		// 	//alert(scroll_height);
		// 	$("#sidebar .slimScrollBar").css({ "height" : scroll_height + "px"});
		// });
		// $("#sidebar .sidebar-menu").on("mouseleave",function(){
		// 	$("#sidebar .slimScrollBar").css({ "height" : scroll_height + "px"});
		// });
	});
</script>
</body>
</html>