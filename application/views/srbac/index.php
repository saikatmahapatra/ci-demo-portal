<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></h1>
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
			<span class="mx-2"><i class="fa fa-circle-o text-success" aria-hidden="true"></i> Published</span>
			<span class="mx-2"><i class="fa fa-circle-o text-warning" aria-hidden="true"></i> Unpublished</span>
			</div>
			<div class="col-md-4 text-right">
			<a href="<?php echo base_url($this->router->directory.$this->router->class.'/add');?>" class="btn btn-sm btn-outline-success" title="Add"> <i class="fa fa-plus"></i> Add New</a>
			</div>		
		</div><!--/.grid-action-holder-->

		<div class="table-responsive">
			<table id="cms-datatable" class="table ci-table table-striped">
				<thead class="thead-light">
					<tr>
						<th scope="col">Type</th>								
						<th scope="col">Title</th>
						<th scope="col">Created On</th>
						<th scope="col">Status</th>								
						<th scope="col">Action</th>
					</tr>
				</thead>
				<tbody></tbody>
				<tfoot>
					<tr>
						<th scope="col">Type</th>								
						<th scope="col">Title</th>
						<th scope="col">Created On</th>
						<th scope="col">Status</th>								
						<th scope="col">Action</th>
					</tr>
				</tfoot>
			</table>
		</div><!--/.table-responsive-->
			
		</div>
	</div>
</div><!--/.row-->
