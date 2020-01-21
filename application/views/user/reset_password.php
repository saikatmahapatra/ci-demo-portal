<div class="row align-items-center justify-content-center no-gutters min-vh-100">
	<div class="col-8 col-md-6 col-lg-7 offset-md-1 order-md-2 mt-auto mt-md-0 pt-8 pb-4 py-md-11">
		<img src="<?php echo base_url('assets/dist/img/illustration-2.png');?>" alt="Login" class="img-fluid">
	</div>

	<div class="col-12 col-md-5 col-lg-4 order-md-1 mb-auto mb-md-0 pb-8 py-md-11">
		<h1 class="page-title mb-0 text-center"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></h1>
		<p class="mb-4 text-center text-muted">Create your new login password.</p>
		<?php echo isset($alert_message) ? $alert_message : ''; ?>
		<?php echo form_open(current_url(), array('method' => 'post', 'class'=>'mb-4')) ?>
		<?php echo form_hidden('form_action', 'reset_password'); ?>
		<?php echo form_hidden('user_email', isset($_POST['user_email']) ? set_value('user_email') : $this->session->userdata('sess_forgot_password_username')); ?>
		<?php echo form_error('user_email'); ?>
		<div class="form-group">
			<label for="password_reset_key">6-digit OTP (Received via email)</label>
			<?php echo form_password(array( 'name' => 'password_reset_key', 'value' => set_value('password_reset_key'), 'id' => 'password_reset_key', 'placeholder' => '6-digit email OTP', 'class' => 'form-control', 'maxlength' => '6', 'autofocus' => '' )); ?>
			<?php echo form_error('password_reset_key'); ?>
		</div>
		<div class="form-group">
			<label for="user_new_password" class="">New Password</label>
			<?php echo form_password(array( 'name' => 'user_new_password', 'value' => set_value('user_new_password'), 'id' => 'user_new_password', 'placeholder' => 'Enter new password', 'class' => 'form-control', 'maxlength' => '20', )); ?>
			<?php echo form_error('user_new_password'); ?>
		</div>
		<div class="form-group mb-5">
			<label for="confirm_user_new_password">Confirm Password</label>
			<?php echo form_password(array( 'name' => 'confirm_user_new_password', 'value' => set_value('confirm_user_new_password'), 'id' => 'confirm_user_new_password', 'placeholder' => 'Confirm new password', 'class' => 'form-control', 'maxlength' => '20', )); ?>
			<?php echo form_error('confirm_user_new_password'); ?>
		</div>
		<?php echo form_button(array('name' => 'submit_btn','type' => 'submit','content' => 'Submit','class' => 'btn btn-lg ci-btn-primary btn-primary btn-block'));?>	
		<?php echo form_close(); ?>

		<p class="mb-0 font-size-sm text-center text-muted">
			<a href="<?php echo base_url($this->router->class.'/forgot_password');?>">Resend email OTP</a>
		</p>
		<p class="mb-0 font-size-sm text-center text-muted">
			<a href="<?php echo base_url($this->router->class.'/login');?>">Go back to login</a>
		</p>
	</div>
</div>