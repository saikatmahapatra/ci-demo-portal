<div class="row justify-content-center">
	<div class="col-12 col-sm-8 col-md-4">	
		<div class="text-center">
			<img class="pb-3 logo-2x" src="<?php echo base_url('assets/src/img/logo-dark.png');?>">
			<!-- <h6><?php echo $this->config->item('app_company_product');?></h6> -->
			<h1 class="h3 mb-3 font-weight-normal"><?php echo isset($page_heading)? $page_heading:'Page Heading'; ?></h1>
		</div>	
		
		
		<?php echo form_open(current_url(), array('method' => 'post', 'class'=>'form-signin')) ?>
		<?php
			// Show server side flash messages
			if (isset($alert_message)) {
				$html_alert_ui = '';
				$html_alert_ui.='<div class="auto-closable-alert alert ' . $alert_message_css . ' alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$alert_message.'</div>';
				echo $html_alert_ui;
			}
		?>
		<?php echo form_hidden('form_action', 'reset_password'); ?>
		<?php //echo form_hidden('password_reset_key', $password_reset_key); ?>
		
			<div class="form-group">
				<label for="user_email" class="">Email <span class="required">*</span></label>				
				<!-- <div class="input-group">
					<div class="input-group-prepend"><div class="input-group-text"><i class="fa fa-envelope" aria-hidden="true"></i></div></div> -->
					<?php
					echo form_input(array(
						'name' => 'user_email',
						'value' => isset($_POST['user_email']) ? set_value('user_email') : $this->session->userdata('sess_forgot_password_username'),
						'id' => 'user_email',
						'class' => 'form-control',
						'placeholder' => 'Please enter your registered email',
						'maxlength' => '255'
					));
					?>
				<!-- </div>  -->
				<?php echo form_error('user_email'); ?>
			</div>
			
			<div class="form-group">
				<label for="password_reset_key" class="">OTP received by Email <span class="required">*</span></label>
				<!-- <div class="input-group">
					<div class="input-group-prepend"><div class="input-group-text"><i class="fa fa-lock" aria-hidden="true"></i></div></div> -->
					<?php
					echo form_password(array(
						'name' => 'password_reset_key',
						'value' => set_value('password_reset_key'),
						'id' => 'password_reset_key',
						'placeholder' => '6-digit OTP',
						'class' => 'form-control',
						'maxlength' => '6',
						'autofocus' => ''
					));
					?>
				<!-- </div>  -->
				<?php echo form_error('password_reset_key'); ?>
			</div>

			<div class="form-group">
				<label for="user_new_password" class="">New Password <span class="required">*</span></label>
				<!-- <div class="input-group">
					<div class="input-group-prepend"><div class="input-group-text"><i class="fa fa-lock" aria-hidden="true"></i></div></div> -->
					<?php
					echo form_password(array(
						'name' => 'user_new_password',
						'value' => set_value('user_new_password'),
						'id' => 'user_new_password',
						'placeholder' => 'Create a new password',
						'class' => 'form-control',
						'maxlength' => '16',
					));
					?>
				<!-- </div>  -->
				<?php echo form_error('user_new_password'); ?>
			</div>

			<div class="form-group">            
				<label for="confirm_user_new_password" class="">Confirm New Password <span class="required">*</span></label>
				<!-- <div class="input-group">
					<div class="input-group-prepend"><div class="input-group-text"><i class="fa fa-lock" aria-hidden="true"></i></div></div> -->
					<?php
					echo form_password(array(
						'name' => 'confirm_user_new_password',
						'value' => set_value('confirm_user_new_password'),
						'id' => 'confirm_user_new_password',
						'placeholder' => 'Confirm password',
						'class' => 'form-control',
						'maxlength' => '16',
					));
					?>
				<!-- </div>        -->
				<?php echo form_error('confirm_user_new_password'); ?>
			</div>
			<?php echo form_button(array('name' => 'submit_btn','type' => 'submit','content' => '<i class="fa fa-fw fa-check-circle"></i> Submit','class' => 'btn btn-lg btn-primary btn-block'));?>	
			<?php form_close(); ?>
				
			<div class="mt-3">
				<a class="d-block" href="<?php echo base_url($this->router->directory.$this->router->class.'/login');?>">Back to login</a>
				<a class="d-block" href="<?php echo base_url($this->router->directory.$this->router->class.'/forgot_password');?>" class="">Resend Email OTP</a>
			</div>
		</div>
	</div>