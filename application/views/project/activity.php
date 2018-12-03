<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<div class="row heading-container">
    <div class="col-12">
        <h1 class="h3 mb-3 font-weight-normal"><?php echo isset($page_heading)? $page_heading:'Page Heading'; ?></h1>
    </div>
</div><!--/.heading-container-->

<div class="row">
	<div class="col-md-12">
		<?php
		// Show server side flash messages
		if (isset($alert_message)) {
			$html_alert_ui = '';                
			$html_alert_ui.='<div class="auto-closable-alert alert ' . $alert_message_css . ' alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$alert_message.'</div>';
			echo $html_alert_ui;
		}
		?>
		<div class="card">
			<div class="card-header">
				<span class="">Data Table</span>
				<span class="float-right">
					<a href="<?php echo base_url($this->router->directory.$this->router->class.'/add_activity');?>" class="btn btn-sm btn-primary" title="Add"> Add New</a>
				</span>
			</div>
			<div class="card-body">

				<div class="pl-2 mb-2 small">					
					<span class="mx-2"><i class="fa fa-circle text-success" aria-hidden="true"></i> Published</span>
					<span class="mx-2"><i class="fa fa-circle text-warning" aria-hidden="true"></i> Unpublished</span>					
				</div>

				<div class="table-responsive">
					<table id="activity-datatable" class="table ci-table table-striped">
						<thead class="thead-dark">
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
				</div>
			</div>
		</div>
	</div>
</div><!--/.row-->
