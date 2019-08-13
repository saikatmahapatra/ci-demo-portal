<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></h1>
<div class="row">
	<div class="col-md-12">
		<div class="card ci-card">
			<div class="card-header">
				Data Table
				<a href="<?php echo base_url($this->router->directory.$this->router->class.'/add_activity');?>" class="float-right btn btn-sm btn-outline-success" title="Add"> <i class="fa fa-fw fa-plus"></i> Add New</a>
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
						<span class=""><i class="fa fa-fw fa-circle-o text-success" aria-hidden="true"></i> Published</span>
						<span class=""><i class="fa fa-fw fa-circle-o text-warning" aria-hidden="true"></i> Unpublished</span>
					</div><!--/.grid-action-holder-->
					<table id="activity-datatable" class="table ci-table table-striped">
						<thead class="thead-light">
							<tr>
								<th scope="col">Activity Name</th>
								<th scope="col">Status</th>
								<th scope="col">Action</th>
							</tr>
						</thead>
						<tbody></tbody>
						<tfoot>
							<tr>
								<th scope="col">Activity Name</th>
								<th scope="col">Status</th>
								<th scope="col">Action</th>
							</tr>
						</tfoot>
					</table>
				</div><!--/.table-responsive-->
			
			</div><!--./card-body-->
			<!--<div class="card-footer"></div>--><!--/.card-footer-->
		</div><!--/.card-->
		
	</div><!--/.col-->
</div><!--/.row-->