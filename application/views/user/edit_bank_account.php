<?php $row = $bank_details[0]; ?>
<?php $uni = isset($user_national_identifiers) ? $user_national_identifiers[0] : ''; ?>
<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></h1>

<div class="row">
    <div class="col-lg-9">
        <div class="card ci-card">
            <div class="card-body">
            <h5 class="card-title">Edit Salary Account</h5>
            <?php echo isset($alert_message) ? $alert_message : ''; ?>

                <?php echo form_open(current_url(), array('method' => 'post', 'class' => 'ci-form', 'name' => 'address_add','id' => 'address_add')); ?>
                <?php echo form_hidden('form_action', 'edit'); ?>
                <h6 class="card-subtitle mb-2 text-muted">National Identification (Govt ID)</h6>
                <div class="form-row">
                    <div class="form-group col-lg-6">
                        <label for="user_pan_no" class="optional">PAN Number</label>
                        <?php echo form_input(array('name' => 'user_pan_no','value' => isset($_POST['user_pan_no']) ? set_value('user_pan_no') : $uni['user_pan_no'],'id' => 'user_pan_no','maxlength' => '10','class' => 'form-control text-uppercase','placeholder' => '','autocomplete'=>'off'));?>
                        <?php echo form_error('user_pan_no'); ?>
                    </div>
                
                    <div class="form-group col-lg-6">
                        <label for="user_uan_no" class="optional">UAN No</label>
                        <?php echo form_input(array('name' => 'user_uan_no','value' => isset($_POST['user_uan_no']) ? set_value('user_uan_no') : $uni['user_uan_no'],'id' => 'user_uan_no','maxlength' => '12','class' => 'form-control','placeholder' => '','autocomplete'=>'off',));?>
                        <?php echo form_error('user_uan_no'); ?>
                    </div>
                </div>
                <h6 class="card-subtitle mb-2 text-muted">Bank Account Details</h6>
                <div class="form-row">
                    <div class="form-group col-lg-12">
                        <label for="bank_id" class="required">Bank</label>
                        <?php echo form_dropdown('bank_id', $arr_banks, isset($_POST['bank_id']) ? set_value('bank_id') : $row['bank_id'], array('class' => 'form-control','id' => 'bank_id'));?>
                        <?php echo form_error('bank_id'); ?>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-lg-6">
                        <label for="bank_account_no" class="required">Account No</label>
                        <?php echo form_input(array('name' => 'bank_account_no','value' => isset($_POST['bank_account_no']) ? set_value('bank_account_no') : $row['bank_account_no'],'id' => 'bank_account_no','maxlength' => '16','class' => 'form-control','placeholder' => '','autocomplete'=>'off')); ?>
                        <?php echo form_error('bank_account_no'); ?>
                    </div>
                
                    <div class="form-group col-lg-6">
                        <label for="confirm_bank_account_no" class="required">Confirm Account No</label>
                        <?php echo form_input(array('name' => 'confirm_bank_account_no','value' => isset($_POST['confirm_bank_account_no']) ? set_value('confirm_bank_account_no') : $row['bank_account_no'],'id' => 'confirm_bank_account_no','maxlength' => '16','class' => 'form-control','placeholder' => '','autocomplete'=>'off',)); ?>
                        <?php echo form_error('confirm_bank_account_no'); ?>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-lg-6">
                        <label for="ifsc_code" class="required">IFSC Code</label>
                        <?php echo form_input(array('name' => 'ifsc_code','value' => isset($_POST['ifsc_code']) ? set_value('ifsc_code') : $row['ifsc_code'],'id' => 'ifsc_code','maxlength' => '11','class' => 'form-control text-uppercase','placeholder' => '','autocomplete'=>'off',));?>
                        <?php echo form_error('ifsc_code'); ?>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-12">
                        <label for="account_type" class="required">Account Type</label>
                        <div>
						<?php						
						if(isset($bank_ac_type)){
							foreach($bank_ac_type as $key=>$val){
								?>							
								<div class="custom-control custom-radio custom-control-inline">
									<?php
										//$radio_is_checked = $this->input->post('account_type') === $key;
										$radio_is_checked = isset($_POST['account_type']) ? ($this->input->post('account_type') === $key) : ($row['account_type'] === $key);
										echo form_radio(array('name' => 'account_type','value' => $key,'id' => $key,'checked' => $radio_is_checked,'class' => 'custom-control-input'), set_radio('account_type', $key));
									?>
									<label class="custom-control-label" for="<?php echo $key;?>"><?php echo $val;?></span></label>
								</div>
								
								<?php
							}
						}
						?>
                        </div>
                        <?php echo form_error('account_type'); ?>
                    </div>
                </div>
                <?php echo form_button(array('name' => 'submit_btn','type' => 'submit','content' => 'Submit','class' => 'btn ci-btn-primary btn-primary'));?>
                <a href="<?php echo base_url($this->router->directory.$this->router->class.'/profile');?>"
                    class="btn btn-light ci-btn-cancel">Cancel</a>
                <?php echo form_close(); ?>

            </div>
            <!--./card-body-->
        </div>
        <!--/.card-->
    </div>
    <!--/.col-->
</div>
<!--/.row-->