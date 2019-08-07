<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<div class="row page-title-container">
    <div class="col-sm-12">
        <h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Untitled Page'; ?></h1>
    </div>
</div><!--/.page-title-container-->

<div class="row">
	<div class="col-md-12">
		<div class="card ci-card">
			<div class="card-header">
				Data Table
				<a href="<?php echo base_url($this->router->directory.$this->router->class.'/create_account');?>" class="float-right btn btn-sm btn-outline-success" data-toggle="tooltip" title="Create new user account"> <i class="fa fa-plus"></i> Add New</a>
				<?php echo form_open(current_url(), array('method' => 'post', 'class' => 'float-right mx-2', 'name' => 'download_data')); ?>
					<input type="hidden" name="form_action" value="download">
					<button type="submit" class="btn btn-sm btn-outline-secondary" data-toggle="tooltip" title="Download data as excel"> <i class="fa fa-download" aria-hidden="true"></i> Download</button>
				<?php echo form_close(); ?>
			</div><!--/.card-header-->

			<div class="card-body">
				
				<?php
				// Show server side flash messages
				if (isset($alert_message)) {
					$html_alert_ui = '';
					$html_alert_ui.='<div class="auto-closable-alert alert ' . $alert_message_css . ' alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$alert_message.'</div>';
					echo $html_alert_ui;
				}
				?>
				
				<div class="table-responsive">
					<div class="grid-action-holder mb-3">
						<span class=""><i class="fa fa-circle-o text-success" aria-hidden="true"></i> Active</span>
						<span class=""><i class="fa fa-circle-o text-warning" aria-hidden="true"></i> Inactive</span>
						<span class=""><i class="fa fa-circle-o text-danger" aria-hidden="true"></i> Archived</span>
					</div><!--/.grid-action-holder-->

					<table id="user-datatable" class="table ci-table table-striped">
						<thead class="thead-light">
							<tr>
								<th>Name</th>
								<th>EmpID</th>
								<th>Email</th>
								<th>Phone</th>
								<th>Designation</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody></tbody>
						<tfoot>
							<tr>
								<th>Name</th>
								<th>EmpID</th>
								<th>Email</th>
								<th>Phone</th>
								<th>Designation</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
						</tfoot>
					</table>
				</div><!--/.table-responsive-->
			</div><!--./card-body-->
			<!--<div class="card-footer"></div>--><!--/.card-footer-->
		</div><!--/.card-->
		
	</div><!--/.col-->
</div><!--/.row-->