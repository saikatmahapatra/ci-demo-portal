<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></h1>
<div class="row">
	<div class="col-lg-9">
		<div class="card ci-card">
			<div class="card-header">List of Holidays</div>
			<div class="card-body">
				<div class="table-responsive">
			<table class="table ci-table table-sm table-bordered text-center">
				<thead class="thead-light">
				<tr>
					<th scope="col">#</th>
					<th scope="col">Date</th>
					<th scope="col">Day</th>
					<!-- <th scope="col">Holiday Type</th> -->
					<th scope="col">Occasion</th>
				</tr>
				</thead>
				<tbody>
				<?php
					$count = 1;
					foreach($data_rows as $key=>$row){
						?>
						<tr class="<?php echo $row['holiday_type']=='O' ? '' : '' ;?>">
							<td scope="row"><?php echo $count;?></td>
							<td>
								<?php echo $this->common_lib->display_date($row['holiday_date'], null, null, 'd-M-Y'); ?>
								<?php //echo $row['holiday_type']=='O' ? '<span class="text-danger font-weight-bold h5">*</span>' : '' ;?>
							</td>
							<td>
								<?php echo $this->common_lib->display_date($row['holiday_date'], null, null, 'D'); ?>
							</td>
							<!-- <td><?php echo $arr_holiday_type[$row['holiday_type']]; ?></td> -->
							<td>
								<?php echo $row['holiday_description']; ?>
								<?php echo $row['holiday_type']=='O' ? '('.strtolower($arr_holiday_type[$row['holiday_type']]).')' : '' ;?>
							</td>
						</tr>
						<?php
						$count++;
					}
				?>
							
				</tbody>
			</table>
		</div>
			</div>
		</div>		
	</div>
</div>
