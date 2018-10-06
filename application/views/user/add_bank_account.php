<?php //echo isset($breadcrumbs) ? $breadcrumbs : ''; ?>
<div class="row heading-container mb-3">
    <div class="col-12">
        <h1 class="page-header"><?php echo isset($page_heading)? $page_heading:'Page Heading'; ?></h1>
    </div>
</div><!--/.heading-container-->

<div class="row">	
    <div class="col-md-8">
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
				
				<div class="form-row">                
					<div class="form-group col-md-6">                                
						<label for="bank_id" class="">Bank <span class="required">*</span></label>
						<?php
						echo form_dropdown('bank_id', $arr_banks, set_value('bank_id'), array(
							'class' => 'form-control',
							'id' => 'bank_id'
						));
						?> 
						<?php echo form_error('bank_id'); ?>
				</div>

									
      </div>
			
			<div class="form-row">
				<div class="form-group col-md-6">                                
					<label for="bank_account_no" class="">Account Number <span class="required">*</span></label>				
					<?php
					echo form_password(array(
						'name' => 'bank_account_no',
						'value' => set_value('bank_account_no'),
						'id' => 'bank_account_no',
						'maxlength' => '15',
						'class' => 'form-control',
						'placeholder' => '',
						'autocomplete'=>'off'
					));
					?>
					<?php echo form_error('bank_account_no'); ?>
				</div>
				</div>
				<div class="form-row">
					<div class="form-group col-md-6">        							
					<label for="confirm_bank_account_no" class="">Confirm Account Number <span class="required">*</span></label>				
						<?php
						echo form_input(array(
							'name' => 'confirm_bank_account_no',
							'value' => set_value('confirm_bank_account_no'),
							'id' => 'confirm_bank_account_no',
							'maxlength' => '15',
							'class' => 'form-control',
							'placeholder' => '',
							'autocomplete'=>'off',
						));
						?>
						<?php echo form_error('confirm_bank_account_no'); ?>
				</div>
			</div>

			<div class="form-row">
					<div class="form-group col-md-6">        							
					<label for="account_type" class="">Account Type <span class="required">*</span></label>				
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
						<?php echo form_error('account_type'); ?>
				</div>
			</div>

			<div class="form-row">
					<div class="form-group col-md-6">        							
						<label for="ifsc_code" class="">IFSC Code <span class="required">*</span></label>				
							<?php
							echo form_input(array(
								'name' => 'ifsc_code',
								'value' => set_value('ifsc_code'),
								'id' => 'ifsc_code',
								'maxlength' => '12',
								'class' => 'form-control',
								'placeholder' => '',
								'autocomplete'=>'off',
							));
							?>
							<?php echo form_error('ifsc_code'); ?>
					</div>
			</div>
			
			<?php echo form_button(array('name' => 'submit_btn','type' => 'submit','content' => '<i class="fa fa-fw fa-check-circle"></i> Submit','class' => 'btn btn-primary'));?>
			<a href="<?php echo base_url($this->router->directory.$this->router->class.'/my_profile');?>" class="ml-2 btn btn-secondary"><i class="fa fa-fw fa-times-circle"></i> Cancel</a>
        <?php echo form_close(); ?>
    </div>  
</div>