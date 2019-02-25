<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<div class="row heading-container">
    <div class="col-12">
        <h1 class="h4 mb-3 font-weight-normal"><?php echo isset($page_heading)? $page_heading:'Page Heading'; ?></h1>
    </div>
</div><!--/.heading-container-->

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
	</div>	
</div>

<div class="row">
	<div class="col-md-12">
		
		<small class="form-text text-muted bg-light py-1 mb-3">
			<ul>
				<div class="font-weight-bold mb-2">Instructions:</div>
			<?php
				foreach($system_msg as $key=>$val){
					?>
					<li class="<?php echo $val['css'];?>"><?php echo $val['txt'];?></li>
					<?php
				}
			?>
				<li>PL, CL balance will be credited automatically as per credit cycle.</li>
				<li>Self cancellation is allowed once leave request is in applied/processing status. For approved leave you can request leave cancellation.</li>
				<li>Once leave cancellaion approved by approver, debited leave balance will be credit back to the leave balance.</li>
				<li>For leave balance debit, credit related issues or information please contact to your HR.</li>
				<li class="text-info font-weight-bold">
					<span class="">Your Leave Balance : </span>
					<span class="mx-3">Casual Leave (CL) : <?php echo isset($leave_balance[0]['cl']) ? $leave_balance[0]['cl'] : '0.0'; ?></span>
					<span class="ml-3">Privileged Leave (PL) : <?php echo isset($leave_balance[0]['pl']) ? $leave_balance[0]['pl'] : '0.0'; ?></span>
					<!-- <span class="ml-3">Optional Leave (OL) : <?php echo isset($leave_balance[0]['ol']) ? $leave_balance[0]['ol'] : '0.0'; ?></span> -->
					<span class="ml-3"><a class="" href="#" id="view_leave_balance_update_details" data-toggle="modal" data-target="#leaveBalanceModal">Click here to view balance details</a></span>
				</li>
			</ul>
		</small>
		
		<!-- <a class="" href="#" id="view_leave_balance_update_details" data-toggle="modal" data-target="#leaveBalanceModal">Click here to view balance details</a>
		<div class="row mb-3">
			<div class="col-md-3 font-weight-bold">Leave Balance</div>
			<div class="col-md-4">Casual Leave (CL) : <?php echo isset($leave_balance[0]['cl']) ? $leave_balance[0]['cl'] : '0.0'; ?></div>
			<div class="col-md-4">Privileged Leave (PL) : <?php echo isset($leave_balance[0]['pl']) ? $leave_balance[0]['pl'] : '0.0'; ?></div>
			<div class="col-md-3">Optional Leave (OL) : <?php echo isset($leave_balance[0]['ol']) ? $leave_balance[0]['ol'] : '0.0'; ?></div>
		</div> -->
		
		

		<?php echo form_open(current_url(), array( 'method' => 'post','class'=>'ci-form','name' => '','id' => 'ci-form-leave',)); ?>
		<?php echo form_hidden('form_action', 'add'); ?>
		<div class="form-row">
			<div class="form-group col-md-3">
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
		
			<div class="form-group col-md-5">
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
		</div>
		
		<button type="submit" <?php echo ($system_msg_error_counter >0 ) ? 'disabled="disabled"' : '';  ?> class="btn btn-primary"><i class="fa fa-fw fa-check-circle"></i> Submit</button>
		<?php echo form_close(); ?>
	</div>
</div>







	<!-- Modal -->
<div class="modal fade" id="leaveBalanceModal" tabindex="-1" role="dialog" aria-labelledby="leaveBalanceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="leaveBalanceModalLabel">Leave Balance Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
				<div class="table-responsive">
					<table class="table table-sm ci-table table-bordered text-center">
						<thead class="thead-light">
						<tr>
							<th scope="col">Casual Leave (CL)</th>
							<th scope="col">Privileged Leave (PL)</th>
							<!-- <th scope="col">Optional Leave (OL)</th> -->
						</tr>
						</thead>
						<tbody>
							<tr>
								<td><?php echo isset($leave_balance[0]['cl']) ? $leave_balance[0]['cl'] : '0.0'; ?></td>
								<td><?php echo isset($leave_balance[0]['pl']) ? $leave_balance[0]['pl'] : '0.0'; ?></td>
								<!-- <td><?php echo isset($leave_balance[0]['ol']) ? $leave_balance[0]['ol'] : '0.0'; ?></td> -->
							</tr>
						</tbody>
					</table>
				</div>
				<div class="">
					Balance added on : <?php echo isset($leave_balance[0]['created_on']) ? $this->common_lib->display_date($leave_balance[0]['created_on'],true) : '-'; ?>
				</div>
				<div class="">
					Balance updated on : <?php echo isset($leave_balance[0]['updated_on']) ? $this->common_lib->display_date($leave_balance[0]['updated_on'],true) : '-'; ?>
				</div>
				<div>
					CL auto credited on : 
					<?php echo isset($leave_balance[0]['cl_updated_by_cron_on']) ? $this->common_lib->display_date($leave_balance[0]['cl_updated_by_cron_on'],true) : '-'; ?>
				</div>
				<div>
					PL auto credited on : 
					<?php echo isset($leave_balance[0]['pl_updated_by_cron_on']) ? $this->common_lib->display_date($leave_balance[0]['pl_updated_by_cron_on'],true) : '-'; ?>
				</div>
				<!-- <div>
					OL auto credited on : 
					<?php echo isset($leave_balance[0]['ol_updated_by_cron_on']) ? $this->common_lib->display_date($leave_balance[0]['ol_updated_by_cron_on'],true) : '-'; ?>
				</div> -->
            </div>
            <div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>