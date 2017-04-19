
<!-- Category -->
<!-- New category modal wrapper -->
<?php 
	require_once("brand_query.php");
?>
<div id="new-brand-dialog-wrapper" style="position: relative;z-index: -4">
</div>
<!-- Update category modal wrapper -->
<div id="update-brand-dialog-wrapper">
</div>

<div id="brand-save-dialog-wrapper">
</div>
<!-- Category content wrapper -->

<div class="brand-contents content-wrapper" style="position: relative;z-index: inherit;">
	<div class="panel"> <!-- style="position: relative;z-index: inherit;" -->
		<header class="panel-heading">
			<h4>
				Brands
			</h4>
		</header>
		<div class="panel-body brand-table-panel">
			<div style="width:80%">
				<button id="brand-add-btn" class="btn btn-primary">Add New</button>
			</div>
			<table id="brand-table" class="table table-striped table-bordered" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th>
						</th>
						<th>
							Brand
						</th>
						<th>
						</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$brand = new Brand();
						$brand->getBrandAll();
					?>
					<!-- <tr>
						<td>
							<input type="checkbox" name="check" id="" />
						</td>
						<td>
							Category
						</td>
						<td>
							<button type="button" name="Update" value="" class="btn btn-success">
								Update
							</button>
						</td>
					</tr> -->
					<!-- <tr>
						<td>
							<input type="checkbox" name="check" id="" />
						</td>
						<td>
							Category
						</td>
						<td>
							<button type="button" name="Update" value=""
							class="btn btn-success">
								Update
							</button>
						</td>
					</tr> -->
					<!-- <tr>
						<td>
							<input type="checkbox" name="check" id="" />
						</td>
						<td>
							Category
						</td>
						<td>
							<button type="button" name="Update" value="" class="btn btn-success">
								Update
							</button>
						</td>
					</tr> -->
					<!-- <tr>
						<td>
							<input type="checkbox" name="check" id="" />
						</td>
						<td>
							Category
						</td>
						<td>
							<button type="button" name="Update" value="" class="btn btn-success">
								Update
							</button>
						</td>
					</tr> -->
				</tbody>
			</table>
		</div>
	</div>
</div>
<!-- <link rel="stylesheet" type="text/css" href="/contents/dataTables/css/jquery.dataTables.min.css" /> -->
<link rel="stylesheet" type="text/css" href="/contents/dataTables/css/dataTables.bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="/contents/brand-dialog-style.css" />
<script type="text/javascript" src="/contents/dataTables/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="/contents/dataTables/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$("#brand-table").DataTable({
			"aoColumns": [{"bSearchable": false},{"bSearchable": true},{"bSearchable": false}],
			"order": [[1, "asc"]],
			"lengthMenu": [5, 10, 25, 50, 100],
			"iDisplayLength": 5
		});
		var brow_height = $(window).height();
		//alert(brow_height + "g");
		// firefox browser with 768 reso in 18 inch computer
		var brandtblscroll_height;
		brandtblscroll_height = brow_height - 169;
		$(".brand-table-panel").slimscroll({
			wheelStep: 300,
			height: '480px'
		});
		$(".slimScrollDiv").css({"height": brandtblscroll_height});
		$(".brand-table-panel").css("height", brandtblscroll_height);
	});
</script>
<script type="text/javascript" src="/scripts/brand/brand-all.js"></script>
