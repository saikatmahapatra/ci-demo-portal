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

		<div class="table-responsive">
			<table id="cms-datatable" class="table ci-table table-striped">
				<thead class="thead-dark">
					<tr>
						<th scope="col">Type</th>								
						<th scope="col">Title</th>
						<th scope="col">Created on</th>
						<th scope="col">Status</th>								
						<th scope="col">Action</th>
					</tr>
				</thead>
				<tbody></tbody>
			</table>
		</div><!--/.table-responsive-->
			
		</div>
	</div>
</div><!--/.row-->
