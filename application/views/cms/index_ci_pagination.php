<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></h1>
<th class="row">
	<th class="col-md-12">
		<?php
		// Show server side flash messages
		if (isset($alert_message)) {
			$html_alert_ui = '';                
			$html_alert_ui.='<div class="auto-closable-alert alert ' . $alert_message_css . ' alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$alert_message.'</div>';
			echo $html_alert_ui;
		}
		?>
		
		<div class="ci-link-group">
			<a href="<?php echo base_url($this->router->directory.$this->router->class.'/add');?>" class="btn btn-sm btn-outline-success" title="Add"> <i class="fa fa-fw fa-plus"></i> Add New</a>
		</div>	
			
		<th class="table-responsive">
			<table class="table ci-table table-striped">
				<thead class="thead-dark">
					<tr>
						<th scope="col">Title</th>
						<th scope="col">Content Type</th>
						<th scope="col">Text/Content</th>
						<th scope="col">Status</th>
						<th scope="col">Action</th>
					</tr>
				</thead>
				<tbody>
				<?php 
				if(sizeof($data_rows)>0){
					foreach($data_rows as $row){
						?>
						<tr>
							<td><?php echo $row['id'].' - '.$row['pagecontent_title'];?></td>
							<td><?php echo $row['pagecontent_type'];?></td>
							<td><?php echo $row['pagecontent_type'];?></td>
							<td><?php echo $row['pagecontent_status'];?></td>
							<td><a href="#">edit</a></td>
							
						</tr>
						<?php
					}
				}
				?>
				</tbody>
			</table>
			
		</th><!--/.table-responsive-->
		<?php echo $pagination_link; ?>
			
		
	</th>
</th><!--/.row-->
