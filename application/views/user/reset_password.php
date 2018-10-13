<div class="row justify-content-center">
	<div class="col-12 col-sm-8 col-md-4">		
		<div class="card">
			<div class="card-header text-center bg-primary text-white">				
				<img class="mb-1" style="width:180px;" src="<?php echo base_url('assets/src/img/logo.png');?>">
				<!-- <h6><?php echo $this->config->item('app_company_product');?></h6> -->
				<h5 class=""><?php echo isset($page_heading)? $page_heading:'Page Heading'; ?></h5>
			</div>
			<div class="card-body">
				<?php
					// Show server side flash messages
					if (isset($alert_message)) {
						$html_alert_ui = '';                
						$html_alert_ui.='<div class="auto-closable-alert alert ' . $alert_message_css . ' alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$alert_message.'</div>';
						echo $html_alert_ui;
					}
				?>
				<?php echo form_open(current_url(), array('method' => 'post', 'class'=>'ci-form')) ?>
				<?php echo form_hidden('form_action', 'reset_password'); ?>
				<?php echo form_hidden('password_reset_key', $password_reset_key); ?>
				
					<div class="form-group">                    
						<label for="user_email" class="">Registered Email <span class="required">*</span></label>
						<?php
						echo form_input(array(
							'name' => 'user_email',
							'value' => set_value('user_email'),
							'id' => 'name',
							'class' => 'form-control',
							'placeholder' => '',
							'maxlength' => '255',
							'autofocus' => '',
						));
						?>         
						<?php echo form_error('user_email'); ?>
					</div>


					<div class="form-group">            
						<label for="user_new_password" class="">New Password <span class="required">*</span></label>
						<?php
						echo form_password(array(
							'name' => 'user_new_password',
							'value' => set_value('user_new_password'),
							'id' => 'user_new_password',
							'placeholder' => '',
							'class' => 'form-control',
							'maxlength' => '16',
						));
						?>        
						<?php echo form_error('user_new_password'); ?>
					</div>

					<div class="form-group">            
						<label for="confirm_user_new_password" class="">Confirm New Password <span class="required">*</span></label>
						<?php
						echo form_password(array(
							'name' => 'confirm_user_new_password',
							'value' => set_value('confirm_user_new_password'),
							'id' => 'confirm_user_new_password',
							'placeholder' => '',
							'class' => 'form-control',
							'maxlength' => '16',
						));
						?>        
						<?php echo form_error('confirm_user_new_password'); ?>
					</div>
					<?php echo form_button(array('name' => 'submit_btn','type' => 'submit','content' => '<i class="fa fa-fw fa-check-circle"></i> Submit','class' => 'btn btn-primary btn-block'));?>	
					<?php form_close(); ?>
						
					<div class="mt-3">
						<a class="d-block" href="<?php echo base_url($this->router->directory.$this->router->class.'/login');?>">Back to login</a>
						<a class="d-block" href="<?php echo base_url($this->router->directory.$this->router->class.'/forgot_password');?>" class="">Resend password reset link</a>
					</div>

				</div>
			</div>
		</div>
	</div>