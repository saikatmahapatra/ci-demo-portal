<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></h1>
<div class="row">
	<div class="col-lg-12">
		<div class="card ci-card">
			<div class="card-header">Data Table</div>
			<div class="card-body">
			
			<?php echo isset($alert_message) ? $alert_message : ''; ?>
				<div class="d-flex h-100 mb-2">
					<div class="align-self-end ml-auto"> 
						<a href="<?php echo base_url($this->router->directory.$this->router->class.'/create_account');?>" class="btn btn-outline-success"> <?php echo $this->common_lib->get_icon('plus'); ?> Add New Employee</a>

						<?php echo form_open(current_url(), array('method' => 'post', 'class' => 'd-inline-block', 'name' => 'download_data')); ?>
						<input type="hidden" name="form_action" value="download">
						<button type="submit" class="btn btn-outline-secondary"> <?php echo $this->common_lib->get_icon('download'); ?> Download</button>
					<?php echo form_close(); ?>
					</div>
				</div>

				<div class="table-responsive">

					<table id="user-datatable" class="table ci-table table-sm table-striped w-100">
						<thead class="">
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