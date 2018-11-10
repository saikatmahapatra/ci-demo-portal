<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<div class="row heading-container">
    <div class="col-12">
        <h1 class="page-header"><?php echo isset($page_heading)? $page_heading:'Page Heading'; ?></h1>
    </div>
</div><!--/.heading-container-->

<div class="row my-2">
	<div class="col-md-12">
	<?php
	// Show server side flash messages
	if (isset($alert_message)) {
		$html_alert_ui = '';                
		$html_alert_ui.='<div class="auto-closable-alert alert ' . $alert_message_css . ' alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$alert_message.'</div>';
		echo $html_alert_ui;
	}
	?>
	</div>	
</div>

<div class="row my-3">
	<div class="col-md-12">
		<div class="card card-legend">			
			<div class="card-body">
				<h6 class="card-title text-on-card">Apply Leave</h6>

					<table class="table table-sm table-bordered">
						<thead class="thead-light text-center">
							<tr>
								<th class="bg-dark text-white" scope="col" colspan="3">Leave Balance 2017-2018 FY</th>								
							</tr>
							<tr>
								<th>Casual Leave (CL)</th>								
								<th>Sick Leave (SL)</th>								
								<th>Earned Leave (EL)</th>								
							</tr>
						</thead>
						<tbody class="text-center">
							<tr>
								<td>4.0 / 10.0</td>
								<td>1.5 / 7.0</td>
								<td>0.25 / 7.0</td>
							</tr>
						</tbody>
					</table>

				<?php echo form_open(current_url(), array( 'method' => 'post','class'=>'ci-form','name' => '','id' => 'ci-form-leave',)); ?>
				<?php echo form_hidden('form_action', 'add'); ?>
				<div class="form-row">
					<div class="form-group col-md-2">
						<label for="leave_type" class="bmd-label-floating">Leave Type <span class="required">*</span></label>
						<?php
						echo form_dropdown('leave_type', $leave_type_arr, set_value('leave_type'), array(
							'class' => 'form-control',
						));
						?> 
						<?php echo form_error('leave_type'); ?>
					</div>
										
					<div class="form-group col-md-2">
						<label for="leave_from_date" class="bmd-label-floating">From Date <span class="required">*</span></label>
						<?php echo form_input(array('name' => 'leave_from_date','value' => set_value('leave_from_date'),'id' => 'leave_from_date','class' => 'form-control', 'placeholder'=>'dd-mm-yyyy', 'readonly'=>'readonly')); ?>
						<?php echo form_error('leave_from_date'); ?>
					</div>
						
					<div class="form-group col-md-2">
						<label for="leave_to_date" class="bmd-label-floating">To Date <span class="required">*</span></label>		
						<?php echo form_input(array('name' => 'leave_to_date','value' => set_value('leave_to_date'),'id' => 'leave_to_date','class' => 'form-control', 'placeholder'=>'dd-mm-yyyy', 'readonly'=>'readonly')); ?>
						<?php echo form_error('leave_to_date'); ?>
					</div>
				
					<div class="form-group col-md-4">
						<label for="leave_reason" class="bmd-label-floating">Reason <span class="required">*</span></label>
						<?php
						echo form_input(array(
							'name' => 'leave_reason',
							'value' => set_value('leave_reason'),
							'id' => 'leave_reason',
							'class' => 'form-control',
							'placeholder'=>'Briefly describe leave reason',
							'maxlength' => '100'
						));
						?>
						<?php echo form_error('leave_reason'); ?>				
					</div>

					<div class="col-md-2 mt-4">
						<button type="submit" class="btn btn-primary"><i class="fa fa-fw fa-check-circle"></i> Submit</button>
					</div>
				</div>
				
				<?php echo form_close(); ?>
			</div>
		</div>		
	</div>
</div>

<div class="row my-3">
	<div class="col-md-12">
		<div class="card card-legend">			
			<div class="card-body">
			<h6 class="card-title text-on-card">Leave Details</h6>
				<div class="table-responsive">
					<div class="mb-2 d-none">
						<span class="mx-2"><i class="fa fa-square text-secondary" aria-hidden="true"></i> Pending</span>					
						<span class="mx-2"><i class="fa fa-square text-success" aria-hidden="true"></i> Approved</span>
						<span class="mx-2"><i class="fa fa-square text-warning" aria-hidden="true"></i> Cancelled</span>
						<span class="mx-2"><i class="fa fa-square text-danger" aria-hidden="true"></i> Rejected</span>
					</div>
					<table class="table table-striped">
						<thead class="thead-dark">
							<tr>
								<th scope="col">Leave Req #</th>
								<th scope="col">Leave Type</th>
								<th scope="col">From Date</th>
								<th scope="col">To Date</th>
								<th scope="col">Leave Status</th>
								<th scope="col">Reason</th>						
								<th scope="col"></th>
							</tr>
						</thead>
						<tbody>
						<?php 
						if(sizeof($data_rows)>0){
							foreach($data_rows as $row){
								?>
								<tr>
									<td><?php echo $row['leave_req_id'];?></td>
									<td><?php echo $row['leave_type'];?></td>
									<td><?php echo $this->common_lib->display_date($row['leave_from_date']);?></td>
									<td><?php echo $this->common_lib->display_date($row['leave_to_date']);?></td>
									<td>
										<!-- <span class="small"><i class="fa fa-square <?php echo $leave_status_arr[$row['leave_status']]['css'];?>" aria-hidden="true"></i></span>  -->
										<span class="<?php echo $leave_status_arr[$row['leave_status']]['css'];?>"> <?php echo $leave_status_arr[$row['leave_status']]['text'];?></span>
									</td>
									<td><?php echo isset($row['leave_reason']) ? word_limiter($row['leave_reason'], 5) : '';?></td>
									<td><a href="#" class="btn btn-outline-info">Details</a></td>
								</tr>
								<?php
							}
						}
						else{
							?>
							<tr>
								<td colspan="7"> No leave records found</td>
							</tr>
							<?php
						}
						?>
						</tbody>
					</table>
					<div class="float-right"><?php echo $pagination_link; ?></div>			
				</div><!--/.table-responsive-->
			</div><!--/.card-body-->
		</div><!--/.card-->
	</div>
</div>