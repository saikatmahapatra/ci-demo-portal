<div class="row justify-content-center">
	<div class="col-lg-5">
		<div class="card shadow-lg border-0 rounded-lg mt-5">
			<div class="card-header"><h3 class="font-weight-light my-4"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></h3></div>
			<div class="card-body">
				<?php echo isset($alert_message) ? $alert_message : ''; ?>
				<?php echo form_open(current_url(), array('method' => 'post', 'class'=>'')); ?>
				<?php echo form_hidden('form_action', 'login'); ?>
					<div class="form-group">
						<label class="small mb-1" for="user_email">Email</label>
						<?php echo form_input(array('name' => 'user_email', 'value' => set_value('user_email'),'id' => 'user_email','class' => 'form-control py-4','placeholder' => 'Enter email address','maxlength' => '100','autofocus' => true,));?>
						<?php echo form_error('user_email'); ?>
					</div>

					<div class="form-group">
						<label class="small mb-1" for="user_password">Password</label>
						<?php echo form_password(array('name' => 'user_password','value' => set_value('user_password'),'id' =>'user_password','placeholder' => 'Enter password','class' => 'form-control py-4','maxlength' => '16'));?>
						<?php echo form_error('user_password'); ?>
					</div>

					<div class="form-group">
						<div class="custom-control custom-checkbox">
							<input class="custom-control-input" id="rememberPasswordCheck" type="checkbox" />
							<label class="custom-control-label" for="rememberPasswordCheck">Remember password</label>
						</div>
					</div>
					<div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
						<a class="small" href="<?php echo base_url($this->router->class.'/forgot_password');?>">Forgot password?</a>
						<?php echo form_button(array('name' => 'submit_btn','type' => 'submit','content' => 'Login','class' => 'btn ci-btn-primary btn-primary'));?>
					</div>
				<?php echo form_close(); ?>
			</div>
			<div class="card-footer text-center">
				<div class="small"><a href="#">Need an account? Sign up!</a></div>
			</div>
		</div>
	</div>
</div>