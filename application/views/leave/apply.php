<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>

<h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></h1>
<p><i class="fa fa-fw fa-question-circle-o" aria-hidden="true"></i> Looking for help or information? Click <a class=""
        href="#" data-toggle="modal" id="view_leave_balance_update_details" data-target="#leaveBalanceModal">here to
        read.</a></p>

<div class="row">
    <div class="col-lg-6">
        <div class="card ci-card">
            <div class="card-header h6">Apply Leave</div>
            <!--/.card-header-->
            <div class="card-body">
                <?php echo isset($alert_message) ? $this->common_lib->display_flash_message($alert_message, $alert_message_css) : ''; ?>
                <div class="form-text mb-4 text-muted">
                    <ul>
                        <?php foreach($system_msg as $key=>$val){?>
                        <li class="<?php echo $val['css'];?>"><?php echo $val['txt'];?></li>
                        <?php } ?>

                        <li class="">
                            <span class="">Leave Balance : </span>
                            <span class="font-weight-bold mr-3">CL :
                                <?php echo isset($leave_balance[0]['cl']) ? $leave_balance[0]['cl'] : '0.0'; ?></span>
                            <span class="font-weight-bold">PL :
                                <?php echo isset($leave_balance[0]['pl']) ? $leave_balance[0]['pl'] : '0.0'; ?></span>
                            <!-- <span class="ml-3">OL : <?php echo isset($leave_balance[0]['ol']) ? $leave_balance[0]['ol'] : '0.0'; ?></span> -->
                            <!-- <span class="ml-3"><a class="" href="#" id="view_leave_balance_update_details" data-toggle="modal" data-target="#leaveBalanceModal">Click here to view balance details</a></span> -->
                        </li>
                    </ul>
                </div>


                <?php echo form_open(current_url(), array( 'method' => 'post','class'=>'ci-form','name' => '','id' => 'ci-form-leave',)); ?>
                <?php echo form_hidden('form_action', 'add'); ?>

                <div class="form-row">
                    <div class="form-group col-lg-4">
                        <label for="leave_from_date" class="required">From Date</label>
                        <?php echo form_input(array('name' => 'leave_from_date','value' => set_value('leave_from_date'),'id' => 'leave_from_date','class' => 'form-control', 'placeholder'=>'dd-mm-yyyy', 'readonly'=>'readonly')); ?>
                        <?php echo form_error('leave_from_date'); ?>
                    </div>
                    <div class="form-group col-lg-4">
                        <label for="leave_to_date" class="required">To Date</label>
                        <?php echo form_input(array('name' => 'leave_to_date','value' => set_value('leave_to_date'),'id' => 'leave_to_date','class' => 'form-control', 'placeholder'=>'dd-mm-yyyy', 'readonly'=>'readonly')); ?>
                        <?php echo form_error('leave_to_date'); ?>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-12">
                        <label for="leave_reason" class="required">Purpose of Leave</label>
                        <?php echo form_input(array('name' => 'leave_reason','value' => set_value('leave_reason'),'id' => 'leave_reason','class' => 'form-control','placeholder'=>'','maxlength' => '100'));?>
                        <?php echo form_error('leave_reason'); ?>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-12">
                        <label for="leave_type" class="required">Type of Leave</label>
                        <?php echo form_dropdown('leave_type', $leave_type_arr, set_value('leave_type'), array('class' => 'form-control')); ?>
                        <?php echo form_error('leave_type'); ?>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-12">
                        <div class="custom-control custom-checkbox my-1 mr-sm-2">
                            <?php $cb_is_checked = $this->input->post('leave_term') === 'H';
							echo form_checkbox('leave_term', 'H', $cb_is_checked, array('id' => 'trems','class' => 'custom-control-input'));
							?>
                            <label class="custom-control-label" for="trems">Apply half day leave.</label>
                        </div>
                        <?php echo form_error('leave_term'); ?>
                    </div>
                </div>

                <button type="submit" <?php echo ($system_msg_error_counter >0 ) ? 'disabled="disabled"' : '';  ?>
                    class="btn btn-primary">Submit</button>
                <a href="<?php echo base_url($this->router->directory.$this->router->class.'/history');?>"
                    class="btn btn-link">Leave History</a>
                <?php echo form_close(); ?>
            </div>
            <!--/.card-body-->
            <div class="card-footer d-none">
            </div>
            <!--/.card-footer-->
        </div>
        <!--/.card ci-card-->

    </div>
    <!--/.col-->
</div>
<!--/.row-->

<!-- Modal -->
<div class="modal fade" id="leaveBalanceModal" tabindex="-1" role="dialog" aria-labelledby="leaveBalanceModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="leaveBalanceModalLabel">Apply Leave - Help & Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <ul>
                        <li>PL, CL balance will be credited automatically as per credit cycle.</li>
                        <li>To apply half day leave click on the "Apply half day leave" checkbox. On approval 0.5 leave
                            balance will be deducted.</li>
                        <li>Self cancellation is allowed once leave request is in applied/processing status. For
                            approved leave you can request leave cancellation.</li>
                        <li>Once leave cancellaion approved by approver, debited leave balance will be credit back to
                            the leave balance.</li>
                        <li>For leave balance debit, credit related issues or information please contact to your HR.
                        </li>
                    </ul>
                    <table class="table table-sm ci-table table-bordered text-center">
                        <thead class="thead-dark">
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
                    Balance added on :
                    <?php echo isset($leave_balance[0]['created_on']) ? $this->common_lib->display_date($leave_balance[0]['created_on'],true) : '-'; ?>
                </div>
                <div class="">
                    Balance updated on :
                    <?php echo isset($leave_balance[0]['updated_on']) ? $this->common_lib->display_date($leave_balance[0]['updated_on'],true) : '-'; ?>
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