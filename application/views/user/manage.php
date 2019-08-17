<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></h1>
<div class="row">
	<div class="col-md-12">
		<div class="card ci-card">
			<div class="card-header h6">
				Data Table
				
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
				<div class="ci-link-group">
					<a href="<?php echo base_url($this->router->directory.$this->router->class.'/create_account');?>" class="btn btn-sm btn-outline-success mr-2" data-toggle="tooltip" title="Create new user account"> <i class="fa fa-fw fa-plus"></i> Add New</a>
				
					<?php echo form_open(current_url(), array('method' => 'post', 'class' => '', 'name' => 'download_data')); ?>
						<input type="hidden" name="form_action" value="download">
						<button type="submit" class="btn btn-sm btn-outline-secondary" data-toggle="tooltip" title="Download data as excel"> <i class="fa fa-fw fa-download" aria-hidden="true"></i> Download</button>
					<?php echo form_close(); ?>
				</div>

				<div class="table-responsive">

					<table id="user-datatable" class="table ci-table table-striped">
						<thead class="thead-dark">
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
			<!--<div class="card-footer"></div>--><!--/.card-footer-->
		</div><!--/.card-->
		
	</div><!--/.col-->
</div><!--/.row-->