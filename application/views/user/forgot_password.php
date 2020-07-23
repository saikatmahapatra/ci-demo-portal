<div class="row">
	<div class="col">
		<div class="card ci-card card-login mx-auto">
			<div class="card-body mt-4 mb-2">
				<div class="text-center mb-5">
					<img class="logo-login" src="<?php echo base_url('assets/dist/img/logo-dark.png');?>">
					<!-- <h1 class="page-title mt-2 d-none"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></h1> -->
					<div class="text-muted mt-2"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></div>
				</div>
				<?php echo isset($alert_message) ? $alert_message : ''; ?>
				<?php echo form_open(current_url(), array('method' => 'post', 'class'=>'mb-4')) ?>
				<?php echo form_hidden('form_action', 'forgot_password'); ?>
				<p class="">Don't worry, we'll send you an OTP to your email ID to reset your password.</p>
				<div class="form-group">
					<!-- <label for="user_email">Email ID or Username</label> -->
					<?php echo form_input(array('name' => 'user_email', 'value' => set_value('user_email'),'id' => 'user_email','class' => 'form-control','placeholder' => 'Please enter your email','maxlength' => '100','autofocus' => true,));?>
					<?php echo form_error('user_email'); ?>
				</div>
				<p class="small">Don't remember your email? <a href="mailto:admin@unitedexploration.com">Contact Administrator.</a></p>
				<?php echo form_button(array('name' => 'submit_btn','type' => 'submit','content' => 'Submit','class' => 'btn ci-btn-primary btn-primary btn-block'));?>			
				<?php echo form_close(); ?>
				<a class="btn-link" href="<?php echo base_url($this->router->class.'/login');?>">Go to login</a>
			</div>
		</div>
	</div>
</div>