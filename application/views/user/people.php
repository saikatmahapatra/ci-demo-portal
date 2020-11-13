<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></h1>
<div class="row">
	<div class="col-lg-12">
		<div class="card ">
			<div class="card-header"><?php echo $this->common_lib->get_icon('table'); ?> Data Table</div>
			<div class="card-body">
			<div class="table-responsive">
				<table id="employees-datatable" class="table ci-table  table-bordered w-100">
					<thead class="">
						<tr>
							<th>Name</th>
							<!-- <th>Designation</th> -->
							<th>Emp ID</th>
							<th>Email</th>
							<th>Phone</th>
						</tr>
					</thead>
					<tbody></tbody>
					<tfoot class="">
						<tr>
							<th>Name</th>
							<!-- <th>Designation</th> -->
							<th>Emp ID</th>
							<th>Email</th>
							<th>Phone</th>
						</tr>
					</tfoot>
				</table>
				</div><!--/.table-responsive-->
			</div><!--./card-body-->
		</div><!--/.card-->
	</div><!--/.col-->
</div><!--/.row-->