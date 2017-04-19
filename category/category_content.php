
<!-- Category -->
<!-- New category modal wrapper -->
<?php 
	require_once("category_query.php");
?>
<div id="new-category-dialog-wrapper" style="position: relative;z-index: -4">
</div>
<!-- Update category modal wrapper -->
<div id="update-category-dialog-wrapper">
</div>

<div id="category-save-dialog-wrapper">
</div>
<!-- Category content wrapper -->

<div class="category-contents content-wrapper" style="position: relative;z-index: inherit;">
	<div class="panel">
		<header class="panel-heading">
			<h4>
				Categories
			</h4>
		</header>
		<div class="panel-body category-table-panel">
			<div style="width:80%">
				<button id="category-add-btn" class="btn btn-primary">Add New</button>
			</div>
			<table id="category-table" class="table table-striped table-bordered" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th>
						</th>
						<th>
							Category
						</th>
						<th>
						</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$category = new Category();
						$category->getCategoryAll();
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
<link rel="stylesheet" type="text/css" href="/contents/category-dialog-style.css" />
<script type="text/javascript" src="/contents/dataTables/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="/contents/dataTables/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$("#category-table").DataTable({
			"aoColumns": [{"bSearchable": false},{"bSearchable": true},{"bSearchable": false}],
			"order": [[1, "asc"]],
			"lengthMenu": [5, 10, 25, 50, 100],
			"iDisplayLength": 5
		});
		var brow_height = $(window).height();
		//alert(brow_height + "g");
		// firefox browser with 768 reso in 18 inch computer
		var categorytblscroll_height;
		categorytblscroll_height = brow_height - 169;
		$(".category-table-panel").slimscroll({
			wheelStep: 300,
			height: '480px'
		});
		$(".slimScrollDiv").css("height", categorytblscroll_height);
		$(".category-table-panel").css("height", categorytblscroll_height);
	});
</script>
<script type="text/javascript" src="/scripts/category/category-all.js"></script>
