<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<?php 
$row = $data_rows[0];
//print_r($row);
?>
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
				<dl class="row">
					<dt class="col-md-2">Request #</dt>
					<dd class="col-md-2"><?php echo $row['leave_req_id'];?></dd>					
					<dt class="col-md-2">Leave Status</dt>
					<dd class="col-md-2 font-weight-bold">
					<span class=""><i class="fa fa-square <?php echo $leave_status_arr[$row['leave_status']]['css'];?>" aria-hidden="true"></i></span>
					<span class="<?php echo $leave_status_arr[$row['leave_status']]['css'];?>"> <?php echo $leave_status_arr[$row['leave_status']]['text'];?></span>
					</dd>					
					<dt class="col-md-2">Leave Type</dt>
					<dd class="col-md-2"><?php echo $row['leave_type'];?></dd>
					<dt class="col-md-2">From</dt>
					<dd class="col-md-2"><?php echo $this->common_lib->display_date($row['leave_from_date']);?></dd>
					<dt class="col-md-2">To</dt>
					<dd class="col-md-2"><?php echo $this->common_lib->display_date($row['leave_to_date']);?></dd>
					<dt class="col-md-2">Days Count</dt>
					<dd class="col-md-2"><?php echo $row['leave_days'].' day(s)';?></dd>
					<dt class="col-md-2">Reason/Occasion</dt>
					<dd class="col-md-10"><?php echo isset($row['leave_reason']) ? word_limiter($row['leave_reason'], 5) : '';?></dd>
					<dt class="col-md-2">Applicant Details</dt>
					<dd class="col-md-10">
						<?php echo isset($row['user_firstname']) ? $row['user_firstname'] : '';?>
						<?php echo isset($row['user_lastname']) ? $row['user_lastname'] : '';?>
						<div><?php echo isset($row['user_email']) ? $row['user_email'] : '';?></div>
						<div>
							<?php echo isset($row['user_phone1']) ? $row['user_phone1'] : '';?>
							<?php echo isset($row['user_phone2']) ? $row['user_phone2'] : '';?>
						</div>
					</dd>
				</dl>

				
				<div class="row ci-wizard">                
					<div class="col-sm-4 ci-wizard-step complete">
						<div class="text-center ci-wizard-stepnum">
							<div>
								<?php echo isset($row['user_firstname']) ? $row['user_firstname'] : '';?>
								<?php echo isset($row['user_lastname']) ? $row['user_lastname'] : '';?>
							</div>
						</div>
						<div class="progress"><div class="progress-bar"></div></div>
						<a data-action-by="applicant" data-action-by-userid="<?php echo isset($row['user_id']) ? $row['user_id']: ''; ?>" href="#" class="ci-wizard-dot"></a>
						<div class="ci-wizard-info text-center">	
							<div class="">Applied</div>						
							<div class=""><?php echo $this->common_lib->display_date($row['leave_created_on'], true);?></div>
							<div class=""><?php echo isset($row['leave_reason']) ? $row['leave_reason'] : '';?></div>
						</div>
					</div>
					
					<?php
						$wizard_class = '';
						if($row['supervisor_approver_status']=='P' || $row['supervisor_approver_status']=='R'){
							$wizard_class = 'active';
						}
						if($row['supervisor_approver_status']=='A'){
							$wizard_class = 'complete';
						}
					?>
					<div class="col-sm-4 ci-wizard-step <?php echo $wizard_class; ?>">
						<div class="text-center ci-wizard-stepnum">
							<?php echo isset($row['supervisor_approver_firstname']) ? $row['supervisor_approver_firstname']: ''; ?>
							<?php echo isset($row['supervisor_approver_lastname']) ? $row['supervisor_approver_lastname']: ''; ?>
						</div>
						<div class="progress"><div class="progress-bar"></div></div>
						<a data-action-by="supervisor" data-action-by-userid="<?php echo isset($row['supervisor_approver_id']) ? $row['supervisor_approver_id']: ''; ?>" href="#" class="ci-wizard-dot <?php echo $row['supervisor_approver_status'];?>"></a>
						<div class="ci-wizard-info text-center">
							<div class=""><?php echo isset($row['supervisor_approver_status']) ? '<span class="'.$leave_status_arr[$row['supervisor_approver_status']]['css'].'">'.$leave_status_arr[$row['supervisor_approver_status']]['text'].'</span>' : ''; ?></div>
							<div class=""><?php echo isset($row['supervisor_approver_datetime']) ? $this->common_lib->display_date($row['supervisor_approver_datetime'], true): ''; ?></div>
							<div class=""><?php echo isset($row['supervisor_approver_comment']) ? $row['supervisor_approver_comment']: ''; ?></div>
						</div>
					</div>
					
					<?php
						$wizard_class = '';
						if($row['director_approver_status']=='P'){
							$wizard_class = 'disabled';
						}
						if($row['supervisor_approver_status']=='A'){
							$wizard_class = 'complete';
						}
						if($row['director_approver_status']=='A'){
							$wizard_class = 'complete';
						}
					?>

					<div class="col-sm-4 ci-wizard-step <?php echo $wizard_class; ?>">
						<div class="text-center ci-wizard-stepnum">
							<?php echo isset($row['director_approver_firstname']) ? $row['director_approver_firstname']: ''; ?>
							<?php echo isset($row['director_approver_lastname']) ? $row['director_approver_lastname']: ''; ?>
						</div>
						<div class="progress"><div class="progress-bar"></div></div>
						<a data-action-by="director" data-action-by-userid="<?php echo isset($row['director_approver_id']) ? $row['director_approver_id']: ''; ?>" href="#" class="ci-wizard-dot <?php echo $row['director_approver_status'];?>" href="#" class="ci-wizard-dot <?php echo $row['director_approver_status'];?>"></a>
						<div class="ci-wizard-info text-center">
						<div class=""><?php echo isset($row['director_approver_status']) ? '<span class="'.$leave_status_arr[$row['director_approver_status']]['css'].'">'.$leave_status_arr[$row['director_approver_status']]['text'].'</span>': ''; ?></div>
						<div class=""><?php echo isset($row['director_approver_datetime']) ? $this->common_lib->display_date($row['director_approver_datetime'], true): ''; ?></div>
						<div class=""><?php echo isset($row['director_approver_comment']) ? $row['director_approver_comment']: ''; ?></div>
						</div>
					</div>			
            	</div><!--/.row .ci-wizard-->

				

				<a href="<?php echo base_url($this->router->directory.$this->router->class.'/history');?>" class="ml-2 btn btn-outline-secondary"><i class="fa fa-chevron-left"></i> Back</a>

			
	</div>
</div>



<!-- Update Leave / Leave Action -->
<div class="modal fade" id="leaveActionModal" tabindex="-1" role="dialog" aria-labelledby="leaveActionModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addDegreeTitle">Manage Leave Request <?php echo $row['leave_req_id'];?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
		<div class="form-group col-md-12" id="responseMessage_leaveActionModal"></div>
		<div class="form-group col-md-12">
		<input type="hidden" id="leave_id" name="leave_id" value="<?php echo $row['id'];?>">
		<input type="hidden" id="leave_req_id" name="leave_req_id" value="<?php echo $row['leave_req_id'];?>">
		<input type="hidden" id="action_by_approver" name="action_by_approver" value="">
		<input type="hidden" id="action_by_approver_id" name="action_by_approver_id" value="">
		<label class="bmd-label-floating">Status <span class="required">*</span></label>
			<select class="form-control" name="leave_action_status" id="leave_action_status">
				<option value="">Select Status</option>
				<option value="A">Approve</option>
				<option value="R">Reject</option>
				<option value="C">Cancel Request</option>
			</select>
		</div>
		<div class="form-group col-md-12">
			<label class="bmd-label-floating">Comments/Remarks <span class="required">*</span></label>
			<textarea class="form-control" id="leave_action_comment" name="leave_action_comment" placeholder="Please enter your comments here"></textarea>				
		</div>
		
		
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-fw fa-times-circle"></i> Close</button>
        <button type="button" id="btnManageLeave" class="btn btn-primary"><i class="fa fa-fw fa-check-circle"></i> Save changes</button>
        
      </div>
    </div>
  </div>
</div>