<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<?php 
$row = $data_rows[0];
//print_r($row);
?>
<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<div class="row page-title-container">
    <div class="col-sm-12">
        <h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Untitled Page'; ?></h1>
    </div>
</div><!--/.page-title-container-->

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
				<dl class="row">
					<dt class="col-md-2">Leave Status</dt>
					<dd class="col-md-4 font-weight-bold">
					<span class=""><i class="fa fa-circle-o-notch <?php echo $leave_status_arr[$row['leave_status']]['css'];?>" aria-hidden="true"></i></span>
					<span class="<?php echo $leave_status_arr[$row['leave_status']]['css'];?>"> <?php echo $leave_status_arr[$row['leave_status']]['text'];?></span>
					</dd>
					<dt class="col-md-2">Leave Request No</dt>
					<dd class="col-md-4"><?php echo $row['leave_req_id'];?></dd>
					<dt class="col-md-2">Applied On</dt>
					<dd class="col-md-4"><?php echo $this->common_lib->display_date($row['leave_created_on'], TRUE);?></dd>
					<dt class="col-md-2">Leave Type</dt>
					<dd class="col-md-4"><?php echo $leave_type_arr[$row['leave_type']];?> - <?php echo $leave_term_arr[$row['leave_term']];?></dd>
					<dt class="col-md-2">From - To</dt>
					<dd class="col-md-4"><?php echo $this->common_lib->display_date($row['leave_from_date']);?> to <?php echo $this->common_lib->display_date($row['leave_to_date']);?></dd>
					<dt class="col-md-2">Days Count</dt>
					<dd class="col-md-4"><?php echo $row['applied_for_days_count'].' day(s)';?></dd>
					
					<dt class="col-md-2">Applicant / Employee</dt>
					<dd class="col-md-10">
						<?php echo isset($row['user_firstname']) ? $row['user_firstname'] : '';?>
						<?php echo isset($row['user_lastname']) ? $row['user_lastname'] : '';?>
						<?php echo isset($row['user_emp_id']) ? '('.$row['user_emp_id'].')' : '';?>
						<?php echo isset($row['user_email']) ? '; '.$row['user_email'] : '';?>
						<?php echo isset($row['user_phone1']) ? '; '.$row['user_phone1'] : '';?>
						<?php echo isset($row['user_phone2']) ? ' / '.$row['user_phone2'] : '';?>
					</dd>
					
					<dt class="col-md-2">Leave Reason</dt>
					<dd class="col-md-10"><?php echo isset($row['leave_reason']) ? $row['leave_reason'] : '';?></dd>
					<dt class="col-md-2">Leave Balance</dt>
					<dd class="col-md-10">
						<span class="">Before apply 
						<?php echo isset($row['on_apply_cl_bal']) ? ' CL '.$row['on_apply_cl_bal'] : '' ;?>
						<?php echo isset($row['on_apply_pl_bal']) ? ' PL '.$row['on_apply_pl_bal'] : '' ;?>
						</span>

						<?php if( isset($row['debited_cl']) || isset($row['debited_pl']) ) {?>
						<span class="font-weight-bold"> | </span>
						<span class="text-danger">Debited 
						<?php echo isset($row['debited_cl']) ? ' CL '.$row['debited_cl'] : '' ;?>
						<?php echo isset($row['debited_pl']) ? ' PL '.$row['debited_pl'] : '' ;?>
						</span>
						<?php } ?>
						
						<?php if( isset($row['credited_cl']) || isset($row['credited_pl']) ) {?>
						<span class="font-weight-bold"> | </span>
						<span class="text-info">Adjusted 
						<?php echo isset($row['credited_cl']) ? ' CL '.$row['credited_cl'] : '' ;?>
						<?php echo isset($row['credited_pl']) ? ' PL '.$row['credited_pl'] : '' ;?>
						</span>
						<?php } ?>
					</dd>
				</dl>

				
				<div class="row ci-wizard">
					<div class="col-sm-4 ci-wizard-step complete">
						<div class="text-center ci-wizard-stepnum">
							<div>
								<?php echo isset($row['user_firstname']) ? $row['user_firstname'] : '';?>
								<?php echo isset($row['user_lastname']) ? $row['user_lastname'] : '';?>
								<?php echo isset($row['user_emp_id']) ? '('.$row['user_emp_id'].')' : '';?>
							</div>
						</div>
						<div class="progress"><div class="progress-bar"></div></div>
						<?php
							$set_attributes ='';	
							$edit_icon = '';						
							if($this->common_lib->get_sess_user('id') == $row['user_id']){
								$set_attributes = 'data-action-by="applicant" data-action-by-userid="'.$row['user_id'].'"';
								$edit_icon = '<i class="fa fa-edit" aria-hidden="true"></i>';
							}
							if($row['leave_status'] == 'R' || $row['leave_status'] == 'C'){
								$set_attributes ='';	
								$edit_icon = '';
							}
							
						?>
						<a <?php echo $set_attributes; ?> href="#" class="ci-wizard-dot"></a>
						<div class="ci-wizard-info text-center">	
							<label <?php echo $set_attributes; ?>><?php echo $edit_icon;?> Applied</label>		
							<div class="small"><?php echo $this->common_lib->display_date($row['leave_created_on'], true);?></div>
							<div class=""><?php echo isset($row['leave_reason']) ? $row['leave_reason'] : '';?></div>
							
							<?php
							if($row['cancel_requested'] == 'Y'){
								$set_attributes ='';	
								$edit_icon = '';
								?>
								<label><span class="text text-warning">Calcel Requested</span></label>
								<div class="small"><?php echo $this->common_lib->display_date($row['cancel_request_datetime'], true);?></div>
								<div class=""><?php echo isset($row['cancel_request_reason']) ? $row['cancel_request_reason'] : '';?></div>
								<?php
							}
							// Self Cancellation
							if($row['user_id'] == $row['cancelled_by']){
								$set_attributes ='';	
								$edit_icon = '';
								?>
								<label <?php echo $set_attributes; ?> class="">
								<?php echo $edit_icon;?>
								<?php echo isset($row['leave_status']) ? '<span class="'.$leave_status_arr[$row['leave_status']]['css'].'">'.$leave_status_arr[$row['leave_status']]['text'].'</span>' : ''; ?>
								</label>
								<div class="small"><?php echo $this->common_lib->display_date($row['cancellation_datetime'], true);?></div>
								<div class=""><?php echo isset($row['cancellation_reason']) ? $row['cancellation_reason'] : '';?></div>
								<?php
							}
							?>

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
						if(($row['leave_status']=='C') && ($row['user_id'] == $row['cancelled_by'])){
							//$wizard_class = 'disabled';
						}
					?>
					<div class="col-sm-4 ci-wizard-step <?php echo $wizard_class; ?>">
						<div class="text-center ci-wizard-stepnum">
							<?php echo isset($row['supervisor_approver_firstname']) ? $row['supervisor_approver_firstname']: ''; ?>
							<?php echo isset($row['supervisor_approver_lastname']) ? $row['supervisor_approver_lastname']: ''; ?>
							<?php echo isset($row['supervisor_approver_emp_id']) ? '('.$row['supervisor_approver_emp_id'].')': ''; ?>
						</div>
						<div class="progress"><div class="progress-bar"></div></div>
						<?php
							$set_attributes = '';
							$edit_icon = '';
							if($this->common_lib->get_sess_user('id') == $row['supervisor_approver_id']){
								$set_attributes = 'data-action-by="supervisor" data-action-by-userid="'.$row['supervisor_approver_id'].'"';
								$edit_icon = '<i class="fa fa-edit" aria-hidden="true"></i>';
							}
							if(($row['leave_status'] == 'R' || $row['leave_status'] == 'C' || $row['director_approver_status']=='A')){
								//&&  $row['cancel_requested']!='Y'
								$set_attributes ='';	
								$edit_icon = '';
							}
						?>
						<a <?php echo $set_attributes; ?> href="#" class="ci-wizard-dot <?php echo $row['supervisor_approver_status'];?>"></a>
						<div class="ci-wizard-info text-center">
							
							<label <?php echo $set_attributes; ?> class="">
							<?php echo $edit_icon;?>
							<?php echo isset($row['supervisor_approver_status']) ? '<span class="'.$leave_status_arr[$row['supervisor_approver_status']]['css'].'">'.$leave_status_arr[$row['supervisor_approver_status']]['text'].'</span>' : ''; ?>
							</label>

							<div class="small"><?php echo isset($row['supervisor_approver_datetime']) ? $this->common_lib->display_date($row['supervisor_approver_datetime'], true): ''; ?></div>
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
						if(($row['leave_status']=='C') && ($row['user_id'] == $row['cancelled_by'])){
							//$wizard_class = 'disabled';
						}
					?>

					<div class="col-sm-4 ci-wizard-step <?php echo $wizard_class; ?>">
						<div class="text-center ci-wizard-stepnum">
							<?php echo isset($row['director_approver_firstname']) ? $row['director_approver_firstname']: ''; ?>
							<?php echo isset($row['director_approver_lastname']) ? $row['director_approver_lastname']: ''; ?>
							<?php echo isset($row['director_approver_emp_id']) ? '('.$row['director_approver_emp_id'].')': ''; ?>
						</div>
						<div class="progress"><div class="progress-bar"></div></div>
						<?php
							$set_attributes ='';
							$edit_icon = '';
							if(($this->common_lib->get_sess_user('id') == $row['director_approver_id']) && ($row['supervisor_approver_status']=='A' || ( $row['leave_status'] == 'A' && $row['cancel_requested'] == 'Y' ))) {
								$edit_icon = '<i class="fa fa-edit" aria-hidden="true"></i>';
								$set_attributes = 'data-action-by="director" data-action-by-userid="'.$row['director_approver_id'].'"';
							}
							if($row['leave_status'] == 'R' || $row['leave_status'] == 'C' || ( $row['leave_status'] == 'A' && $row['cancel_requested'] == 'N' )){
								$set_attributes ='';	
								$edit_icon = '';
							}
						?>
						<a <?php echo $set_attributes; ?> href="#" class="ci-wizard-dot <?php echo $row['director_approver_status'];?>" href="#" class="ci-wizard-dot <?php echo $row['director_approver_status'];?>"></a>
						<div class="ci-wizard-info text-center">
							
							<label <?php echo $set_attributes; ?> class="">
							 <?php echo $edit_icon;?> <?php echo isset($row['director_approver_status']) ? '<span class="'.$leave_status_arr[$row['director_approver_status']]['css'].'">'.$leave_status_arr[$row['director_approver_status']]['text'].'</span>': ''; ?>
							</label>

							<div class="small"><?php echo isset($row['director_approver_datetime']) ? $this->common_lib->display_date($row['director_approver_datetime'], true): ''; ?></div>
							<div class=""><?php echo isset($row['director_approver_comment']) ? $row['director_approver_comment']: ''; ?></div>
						</div>
					</div>			
            	</div><!--/.row .ci-wizard-->

				

				<a href="<?php echo base_url($this->router->directory.$this->router->class.'/'.$this->uri->segment(5).'/'.$this->uri->segment(6));?>" class="ml-2 btn btn-outline-secondary"><i class="fa fa-chevron-left"></i> Back</a>

			
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
		<?php 
		if($row['leave_status'] == 'X'){
			?>
			<div class="alert alert-warning"><b>Note: </b> Applicant has reqested cancellation for this leave. To cancel this select "Cancel" from the status drop down.</div>
			<?php
		}
		?>
		

		<input type="hidden" id="leave_id" name="leave_id" value="<?php echo $row['id'];?>">
		<input type="hidden" id="leave_req_id" name="leave_req_id" value="<?php echo $row['leave_req_id'];?>">
		<input type="hidden" id="action_by_approver" name="action_by_approver" value="">
		<input type="hidden" id="action_by_approver_id" name="action_by_approver_id" value="">
		<label class="bmd-label-floating">Status <span class="required">*</span></label>
			<select class="form-control" name="leave_action_status" id="leave_action_status">
				<option value="">Select Status</option>
				<option value="A">Approve</option>
				<option value="R">Reject</option>
				<option value="C">Cancel</option>
			</select>
		</div>
		<div class="form-group col-md-12">
			<label class="bmd-label-floating">Comments/Remarks (Optional)</label>
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