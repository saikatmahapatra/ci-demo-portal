<div class="row">
	<div class="col">
		<div class="card ci-card card-login mx-auto">
			<div class="card-body mt-4 mb-2">
				<div class="text-center mb-5">
					<img class="logo-login" src="<?php echo base_url('assets/dist/img/logo-dark.png');?>">
					<h1 class="mt-2 h4 font-weight-light"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></h1>
					<!-- <div class="text-muted mt-2"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></div> -->
				</div>
				<?php echo isset($alert_message) ? $alert_message : ''; ?>

				<?php echo form_open(current_url(), array('method' => 'post', 'class'=>'')) ?>
				<?php echo form_hidden('form_action', 'reset_password'); ?>
				<?php echo form_hidden('user_email', isset($_POST['user_email']) ? set_value('user_email') : $this->session->userdata('sess_forgot_password_username')); ?>
				<?php echo form_error('user_email'); ?>
				<div class="form-group">
					<!-- <div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><?php echo $this->common_lib->get_icon('otp'); ?></span></div> -->
					<?php echo form_password(array( 'name' => 'password_reset_key', 'value' => set_value('password_reset_key'), 'id' => 'password_reset_key', 'placeholder' => '6-digit email OTP', 'class' => 'form-control', 'maxlength' => '6', 'autofocus' => '' )); ?>
					<?php echo form_error('password_reset_key'); ?>
				</div>
				<div class="form-group">
					<!-- <div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><?php echo $this->common_lib->get_icon('password'); ?></span></div> -->
					<?php echo form_password(array( 'name' => 'user_new_password', 'value' => set_value('user_new_password'), 'id' => 'user_new_password', 'placeholder' => 'New password', 'class' => 'form-control', 'maxlength' => '20', )); ?>
					<?php echo form_error('user_new_password'); ?>
				</div>
				<div class="form-group">
					<!-- <div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><?php echo $this->common_lib->get_icon('password'); ?></span></div> -->
					<?php echo form_password(array( 'name' => 'confirm_user_new_password', 'value' => set_value('confirm_user_new_password'), 'id' => 'confirm_user_new_password', 'placeholder' => 'Confirm new password', 'class' => 'form-control', 'maxlength' => '20', )); ?>
					<?php echo form_error('confirm_user_new_password'); ?>
				</div>
				
				<?php echo form_button(array('name' => 'submit_btn','type' => 'submit','content' => 'Submit','class' => 'btn ci-btn-primary btn-primary btn-block'));?>	
				<?php echo form_close(); ?>

				<p class="mb-0 mt-2 text-center"><a href="<?php echo base_url($this->router->class.'/forgot_password');?>">Resend email OTP</a></p>

				<p class="my-0 text-center"><a href="<?php echo base_url($this->router->class.'/login');?>">Go to login</a></p>
			</div>
		</div>
	</div>
</div>