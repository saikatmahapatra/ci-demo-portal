<div class="row">
	<div class="col">
		<div class="card ci-card card-login mx-auto">
			<div class="card-body mt-4 mb-2">
				<div class="text-center mb-5">
					<img class="logo-login" src="<?php echo base_url('assets/dist/img/logo-dark.png');?>">
					<h1 class="mt-2 h4 font-weight-light"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></h1>
				</div>
				<?php echo isset($alert_message) ? $alert_message : ''; ?>
				<?php echo form_open(current_url(), array('method' => 'post', 'class'=>'')); ?>
					<?php echo form_hidden('form_action', 'login'); ?>
					<div class="form-group">
						<!-- <label for="user_email">Username or Email</label> -->
						<?php echo form_input(array('name' => 'user_email', 'value' => set_value('user_email'),'id' => 'user_email','class' => 'form-control','placeholder' => 'Username','maxlength' => '100','autofocus' => true,));?>
						<?php echo form_error('user_email'); ?>
					</div>
					<div class="form-group">
						<!-- <label for="user_email">Password</label> -->
						<?php echo form_password(array('name' => 'user_password','value' => set_value('user_password'),'id' =>'user_password','placeholder' => 'Password','class' => 'form-control','maxlength' => '16'));?>
						<?php echo form_error('user_password'); ?>
					</div>
					<?php echo form_button(array('name' => 'submit_btn','type' => 'submit','content' => 'Sign In','class' => 'btn ci-btn-primary btn-primary btn-block'));?>
					<?php echo form_close(); ?>
					<p class="my-2 text-center"><a href="<?php echo base_url($this->router->class.'/forgot_password');?>">Forgot password?</a></p>
			</div>
		</div>
	</div>
</div>