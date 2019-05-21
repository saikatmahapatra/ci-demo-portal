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
			
			<div class="col-md-12 text-right">
			<a href="<?php echo base_url($this->router->directory.$this->router->class.'/add');?>" class="btn btn-sm btn-outline-success" title="Add"> <i class="fa fa-plus"></i> Add New</a>
			</div>		
		</div><!--/.grid-action-holder-->

		<div class="table-responsive">
			<table id="holiday-datatable" class="table ci-table table-striped">
				<thead class="thead-dark">
					<tr>
						<th scope="col">Date</th>
						<th scope="col">Day</th>
						<th scope="col">Occasion</th>
						<th scope="col">Holiday Type</th>
						<th scope="col">Action</th>
					</tr>
				</thead>
				<tbody></tbody>
				<tfoot>
					<tr>
						<th scope="col">Date</th>
						<th scope="col">Day</th>
						<th scope="col">Occasion</th>
						<th scope="col">Holiday Type</th>
						<th scope="col">Action</th>
					</tr>
				</tfoot>
			</table>
		</div><!--/.table-responsive-->
		
	</div>
</div><!--/.row-->
