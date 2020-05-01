<div class="row align-items-center justify-content-center no-gutters min-vh-100">
	<div class="card ci-card col-lg-7">
		<div class="card-body">
			<h1 class="page-title my-0"><?php echo isset($page_title) ? $page_title : 'Page Heading'; ?></h1>
			<div class="text-muted mb-2">Password reset OTP will be sent to your registered email.</div>
			<?php echo isset($alert_message) ? $alert_message : ''; ?>
			<div class="row justify-content-center mt-4">
				<div class="col-8 col-md-5 col-lg-6 order-md-2 mt-auto mt-md-0 pt-8 pb-4 py-md-11">
					<img src="<?php echo base_url('assets/dist/img/illustration-2.png');?>" alt="Login" class="img-fluid">
				</div>
				<div class="col-12 col-md-7 col-lg-6 order-md-1 mb-auto mb-md-0 pb-8 py-md-11">
				<?php echo form_open(current_url(), array('method' => 'post', 'class'=>'mb-4')) ?>
				<?php echo form_hidden('form_action', 'forgot_password'); ?>
					<div class="mb-3">
						<div class="input-group">
							<!-- <label for="user_email">Email ID or Username</label> -->
							<div class="input-group-prepend"><span class="input-group-text" id="basic-addon1"><?php echo $this->common_lib->get_icon('email'); ?></span></div>
							<?php echo form_input(array('name' => 'user_email', 'value' => set_value('user_email'),'id' => 'user_email','class' => 'form-control','placeholder' => 'Please enter your email','maxlength' => '100','autofocus' => true,));?>
						</div>
						<?php echo form_error('user_email'); ?>
					</div>
					<?php echo form_button(array('name' => 'submit_btn','type' => 'submit','content' => 'Submit','class' => 'btn ci-btn-primary btn-primary btn-block'));?>			
				<?php echo form_close(); ?>
					<p class="mb-0 text-muted"><a href="<?php echo base_url($this->router->class.'/login');?>">Go to login</a></p>
				</div>
			</div>

		</div>
	</div>
</div>