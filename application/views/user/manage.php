<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></h1>
<div class="row">
	<div class="col-lg-12">
		<div class="card ci-card">
			<div class="card-header">Data Table</div>
			<div class="card-body">
			
			<?php echo isset($alert_message) ? $alert_message : ''; ?>
				<div class="ci-link-group">
					<a href="<?php echo base_url($this->router->directory.$this->router->class.'/create_account');?>" class="btn btn-sm btn-outline-success mr-2" data-toggle="tooltip" title="Create new user account"> <i class="fas fa-plus"></i> Add New</a>
				
					<?php echo form_open(current_url(), array('method' => 'post', 'class' => '', 'name' => 'download_data')); ?>
						<input type="hidden" name="form_action" value="download">
						<button type="submit" class="btn btn-sm btn-outline-secondary" data-toggle="tooltip" title="Download data as excel"> <i class="fas fa-download" aria-hidden="true"></i> Download</button>
					<?php echo form_close(); ?>
				</div>

				<div class="table-responsive">

					<table id="user-datatable" class="table ci-table table-sm table-bordered text-center w-100">
						<thead class="thead-light">
							<tr>
								<th>Name</th>
								<th>Emp ID</th>
								<th>Email</th>
								<th>Mobile</th>
								<th>Designation</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody></tbody>
					</table>
				</div><!--/.table-responsive-->
			</div><!--./card-body-->
		</div><!--/.card-->
	</div><!--/.col-->
</div><!--/.row-->