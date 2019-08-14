<?php $uni = isset($user_national_identifiers) ? $user_national_identifiers[0] : ''; ?>
<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></h1>
<?php $uni = isset($user_national_identifiers) ? $user_national_identifiers[0] : ''; ?>
<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>

<div class="row">
	<div class="col-md-12">
		<div class="card ci-card">
			<div class="card-header h6">Form</div><!--/.card-header-->

			<div class="card-body">
				<?php
					// Show server side flash messages
					if (isset($alert_message)) {
						$html_alert_ui = '';
						$html_alert_ui.='<div class="auto-closable-alert alert ' . $alert_message_css . ' alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$alert_message.'</div>';
						echo $html_alert_ui;
					}
				?>

<?php echo form_open(current_url(), array('method' => 'post', 'class' => 'ci-form', 'name' => 'address_add','id' => 'address_add')); ?>
        <?php echo form_hidden('form_action', 'add'); ?>
			<h6 class="">National Identification (Govt ID)</h6>
			<div class="form-row">
				<div class="form-group col-md-3">                                
					<label for="user_pan_no" class="">PAN Number</label>
					<?php
					echo form_input(array(
						'name' => 'user_pan_no',
						'value' => isset($_POST['user_pan_no']) ? set_value('user_pan_no') : $uni['user_pan_no'],
						'id' => 'user_pan_no',
						'maxlength' => '10',
						'class' => 'form-control text-uppercase',
						'placeholder' => '',
						'autocomplete'=>'off'
					));
					?>
					<?php echo form_error('user_pan_no'); ?>
				</div>

				<div class="form-group col-md-3">        							
					<label for="user_uan_no" class="">UAN No</label>				
						<?php
						echo form_input(array(
							'name' => 'user_uan_no',
							'value' => isset($_POST['user_uan_no']) ? set_value('user_uan_no') : $uni['user_uan_no'],
							'id' => 'user_uan_no',
							'maxlength' => '12',
							'class' => 'form-control',
							'placeholder' => '',
							'autocomplete'=>'off',
						));
						?>
						<?php echo form_error('user_uan_no'); ?>
				</div>
			</div>
			<h6 class="mt-4">Bank Account Details</h6>
			<div class="form-row">
					<div class="form-group col-md-4">        							
					<label for="account_uses" class="">Account For <span class="required">*</span></label>				
					<div>
					<?php						
					if(isset($account_uses)){
						foreach($account_uses as $key=>$val){
							?>							
							<div class="custom-control custom-radio custom-control-inline">
								<?php
									$radio_is_checked = $this->input->post('account_uses') === $key;
									echo form_radio(array('name' => 'account_uses','value' => $key,'id' => $key,'checked' => $radio_is_checked,'class' => 'custom-control-input'), set_radio('account_uses', $key));
								?>
								<label class="custom-control-label" for="<?php echo $key;?>"><?php echo $val;?></span></label>
							</div>
							
							<?php
						}
					}
					?>
					</div>
					<?php echo form_error('account_uses'); ?>
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col-md-3">
					<label for="bank_id" class="">Bank Name <span class="required">*</span></label>
					<?php
					echo form_dropdown('bank_id', $arr_banks, set_value('bank_id'), array(
						'class' => 'form-control',
						'id' => 'bank_id'
					));
					?> 
					<?php echo form_error('bank_id'); ?>
				</div>
				<div class="form-group col-md-3">
					<label for="bank_account_no" class="">Account No <span class="required">*</span></label>				
					<?php
					echo form_input(array(
						'name' => 'bank_account_no',
						'value' => set_value('bank_account_no'),
						'id' => 'bank_account_no',
						'maxlength' => '16',
						'class' => 'form-control',
						'placeholder' => '',
						'autocomplete'=>'off'
					));
					?>
					<?php echo form_error('bank_account_no'); ?>
				</div>
				
					<div class="form-group col-md-3">        							
					<label for="confirm_bank_account_no" class="">Confirm Account No <span class="required">*</span></label>				
						<?php
						echo form_input(array(
							'name' => 'confirm_bank_account_no',
							'value' => set_value('confirm_bank_account_no'),
							'id' => 'confirm_bank_account_no',
							'maxlength' => '16',
							'class' => 'form-control',
							'placeholder' => '',
							'autocomplete'=>'off',
						));
						?>
						<?php echo form_error('confirm_bank_account_no'); ?>
				</div>
			
				<div class="form-group col-md-3">        							
					<label for="ifsc_code" class="">IFSC Code <span class="required">*</span></label>				
						<?php
						echo form_input(array(
							'name' => 'ifsc_code',
							'value' => set_value('ifsc_code'),
							'id' => 'ifsc_code',
							'maxlength' => '11',
							'class' => 'form-control text-uppercase',
							'placeholder' => '',
							'autocomplete'=>'off',
						));
						?>
						<?php echo form_error('ifsc_code'); ?>
				</div>
				

				<div class="form-row">
				<div class="form-group col-md-12">
					<label for="account_type" class="">Account Type <span class="required">*</span></label>
					<div>
					<?php						
					if(isset($bank_ac_type)){
						foreach($bank_ac_type as $key=>$val){
							?>							
							<div class="custom-control custom-radio custom-control-inline">
								<?php
									$radio_is_checked = $this->input->post('account_type') === $key;
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
			</div>
			<?php echo form_button(array('name' => 'submit_btn','type' => 'submit','content' => 'Submit','class' => 'btn btn-primary'));?>
			<a href="<?php echo base_url($this->router->directory.$this->router->class.'/profile');?>" class="ml-2 btn btn-secondary">Cancel</a>
        <?php echo form_close(); ?>
				
			
			</div><!--./card-body-->
			<!--<div class="card-footer"></div>--><!--/.card-footer-->
		</div><!--/.card-->
		
	</div><!--/.col-->
</div><!--/.row-->