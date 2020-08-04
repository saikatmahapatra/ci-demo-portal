<div class="row justify-content-center">
	<div class="col-lg-5">
		<div class="card shadow-lg border-0 rounded-lg mt-5">
			<div class="card-header"><h3 class="font-weight-light my-4"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></h3></div>
			<div class="card-body">
				<?php echo isset($alert_message) ? $alert_message : ''; ?>
				<div class="small mb-3 text-muted">Enter your email address and we will send you an OTP to reset your password.</div>
				<?php echo form_open(current_url(), array('method' => 'post', 'class'=>'')); ?>
				<?php echo form_hidden('form_action', 'forgot_password'); ?>
					<div class="form-group">
						<label class="small mb-1" for="user_email">Email</label>
						<?php echo form_input(array('name' => 'user_email', 'value' => set_value('user_email'),'id' => 'user_email','class' => 'form-control py-4','placeholder' => 'Enter email address','maxlength' => '100','autofocus' => true,));?>
						<?php echo form_error('user_email'); ?>
					</div>
					<div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
						<a class="small" href="<?php echo base_url($this->router->class.'/login');?>">Return to login</a>
						<?php echo form_button(array('name' => 'submit_btn','type' => 'submit','content' => 'Reset Password','class' => 'btn ci-btn-primary btn-primary'));?>
					</div>
				<?php echo form_close(); ?>
			</div>
			<div class="card-footer text-center">
				<div class="small"><a href="#">Need an account? Sign up!</a></div>
			</div>
		</div>
	</div>
</div>