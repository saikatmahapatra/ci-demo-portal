<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<?php 
$row = $data_rows[0];
//print_r($row);
?>
<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></h1>

<div class="row">
    <div class="col-md-12 ci-dl">
        <div class="card ">
            <div class="card-header"><?php echo $this->common_lib->get_icon('card'); ?> Leave Details # <?php echo $row['leave_req_id'];?></div>
            <div class="card-body">
            <?php echo isset($alert_message) ? $alert_message : ''; ?>
                <dl class="row">
                    <dt class="col-md-2">Application No</dt>
                    <dd class="col-md-10"><?php echo $row['leave_req_id'];?></dd>
                    <dt class="col-md-2">Status</dt>
                    <dd class="col-md-10">
                        <span class="<?php echo $leave_status_arr[$row['leave_status']]['badge_css'];?>"><?php echo $leave_status_arr[$row['leave_status']]['text'];?></span>
                    </dd>
                    <dt class="col-md-2">Applied on</dt>
                    <dd class="col-md-10">
                        <?php echo $this->common_lib->display_date($row['leave_created_on'], TRUE, NULL);?>
                    </dd>
                    <dt class="col-md-2">Type of Leave</dt>
                    <dd class="col-md-10"><?php echo $leave_type_arr[$row['leave_type']];?> -
                        <?php echo $leave_term_arr[$row['leave_term']];?></dd>
                    <dt class="col-md-2">From - To</dt>
                    <dd class="col-md-10">
                        <?php echo $this->common_lib->display_date($row['leave_from_date'], NULL, NULL);?> to
                        <?php echo $this->common_lib->display_date($row['leave_to_date'], NULL, NULL);?></dd>
                    <dt class="col-md-2">No of day(s)</dt>
                    <dd class="col-md-10"><?php echo $row['applied_for_days_count'];?></dd>

                    <dt class="col-md-2">Applied by</dt>
                    <dd class="col-md-10">
                        <?php echo isset($row['user_firstname']) ? $row['user_firstname'] : '';?>
                        <?php echo isset($row['user_lastname']) ? $row['user_lastname'] : '';?>
                        <?php echo isset($row['user_emp_id']) ? '('.$row['user_emp_id'].')' : '';?>
                        <?php echo isset($row['user_email']) ? '; '.$row['user_email'] : '';?>
                        <?php echo isset($row['user_phone1']) ? '; '.$row['user_phone1'] : '';?>
                        <?php echo isset($row['user_phone2']) ? ' / '.$row['user_phone2'] : '';?>
                    </dd>

                    <dt class="col-md-2">Reason</dt>
                    <dd class="col-md-10"><?php echo isset($row['leave_reason']) ? $row['leave_reason'] : '';?></dd>
                    <dt class="col-md-2">Leave Balance</dt>
                    <dd class="col-md-10">
                        <span class="">Before apply
                            <?php echo isset($row['on_apply_cl_bal']) ? ' CL '.$row['on_apply_cl_bal'] : '' ;?>
                            <?php echo isset($row['on_apply_pl_bal']) ? ' PL '.$row['on_apply_pl_bal'] : '' ;?>
                            <?php echo isset($row['on_apply_sl_bal']) ? ' SL '.$row['on_apply_sl_bal'] : '' ;?>
                        </span>

                        <?php if( isset($row['debited_cl']) || isset($row['debited_pl']) || isset($row['debited_sl'])) {?>
                        <span class="font-weight-bold"> | </span>
                        <span class="text-danger">Debited
                            <?php echo isset($row['debited_cl']) ? ' CL '.$row['debited_cl'] : '' ;?>
                            <?php echo isset($row['debited_pl']) ? ' PL '.$row['debited_pl'] : '' ;?>
                            <?php echo isset($row['debited_sl']) ? ' SL '.$row['debited_sl'] : '' ;?>
                        </span>
                        <?php } ?>

                        <?php if( isset($row['credited_cl']) || isset($row['credited_pl']) || isset($row['credited_sl'])) {?>
                        <span class="font-weight-bold"> | </span>
                        <span class="text-info">Adjusted
                            <?php echo isset($row['credited_cl']) ? ' CL '.$row['credited_cl'] : '' ;?>
                            <?php echo isset($row['credited_pl']) ? ' PL '.$row['credited_pl'] : '' ;?>
                            <?php echo isset($row['credited_sl']) ? ' SL '.$row['credited_sl'] : '' ;?>
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
                        <div class="progress">
                            <div class="progress-bar"></div>
                        </div>
                        <?php
							$set_attributes ='';	
							$edit_icon = '';						
							if($this->common_lib->get_sess_user('id') == $row['user_id']){
								$set_attributes = 'data-action-by="applicant" data-action-by-userid="'.$row['user_id'].'"';
								$edit_icon = $this->common_lib->get_icon('edit');
							}
							if($row['leave_status'] == 'R' || $row['leave_status'] == 'C'){
								$set_attributes ='';	
								$edit_icon = '';
							}
							
						?>
                        <a <?php echo $set_attributes; ?> href="#" class="ci-wizard-dot"></a>
                        <div class="ci-wizard-info text-center">
                            <label <?php echo $set_attributes; ?>><?php echo $edit_icon;?> Applied</label>
                            <div class="small">
                                <?php echo $this->common_lib->display_date($row['leave_created_on'], true);?>
                            </div>
                            <div class=""><?php echo isset($row['leave_reason']) ? $row['leave_reason'] : '';?></div>

                            <?php
							if($row['cancel_requested'] == 'Y'){
								$set_attributes ='';	
								$edit_icon = '';
								?>
                            <label><span class="text text-warning">Calcel Requested</span></label>
                            <div class="small">
                                <?php echo $this->common_lib->display_date($row['cancel_request_datetime'], true);?>
                            </div>
                            <div class="">
                                <?php echo isset($row['cancel_request_reason']) ? $row['cancel_request_reason'] : '';?>
                            </div>
                            <?php
							}
							// Self Cancellation
							if($row['user_id'] == $row['cancelled_by']){
								$set_attributes ='';	
								$edit_icon = '';
								?>
                            <label <?php echo $set_attributes; ?> class="">
                                <?php echo $edit_icon;?>
                                <?php echo isset($row['leave_status']) ? '<span class="">'.$leave_status_arr[$row['leave_status']]['text'].'</span>' : ''; ?>
                            </label>
                            <div class="small">
                                <?php echo $this->common_lib->display_date($row['cancellation_datetime'], true);?></div>
                            <div class="">
                                <?php echo isset($row['cancellation_reason']) ? $row['cancellation_reason'] : '';?>
                            </div>
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
                        <div class="progress">
                            <div class="progress-bar"></div>
                        </div>
                        <?php
							$set_attributes = '';
							$edit_icon = '';
							if($this->common_lib->get_sess_user('id') == $row['supervisor_approver_id']){
								$set_attributes = 'data-action-by="supervisor" data-action-by-userid="'.$row['supervisor_approver_id'].'"';
								$edit_icon = $this->common_lib->get_icon('edit');
							}
							if(($row['leave_status'] == 'R' || $row['leave_status'] == 'C' || $row['director_approver_status']=='A')){
								//&&  $row['cancel_requested']!='Y'
								$set_attributes ='';	
								$edit_icon = '';
							}
						?>
                        <a <?php echo $set_attributes; ?> href="#"
                            class="ci-wizard-dot <?php echo $row['supervisor_approver_status'];?>"></a>
                        <div class="ci-wizard-info text-center">

                            <label <?php echo $set_attributes; ?> class="">
                                <?php echo $edit_icon;?>
                                <?php echo isset($row['supervisor_approver_status']) ? '<span class="">'.$leave_status_arr[$row['supervisor_approver_status']]['text'].'</span>' : ''; ?>
                            </label>

                            <div class="small">
                                <?php echo isset($row['supervisor_approver_datetime']) ? $this->common_lib->display_date($row['supervisor_approver_datetime'], true): ''; ?>
                            </div>
                            <div class="">
                                <?php echo isset($row['supervisor_approver_comment']) ? $row['supervisor_approver_comment']: ''; ?>
                            </div>
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
                        <div class="progress">
                            <div class="progress-bar"></div>
                        </div>
                        <?php
							$set_attributes ='';
							$edit_icon = '';
							if(($this->common_lib->get_sess_user('id') == $row['director_approver_id']) && ($row['supervisor_approver_status']=='A' || ( $row['leave_status'] == 'A' && $row['cancel_requested'] == 'Y' ))) {
								$edit_icon = $this->common_lib->get_icon('edit');
								$set_attributes = 'data-action-by="director" data-action-by-userid="'.$row['director_approver_id'].'"';
							}
							if($row['leave_status'] == 'R' || $row['leave_status'] == 'C' || ( $row['leave_status'] == 'A' && $row['cancel_requested'] == 'N' )){
								$set_attributes ='';	
								$edit_icon = '';
							}
						?>
                        <a <?php echo $set_attributes; ?> href="#"
                            class="ci-wizard-dot <?php echo $row['director_approver_status'];?>" href="#"
                            class="ci-wizard-dot <?php echo $row['director_approver_status'];?>"></a>
                        <div class="ci-wizard-info text-center">

                            <label <?php echo $set_attributes; ?> class="">
                                <?php echo $edit_icon;?>
                                <?php echo isset($row['director_approver_status']) ? '<span class="">'.$leave_status_arr[$row['director_approver_status']]['text'].'</span>': ''; ?>
                            </label>

                            <div class="small">
                                <?php echo isset($row['director_approver_datetime']) ? $this->common_lib->display_date($row['director_approver_datetime'], true): ''; ?>
                            </div>
                            <div class="">
                                <?php echo isset($row['director_approver_comment']) ? $row['director_approver_comment']: ''; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/.row .ci-wizard-->
                <a href="<?php echo base_url($this->router->directory.$this->router->class.'/'.$this->uri->segment(5));?>"
                    class="btn-back btn btn-link action-link"><?php echo $this->common_lib->get_icon('left_back'); ?>Back</a>
            </div>
        </div>
        <!--/.card-body-->
    </div>
    <!--/.card -->
    <!--/.col-->
</div>
<!--/.row-->

<!-- Update Leave / Leave Action -->
<div class="modal fade" id="leaveActionModal" tabindex="-1" role="dialog" aria-labelledby="leaveActionModal"
    aria-hidden="true">
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
                    <div class="alert alert-warning"><b>Note: </b> Applicant has reqested cancellation for this leave.
                        To cancel this select "Cancel" from the status drop down.</div>
                    <?php
		}
		?>


                    <input type="hidden" id="leave_id" name="leave_id" value="<?php echo $row['id'];?>">
                    <input type="hidden" id="leave_req_id" name="leave_req_id"
                        value="<?php echo $row['leave_req_id'];?>">
                    <input type="hidden" id="action_by_approver" name="action_by_approver" value="">
                    <input type="hidden" id="action_by_approver_id" name="action_by_approver_id" value="">
                    <label class="required">Status</label>
                    <select class="form-control" name="leave_action_status" id="leave_action_status">
                        <option value="">Select Status</option>
                        <option value="A">Approve</option>
                        <option value="R">Reject</option>
                        <option value="C">Cancel</option>
                    </select>
                </div>
                <div class="form-group col-md-12">
                    <label class="">Comments/Remarks </label>
                    <textarea class="form-control" id="leave_action_comment" name="leave_action_comment"
                        placeholder="Please enter your comments here"></textarea>
                </div>



            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="btnManageLeave" class="btn btn-primary">Save changes</button>

            </div>
        </div>
    </div>
</div>