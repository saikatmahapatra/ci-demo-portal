<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<div class="row heading-container">
    <div class="col-12">
        <h1 class="page-header"><?php echo isset($page_heading)? $page_heading:'Page Heading'; ?></h1>
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
				<span class="">Employees</span>
				<span class="float-right">
					<a href="<?php echo base_url($this->router->directory.$this->router->class.'/create_account');?>" class="btn btn-sm btn-primary" title="Add"> Add New</a>
				</span>
			</div>
			<!-- /.card-header -->
			<div class="card-body">
				<div class="table-responsive">
					<table id="user-datatable" class="table table-sm">
						<thead>
							<tr>
								<th>Name & Info</th>
								<th>Corp Details</th>
								<th>Contact Info</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody></tbody>
						<tfoot>
							<tr>
							<th>Name & Info</th>
							<th>Corp Details</th>
							<th>Contact Info</th>
							<th>Action</th>
							</tr>
						</tfoot>
					</table>
				</div>
			</div><!-- /.card-body -->
		</div><!-- /.card -->
    </div>
</div>