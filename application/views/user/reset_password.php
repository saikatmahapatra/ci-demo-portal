<div class="row justify-content-center">
	<div class="col-lg-5">
		<div class="card shadow-lg border-0 rounded-lg mt-5">
			<div class="card-header"><h3 class="font-weight-light my-4"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></h3></div>
			<div class="card-body">
				<?php echo isset($alert_message) ? $alert_message : ''; ?>
				<!-- <div class="small mb-3 text-muted">Enter your email address and we will send you an OTP to reset your password.</div> -->
				<?php echo form_open(current_url(), array('method' => 'post', 'class'=>'')); ?>
				<?php echo form_hidden('form_action', 'reset_password'); ?>
				<?php echo form_hidden('user_email', isset($_POST['user_email']) ? set_value('user_email') : $this->session->userdata('sess_forgot_password_username')); ?>
				<?php echo form_error('user_email'); ?>
					<div class="form-group">
						<label class="small mb-1" for="password_reset_key">OTP</label>
						<?php echo form_password(array( 'name' => 'password_reset_key', 'value' => set_value('password_reset_key'), 'id' => 'password_reset_key', 'placeholder' => 'Enter 6-digit email OTP', 'class' => 'form-control py-4', 'maxlength' => '6', 'autofocus' => '' )); ?>
						<?php echo form_error('password_reset_key'); ?>
					</div>
					<div class="form-group">
						<label class="small mb-1" for="user_new_password">New Password</label>
						<?php echo form_password(array( 'name' => 'user_new_password', 'value' => set_value('user_new_password'), 'id' => 'user_new_password', 'placeholder' => 'Enter a new password', 'class' => 'form-control py-4', 'maxlength' => '20', )); ?>
						<?php echo form_error('user_new_password'); ?>
					</div>
					<div class="form-group">
						<label class="small mb-1" for="confirm_user_new_password">Confirm Password</label>
						<?php echo form_password(array( 'name' => 'confirm_user_new_password', 'value' => set_value('confirm_user_new_password'), 'id' => 'confirm_user_new_password', 'placeholder' => 'Re-enter the password', 'class' => 'form-control py-4', 'maxlength' => '20', )); ?>
						<?php echo form_error('confirm_user_new_password'); ?>
					</div>
					<div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
						<a class="small" href="<?php echo base_url($this->router->class.'/forgot_password');?>">Return to forgot password</a>
						<?php echo form_button(array('name' => 'submit_btn','type' => 'submit','content' => 'Submit','class' => 'btn ci-btn-primary btn-primary'));?>
					</div>
				<?php echo form_close(); ?>
			</div>
			<div class="card-footer text-center">
				<div class="small"><a href="<?php echo base_url($this->router->class.'/login');?>">Return to login</a></div>
				<div class="small"><a href="#">Need an account? Sign up!</a></div>
			</div>
		</div>
	</div>
</div>