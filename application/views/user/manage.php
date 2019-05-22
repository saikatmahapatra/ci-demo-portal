<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<div class="row page-title-container">
    <div class="col-sm-12">
        <h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Untitled Page'; ?></h1>
    </div>
</div><!--/.page-title-container-->

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
			<span class="mx-2"><i class="fa fa-circle-o-notch text-success" aria-hidden="true"></i> Active Employees</span>
			<span class="mx-2"><i class="fa fa-circle-o-notch text-warning" aria-hidden="true"></i> Inactive Employees</span>
			<span class="mx-2"><i class="fa fa-circle-o-notch text-danger" aria-hidden="true"></i> Ex-Employees</span>
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
    </div>
</div>