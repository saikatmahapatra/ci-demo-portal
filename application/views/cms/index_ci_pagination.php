<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></h1>
<th class="row">
	<th class="col-lg-12">
	<?php echo isset($alert_message) ? $alert_message : ''; ?>

		<div class="d-flex mb-2">
			<div class="align-self-end ml-auto"> 
				<a href="<?php echo base_url($this->router->directory.$this->router->class.'/add');?>" class="btn btn-outline-success"> <?php echo $this->common_lib->get_icon('plus'); ?> Add New</a>
			</div>
		</div>	
			
		<th class="table-responsive">
			<table class="table ci-table  table-bordered table-hover w-100">
				<thead class="">
					<tr>
						<th scope="col">Title</th>
						<th scope="col">Type</th>
						<th scope="col">Description</th>
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
				<tfoot class="">
					<tr>
						<th scope="col">Title</th>
						<th scope="col">Type</th>
						<th scope="col">Description</th>
						<th scope="col">Status</th>
						<th scope="col">Action</th>
					</tr>
				</tfoot>
			</table>
			
		</th><!--/.table-responsive-->
		<?php echo $pagination_link; ?>
			
		
	</th>
</th><!--/.row-->
