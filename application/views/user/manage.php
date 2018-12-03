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
		<div class="card ">
			<div class="card-header">
				<span class="">Data Table</span>
				<span class="float-right">
					<a href="<?php echo base_url($this->router->directory.$this->router->class.'/create_account');?>" class="btn btn-sm btn-primary" title="Add"> Add New</a>					
				</span>
			</div>
			<!-- /.card-header -->
			<div class="card-body">
				
				<div class="pl-2 mb-2 small">					
					<span class="mx-2"><i class="fa fa-circle text-success" aria-hidden="true"></i> Active Employees</span>
					<span class="mx-2"><i class="fa fa-circle text-warning" aria-hidden="true"></i> Inactive Employees</span>
					<span class="mx-2"><i class="fa fa-circle text-danger" aria-hidden="true"></i> Ex-Employees</span>
				</div>

				<div class="table-responsive">					
					<?php echo form_open(current_url(), array('method' => 'post', 'class' => 'form-inline my-3 mx-3', 'name' => 'download_data')); ?>
						<input type="hidden" name="form_action" value="download">
						<button type="submit" class="btn btn-sm btn-outline-success" title="Download"> <i class="fa fa-download" aria-hidden="true"></i> Download Employee Data</button>
					<?php echo form_close(); ?>
					<table id="user-datatable" class="table ci-table table-striped">					
						<thead class="thead-dark">
							<tr>
								<th>Employee</th>
								<th>Emp#</th>
								<th>Designation</th>
								<th>Registered Email</th>
								<th>Mobile</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody></tbody>
						<tfoot>
							<tr>
								<th>Employee</th>
								<th>Emp ID</th>
								<th>Designation</th>
								<th>Registered Email</th>
								<th>Mobile</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
						</tfoot>
					</table>
				</div>
			</div><!-- /.card-body -->
		</div><!-- /.card -->
    </div>
</div>