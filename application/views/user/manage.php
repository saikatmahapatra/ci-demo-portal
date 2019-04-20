<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<div class="row heading-container">
    <div class="col-12">
        <h1 class="page-heading"><?php echo isset($page_heading)? $page_heading:'Page Heading'; ?></h1>
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
		<div class="grid-action-holder row my-2 px-3">
			<div class="col-md-8">
			<span class="mx-2"><i class="fa fa-circle text-success" aria-hidden="true"></i> Active Employees</span>
			<span class="mx-2"><i class="fa fa-circle text-warning" aria-hidden="true"></i> Inactive Employees</span>
			<span class="mx-2"><i class="fa fa-circle text-danger" aria-hidden="true"></i> Ex-Employees</span>
			</div>
			<div class="col-md-4 text-right">
			<a href="<?php echo base_url($this->router->directory.$this->router->class.'/create_account');?>" class="btn btn-sm btn-outline-success" title="Add"> <i class="fa fa-plus"></i> Add New</a>
			</div>		
		</div><!--/.grid-action-holder-->
		<?php echo form_open(current_url(), array('method' => 'post', 'class' => 'form-inline my-1 mx-3', 'name' => 'download_data')); ?>
				<input type="hidden" name="form_action" value="download">
				<button type="submit" class="btn btn-sm btn-outline-secondary" title="Download"> <i class="fa fa-download" aria-hidden="true"></i> Download as Excel</button>
			<?php echo form_close(); ?>
		<div class="table-responsive">					
			
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
		</div><!--/.table-responsive-->
    </div>
</div>