<div class="row align-items-center justify-content-center no-gutters min-vh-100">
	<div class="col-8 col-md-6 col-lg-7 offset-md-1 order-md-2 mt-auto mt-md-0 pt-8 pb-4 py-md-11">
		<img src="<?php echo base_url('assets/dist/img/illustration-2.png');?>" alt="Login" class="img-fluid">
	</div>

	<div class="col-12 col-md-5 col-lg-4 order-md-1 mb-auto mb-md-0 pb-8 py-md-11">
		<h1 class="page-title mb-0 text-center"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></h1>
		<p class="mb-4 text-center text-muted">Password reset OTP will be sent to your registered email.</p>
		<?php echo isset($alert_message) ? $alert_message : ''; ?>
		<?php echo form_open(current_url(), array('method' => 'post', 'class'=>'mb-4')) ?>
		<?php echo form_hidden('form_action', 'forgot_password'); ?>
			<div class="form-group mb-5">
				<label for="user_email">Registered Email or Username</label>
				<?php echo form_input(array('name' => 'user_email','value' => set_value('user_email'),'id' => 'user_email','class'=> 'form-control','placeholder' => 'name@address.com','maxlength' => '100','autofocus' => true,));?>	
				<?php echo form_error('user_email'); ?>
			</div>
			<?php echo form_button(array('name' => 'submit_btn','type' => 'submit','content' => 'Submit','class' => 'btn btn-lg ci-btn-primary btn-primary btn-block'));?>			
		<?php echo form_close(); ?>
		<p class="mb-0 font-size-sm text-center text-muted">
			<a href="<?php echo base_url($this->router->class.'/login');?>">Go back to login</a>
		</p>
	</div>
</div>