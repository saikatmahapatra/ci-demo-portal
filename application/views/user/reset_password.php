<div class="card card-login mx-auto">
<div class="card-header"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></div>
<div class="card-body text-center">
	<div class="mb-2"><?php echo isset($alert_message) ? $alert_message : ''; ?></div>
	<a href="<?php echo base_url();?>"><img class="mb-1" src="<?php echo base_url('assets/dist/img/logo-nav.png');?>" alt="Logo" width="100"></a>
	<h4 class="text-center">Create New Password</h4>
	<?php echo form_open(current_url(), array('method' => 'post', 'class'=>'form-signin mt-3')); ?>
	<?php echo form_hidden('form_action', 'reset_password'); ?>
	<?php echo form_hidden('user_email', isset($_POST['user_email']) ? set_value('user_email') : $this->session->userdata('sess_forgot_password_username')); ?>
	
	<?php echo form_error('user_email'); ?>
	<div class="form-group">
	<label class="sr-only" for="password_reset_key">OTP</label>
	<?php echo form_password(array( 'name' => 'password_reset_key', 'value' => set_value('password_reset_key'), 'id' => 'password_reset_key', 'placeholder' => 'Enter 6-digit email OTP', 'class' => 'form-control', 'maxlength' => '6', 'autofocus' => '' )); ?>
	<?php echo form_error('password_reset_key'); ?>
	</div>
	<div class="form-group">
		<label class="sr-only" for="user_new_password">New Password</label>
		<?php echo form_password(array( 'name' => 'user_new_password', 'value' => set_value('user_new_password'), 'id' => 'user_new_password', 'placeholder' => 'Enter a new password', 'class' => 'form-control', 'maxlength' => '20', )); ?>
		<?php echo form_error('user_new_password'); ?>
	</div>
	<div class="form-group">
		<label class="sr-only" for="confirm_user_new_password">Confirm Password</label>
		<?php echo form_password(array( 'name' => 'confirm_user_new_password', 'value' => set_value('confirm_user_new_password'), 'id' => 'confirm_user_new_password', 'placeholder' => 'Re-enter password', 'class' => 'form-control', 'maxlength' => '20', )); ?>
		<?php echo form_error('confirm_user_new_password'); ?>
	</div>
	
	<?php echo form_button(array('name' => 'submit_btn','type' => 'submit','content' => 'Submit','class' => 'btn ci-btn-primary btn-primary btn-block btn-lg mb-2'));?>
	<div class="">
	<a class="" href="<?php echo base_url($this->router->class.'/login');?>">Return to login</a> <br>
	<a class="" href="<?php echo base_url($this->router->class.'/forgot_password');?>">Return to forgot password</a>
	</div>
	<?php echo form_close(); ?>
</div>
</div>