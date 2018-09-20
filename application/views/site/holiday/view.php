<div class="row heading-container">
    <div class="col-md-5">
        <h1 class="page-header"><?php echo isset($page_heading)? $page_heading:'Page Heading'; ?></h1>
    </div>
    <div class="col-md-7">
        <?php echo $breadcrumbs; ?>
    </div>
</div><!--/.heading-container-->

<div class="row">
	<div class="col-md-8">
		<table class="table table-bordered">
		  <thead class="">
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
					  <td><?php echo $row['holiday_date']; ?></td>
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
