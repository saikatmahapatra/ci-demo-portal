<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></h1>
<div class="row">
	<div class="col-lg-8">
		<div class="card ">
			<div class="card-header"><?php echo $this->common_lib->get_icon('holiday_calendar'); ?> List of Holidays <?php echo date('Y');?></div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table ci-table  table-bordered table-striped w-100">
						<thead class="">
						<tr>
							<!-- <th scope="col">#</th> -->
							<th scope="col">Date</th>
							<th scope="col">Day</th>
							<!-- <th scope="col">Holiday Type</th> -->
							<th scope="col">Holiday</th>
						</tr>
						</thead>
						<tbody>
						<?php
							$count = 1;
							foreach($data_rows as $key=>$row){
								?>
								<tr class="">
									<!-- <td scope="row"><?php echo $count;?></td> -->
									<td>
										<?php echo $this->common_lib->display_date($row['holiday_date'], null, null, 'M d, Y'); ?>
										<?php //echo $row['holiday_type']=='O' ? '<span class="text-danger font-weight-bold h5">*</span>' : '' ;?>
									</td>
									<td>
										<?php echo $this->common_lib->display_date($row['holiday_date'], null, null, 'D'); ?>
									</td>
									<!-- <td><?php echo $arr_holiday_type[$row['holiday_type']]; ?></td> -->
									<td>
										<?php echo $row['holiday_description']; ?>
										<?php echo $row['holiday_type']=='O' ? '<span class="small text-muted">('.strtolower($arr_holiday_type[$row['holiday_type']]).')</span>' : '' ;?>
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
