<div class="row align-items-center justify-content-center no-gutters min-vh-100">
	<div class="card ci-card col-lg-7">
		<div class="card-body">
			<h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></h1>
			<div class="text-muted mb-2">Create your new login password</div>
			<?php echo isset($alert_message) ? $alert_message : ''; ?>
			<div class="row justify-content-center mt-4">
				<div class="col-8 col-md-5 col-lg-6 order-md-2 mt-auto mt-md-0 pt-8 pb-4 py-md-11">
					<img src="<?php echo base_url('assets/dist/img/illustration-2.png');?>" alt="Login" class="img-fluid">
				</div>
				<div class="col-12 col-md-7 col-lg-6 order-md-1 mb-auto mb-md-0 pb-8 py-md-11">
				<?php echo form_open(current_url(), array('method' => 'post', 'class'=>'mb-4')) ?>
				<?php echo form_hidden('form_action', 'reset_password'); ?>
				<?php echo form_hidden('user_email', isset($_POST['user_email']) ? set_value('user_email') : $this->session->userdata('sess_forgot_password_username')); ?>
				<?php echo form_error('user_email'); ?>
				<div class="mb-3">
					<div class="input-group">
						<div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><?php echo $this->common_lib->get_icon('otp'); ?></span></div>
						<?php echo form_password(array( 'name' => 'password_reset_key', 'value' => set_value('password_reset_key'), 'id' => 'password_reset_key', 'placeholder' => '6-digit email OTP', 'class' => 'form-control', 'maxlength' => '6', 'autofocus' => '' )); ?>
					</div>
					<?php echo form_error('password_reset_key'); ?>
				</div>

				<div class="mb-3">
					<div class="input-group">
						<div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><?php echo $this->common_lib->get_icon('password'); ?></span></div>
						<?php echo form_password(array( 'name' => 'user_new_password', 'value' => set_value('user_new_password'), 'id' => 'user_new_password', 'placeholder' => 'New password', 'class' => 'form-control', 'maxlength' => '20', )); ?>
					</div>
					<?php echo form_error('user_new_password'); ?>
				</div>


				<div class="mb-3">
					<div class="input-group">
						<div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><?php echo $this->common_lib->get_icon('password'); ?></span></div>
						<?php echo form_password(array( 'name' => 'confirm_user_new_password', 'value' => set_value('confirm_user_new_password'), 'id' => 'confirm_user_new_password', 'placeholder' => 'Confirm new password', 'class' => 'form-control', 'maxlength' => '20', )); ?>
					</div>
					<?php echo form_error('confirm_user_new_password'); ?>
				</div>
				
				<?php echo form_button(array('name' => 'submit_btn','type' => 'submit','content' => 'Submit','class' => 'btn ci-btn-primary btn-primary btn-block'));?>	
				<?php echo form_close(); ?>
					
					<p class="mb-0 text-muted"><a href="<?php echo base_url($this->router->class.'/forgot_password');?>">Resend email OTP</a></p>
					<p class="mb-0 text-muted"><a href="<?php echo base_url($this->router->class.'/login');?>">Go to login</a></p>
				</div>
			</div>

		</div>
	</div>
</div>