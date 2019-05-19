<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<div class="row heading-container">
    <div class="col-md-12">
		<h1 class="page-heading"><?php echo isset($page_heading)? $page_heading:'Page Heading'; ?></h1>
    </div>
</div><!--/.heading-container-->

<div class="row mt-3">
	<div class="col-md-7">
		<!-- <div class="grid-action-holder row my-2">
			<div class="col-md-12">
				<span class="m-1 p-1 table-warning"> Optional Holidays</span>
			</div>	
		</div> -->
		<!-- <p class="alert alert-info"><i class="fa fa-info-circle" aria-hidden="true"></i> Please note that <span class="h5 text-danger font-weight-bold">*</span> marked dates are optional holiday.<p> -->
		<div class="table-responsive">
			<table class="table table-sm ci-table table-bordered">
				<thead class="thead-dark">
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
							<th scope="row"><?php echo $count;?></th>
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
								<?php echo $row['holiday_type']=='O' ? ' <span class="text-danger font-italic">('.strtolower($arr_holiday_type[$row['holiday_type']]).')</span>' : '' ;?>
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
