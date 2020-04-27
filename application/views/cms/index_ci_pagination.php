<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></h1>
<th class="row">
	<th class="col-lg-12">
	<?php echo isset($alert_message) ? $alert_message : ''; ?>
		<div class="action-btn-group">
			<a href="<?php echo base_url($this->router->directory.$this->router->class.'/add');?>" class="btn btn-sm btn-outline-success" title="Add"> <i class="fas fa-fw fa-plus"></i> Add New</a>
		</div>	
			
		<th class="table-responsive">
			<table class="table ci-table table-sm table-bordered text-center w-100">
				<thead class="thead-light">
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
							<td><?php echo $row['id'].' - '.$row['content_title'];?></td>
							<td><?php echo $row['content_type'];?></td>
							<td><?php echo $row['content_type'];?></td>
							<td><?php echo $row['content_status'];?></td>
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
