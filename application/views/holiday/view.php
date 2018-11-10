<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<div class="row heading-container">
    <div class="col-12">
        <h1 class="page-header"><?php echo isset($page_heading)? $page_heading:'Page Heading'; ?></h1>
    </div>
</div><!--/.heading-container-->

<div class="row">
	<div class="col-md-8">
		<table class="table ci-table table-striped table-bordered">
		  <thead class="thead-dark">
			<tr>
			  <th scope="col">#</th>
			  <th scope="col">Date</th>
			  <th scope="col">Occasion</th>
			</tr>
		  </thead>
		  <tbody>
			<?php
				$count = 1;
				foreach($data_rows as $key=>$row){
					?>
					<tr>
					  <th scope="row"><?php echo $count;?></th>
					  <td><?php echo $this->common_lib->display_date($row['holiday_date']); ?></td>
					  <td><?php echo $row['holiday_description']; ?></td>					  
					</tr>
					<?php
					$count++;
				}
			?>
						
		  </tbody>
		</table>
	</div>
</div>
